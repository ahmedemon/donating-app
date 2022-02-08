<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use Yajra\DataTables\DataTables;
class SponsorController extends Controller
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
            $data = Sponsor::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return $status = '
                            <span class="badge">Dective</span>
                            <a href="' . route("admin.sponsor.active", $data->id) . '" onClick="' . "return confirm('You want to active ({$data->company_name}`s)?');" . '" class="badge badge-primary">
                                Active
                            </a>
                        ';
                    }
                    if ($data->status == 1) {
                        return $status = '
                            <span class="badge">Active</span>
                            <a href="' . route("admin.sponsor.deactive", $data->id) . '" onClick="' . "return confirm('You want to deactivate ({$data->company_name}`s)?');" . '" class="badge badge-danger">
                                Deactive
                            </a>
                        ';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->company_name . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("admin.sponsor.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("admin.sponsor.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->company_name}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }        
        return view('admin.sponsor.index', compact('headerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headerTitle = 'Add Sponsor';
        return view('admin.sponsor.create', compact('headerTitle'));
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
            'company_name' => 'required|string',
            'description' => 'nullable|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);
        $sponsor = new Sponsor($request->all());
        $sponsor->status = 0;
        $sponsor->save();
        toastr()->success('Sponsor Added Successfully!', 'Success!');
        return redirect()->route('admin.sponsor.index');
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
        $sponsor = Sponsor::find($id);
        $headerTitle = "Edit Sponsor | " . $sponsor->company_name;
        return view('admin.sponsor.edit', compact('sponsor', 'headerTitle'));
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
            'company_name' => 'required|string',
            'description' => 'nullable|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);

        $sponsor = Sponsor::find($id);
        $sponsor->update($request->except('_token', '_method'));
        $sponsor->save();
        toastr()->success('Sponsor Updated Successfully!', 'Updated!');
        return redirect()->route('admin.sponsor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);
        $sponsor->delete();
        toastr()->error('Sponsor Deleted!', 'Deleted!');
        return redirect()->route('admin.sponsor.index');
    }

    public function active($id)
    {
        $sponsor = Sponsor::find($id);
        $sponsor->status = 1;
        $sponsor->save();
        toastr()->success('Sponsor Activate!', 'Activate!');
        return redirect()->back();
    }

    public function deactive($id)
    {
        $sponsor = Sponsor::find($id);
        $sponsor->status = 0;
        $sponsor->save();
        toastr()->warning('Sponsor Deactivate!', 'Deactivate!');
        return redirect()->back();
    }
}
