<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\CurrentBalance;
use App\Helpers\FileManager;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'phone'    => ['required', 'numeric'],
            'gender'   => ['required'],
            'image' => ['nullable'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = new FileManager();
            $image = $request->file('image');
            $file->folder('user')
                ->prefix('profile')
                ->postfix(Str::random(10))
                ->upload($image);
            $request->image = $file->getName();
        }

        return $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'username' => $request->username,
            'phone'    => $request->phone,
            'gender'   => $request->gender,
            'image' => $request->image,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request);
        $current_balance = new CurrentBalance();
        $current_balance->user_id = $user->id;
        $current_balance->credit_point = 2000;
        $current_balance->save();

        event(new Registered($user));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        toastr()->success('You`ve registered successfully!', 'Success!');
        toastr()->info('You`re profile is not activate. Please wait for admin approval!', 'Notice!');
        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
        // : redirect(route('user.frontend'));
    }
}
