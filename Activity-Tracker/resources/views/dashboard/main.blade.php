@extends('master')
<!-- Main.blade.php -->
@section('site-content')
<div style="text-align: center;">
    <p>Welcome to Dashboard,
        @if (session()->has('userdata'))
            <b>{{ ucfirst(session()->get('userdata')->name) }}</b>
            (
            <b>{{ session()->get('userdata')->email }}</b>
            )
        @endif
    </p>
    <hr />
    <div style="margin-bottom: 20px;">
        <a href="{{ url('dashboard/user/manage-task/add') }}">
            <button style="padding: 10px 20px; font-size: 16px;">
                Add Task
            </button>
        </a>
    </div>
    <div style="overflow-x:auto;">
        <table border="1" rules="all" style="width: 100%; border-collapse: collapse;">
            <caption><b>My Task List</b></caption>
            <thead>
                <tr>
                    <th style="padding: 10px;">#</th>
                    <th style="padding: 10px;">Task Name</th>
                    <th style="padding: 10px;">Project Name</th>
                    <th style="padding: 10px;">Start At</th>
                    <th style="padding: 10px;">Ended At</th>
                    <th style="padding: 10px;">Total Time (In Seconds)</th>
                    <th style="padding: 10px;">View Recording</th>
                </tr>
            </thead>
            <tbody>
                @if(count($tasks) > 0)
                            @foreach ($tasks as $task)
                                        <tr>
                                            <td style="padding: 10px;">{{$task->id}}</td>
                                            <td style="padding: 10px;">
                                                <span style="padding:5px;display:inline-block;color:white;background:green;border-radius:5px">
                                                    {{$task->taskInfo}}
                                                </span>
                                            </td>
                                           
                                            <td style="padding: 10px;">
                                                <a href="#">{{ProjectHelper::getProjectName($task->project_id)}}</a>
                                            </td>
                                            <td style="padding: 10px;">
                                                <span style="padding:5px;display:inline-block;color:white;background:blue;border-radius:5px">
                                                    {{$task->startTime}}
                                                </span>
                                            </td>
                                            <td style="padding: 10px;">
                                                <span style="padding:5px;display:inline-block;color:white;background:red;border-radius:5px">
                                                    {{$task->endTime}}
                                                </span>
                                            </td>
                                            <td style="padding: 10px;">{{$task->totalTime}} sec</td>
                                            <td style="padding: 10px;">
                                                @php
                                                    $url = url('uploads/' . $task->vedio_uniqueFileName);
                                                @endphp
                                                <img src="{{asset('assets/images/view-icons.png')}}"
                                                    style="height:30px;width:30px;cursor:pointer" onclick="openVedioPlayer('{!!$url!!}')">
                                            </td>
                                        </tr>
                            @endforeach
                @else
                    <tr>
                        <td colspan=" 7" style="text-align:center">No Record Found
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    function openVedioPlayer(vedioURL) {
        window.open(vedioURL, "_blank",
            "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
    }
</script>
@endsection