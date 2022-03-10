<?php

namespace App\Http\Controllers\User;

use App\Helpers\FileManager;
use App\Helpers\Traits\WalletTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $upload = new FileManager();
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $upload->folder('user')->prefix('profile')->update($image, $user->image);
            $user->image = $upload->getName();
        }
        $user->save();
        toastr()->success("Profile Picture Updated Successfully.", "Success!");
        return redirect()->route('profile.index');
    }
}
