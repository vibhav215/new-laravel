<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = DB::table('projects')->get();
        return view('admin.projects.show', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = DB::table('skills')->get();
        $managers = DB::table('users')->where('designation', 'Manager')->get();
        return view('admin.projects.add', [
            'skills' => $skills,
            'managers' => $managers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        DB::table('projects')->insert([
            'project_name' => $request->projectName,
            'project_description' => $request->projectDescription,
            'project_type' => $request->projectType,
            'duration' => $request->duration,
            'start_time' => $request->startTime,
            'team_size' => $request->teamSize,
            'skill_set' => implode(',', array_unique($request->skillSet)),
            'user_id' => $request->manager,
            'priority' => $request->priority,
            'contract_type' => $request->contractType,
            'status' => $request->status,
            'reference' => $request->reference,
            'attachment' => '',
            'git_repo' => $request->gitRepo,
            'client_name' => $request->clientName,
            'level' => $request->level,
            'project_management_tool' => $request->projectManagementTool,
            'ticket_id' => $request->ticketId,
            'sdlc_model' => $request->sdlcModel,
            'total_sprint' => $request->totalSprint,
            'project_location' => $request->projectLocation,
            'community' => $request->community,
            'client_contact_number' => $request->clientContactNumber,
            'client_email_address' => $request->clientEmailAddress,
        ]);
        return redirect()->to('admin/manage-project?msg=Project Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skills = DB::table('skills')->get();
        $managers = DB::table('users')->where('designation', 'Manager')->get();
        $project = DB::table('projects')->where('id', $id)->first();
        return view('admin.projects.edit', [
            'skills' => $skills,
            'managers' => $managers,
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('projects')->where('id', $id)->update([
            'project_name' => $request->projectName,
            'project_description' => $request->projectDescription,
            'project_type' => $request->projectType,
            'duration' => $request->duration,
            'start_time' => $request->startTime,
            'team_size' => $request->teamSize,
            'skill_set' => implode(',', array_unique($request->skillSet)),
            'user_id' => $request->manager,
            'priority' => $request->priority,
            'contract_type' => $request->contractType,
            'status' => $request->status,
            'reference' => $request->reference,
            'attachment' => '',
            'git_repo' => $request->gitRepo,
            'client_name' => $request->clientName,
            'level' => $request->level,
            'project_management_tool' => $request->projectManagementTool,
            'ticket_id' => $request->ticketId,
            'sdlc_model' => $request->sdlcModel,
            'total_sprint' => $request->totalSprint,
            'project_location' => $request->projectLocation,
            'community' => $request->community,
            'client_contact_number' => $request->clientContactNumber,
            'client_email_address' => $request->clientEmailAddress,
        ]);
        return redirect()->to('admin/manage-project?msg=Project Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('projects')->where('id', $id)->delete();
        return redirect()->to('admin/manage-project?msg=Project Deleted');
    }

    public function agreement(string $id)
    {
        $project = DB::table('projects')->where('id', $id)->first();
        return view('admin.projects.agreement', [
            'project' => $project
        ]);
    }
}