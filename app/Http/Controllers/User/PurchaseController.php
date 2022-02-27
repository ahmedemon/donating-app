<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\PurchasedProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    public function purchaseRequest($id)
    {
        $user_id = Auth::user()->id;
        $product = Donation::find($id);
        $product->requested_by = $user_id;
        $product->save();
        PurchasedProduct::create([
            'product_id' => $id,
            'user_id' => $user_id,
            'product_point' => $product->point,
            'date' => date('Y-m-d'),
            'status' => 0,
            'owner_approval' => 0,
        ]);
        toastr()->info('Request sent successfully to the product woner! Please wait form confirmation', 'Success!');
        return redirect()->back();
    }

    public function pending()
    {
        $user_id = Auth::user()->id;
        $headerTitle = "Requested Product - Pending List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('user_id', $user_id)->where('status', 0)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function($data){
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->donation->category->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category = 'Owner: ' . '<span style="color: darkorange !important; border-bottom: 2px solid darkorange !important;">'. $user_name .'</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point). ' Points' . '<br>' . $category . '<br><br>' . $image;
                })
                // ->addColumn('user', function ($data) {
                //     return $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                // })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="javascript:void();" class="btn btn-dark shadow btn-xs sharp disabled">
                            <i class="fa fa-check"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user'])
                ->make(true);
        }
        return view('user.ordered_items.pending', compact('headerTitle'));
    }

    public function approved()
    {
        $user_id = Auth::user()->id;
        $headerTitle = "Requested Product - Approved List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('user_id', $user_id)->where('status', 1)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function($data){
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->donation->category->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category = 'Owner: ' . '<span style="color: darkorange !important; border-bottom: 2px solid darkorange !important;">'. $user_name .'</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . $point . '<br>' . $category . '<br><br>' . $image;
                })
                // ->addColumn('user', function ($data) {
                //     return $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                // })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="javascript:void();" class="btn btn-dark shadow btn-xs sharp disabled">
                            <i class="fa fa-check"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user'])
                ->make(true);
        }
        return view('user.ordered_items.approved', compact('headerTitle'));
    }

    public function rejected()
    {
        $user_id = Auth::user()->id;
        $headerTitle = "Requested Product - Rejected List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('user_id', $user_id)->where('status', 2)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function($data){
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->donation->category->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category = 'Owner: ' . '<span style="color: darkorange !important; border-bottom: 2px solid darkorange !important;">'. $user_name .'</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . $point . '<br>' . $category . '<br><br>' . $image;
                })
                // ->addColumn('user', function ($data) {
                //     return $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                // })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="javascript:void();" class="btn btn-dark shadow btn-xs sharp disabled">
                            <i class="fa fa-check"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user'])
                ->make(true);
        }
        return view('user.ordered_items.rejected', compact('headerTitle'));
    }
}
