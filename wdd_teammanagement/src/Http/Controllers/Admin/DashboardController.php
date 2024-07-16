<?php

namespace wdd\teammanagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() : View
    {
        return view('wdd/teammanagement::admin.dashboard');
    }
}
