<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DonationRequest;
use App\Models\Donation;
use App\Models\Category;
use App\Helpers\FileManager;
use App\Models\Duration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Total Sales";
        if (request()->ajax()) {
            $data = Donation::where('user_id', $user_id)->where('status', 3)->where('requested_by', !null)->with(['user', 'category', 'duration'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function ($data) {
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 3) {
                        return '<span class="badge badge-secondary">Complete</span>';
                    }
                })
                ->addColumn('category_id', function ($data) {
                    $category = $data->category->name ?? '-';
                    return '<span class="badge badge-danger">' . $category . '</span>';
                })
                ->addColumn('used_duration', function ($data) {
                    $duration = $data->duration->duration ?? '-';
                    $type = $data->duration->type ?? '-';
                    return $duration . ' ' . $type;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("donation.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("donation.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images', 'category_id', 'used_duration'])
                ->make(true);
        }
        return view('user.donation.index', compact('headerTitle'));
    }
    public function pending()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Donatated Product | Pending";
        if (request()->ajax()) {
            $data = Donation::where('user_id', $user_id)->where('status', 0)->with(['user', 'category', 'duration'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function ($data) {
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return $status = '<span class="badge badge-primary">Pending</span>';
                    }
                })
                ->addColumn('category_id', function ($data) {
                    $category = $data->category->name ?? '-';
                    return '<span class="badge badge-danger">' . $category . '</span>';
                })
                ->addColumn('used_duration', function ($data) {
                    $duration = $data->duration->duration ?? '-';
                    $type = $data->duration->type ?? '-';
                    return $duration . ' ' . $type;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("donation.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("donation.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images', 'category_id', 'used_duration'])
                ->make(true);
        }
        return view('user.donation.pending');
    }
    public function approved()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Sponsors";
        if (request()->ajax()) {
            $data = Donation::where('user_id', $user_id)->whereIn('status', [1, 3])->with(['user', 'category', 'duration'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function ($data) {
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        return $status = '<span class="badge badge-secondary">Approved</span>';
                    }
                })
                ->addColumn('category_id', function ($data) {
                    $category = $data->category->name ?? '-';
                    return '<span class="badge badge-danger">' . $category . '</span>';
                })
                ->addColumn('used_duration', function ($data) {
                    $duration = $data->duration->duration ?? '-';
                    $type = $data->duration->type ?? '-';
                    return $duration . ' ' . $type;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-' . $data->id . '" action="' . route("donation.destroy", $data->id) . '" method="POST" class="d-none">
                            ' . @csrf_field() . '
                            ' . @method_field("DELETE") . '
                        </form>

                        <a href="' . route("donation.edit", $data->id) . '" onClick="' . "return confirm('You want to edit {$data->title}`s?');" . '" class="btn btn-success shadow btn-xs sharp">
                            <i class="flaticon-381-edit-1"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images', 'category_id', 'category_id', 'used_duration'])
                ->make(true);
        }
        return view('user.donation.approve');
    }
    public function rejected()
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        $headerTitle = "Sponsors";
        if (request()->ajax()) {
            $data = Donation::where('user_id', $user_id)->where('status', 2)->with(['user', 'category', 'duration'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('images', function ($data) {
                    return '<img src="' . asset('storage/donation/' . $data->images) . '" height="50" width="100">';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d, Y, h:i a', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 2) {
                        return $status = '<span class="badge badge-danger">Rejected</span>';
                    }
                })
                ->addColumn('category_id', function ($data) {
                    $category = $data->category->name ?? '-';
                    return '<span class="badge badge-danger">' . $category . '</span>';
                })
                ->addColumn('used_duration', function ($data) {
                    $duration = $data->duration->duration ?? '-';
                    $type = $data->duration->type ?? '-';
                    return $duration . ' ' . $type;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a class="btn btn-danger shadow btn-xs sharp" href="#" onclick="noticeDelete(this);" data-id="' . $data->id . '" data-name="' . $data->title . '">
                            <i class="fa fa-check"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'images', 'category_id', 'category_id', 'used_duration'])
                ->make(true);
        }
        return view('user.donation.rejected');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $durations = Duration::all();
        return view('user.donation.create', compact('categories', 'durations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'price' => 'required',
            'point' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'shipping_address' => 'required',
            'used_duration' => 'required',
            'images' => 'required|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $donation = new Donation($request->all());

        $input = $request->all();

        $parts = explode(";base64,", $input['cropimage64']);
        $type_aux = explode("image/", $parts[0]);
        $type = $type_aux[1];
        $image_base64 = base64_decode($parts[1]);

        // file naming convension
        $separator = '-';
        $prefix = 'image-';
        $postfix = str_replace(' ', '-', $request->title);
        $filename = $prefix . Str::uuid() . $separator . $postfix . $separator .  date('Y-m-d') . '.' . $type;
        // file naming convension

        Storage::disk('donations')->put($filename, $image_base64);

        $donation->images = $filename;
        $donation->save();
        toastr()->success('Product Successfully Donated!', 'Success!');
        return redirect()->route('donation.pending');
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
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $categories = Category::all();
        $durations = Duration::all();
        $donation = Donation::find($id);
        return view('user.donation.edit', compact('donation', 'categories', 'durations'));
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
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
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

        $input = $request->all();

        $parts = explode(";base64,", $input['cropimage64']);
        $type_aux = explode("image/", $parts[0]);
        $type = $type_aux[1];
        $image_base64 = base64_decode($parts[1]);

        // file naming convension
        $separator = '-';
        $prefix = 'image-';
        $postfix = str_replace(' ', '-', $request->title);
        $filename = $prefix . Str::uuid() . $separator . $postfix . $separator .  date('Y-m-d') . '.' . $type;
        // file naming convension
        Storage::disk('donations')->delete($donation->images);
        Storage::disk('donations')->put($filename, $image_base64);

        $donation->images = $filename;

        // $upload = new FileManager();
        // if ($request->hasFile('images')) {
        //     $images = $request->file('images');

        //     $upload->folder('donation')->prefix('images')->update($images, $donation->images);
        //     $donation->images = $upload->getName();
        // }

        $donation->save();
        toastr()->success('Product Successfully Updated!', 'Updated!');
        return redirect()->route('donation.pending');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $donation = Donation::find($id);
        $donation->delete();
        toastr()->error('Product deleted!', 'Deleted!');
        return redirect()->back();
    }

    public function pause($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $donation = Donation::find($id);
        $donation->is_paused = 0;
        $donation->save();
        toastr()->success('Donated Product Activate!', 'Activate!');
        return redirect()->back();
    }

    public function relese($id)
    {
        $current_user = Auth::user();
        if (!$current_user->is_active) {
            toastr()->error('Your account is not active! Please wait for admin confirmation!', 'Deactive account!');
            return redirect()->back();
        }
        $donation = Donation::find($id);
        $donation->is_paused = 1;
        $donation->save();
        toastr()->warning('Donated Product Deactivate!', 'Deactivate!');
        return redirect()->back();
    }
}
