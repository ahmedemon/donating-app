<?php

namespace App\Http\Controllers\User;

use App\Helpers\FileManager;
use App\Helpers\Traits\WalletTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    use WalletTrait;
    public function index()
    {
        $wallet = $this->allWallets(Auth::user()->id);
        return view('user.profile.index', compact('wallet'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.profile.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'phone'       => 'required|numeric|min:10|unique:users,phone,' . $id,
            'address'     => 'required|string',
        ]);
        $user = User::find($id);
        $user->update($request->except('_token', '_method'));
        $user->save();
        toastr()->success("Profile Updated Successfully.", "Success!");
        return redirect()->route('profile.index')->with('success', 'Your Profile Is Updated Successfully!');
    }
    public function image(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->all();

        $parts = explode(";base64,", $input['base64image']);
        $type_aux = explode("image/", $parts[0]);
        $type = $type_aux[1];
        $image_base64 = base64_decode($parts[1]);

        // file naming convension
        $separator = '-';
        $prefix = 'profile-';
        $postfix = '';
        $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
        // file naming convension

        Storage::disk('profile')->delete($user->image);
        Storage::disk('profile')->put($filename, $image_base64);

        $user->image = $filename;
        $user->save();
        toastr()->success("Profile Picture Updated Successfully.", "Success!");
        return redirect()->route('profile.index');
    }
}
