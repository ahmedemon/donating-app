<?php

namespace App\Http\Controllers\User;

use App\Helpers\Traits\WalletTrait;
use App\Http\Controllers\Controller;
use App\Models\CurrentBalance;
use App\Models\Donation;
use App\Models\PurchasedProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    use WalletTrait;
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function purchaseRequest($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $product = Donation::find($id);
        if ($product->requested_by == !null) {
            toastr()->warning('This product is already has been purchased by another user!', 'Already Purchased!');
            return redirect()->back();
        }
        if ($product->user_id == $user_id) {
            toastr()->warning('This is your product You can`t buy this product!');
            return redirect()->back();
        }
        $current_balance = $this->allWallets(Auth::user()->id)['current_balance'];
        if ($current_balance < $product->point) {
            toastr()->error('You don`t have enough balance!', 'Insufficient Balance!');
            return redirect()->back();
        }

        $product->requested_by = $user_id;
        $product->is_purchased = 1;
        $product->save();
        PurchasedProduct::create([
            'product_id' => $id,
            'user_id' => $user_id,
            'owner_id' => $product->user_id,
            'product_point' => $product->point,
            'date' => date('Y-m-d'),
            'status' => 0,
            'owner_approval' => 0,
        ]);
        toastr()->success('You`ve just invested ' . $product->point . ' point for ' . $product->title . '!', 'Debit Notice!');
        toastr()->info('Request sent successfully to the product woner! Please wait form confirmation', 'Success!');
        return redirect()->back();
    }

    public function pending()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Requested Product - Pending List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('user_id', $user_id)->where('status', 0)->where('admin_approval', 0)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->donation->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category = 'Category: ' . '<span style="color: darkorange !important; border-bottom: 2px solid darkorange !important;">' . $data->donation->category->name . '</span>';
                    $image = '<img src="' . asset('storage/donation/' . $data->donation->images) . '" height="70" width="120">' ?? '-';
                    return $title . '<br>' . str_replace('.00', '', $point) . ' Points' . '<br>' . $category . '<br>' . 'Owner: ' . $user_name . '<br><br>' . $image;
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
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("my-order.cancel.request", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'product', 'user', 'owner_approval'])
                ->make(true);
        }
        return view('user.ordered_items.pending', compact('headerTitle'));
    }

    public function approved()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Requested Product - Approved List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('user_id', $user_id)->where('admin_approval', 1)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->donation->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category = 'Owner: ' . '<span style="color: darkorange !important; border-bottom: 2px solid darkorange !important;">' . $user_name . '</span>';
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
                ->addColumn('owner_approval', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->gotted == 0) {
                        return '
                            <a href="' . route("my-order.gotted.request", $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="' . "return confirm('Are you sure you`ve received your product?');" . '">
                                Got It <i class="fa fa-check"></i>
                            </a>
                        ';
                    } else {
                        return '<span class="badge badge-secondary">Gotted</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'owner_approval', 'product', 'user'])
                ->make(true);
        }
        return view('user.ordered_items.approved', compact('headerTitle'));
    }

    public function rejected()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Requested Product - Rejected List";
        if (request()->ajax()) {
            $data = PurchasedProduct::where('user_id', $user_id)->where('status', 2)->where('owner_approval', 2)->with('donation')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    $title = 'Title: ' . $data->donation->title ?? '<span class="badge badge-danger">Not Found</span>';
                    $price = 'Price: ' . $data->donation->price ?? '<span class="badge badge-danger">Not Found</span>';
                    $point = 'Cost: ' . $data->donation->point ?? '<span class="badge badge-danger">Not Found</span>';
                    $user_name = $data->donation->user->name ?? '<span class="badge badge-danger">Not Found</span>';
                    $category = 'Owner: ' . '<span style="color: darkorange !important; border-bottom: 2px solid darkorange !important;">' . $user_name . '</span>';
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
    public function cancel($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $purchase = PurchasedProduct::find($id);

        $product = Donation::find($purchase->product_id);
        $product->status = 1;
        $product->is_purchased = 0;
        $product->requested_by = null;
        $product->save();

        $purchase->delete();
        toastr()->error('Order Canceled!', 'Order calcel successfully!');
        return redirect()->back();
    }

    public function gotted($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $purchase = PurchasedProduct::find($id);
        $purchase->gotted = 1;
        $purchase->save();
        toastr()->info('Thanks for confirming that you got the product!', 'Product Gotted Successfully!');
        return redirect()->back();
    }
}
