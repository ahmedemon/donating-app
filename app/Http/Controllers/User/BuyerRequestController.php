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
        $headerTitle = "Receiver Request List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('owner_id', $user_id)->with('donation')->latest()->get();
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
                ->addColumn('admin_approval', function ($data) {
                    if ($data->gotted == 1) {
                        return '<span class="badge badge-secondary">Delivered</span>';
                    } else {
                        if ($data->admin_approval == 0) {
                            return '<span class="badge badge-primary">Pending</span>';
                        }
                        if ($data->admin_approval == 1) {
                            return '<span class="badge badge-secondary">Approved</span>';
                        }
                        if ($data->admin_approval == 2) {
                            return '<span class="badge badge-danger">Rejected</span>';
                        }
                    }
                })
                ->addColumn('owner_approval', function ($data) {
                    if ($data->admin_approval == 2) {
                        return '<span class="badge badge-danger">Rejected by Admin</span>';
                    } else {
                        if ($data->owner_approval == 0) {
                            if ($data->admin_approval == 0) {
                                return '<span class="badge badge-primary">Pending</span>';
                            } else {
                                return '<span class="badge badge-primary">Pending</span>
                                <a href="' . route('buyer-request.proceed.request', $data->id) . '" class="btn btn-secondary shadow btn-xs sharp" onClick="' . "return confirm('Are you sure you want proceed this request?');" . '">
                                    <i class="fa fa-check"></i>
                                </a>';
                            }
                        }
                        if ($data->owner_approval == 1) {
                            if ($data->gotted == 1) {
                                return '<span class="badge badge-secondary">Approved</span>';
                            }
                            return '<span class="badge badge-primary">Processing</span>';
                        }
                        if ($data->owner_approval == 2) {
                            return '<span class="badge badge-danger">Rejected</span>';
                        }
                    }
                })
                ->editColumn('date', function ($data) {
                    return !is_null($data->created_at) ? date('M d, Y, h:i a', strtotime($data->created_at)) : '-';
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 2 || $data->admin_approval == 2) {
                        return '<a href="javascript:void();" class="btn btn-dark shadow btn-xs sharp disabled">
                            <i class="fa fa-times"></i>
                        </a>';
                    } else {
                        if ($data->gotted == 1) {
                            if ($data->status == 1) {
                                $actionBtn = '<span class="badge badge-info">Completed <i class="fa fa-check"></i></span>';
                            } else {
                                $actionBtn = '
                                    <a href="' . route('buyer-request.approve.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="' . "return confirm('Are you sure you want to collect your reward?');" . '">
                                        Collect Point
                                    </a>
                                ';
                                return $actionBtn;
                            }
                        }
                        if ($data->gotted == 0) {
                            $actionBtn = '
                                <span class="badge badge-secondary shadow">
                                    Waiting For Receiver Confirmation.
                                </span>
                                <a href="' . route('buyer-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs sharp" onClick="' . "return confirm('Are you sure you want to reject receiver request?');" . '">
                                    <i class="fa fa-times"></i>
                                </a>
                            ';
                        }
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'admin_approval', 'product', 'user', 'owner_approval', 'date'])
                ->make(true);
        }
        return view('user.buyer_request.pending', compact('headerTitle'));
    }


    public function proceed($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $approve_request = PurchasedProduct::find($id);
        $approve_request->owner_approval = 1;
        $approve_request->save();

        toastr()->success('Request is being processing!', 'Proceed!');
        return redirect()->back();
    }
    public function approve($id) //collect point
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $approve_request = PurchasedProduct::find($id);
        $approve_request->status = 1;
        $approve_request->owner_approval = 1;
        $approve_request->save();

        $donation = Donation::find($approve_request->product_id);
        $donation->status = 3;
        $donation->is_purchased = 1;
        $donation->save();


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

        toastr()->success('You`ve just earned ' . $approve_request->product_point . ' point!', 'Credit Notice!');
        toastr()->success('Request successfully approved!', 'Approved!');
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
        if ($approve_request->gotted == 1) {
            toastr()->info('Product is delivered you can`t reject it now! Please collect your reward by clicking `Collect Point` button!', 'Message!');
            return redirect()->back();
        }
        $approve_request->status = 2;
        $approve_request->owner_approval = 2;
        $approve_request->save();

        $donation = Donation::find($approve_request->product_id);
        $donation->status = 1;
        $donation->requested_by = null;
        $donation->is_purchased = 0;
        $donation->save();

        toastr()->error('Request rejected!', 'Rejected!');
        toastr()->info('Product added to shelf again!');
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
        toastr()->info('Request recycled successfylly!', 'Recycled!');
        return redirect()->back();
    }

    public function buyerProfile($id)
    {
        $buyer = User::find($id);
        $headerTitle = $buyer->name;
        $pageTitle = "Receiver Profile";
        return view('user.buyer_request.buyer_profile', compact('buyer', 'headerTitle', 'pageTitle'));
    }

    public function view($id)
    {
        $view = PurchasedProduct::find($id);
        if ($view->seen == 0 || $view->gotted == 0) {
            $view->seen = 1;
            $view->save();
            return redirect()->route('buyer-request.pending.request');
        } else {
            $view->seen = 1;
            $view->save();
            return redirect()->route('buyer-request.pending.request');
        }
    }

    public function notifications()
    {
        $notifications = PurchasedProduct::where('owner_id', Auth::user()->id)->latest()->paginate(100);
        return view('user.notifications', compact('notifications'));
    }
}
