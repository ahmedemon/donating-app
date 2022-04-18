<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CurrentBalance;
use App\Models\Donation;
use App\Models\PurchasedProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BuyerRequestController extends Controller
{

    public function pending()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Receiver Request - Pending List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('owner_id', $user_id)->where('status', 0)->where('admin_approval', 1)->where('owner_approval', 0)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category_name = $data->donation->category->name ?? '--';
                    $category = 'Category: ' . '<span>' . '<a style="color: darkorange !important;" href="' . route('category.index', $data->donation->category->id) . '">' . $category_name . '</a>' . '</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point) . ' Points' . '<br>' . $category . '<br>' .
                        '<a class="btn btn-secondary btn-xs" href="' . route('buyer-request.buyer.profile', $data->user->id) . '" onClick="' . "return confirm('You want to view receiver profile?');" . '">View Receiver Profile</a>' .
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
                        return '<span class="badge badge-secondary">Accepted</span>';
                    }
                })
                ->editColumn('date', function ($data) {
                    return !is_null($data->created_at) ? date('M d, Y, h:i a', strtotime($data->created_at)) : '-';
                })
                ->addColumn('action', function ($data) {
                    if ($data->gotted == 1) {
                        $actionBtn = '
                            <a href="' . route('buyer-request.approve.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="' . "return confirm('Are you sure you want to collect your reward?');" . '">
                                Collect Point
                            </a>
                            <a href="' . route('buyer-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs sharp" onClick="' . "return confirm('Are you sure you want to reject receiver request?');" . '">
                                <i class="fa fa-times"></i>
                            </a>
                        ';
                    }
                    if ($data->gotted == 0) {
                        $actionBtn = '
                            <span class="badge badge-secondary shadow">
                                Waiting For Confirmation.
                            </span>
                            <a href="' . route('buyer-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs sharp" onClick="' . "return confirm('Are you sure you want to reject receiver request?');" . '">
                                <i class="fa fa-times"></i>
                            </a>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user', 'owner_approval', 'date'])
                ->make(true);
        }
        return view('user.buyer_request.pending', compact('headerTitle'));
    }

    public function completed()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Receiver Request - Delivered Product List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('owner_id', $user_id)->whereIn('status', [1, 3])->where('admin_approval', 1)->where('owner_approval', 1)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category_name = $data->donation->category->name ?? '--';
                    $category = 'Category: ' . '<span>' . '<a style="color: darkorange !important;" href="' . route('category.index', $data->donation->category->id) . '">' . $category_name . '</a>' . '</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point) . ' Points' . '<br>' . $category . '<br>' .
                        '<a class="btn btn-secondary btn-xs" href="' . route('buyer-request.buyer.profile', $data->user->id) . '" onClick="' . "return confirm('You want to view receiver profile?');" . '">View Receiver Profile</a>' .
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
                        return '<span class="badge badge-secondary">Accepted</span>';
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
        return view('user.buyer_request.completed', compact('headerTitle'));
    }

    public function rejected()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Receiver Request - Rejected List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('owner_id', $user_id)->where('status', 2)->where('admin_approval', 1)->where('owner_approval', 2)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category_name = $data->donation->category->name ?? '--';
                    $category = 'Category: ' . '<span>' . '<a style="color: darkorange !important;" href="' . route('category.index', $data->donation->category->id) . '">' . $category_name . '</a>' . '</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point) . ' Points' . '<br>' . $category . '<br>' .
                        '<a class="btn btn-secondary btn-xs" href="' . route('buyer-request.buyer.profile', $data->user->id) . '" onClick="' . "return confirm('You want to view receiver profile?');" . '">View Receiver Profile</a>' .
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
                        return '<span class="badge badge-secondary">Accepted</span>';
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
                        <a href="' . route('buyer-request.recall.request', $data->id) . '" class="btn btn-dark shadow btn-xs sharp">
                            <i class="fa fa-check"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user', 'owner_approval', 'date'])
                ->make(true);
        }
        return view('user.buyer_request.rejected', compact('headerTitle'));
    }

    public function approve($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $approve_request = PurchasedProduct::find($id);
        $approve_request->status = 1;
        $approve_request->owner_approval = 1;

        $donation = Donation::find($approve_request->product_id);
        $donation->status = 3;
        $donation->is_purchased = 1;

        $approve_request->save();

        CurrentBalance::insert(
            [
                'user_id' => $approve_request->user_id,
                'debit_point' => $approve_request->product_point,
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
        CurrentBalance::insert(
            [
                'user_id' => $approve_request->owner_id,
                'credit_point' => $approve_request->product_point,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        toastr()->success('Credit Notice!', 'You`ve just earned ' . $approve_request->product_point . ' point!');
        toastr()->success('Approved!', 'Request successfully approved!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $approve_request = PurchasedProduct::find($id);
        $approve_request->status = 2;
        $approve_request->owner_approval = 2;

        $donation = Donation::find($approve_request->product_id);
        $donation->status = 1;
        $donation->is_purchased = 0;

        $approve_request->save();
        toastr()->error('Rejected!', 'Request rejected!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $approve_request = PurchasedProduct::find($id);
        $approve_request->status = 0;
        $approve_request->owner_approval = 0;
        $approve_request->save();
        toastr()->info('Recycled!', 'Request recycled successfylly!');
        return redirect()->back();
    }

    public function buyerProfile($id)
    {
        $buyer = User::find($id);
        $headerTitle = $buyer->name;
        $pageTitle = "Receiver Profile";
        return view('user.buyer_request.buyer_profile', compact('buyer', 'headerTitle', 'pageTitle'));
    }
}
