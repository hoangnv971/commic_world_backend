<?php

namespace Core\Modules\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        return view("Admin::auth.index");
    }
}
