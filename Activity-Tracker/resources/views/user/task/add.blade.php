@extends('master')
<!-- Main.blade.php -->
@section('internal-style')
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0px auto;
}

.form-group {
    width: 100%;
    max-width: 600px;
    margin-bottom: 15px;
}

input,
button,
select,
progress {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
}

button {
    cursor: pointer;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
}

button:disabled {
    background-color: #cccccc;
}

#recordingIndicator {
    position: fixed;
    top: 10px;
    left: 10px;
    width: 20px;
    height: 20px;
    background-color: red;
    border-radius: 50%;
    display: none;
}

#timer {
    position: fixed;
    top: 10px;
    right: 10px;
    font-size: 16px;
    color: #333;
}

@keyframes blink {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: 0;
    }
}

@media (min-width: 600px) {
    .form-group {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    input,
    button,
    select,
    progress {
        width: calc(50% - 10px);
    }
}
</style>
@endsection

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
        <a href="{{ url('dashboard/user') }}">
            Back to Dashboard
        </a>
    </div>
</div>
<!-- Container Start -->
<div class="container">
    <div class="form-group">
        <select id="projectSelect">
            @if (count($projects) > 0)
            @foreach ($projects as $project)
            <option value="{{$project->project_id}}">{{ProjectHelper::getProjectName($project->project_id)}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        @php
        $userName = isset(session()->get('userdata')->name) ? session()->get('userdata')->name : "";

        $userID = isset(session()->get('userdata')->id) ? session()->get('userdata')->id : "";
        @endphp
        <input type="text" id="nameInput" placeholder="Enter Name" value="{!!$userName!!}" readonly>
        <input type="hidden" id="user_id" placeholder="Enter ID" value="{!!$userID!!}" readonly>
    </div>
    <div class="form-group">
        <input type="text" id="taskInput" placeholder="Enter Task Information">
    </div>
    <div class="form-group">
        <button id="startButton">Start Tracker</button>
    </div>
    <div class="form-group">
        <button id="stopButton" disabled>Stop Tracker</button>
    </div>
    <progress id="progressBar" max="100" value="0"></progress>
</div>
<div id="recordingIndicator"></div>
<div id="timer">00:00</div>

<script>
let AppURL = "{{url('')}}/"
</script>
<script src="{{asset('assets/js/package/recorder.js')}}"></script>
<!-- Container End -->
@endsection