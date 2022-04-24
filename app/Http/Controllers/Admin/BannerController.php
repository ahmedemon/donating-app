<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerTitle = "Banners";
        if (request()->ajax()) {
            $data = Banner::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('image', function ($data) {
                    return '<img src="' . asset('storage/banners/' . $data->image) . '" height="50" width="100">';
                })
                ->editColumn('url', function ($data) {
                    return '<a style="color: darkorange !important;" href="' . $data->url . '">Go To Url</a>';
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '
                            <span class="badge">Dective</span>
                            <a href="' . route("admin.banner.active", $data->id) . '" onClick="' . "return confirm('You want to active ({$data->title}`s)?');" . '" class="badge badge-primary">
                                Active
                            </a>
                        ';
                    }
                    if ($data->status == 1) {
                        return '
                            <span class="badge">Active</span>
                            <a href="' . route("admin.banner.deactive", $data->id) . '" onClick="' . "return confirm('You want to deactivate ({$data->title}`s)?');" . '" class="badge badge-danger">
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
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.banner.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("admin.banner.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'image', 'created_at', 'url'])
                ->make(true);
        }
        return view('admin.banner.index', compact('headerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headerTitle = "Create Banner";
        return view('admin.banner.create', compact('headerTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->position == 'middle') {
            $banner = Banner::where('position', 'middle')->count();
            if ($banner > 0) {
                toastr()->info('Middle banner is already set!');
                return redirect()->back();
            }
        }
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'url' => 'required|string',
            'position' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $banner = new Banner($request->all());

        $upload = new FileManager();
        // user image start
        if ($request->has('image')) {
            $upload->folder('banners')->prefix($request->position)
                ->postfix($request->username)
                ->upload($request->image) ?
                $banner->image = $upload->getName() : null;
        }
        // user image end
        $banner->save();
        toastr()->success('Banner added successflly!', 'Success!');
        return redirect()->route('admin.banner.index');
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
        $headerTitle = "Edit banner";
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('headerTitle', 'banner'));
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
            'title' => 'required|string|max:100',
            'url' => 'required|string',
            'position' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $banner = new Banner($request->all());

        $upload = new FileManager();
        // user image start
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $upload->folder('banners')->prefix($request->position)->update($image, $banner->image);
            $banner->image = $upload->getName();
        }
        // user image end
        $banner->save();
        toastr()->success('Banner added successflly!', 'Success!');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        toastr()->error('Banner delted successfully!', 'Deleted!');
        return redirect()->back();
    }
    public function active($id)
    {
        $banner = Banner::find($id);
        $banner->status = 1;
        $banner->save();
        toastr()->success('Banner activated!', 'Activate!');
        return redirect()->back();
    }
    public function deactive($id)
    {
        $banner = Banner::find($id);
        $banner->status = 0;
        $banner->save();
        toastr()->success('Banner deactivated!', 'Deactivate!');
        return redirect()->back();
    }
}
