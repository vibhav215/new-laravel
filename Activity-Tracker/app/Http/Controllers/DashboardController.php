<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    //
    public function index() //User
    {
        $userId = isset(session()->get('userdata')->id) ? session()->get('userdata')->id : "";
        $tasks = DB::table('tasks')->where('user_id', $userId)->get();

        return view('dashboard.main', [
            'tasks' => $tasks
        ]); //main for user
    }

    public function admin() //admin
    {

        return view('dashboard.admin'); //admin for admin
    }
}