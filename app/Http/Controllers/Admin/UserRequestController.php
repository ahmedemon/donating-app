<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Helpers\Traits\WalletTrait;
use App\Http\Controllers\Controller;
use App\Models\PurchasedProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserRequestController extends Controller
{
    use WalletTrait;
    public function pending()
    {
        $headerTitle = "User Request - Pending List";
        if (request()->ajax()) {
            $data = User::where('is_approve', 0)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_info', function ($data) {
                    $name = $data->name . ' <span class="small text-warning">(' . $data->username . ')</span>';
                    $email = $data->email ?? ' <span class="badge badge-danger">Not Found</span>';
                    $phone = '0' . $data->phone ?? ' <span class="badge badge-danger">Not Found</span>';
                    $gender = $data->gender ?? ' <span class="badge badge-danger">Not Found</span>';
                    if ($data->is_active == 1) {
                        $is_active = '<a href="' . route('admin.user-request.deactive.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Deactive</a>';
                    } else {
                        $is_active = '<a href="' . route('admin.user-request.active.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Active</a>';
                    }
                    if ($data->is_blocked == 1) {
                        $is_blocked = '<a href="' . route('admin.user-request.unblock.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Unblock</a>';
                    } else {
                        $is_blocked = '<a href="' . route('admin.user-request.block.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Block</a>';
                    }
                    $joining_date = 'Joining: ' . date('M d, Y | h:i a', strtotime($data->created_at));
                    return $name . '<br>' . $email . '<br>' . $phone . '<br>' . $joining_date . '<hr class="my-2">' . $is_active . $is_blocked;
                })
                ->editColumn('image', function ($data) {
                    return '<img class="rounded-circle" style="border: 2px solid darkgray;" src="' . asset($data->image == !null ? 'storage/user/' . $data->image : 'avatar.png') . '" height="100" width="100">';
                })
                ->addColumn('current_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['current_balance'];
                })
                ->addColumn('total_purchased_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['total_purchased_balance'];
                })
                ->addColumn('total_sale', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_sale'];
                })
                ->addColumn('total_purchased', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_purchased'];
                })
                ->addColumn('action', function ($data) {
                    if ($data->is_approve == 1) {
                        $approveOrReject = '<a href="' . route('admin.user-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Reject</a>';
                    } else {
                        $approveOrReject = '<a href="' . route('admin.user-request.approve.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Approve</a>';
                    }
                    $action = '
                        <a href="' . route('admin.user-request.edit.request', $data->id) . '" class="btn btn-info shadow btn-xs sharp" onClick="return confirm("Are you sure? You want to edit this user?")">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.user-request.destroy.request", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $approveOrReject . $action;
                })
                ->rawColumns(['user_info', 'image', 'action', 'current_balance', 'total_purchased_balance', 'total_sale', 'total_purchased'])
                ->make(true);
        }
        return view('admin.user_request.pending', compact('headerTitle'));
    }
    public function approved()
    {
        $headerTitle = "User Request - Approved List";
        if (request()->ajax()) {
            $data = User::where('is_active', 1)->where('is_approve', 1)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_info', function ($data) {
                    $name = $data->name . ' <span class="small text-warning">(' . $data->username . ')</span>';
                    $email = $data->email ?? ' <span class="badge badge-danger">Not Found</span>';
                    $phone = '0' . $data->phone ?? ' <span class="badge badge-danger">Not Found</span>';
                    $gender = $data->gender ?? ' <span class="badge badge-danger">Not Found</span>';
                    if ($data->is_active == 1) {
                        $is_active = '<a href="' . route('admin.user-request.deactive.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Deactive</a>';
                    } else {
                        $is_active = '<a href="' . route('admin.user-request.active.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Active</a>';
                    }
                    if ($data->is_blocked == 1) {
                        $is_blocked = '<a href="' . route('admin.user-request.unblock.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Unblock</a>';
                    } else {
                        $is_blocked = '<a href="' . route('admin.user-request.block.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Block</a>';
                    }
                    $joining_date = 'Joining: ' . date('M d, Y | h:i a', strtotime($data->created_at));
                    return $name . '<br>' . $email . '<br>' . $phone . '<br>' . $joining_date . '<hr class="my-2">' . $is_active . $is_blocked;
                })
                ->editColumn('image', function ($data) {
                    return '<img class="rounded-circle" style="border: 2px solid darkgray;" src="' . asset($data->image == !null ? 'storage/user/' . $data->image : 'avatar.png') . '" height="100" width="100">';
                })
                ->addColumn('current_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['current_balance'];
                })
                ->addColumn('total_purchased_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['total_purchased_balance'];
                })
                ->addColumn('total_sale', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_sale'];
                })
                ->addColumn('total_purchased', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_purchased'];
                })
                ->addColumn('action', function ($data) {
                    if ($data->is_approve == 1) {
                        $approveOrReject = '<a href="' . route('admin.user-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Reject</a>';
                    } else {
                        $approveOrReject = '<a href="' . route('admin.user-request.approve.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Approve</a>';
                    }
                    $action = '
                        <a href="' . route('admin.user-request.edit.request', $data->id) . '" class="btn btn-info shadow btn-xs sharp" onClick="return confirm("Are you sure? You want to edit this user?")">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.user-request.destroy.request", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $approveOrReject . $action;
                })
                ->rawColumns(['user_info', 'image', 'action', 'current_balance', 'total_purchased_balance', 'total_sale', 'total_purchased'])
                ->make(true);
        }
        return view('admin.user_request.approved', compact('headerTitle'));
    }
    public function rejected()
    {
        $headerTitle = "User Request - Rejected List";
        if (request()->ajax()) {
            $data = User::where('is_active', 2)->where('is_approve', 2)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_info', function ($data) {
                    $name = $data->name . ' <span class="small text-warning">(' . $data->username . ')</span>';
                    $email = $data->email ?? ' <span class="badge badge-danger">Not Found</span>';
                    $phone = '0' . $data->phone ?? ' <span class="badge badge-danger">Not Found</span>';
                    $gender = $data->gender ?? ' <span class="badge badge-danger">Not Found</span>';
                    if ($data->is_active == 1) {
                        $is_active = '<a href="' . route('admin.user-request.deactive.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Deactive</a>';
                    } else {
                        $is_active = '<a href="' . route('admin.user-request.active.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Active</a>';
                    }
                    if ($data->is_blocked == 1) {
                        $is_blocked = '<a href="' . route('admin.user-request.unblock.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Unblock</a>';
                    } else {
                        $is_blocked = '<a href="' . route('admin.user-request.block.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Block</a>';
                    }
                    $joining_date = 'Joining: ' . date('M d, Y | h:i a', strtotime($data->created_at));
                    return $name . '<br>' . $email . '<br>' . $phone . '<br>' . $joining_date . '<hr class="my-2">' . $is_active . $is_blocked;
                })
                ->editColumn('image', function ($data) {
                    return '<img class="rounded-circle" style="border: 2px solid darkgray;" src="' . asset($data->image == !null ? 'storage/user/' . $data->image : 'avatar.png') . '" height="100" width="100">';
                })
                ->addColumn('current_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['current_balance'];
                })
                ->addColumn('total_purchased_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['total_purchased_balance'];
                })
                ->addColumn('total_sale', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_sale'];
                })
                ->addColumn('total_purchased', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_purchased'];
                })
                ->addColumn('action', function ($data) {
                    if ($data->is_approve == 1) {
                        $approveOrReject = '<a href="' . route('admin.user-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Reject</a>';
                    } else {
                        $approveOrReject = '<a href="' . route('admin.user-request.approve.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Approve</a>';
                    }
                    $action = '
                        <a href="' . route('admin.user-request.edit.request', $data->id) . '" class="btn btn-info shadow btn-xs sharp" onClick="return confirm("Are you sure? You want to edit this user?")">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.user-request.destroy.request", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $approveOrReject . $action;
                })
                ->rawColumns(['user_info', 'image', 'action', 'current_balance', 'total_purchased_balance', 'total_sale', 'total_purchased'])
                ->make(true);
        }
        return view('admin.user_request.rejected', compact('headerTitle'));
    }
    public function deactivated()
    {
        $headerTitle = "User Request - Deactivated List";
        if (request()->ajax()) {
            $data = User::where('is_active', 0)->where('is_approve', 1)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_info', function ($data) {
                    $name = $data->name . ' <span class="small text-warning">(' . $data->username . ')</span>';
                    $email = $data->email ?? ' <span class="badge badge-danger">Not Found</span>';
                    $phone = '0' . $data->phone ?? ' <span class="badge badge-danger">Not Found</span>';
                    $gender = $data->gender ?? ' <span class="badge badge-danger">Not Found</span>';
                    if ($data->is_active == 1) {
                        $is_active = '<a href="' . route('admin.user-request.deactive.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Deactive</a>';
                    } else {
                        $is_active = '<a href="' . route('admin.user-request.active.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Active</a>';
                    }
                    if ($data->is_blocked == 1) {
                        $is_blocked = '<a href="' . route('admin.user-request.unblock.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Unblock</a>';
                    } else {
                        $is_blocked = '<a href="' . route('admin.user-request.block.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Block</a>';
                    }
                    $joining_date = 'Joining: ' . date('M d, Y | h:i a', strtotime($data->created_at));
                    return $name . '<br>' . $email . '<br>' . $phone . '<br>' . $joining_date . '<hr class="my-2">' . $is_active . $is_blocked;
                })
                ->editColumn('image', function ($data) {
                    return '<img class="rounded-circle" style="border: 2px solid darkgray;" src="' . asset($data->image == !null ? 'storage/user/' . $data->image : 'avatar.png') . '" height="100" width="100">';
                })
                ->addColumn('current_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['current_balance'];
                })
                ->addColumn('total_purchased_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['total_purchased_balance'];
                })
                ->addColumn('total_sale', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_sale'];
                })
                ->addColumn('total_purchased', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_purchased'];
                })
                ->addColumn('action', function ($data) {
                    if ($data->is_approve == 1) {
                        $approveOrReject = '<a href="' . route('admin.user-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Reject</a>';
                    } else {
                        $approveOrReject = '<a href="' . route('admin.user-request.approve.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Approve</a>';
                    }
                    $action = '
                        <a href="' . route('admin.user-request.edit.request', $data->id) . '" class="btn btn-info shadow btn-xs sharp" onClick="return confirm("Are you sure? You want to edit this user?")">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.user-request.destroy.request", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $approveOrReject . $action;
                })
                ->rawColumns(['user_info', 'image', 'action', 'current_balance', 'total_purchased_balance', 'total_sale', 'total_purchased'])
                ->make(true);
        }
        return view('admin.user_request.deactivated', compact('headerTitle'));
    }
    public function blocked()
    {
        $headerTitle = "User Request - Blocked List";
        if (request()->ajax()) {
            $data = User::where('is_blocked', 1)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_info', function ($data) {
                    $name = $data->name . ' <span class="small text-warning">(' . $data->username . ')</span>';
                    $email = $data->email ?? ' <span class="badge badge-danger">Not Found</span>';
                    $phone = '0' . $data->phone ?? ' <span class="badge badge-danger">Not Found</span>';
                    $gender = $data->gender ?? ' <span class="badge badge-danger">Not Found</span>';
                    if ($data->is_active == 1) {
                        $is_active = '<a href="' . route('admin.user-request.deactive.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Deactive</a>';
                    } else {
                        $is_active = '<a href="' . route('admin.user-request.active.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Active</a>';
                    }
                    if ($data->is_blocked == 1) {
                        $is_blocked = '<a href="' . route('admin.user-request.unblock.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Unblock</a>';
                    } else {
                        $is_blocked = '<a href="' . route('admin.user-request.block.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Block</a>';
                    }
                    $joining_date = 'Joining: ' . date('M d, Y | h:i a', strtotime($data->created_at));
                    return $name . '<br>' . $email . '<br>' . $phone . '<br>' . $joining_date . '<hr class="my-2">' . $is_active . $is_blocked;
                })
                ->editColumn('image', function ($data) {
                    return '<img class="rounded-circle" style="border: 2px solid darkgray;" src="' . asset($data->image == !null ? 'storage/user/' . $data->image : 'avatar.png') . '" height="100" width="100">';
                })
                ->addColumn('current_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['current_balance'];
                })
                ->addColumn('total_purchased_balance', function ($data) {
                    return '<i class="fas fa-coins text-warning"></i> ' . $this->allWallets($data->id)['total_purchased_balance'];
                })
                ->addColumn('total_sale', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_sale'];
                })
                ->addColumn('total_purchased', function ($data) {
                    return '<i class="fas fa-gift text-warning"></i> ' . $this->allWallets($data->id)['total_purchased'];
                })
                ->addColumn('action', function ($data) {
                    if ($data->is_approve == 1) {
                        $approveOrReject = '<a href="' . route('admin.user-request.reject.request', $data->id) . '" class="btn btn-danger shadow btn-xs" onClick="return confirm("Are you sure?")">Reject</a>';
                    } else {
                        $approveOrReject = '<a href="' . route('admin.user-request.approve.request', $data->id) . '" class="btn btn-secondary shadow btn-xs" onClick="return confirm("Are you sure?")">Approve</a>';
                    }
                    $action = '
                        <a href="' . route('admin.user-request.edit.request', $data->id) . '" class="btn btn-info shadow btn-xs sharp" onClick="return confirm("Are you sure? You want to edit this user?")">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.user-request.destroy.request", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $approveOrReject . $action;
                })
                ->rawColumns(['user_info', 'image', 'action', 'current_balance', 'total_purchased_balance', 'total_sale', 'total_purchased'])
                ->make(true);
        }
        return view('admin.user_request.blocked', compact('headerTitle'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user_request.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'nullable',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;

        $upload = new FileManager();
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $upload->folder('user')->prefix('image')->update($image, $user->image);
            $user->image = $upload->getName();
        }
        $user->save();

        toastr()->success('User Updated!', 'User has been updated successfully!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        toastr()->error('Deleted!', 'User has been deleted!');
        return redirect()->back();
    }

    public function approve($id)
    {
        $user = User::find($id);
        $user->is_approve = 1;
        $user->is_active = 1;
        $user->save();
        toastr()->success('Approved!', 'User approved successfully!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $user = User::find($id);
        $user->is_approve = 2;
        $user->is_active = 0;
        $user->save();
        toastr()->error('Rejected!', 'User rejected!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $user = User::find($id);
        $user->is_approve = 0;
        $user->is_active = 0;
        $user->save();
        toastr()->error('Rejected!', 'User rejected!');
        return redirect()->back();
    }
    public function active($id)
    {
        $user = User::find($id);
        $user->is_active = 1;
        $user->save();
        toastr()->error('Activate!', 'User Activated!');
        return redirect()->back();
    }
    public function deactive($id)
    {
        $user = User::find($id);
        $user->is_active = 0;
        $user->save();
        toastr()->error('Deactivate!', 'User Deactivated!');
        return redirect()->back();
    }
    public function block($id)
    {
        $user = User::find($id);
        $user->is_blocked = 1;
        $user->is_active = 0;
        $user->save();
        toastr()->error('Blocked!', 'User Blocked!');
        return redirect()->back();
    }
    public function unblock($id)
    {
        $user = User::find($id);
        $user->is_blocked = 0;
        $user->is_active = 1;
        $user->save();
        toastr()->success('Unblocked!', 'User Unblocked!');
        return redirect()->back();
    }
}
