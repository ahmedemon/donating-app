<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search()
    {
        $auth = Auth::user()->id ?? null;
        $this->validate(request(), [
            'search' => 'string|max:255',
        ]);
        $search = request()->search;
        if ($auth) {
            $products = Donation::where('user_id', '!=', $auth)->where('title', 'LIKE', '%' . $search . '%')->orWhere('description', 'LIKE', '%' . $search . '%')
                ->where('status', 1)->where('is_purchased', 0)->paginate(10);
        }
        $products = Donation::where('title', 'LIKE', '%' . $search . '%')->orWhere('description', 'LIKE', '%' . $search . '%')
            ->where('status', 1)->where('is_purchased', 0)->paginate(10);
        return view('search-result', compact('products'));
    }
}
