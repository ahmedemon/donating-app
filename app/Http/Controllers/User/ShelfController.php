<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Donation;
class ShelfController extends Controller
{
    public function index($id)
    {
        $category = Category::find($id);
        $pageTitle = 'Free Shelf | ' . $category->name;
        $donations = Donation::where('status', 1)->where('category_id', $category->id)->get();
        return view('user.free_shelf.index', compact('category', 'donations', 'pageTitle'));
    }
}
