<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use ProjectHelper;

class TeamManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects = DB::table('projects')->get();
        return view('admin.team.show', [
            'projects' => $projects
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projectList = DB::table('projects')->whereNotIn('status', ['Closed'])->get();
        return view('admin.team.add', [
            'projects' => $projectList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $totalCount = count($request->member);

        for ($i = 0; $i < $totalCount; $i++) {
            DB::table('teams')->insert([
                'team_name' => $request->team_name,
                'project_id' => $request->project_id,
                'user_id' => $request->member[$i],
                'member_type' => $request->member_type[$i],
                'is_active' => $request->status[$i],
            ]);
        }
        return redirect()->to('admin/manage-team?msg=Team Created');
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
        $projectList = DB::table('projects')->whereNotIn('status', ['Closed'])->get();
        $selectedProject = DB::table('projects')->where('id', $id)->first();

        return view('admin.team.edit', [
            'projects' => $projectList,
            'selectedProject' => $selectedProject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $totalCount = count($request->member);

        for ($i = 0; $i < $totalCount; $i++) {
            DB::table('teams')->where('id', $request->teamID[$i])->update([
                'team_name' => $request->team_name,
                'user_id' => $request->member[$i],
                'project_id' => $id,
                'member_type' => $request->member_type[$i],
                'is_active' => $request->status[$i],
            ]);
        }
        return redirect()->to('admin/manage-team?msg=Record Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('teams')->where('project_id', $id)->delete();
        return redirect()->to('admin/manage-team?msg=Team Deleted');
    }


    public function ajaxProjectListing(string $id)
    {

        $project = DB::table('projects')->where('id', $id)->first();
        $members = DB::table('users')->whereNotIn('type', ['admin'])->get();

        if ($project && $members) {

            $htmlContent = view('admin.team.ajax-template.project_template', [
                'project' => $project,
                'members' => $members
            ])->render();


            return response()->json([
                'code' => 200,
                'status' => true,
                'data' => [
                    'html' => $htmlContent,
                ],
                'message' => 'Record Found with HTML Content',
            ]);


        } else {
            return response()->json([
                'code' => 404,
                'status' => false,
                'data' => [],
                'message' => 'No Record Found',
            ]);
        }

    }


    public function ajaxProjectListingEdit(string $id)
    {

        $project = DB::table('projects')->where('id', $id)->first();
        $members = DB::table('users')->whereNotIn('type', ['admin'])->get();
        $selectedTeams = DB::table('teams')->where('project_id', $id)->get(); //Add
        $teamName = ProjectHelper::getTeamName($id)->team_name;

        if ($project && $members && $selectedTeams) {

            $htmlContent = view('admin.team.ajax-template.project_template_edit', [ //edit
                'project' => $project,
                'members' => $members,
                'selectedTeam' => $selectedTeams,
                'teamName' => $teamName,
            ])->render();


            return response()->json([
                'code' => 200,
                'status' => true,
                'data' => [
                    'html' => $htmlContent,
                ],
                'message' => 'Record Found with HTML Content',
            ]);


        } else {
            return response()->json([
                'code' => 404,
                'status' => false,
                'data' => [],
                'message' => 'No Record Found',
            ]);
        }

    }
}