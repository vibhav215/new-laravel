<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rolesData = DB::table('roles')->get();
        return view('admin.role.show', [
            'roles' => $rolesData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'designation' => 'required'
        ]);
        //form data insert to Db

        DB::table('roles')->insert([
            'designations' => $request->designation,
        ]);
        //redirect to show
        return redirect()->to('admin/manage-role');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $roleData = DB::table('roles')->where('id', $id)->first();
        return view('admin.role.edit', [
            'role' => $roleData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validation
        $request->validate([
            'designation' => 'required'
        ]);
        //form data insert to Db

        DB::table('roles')->where('id', $id)->update([
            'designations' => $request->designation,
        ]);
        //redirect to show
        return redirect()->to('admin/manage-role?msg=Record-Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->to('admin/manage-role?msg=Record-Deleted');
    }
}