<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $notify = Notification::all();
        return view('admin.index',compact('notify'));
    }
}
