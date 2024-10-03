@extends('dashboard.admin')

@section('internal-style')
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

th,td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: lightgrey;
}

#teamTable tr {
    background-color: white;
}

#teamTable th {
    background-color: black;
    color: white;
}

/* Add transition classes */
.teamInfoHidden {
    display: none;
    height: 0;
    overflow: hidden;
    transition: height 0.1s ease, opacity 0.1s ease;
}

.teamInfoVisible {
    display: table-row;
    height: auto;
    transition: height 0.1s ease, opacity 0.1s ease;
}

.teamInfoRow {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.teamInfoVisible .teamInfoRow {
    opacity: 1;
}

.edit-btn,
.delete-btn {
    cursor: pointer;
    font-size: 16px;
}

.edit-btn {
    color: blue;
}

.delete-btn {
    color: red;
}
button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
@endsection

@section('admin-content')
<h3>
    Manage Team for the Project |
    <a href="{{url('admin/manage-team/add')}}">
        <button>
            Create New Team
        </button>
    </a>
</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Project Name</th>
            <th>Manager Name</th>
            <th>No of Member(s)</th>
            <th>git Credentials</th>
            <th>View Team</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @if (count($projects) > 0)
        @foreach ($projects as $project)
        <tr>
            <td>{{$project->id}}</td>
            <td><a href="#">
                    {{$project->project_name}}
                </a><br />
                @php
                $colors = [
                'High' => 'display:inline-block;padding:4px;color:red;background:pink;border-radius:5px;',
                'Medium' => 'display:inline-block;padding:5px;color:green;background:lightgreen;border-radius:5px;',
                'Low' => 'display:inline-block;padding:5px;color:blue;background:skyblue;border-radius:5px;',
                ];
                $style = $colors[$project->priority]
                @endphp
                <span style="{!!$style!!}">{{$project->priority}}</span>
                | <b>{{$project->status}}</b>|<i> {{$project->contract_type}} </i>
            </td>
            <td>
                <b>
                    {{ProjectHelper::getManagerInfo($project->user_id)->name}}
                </b>
                <br />
                <i>
                    <a href="mailto:{{ProjectHelper::getManagerInfo($project->user_id)->email}}">
                        {{ProjectHelper::getManagerInfo($project->user_id)->email}}
                    </a>
                </i>
            </td>
            <td>{{$project->team_size}} Member(s)</td>
            <td><input type="text" value="{{$project->git_repo}}" id="git_repo_input_{{$project->id}}" readonly
                    disabled>
                <a href="javascript:copySelection('git_repo_input_{{$project->id}}');">&#128464;</a>

            </td>
            <script>
            function copySelection(inputId) {
                // Get the input field by its id
                var inputField = document.getElementById(inputId);

                // Check if the input field exists
                if (inputField) {
                    // Create a temporary textarea element
                    var tempTextArea = document.createElement("textarea");
                    tempTextArea.value = inputField.value;

                    // Append the textarea to the body (required for the copy command to work)
                    document.body.appendChild(tempTextArea);

                    // Select the text in the textarea
                    tempTextArea.select();
                    tempTextArea.setSelectionRange(0, 99999); // For mobile devices

                    try {
                        // Copy the text to the clipboard
                        document.execCommand("copy");
                        alert("Copied to clipboard: " + tempTextArea.value);
                    } catch (err) {
                        alert("Failed to copy text.");
                    }

                    // Remove the temporary textarea from the body
                    document.body.removeChild(tempTextArea);
                } else {
                    alert("Input field not found.");
                }
            }
            </script>
            <td style="cursor:pointer" onclick="toggleTeamInfo({{$project->id}})">
                <center>
                    @php
                    $isVisible = ProjectHelper::getTeamName($project->id) ? true : false;
                    @endphp
                    @if ($isVisible)
                    <img src="{{asset('assets/images/view-icons.png')}}" style="height:40px;width:40px;">
                    @else
                    No Team Assigned
                    @endif
                </center>
            </td>
            <td class="edit-btn">
                @if ($isVisible)
                <a href="{{url('admin/manage-team/edit/' . $project->id)}}">
                    ✏️
                </a>
                @else
                Permission Denied
                @endif

            </td>
            <td class="delete-btn">
                @if ($isVisible)
                <form action="{{url('admin/manage-team/delete/' . $project->id)}}" method="POST"
                    onSubmit="return window.confirm('Do you want Delete?');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="🗑️" />
                </form>
                @else
                Permission Denied
                @endif
            </td>
        </tr>
        @if (ProjectHelper::getTeamName($project->id))
        <tr id="teamInfoTR{{$project->id}}" class="teamInfoHidden" style=" border:2px solid black;">
            <th>Team Name</th>
            <td>
                <b><i>
                        <a href="#">
                            {{ProjectHelper::getTeamName($project->id)->team_name}}
                        </a>
                        <br />
                        Manager Name : <span>{{ProjectHelper::getManagerInfo($project->user_id)->name}}</span>
                        <br />
                        <span>Client Name: {{$project->client_name}}</span>
                        <br />
                        <span>Client Email Address: {{$project->client_email_address}}</span>

                    </i>
                </b>
            </td>
            <td colspan="8">
                <div class="teamInfoRow">
                    <table border="1" id="teamTable" style="border:2px solid black;">
                        <tr>
                            <th>Team ID (#)</th>
                            <th>Member Name</th>
                            <th>Member Type</th>
                            <th>Status</th>
                        </tr>
                        @if (count(ProjectHelper::getTeamsInfo($project->id)) > 0)
                        @foreach (ProjectHelper::getTeamsInfo($project->id) as $team)
                        <tr>
                            <td>
                                <b>
                                    #{{$team->id}}
                                </b>
                            </td>
                            <td>{{ProjectHelper::getUserInfo($team->user_id)->name}}</td>
                            <td>{{$team->member_type}}</td>
                            <td>
                                @php
                                $status = $team->is_active == 1 ? "<span
                                    style='color:green;padding:5px;background:lightgreen;font-weight:bold;border-radius:5px;'>Active</span>"
                                :
                                "<span
                                    style='color:red;padding:5px;background:pink;font-weight:bold;border-radius:5px;'>Disable</span>";
                                @endphp
                                {!!$status!!}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </td>
        </tr>
        @endif
        @endforeach
        @else
        <tr>
            <td colspan="8" style="text-align:center">No Record Found</td>
        </tr>
        @endif
    </tbody>
</table>

<script>
function toggleTeamInfo(id) {
    var row = document.getElementById('teamInfoTR' + id);
    if (row.classList.contains('teamInfoHidden')) {
        row.classList.remove('teamInfoHidden');
        row.classList.add('teamInfoVisible');
    } else {
        row.classList.remove('teamInfoVisible');
        row.classList.add('teamInfoHidden');
    }
}
</script>

@endsection