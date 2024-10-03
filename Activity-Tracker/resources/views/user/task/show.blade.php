@extends('dashboard.admin')

@section('internal-style')
<style>
.btn-custom {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-custom:hover {
    background-color: #0056b3;
}

.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
}

table th,
table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

table th {
    background-color: #f2f2f2;
}

@media screen and (max-width: 600px) {
    table thead {
        display: none;
    }

    table,
    table tbody,
    table tr,
    table td {
        display: block;
        width: 100%;
    }

    table tr {
        margin-bottom: 15px;
    }

    table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: bold;
        text-align: left;
    }
}
</style>

@endsection
@section('admin-content')
<div style="overflow-x:auto;">
    <table border="1" rules="all" style="width: 100%; border-collapse: collapse;">
        <caption><b>All Task List</b></caption>
        <thead>
            <tr>
                <th style="padding: 10px;">#</th>
                <th style="padding: 10px;">Task Name</th>
                <th style="padding: 10px;">User Name</th>
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
                <td>
                    <b>
                        {{$task->user_name}}
                    </b>
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
                    <img src="{{asset('assets/images/view-icons.png')}}" style="height:30px;width:30px;cursor:pointer"
                        onclick="openVedioPlayer('{!!$url!!}')">
                </td>
                </td>
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