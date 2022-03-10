<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Duration;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerTitle = "Duration List";
        if (request()->ajax()) {
            $data = Duration::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('durations', function ($data) {
                    return $data->duration . '-' . $data->type;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->duration . '-' . $data->type . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.duration.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'durations'])
                ->make(true);
        }
        return view('admin.duration.index', compact('headerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headerTitle = "Create Duration";
        return view('admin.duration.create', compact('headerTitle'));
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
            'duration' => 'required',
            'type' => 'required',
        ]);
        $duration = new Duration($request->all());
        $duration->save();
        toastr()->success('Duration Added Successfully!', 'Success!');
        return redirect()->route('admin.duration.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $duration = Duration::find($id);
        $duration->delete();
        toastr()->warning('Duration Deleted Successfully!', 'Deleted!');
        return redirect()->back();
    }
}
