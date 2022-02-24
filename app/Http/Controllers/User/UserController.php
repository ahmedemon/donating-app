<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Traits\WalletTrait;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    use WalletTrait;
    public function index()
    {
        $user_id = Auth::user()->id;

        $wallet = $this->allWallets($user_id);
        $wallet_name = $this->getWalletNames($user_id);

        return view('user.dashboard', compact('wallet', 'wallet_name'));
    }
}
