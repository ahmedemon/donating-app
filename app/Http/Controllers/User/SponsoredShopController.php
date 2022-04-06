<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SponsorItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SponsoredShopController extends Controller
{
    public function index()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $sponsor_items = SponsorItem::where('status', 1)->latest()->paginate(12);
        $headerTitle = "Sponsored Shop";
        return view('user.sponsored_shop.index', compact('headerTitle', 'sponsor_items'));
    }
}
