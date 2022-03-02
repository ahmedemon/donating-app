<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\PurchasedProduct;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BuyerRequestController extends Controller
{

    public function pending()
    {
        $headerTitle = "Buyer Request - Pending List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('admin_approval', 0)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function($data){
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category_name = $data->donation->category->name ?? '--';
                    $category = 'Category: ' . '<span>'. '<a style="color: darkorange !important;" href="'. route('category.index', $data->donation->category->id).'">'.$category_name.'</a>' .'</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point). ' Points' . '<br>' . $category . '<br>' .
                           'Owner: ' . '<a style="color: darkorange !important;" href="'. route('category.index', $data->user->id).'">'.$user_name.'</a>' .
                           '<br><br>' . $image;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('owner_approval', function ($data) {
                    if ($data->owner_approval == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->owner_approval == 1) {
                        return '<span class="badge badge-danger">Accepted</span>';
                    }
                })
                ->editColumn('date', function ($data) {
                    return !is_null($data->created_at) ? date('M d, Y, h:i a', strtotime($data->created_at)) : '-';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="'. route('admin.buyer-request-admin-approval.approve.request', $data->id) .'" class="btn btn-secondary shadow btn-xs sharp" onClick="return confirm("Are you sure?")">
                            <i class="fa fa-check"></i>
                        </a>
                        <a href="'. route('admin.buyer-request-admin-approval.reject.request', $data->id) .'" class="btn btn-danger shadow btn-xs sharp">
                            <i class="fa fa-times"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user', 'owner_approval', 'date'])
                ->make(true);
        }
        return view('admin.buyer_request.pending', compact('headerTitle'));
    }

    public function completed()
    {
        $headerTitle = "Buyer Request - Completed List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('admin_approval', 1)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function($data){
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category_name = $data->donation->category->name ?? '--';
                    $category = 'Category: ' . '<span>'. '<a style="color: darkorange !important;" href="'. route('category.index', $data->donation->category->id).'">'.$category_name.'</a>' .'</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point). ' Points' . '<br>' . $category . '<br>' .
                           'Owner: ' . '<a style="color: darkorange !important;" href="'. route('category.index', $data->user->id).'">'.$user_name.'</a>' .
                           '<br><br>' . $image;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('owner_approval', function ($data) {
                    if ($data->owner_approval == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->owner_approval == 1) {
                        return '<span class="badge badge-danger">Accepted</span>';
                    }
                })
                ->editColumn('date', function ($data) {
                    return !is_null($data->created_at) ? date('M d, Y, h:i a', strtotime($data->created_at)) : '-';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="javascript:void();" class="btn btn-dark shadow btn-xs sharp disabled">
                            <i class="fa fa-check"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user', 'owner_approval', 'date'])
                ->make(true);
        }
        return view('admin.buyer_request.completed', compact('headerTitle'));
    }

    public function rejected()
    {
        $headerTitle = "Buyer Request - Rejected List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('admin_approval', 2)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function($data){
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category_name = $data->donation->category->name ?? '--';
                    $category = 'Category: ' . '<span>'. '<a style="color: darkorange !important;" href="'. route('category.index', $data->donation->category->id).'">'.$category_name.'</a>' .'</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point). ' Points' . '<br>' . $category . '<br>' .
                           'Owner: ' . '<a style="color: darkorange !important;" href="'. route('category.index', $data->user->id).'">'.$user_name.'</a>' .
                           '<br><br>' . $image;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('owner_approval', function ($data) {
                    if ($data->owner_approval == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->owner_approval == 1) {
                        return '<span class="badge badge-danger">Accepted</span>';
                    }
                })
                ->editColumn('date', function ($data) {
                    return !is_null($data->created_at) ? date('M d, Y, h:i a', strtotime($data->created_at)) : '-';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="'. route('admin.buyer-request-admin-approval.recall.request', $data->id) .'" class="btn btn-info shadow btn-xs sharp">
                            <i class="fas fa-recycle"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user', 'owner_approval', 'date'])
                ->make(true);
        }
        return view('admin.buyer_request.rejected', compact('headerTitle'));
    }

    public function approve($id)
    {
        $approve_request = PurchasedProduct::find($id);
        $approve_request->admin_approval = 1;
        $approve_request->save();
        $donation = Donation::find($approve_request->id);
        $donation->status = 3;
        $donation->is_purchased = 1;
        $donation->save();
        toastr()->success('Approved!', 'Request successfully approved!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $approve_request = PurchasedProduct::find($id);
        $approve_request->admin_approval = 2;
        $approve_request->save();
        toastr()->error('Rejected!', 'Request rejected!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $approve_request = PurchasedProduct::find($id);
        $approve_request->admin_approval = 0;
        $approve_request->save();
        toastr()->info('Recycled!', 'Request recycled successfylly!');
        return redirect()->back();
    }
}
