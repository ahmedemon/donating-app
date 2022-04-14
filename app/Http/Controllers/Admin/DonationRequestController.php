<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Category;
use Yajra\DataTables\DataTables;
class DonationRequestController extends Controller
{
    public function pending()
    {
        $headerTitle = "Donation Request | Pending";
        if (request()->ajax()) {
            $data = Donation::where('status', 0)->with('category')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function($data){
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->editColumn('category', function ($data) {
                    $category = $data->category->name ?? '-';
                    return '<span class="badge badge-primary">'. $category .'</span>';
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return $status = '
                            <a href="' . route("admin.donation.requests.approve", $data->id) . '" onClick="' . "return confirm('You want to approve ({$data->title}`s)?');" . '" class="badge badge-primary">
                                Approve
                            </a>
                            <a href="' . route("admin.donation.requests.reject", $data->id) . '" onClick="' . "return confirm('You want to reject ({$data->title}`s)?');" . '" class="badge badge-danger">
                                Reject
                            </a>
                        ';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.donation.requests.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("admin.donation.requests.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images', 'category'])
                ->make(true);
        }
        return view('admin.donation_request.pending');
    }
    public function approved()
    {
        $headerTitle = "Donation Request | Approved";
        if (request()->ajax()) {
            $data = Donation::whereIn('status', [1,3])->with('category')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function($data){
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->editColumn('category', function ($data) {
                    $category = $data->category->name ?? '-';
                    return '<span class="badge badge-primary">'. $category .'</span>';
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        return '<span class="badge badge-secondary secondary">Approved</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.donation.requests.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images', 'category'])
                ->make(true);
        }
        return view('admin.donation_request.approved');
    }
    public function rejected()
    {
        $headerTitle = "Donation Request | Rejected";
        if (request()->ajax()) {
            $data = Donation::where('status', 2)->with('category')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function($data){
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->editColumn('category', function ($data) {
                    $category = $data->category->name ?? '-';
                    return '<span class="badge badge-primary">'. $category .'</span>';
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 2) {
                        return $status = '
                            <a href="' . route("admin.donation.requests.recall", $data->id) . '" onClick="' . "return confirm('You want to recall ({$data->title}`s)?');" . '" class="badge badge-info">
                                Recall
                            </a>
                        ';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.donation.requests.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images', 'category'])
                ->make(true);
        }
        return view('admin.donation_request.rejected');
    }

    public function edit($id)
    {
        $donation = Donation::find($id);
        $categories = Category::all();
        return view('admin.donation_request.edit', compact('donation', 'categories'));
    }

    public function approve($id)
    {
        $donation = Donation::find($id);
        $donation->status = 1;
        $donation->save();
        toastr()->success('Request Approved Successfully!', 'Approved!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'price' => 'required',
            'point' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'shipping_address' => 'required',
            'used_duration' => 'required',
            'images' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $donation = Donation::find($id);
        $donation->update($request->except('_token', '_method'));

        $upload = new FileManager();
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            $upload->folder('donation')->prefix('images')->update($images, $donation->images);
            $donation->images = $upload->getName();
        }

        $donation->save();
        toastr()->success('Product Successfully Updated!', 'Updated!');
        return redirect()->route('admin.donation.requests.pending');
    }

    public function reject($id)
    {
        $donation = Donation::find($id);
        $donation->status = 2;
        $donation->save();
        toastr()->error('Request Rejected Successfully!', 'Rejected!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $donation = Donation::find($id);
        $donation->status = 0;
        $donation->save();
        toastr()->info('Request Recycled Successfully!', 'Recycled!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $donation = Donation::find($id);
        $donation->delete();
        toastr()->error('Request Deleted Successfully!', 'Deleted!');
        return redirect()->back();
    }
}
