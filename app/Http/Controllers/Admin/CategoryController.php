<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerTitle = "Categories";
        if (request()->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return $status = '
                            <span class="badge">Dective</span>
                            <a href="' . route("admin.category.active", $data->id) . '" onClick="' . "return confirm('You want to active ({$data->name}`s)?');" . '" class="badge badge-primary">
                                Active
                            </a>
                        ';
                    }
                    if ($data->status == 1) {
                        return $status = '
                            <span class="badge">Active</span>
                            <a href="' . route("admin.category.deactive", $data->id) . '" onClick="' . "return confirm('You want to deactivate ({$data->name}`s)?');" . '" class="badge badge-danger">
                                Deactive
                            </a>
                        ';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.category.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("admin.category.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->name}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.categories.index', compact('headerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headerTitle = 'Add Category';
        return view('admin.categories.create', compact('headerTitle'));
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
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $category = new Category($request->all());
        $category->created_by = Auth::guard('admin')->user()->id;
        $category->status = 1;
        $category->save();
        toastr()->success('Category added suceessfully!', 'Success');
        return redirect()->route('admin.category.index');
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
        $category = Category::find($id);
        $headerTitle = "Edit Category | " . $category->name;
        return view('admin.categories.edit', compact('category', 'headerTitle'));
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
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->created_by = Auth::guard('admin')->user()->id;
        $category->status = 1;
        $category->save();
        toastr()->success('Category updated suceessfully!', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        toastr()->error('Category Deleted Successfully!', 'Deleted!');
        return redirect()->back();
    }

    public function active($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        toastr()->success('Category Activate!', 'Activate!');
        return redirect()->back();
    }

    public function deactive($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        toastr()->warning('Category Deactivate!', 'Deactivate!');
        return redirect()->back();
    }
}
