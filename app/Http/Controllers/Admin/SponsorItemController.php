<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SponsorItem;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use App\Helpers\FileManager;
class SponsorItemController extends Controller
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
            $data = SponsorItem::where('status', 1)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($data){
                    return '<img src="' . asset('storage/sponsor_item/' . $data->image) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return $status = '
                            <span class="badge">Dective</span>
                            <a href="' . route("admin.sponsor-item.active", $data->id) . '" onClick="' . "return confirm('You want to active ({$data->title}`s)?');" . '" class="badge badge-primary">
                                Active
                            </a>
                        ';
                    }
                    if ($data->status == 1) {
                        return $status = '
                            <span class="badge">Active</span>
                            <a href="' . route("admin.sponsor-item.deactive", $data->id) . '" onClick="' . "return confirm('You want to deactivate ({$data->title}`s)?');" . '" class="badge badge-danger">
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
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.sponsor-item.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("admin.sponsor-item.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }
        return view('admin.sponsor_item.index', compact('headerTitle'));
    }
    public function paused()
    {
        $headerTitle = "Sponsors";
        if (request()->ajax()) {
            $data = SponsorItem::where('status', 0)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($data){
                    return '<img src="' . asset('storage/sponsor_item/' . $data->image) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return $status = '
                            <span class="badge">Dective</span>
                            <a href="' . route("admin.sponsor-item.active", $data->id) . '" onClick="' . "return confirm('You want to active ({$data->title}`s)?');" . '" class="badge badge-primary">
                                Active
                            </a>
                        ';
                    }
                    if ($data->status == 1) {
                        return $status = '
                            <span class="badge">Active</span>
                            <a href="' . route("admin.sponsor-item.deactive", $data->id) . '" onClick="' . "return confirm('You want to deactivate ({$data->title}`s)?');" . '" class="badge badge-danger">
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
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.sponsor-item.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("admin.sponsor-item.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }        
        return view('admin.sponsor_item.index', compact('headerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headerTitle = 'Add Sponsor Item';
        $sponsors = Sponsor::all();
        return view('admin.sponsor_item.create', compact('headerTitle', 'sponsors'));
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
            'title' => 'required|string',
            'price' => 'required|integer',
            'reward_point' => 'required|integer',
            'shipping_address' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $sponsor_item = new SponsorItem($request->all());
        $sponsor_item->created_by = Auth::guard('admin')->user()->id;
        $sponsor_item->sponsored_by = $request->sponsored_by;

        $file = new FileManager();

        if ($request->has('image')) {
            $file->folder('sponsor_item')->prefix('image')
            ->postfix($request->title)
            ->upload($request->image) ?
            $sponsor_item->image = $file->getName() : null;
        }

        $sponsor_item->save();
        toastr()->success('Sponsor item added suceessfully!', 'Success!');
        return redirect()->route('admin.sponsor-item.index');
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
        $sponsor_item = SponsorItem::find($id);
        $headerTitle = 'Edit Sponsor Item | ' . $sponsor_item->title;
        $sponsors = Sponsor::all();
        return view('admin.sponsor_item.edit', compact('headerTitle', 'sponsor_item', 'sponsors'));
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
            'title' => 'required|string',
            'price' => 'required|integer',
            'reward_point' => 'required|integer',
            'shipping_address' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $sponsor_item = SponsorItem::find($id);
        $sponsor_item->update($request->except('_method', '_token'));
        $sponsor_item->edited_by = Auth::guard('admin')->user()->id;
        $sponsor_item->sponsored_by = $request->sponsored_by;
        $upload = new FileManager();

        // user image start
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $upload->folder('user')->prefix('image')->update($image, $user->image);
            $user->image = $upload->getName();
        }
        $sponsor_item->save();
        toastr()->success('Sponsor item updated suceessfully!', 'Success!');
        return redirect()->route('admin.sponsor-item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor_item = SponsorItem::find($id);
        $sponsor_item->delete();
        toastr()->error('Sponsor Item Deleted!', 'Deleted!');
        return redirect()->back();
    }

    public function active($id)
    {
        $sponsor_item = SponsorItem::find($id);
        $sponsor_item->status = 1;
        $sponsor_item->save();
        toastr()->success('Sponsor Item Activate!', 'Activate!');
        return redirect()->back();
    }

    public function deactive($id)
    {
        $sponsor_item = SponsorItem::find($id);
        $sponsor_item->status = 0;
        $sponsor_item->save();
        toastr()->warning('Sponsor Item Deactivate!', 'Deactivate!');
        return redirect()->back();
    }
}
