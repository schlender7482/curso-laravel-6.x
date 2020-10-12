<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return 'index';
    }

    public function products()
    {
        return 'products';
    }

    public function dashboard()
    {
        return 'dashboard';
    }

    public function financial()
    {
        return 'financial';
    }
}
