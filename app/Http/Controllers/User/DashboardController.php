<?php

namespace App\Http\Controllers\User;

use App\Helpers\Traits\TopBuyerTrait;
use App\Helpers\Traits\TopDonatorTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\PurchasedProduct;
use App\Models\User;

class DashboardController extends Controller
{
    use TopDonatorTrait, TopBuyerTrait;
    public function index()
    {
        $total_donation = Donation::count();
        $donators = $this->topDonator();

        $total_purchase = PurchasedProduct::count();
        $buyers = $this->topBuyer();
        $products = Donation::latest()->where('status', 1)->where('is_purchased', 0)->take(10)->get();
        return view('dashboard', compact('products', 'donators', 'buyers', 'total_donation', 'total_purchase'));
    }
}
