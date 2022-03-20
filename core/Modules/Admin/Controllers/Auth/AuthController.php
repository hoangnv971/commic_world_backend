<?php

namespace Core\Modules\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view("Admin::dashboard.index");
    }
}
