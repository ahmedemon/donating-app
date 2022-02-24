<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
class DashboardController extends Controller
{
    public function index()
    {
        $products = Donation::where('status', 1)->where('is_purchased', 0)->get();
        return view('dashboard', compact('products'));
    }
}
