<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class MaintenanceController extends Controller
{
    protected $pincode;

    public function __construct()
    {
        $this->pincode = env('MAINTENANCE_PINCODE', '321131217854227626');
    }

    public function index(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('maintenance.auth');
        }

        $this->validate($request, [
            'pincode' => 'required|string|min:6',
        ]);

        if ($request->pincode !== $this->pincode) {
            return redirect()->route('maintenance.auth')->withErrors(['invalid' => 'Invalid pincode']);
        }

        Session::put('xxmauth', md5($this->pincode));

        toastr()->success('Successfully logged in', 'Success');

        return view('maintenance.index');
    }

    public function artisanAction($command)
    {
        if (!Session::has('xxmauth')) {
            return redirect()->route('maintenance.auth')->withErrors(['invalid' => 'Please login first']);
        }

        if (Session::get('xxmauth') !== md5($this->pincode)) {
            return redirect()->route('maintenance.auth')->withErrors(['invalid' => 'Invalid pincode']);
        }

        Artisan::call($command);

        return Artisan::output();
    }

    public function cacheClear()
    {
        return $this->artisanAction('cache:clear');
    }
    public function configClear()
    {
        return $this->artisanAction('config:clear');
    }
    public function optimizeClear()
    {
        return $this->artisanAction('optimize:clear');
    }
    public function viewClear()
    {
        return $this->artisanAction('view:clear');
    }
    public function routeClear()
    {
        return $this->artisanAction('route:clear');
    }
    public function clearResetTokens()
    {
        return $this->artisanAction('auth:clear-resets');
    }
    public function clearCompiled()
    {
        return $this->artisanAction('clear-compiled');
    }
    public function cronJob()
    {
        return $this->artisanAction('cron:daily');
    }

    public function migrate()
    {
        config(['app.env' => 'local']);
        return $this->artisanAction('migrate'); //throw new \Exception('Not implemented yet');
    }

    public function databaseBackup()
    {
        return $this->artisanAction('backup:run'); // throw new \Exception('Not implemented yet');
    }

    public function logout()
    {
        Session::forget('xxmauth');
        return redirect()->route('maintenance.auth');
    }
}
