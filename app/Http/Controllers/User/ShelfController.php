<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class ShelfController extends Controller
{
    public function categories()
    {
        $pageTitle = "Shelf Categories";
        $categories = Category::paginate(20);
        return view('user.free_shelf.all_category', compact('categories', 'pageTitle'));
    }
    public function index($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $category = Category::find($id);
        $pageTitle = 'Free Shelf | ' . $category->name;
        $donations = Donation::where('status', 1)->where('requested_by', null)->where('category_id', $category->id)->paginate(12);
        return view('user.free_shelf.index', compact('category', 'donations', 'pageTitle'));
    }
}
