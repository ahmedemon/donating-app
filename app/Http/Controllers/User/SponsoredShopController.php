<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SponsorItem;
class SponsoredShopController extends Controller
{
    public function index()
    {
        $sponsor_items = SponsorItem::where('status', 1)->latest()->paginate(5);
        $headerTitle = "Sponsored Shop";
        return view('user.sponsored_shop.index', compact('headerTitle', 'sponsor_items'));
    }
}
