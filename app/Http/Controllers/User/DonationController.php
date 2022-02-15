<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DonationRequest;
use App\Models\Donation;
use App\Models\Category;
use App\Helpers\FileManager;
use Yajra\DataTables\DataTables;
class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerTitle = "Sponsors";
        if (request()->ajax()) {
            $data = Donation::where('status', 1)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function($data){
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return $status = '
                            <span class="badge">Dective</span>
                            <a href="' . route("donations.active", $data->id) . '" onClick="' . "return confirm('You want to active ({$data->title}`s)?');" . '" class="badge badge-primary">
                                Active
                            </a>
                        ';
                    }
                    if ($data->status == 1) {
                        return $status = '
                            <span class="badge">Active</span>
                            <a href="' . route("donations.deactive", $data->id) . '" onClick="' . "return confirm('You want to deactivate ({$data->title}`s)?');" . '" class="badge badge-danger">
                                Deactive
                            </a>
                        ';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("donations.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("donations.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images'])
                ->make(true);
        }
        return view('user.donation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('user.donation.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $donation = new Donation($request->all());

        $file = new FileManager();

        if ($request->has('images')) {
            $file->folder('donation')->prefix('image')
            ->postfix($request->title)
            ->upload($request->images) ?
            $donation->images = $file->getName() : null;
        }
        $donation->save();
        toastr()->success('Product Successfully Donated!', 'Success!');
        return redirect()->route('donations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donation = Donation::find($id);
        return view('user.donation.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        $file = new FileManager();
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            $upload->folder('donation')->prefix('images')->update($images, $donation->images);
            $donation->images = $upload->getName();
        }

        $donation->save();
        toastr()->success('Product Successfully Updated!', 'Updated!');
        return redirect()->route('donations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = Donation::find($id);
        $donation->delete();
        toastr()->error('Product deleted!', 'Deleted!');
        return redirect()->back();
    }

    public function active($id)
    {
        $donation = Donation::find($id);
        $donation->status = 1;
        $donation->save();
        toastr()->success('Donated Product Activate!', 'Activate!');
        return redirect()->back();
    }

    public function deactive($id)
    {
        $donation = Donation::find($id);
        $donation->status = 0;
        $donation->save();
        toastr()->warning('Donated Product Deactivate!', 'Deactivate!');
        return redirect()->back();
    }
}
