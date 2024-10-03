<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tasks = DB::table('tasks')->get();
        return view('user.task.show', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = isset(session()->get('userdata')->id) ? session()->get('userdata')->id : "";
        $projects = DB::table('teams')->where('user_id', $userId)->get();
        return view('user.task.add', [
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function ajaxTaskHandler(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'taskInfo' => 'required|string',
            'project_id' => 'required|integer',
            'startTime' => 'required|date',
            'endTime' => 'required|date',
            'totalTime' => 'required|integer',
            'uniqueFileName' => 'required|string',
            'user_id' => 'required|integer',
        ]);


        DB::table('tasks')->insert([
            'user_name' => $request->name,
            'taskInfo' => $request->taskInfo,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'totalTime' => $request->totalTime,
            'vedio_uniqueFileName' => $request->uniqueFileName,
            'project_id' => $request->project_id,
            'user_id' => $request->user_id
        ]);

        return response()->json(['message' => 'Task created successfully'], 201);

    }
    public function ajaxTaskVedioHandler(Request $request)
    {

        $uploadFolder = public_path('uploads/');
        $uploadedChunks = [];
        $status = 'error';

        if (!empty($_FILES)) {
            foreach ($_FILES as $key => $file) {
                $tempFilePath = $file['tmp_name'];
                $newFilePath = $uploadFolder . basename($file['name']);

                if (move_uploaded_file($tempFilePath, $newFilePath)) {
                    $uploadedChunks[] = $newFilePath;
                }
            }

            if (count($uploadedChunks) === count($_FILES)) {
                $status = 'success';
            }
        }

        echo json_encode(['status' => $status, 'uploaded_chunks' => $uploadedChunks]);
        exit;
    }
}