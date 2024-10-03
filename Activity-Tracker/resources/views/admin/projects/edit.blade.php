
@extends('dashboard.admin')

@section('internal-style')
<style>
/* Edit Page Styles */
.edit-page {
    margin-bottom: 100px;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.edit-page .container {
    width: 50%;
    margin: auto;
    overflow: hidden;
    padding: 20px;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 30px;
}

.edit-page h2 {
    text-align: center;
    color: #333;
}

.edit-page label {
    display: inline;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

.edit-page input[type="text"],
.edit-page input[type="date"],
.edit-page input[type="email"],
.edit-page input[type="file"],
.edit-page input[type="number"],
.edit-page textarea,
.edit-page select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.edit-page textarea {
    height: 100px;
}

.edit-page input[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.edit-page input[type="submit"]:hover {
    background-color: #4cae4c;
}
</style>
@endsection

@section('admin-content')
<div class="edit-page">
<div class="container">
    <h2>Edit Project Information</h2>
    <form action="{{url('admin/manage-project/update/'.$project->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Project Name:</label>
        <input type="text" name="projectName" value="{{$project->project_name}}">

        <label>Project Description:</label>
        <textarea name="projectDescription">{{$project->project_description}}</textarea>

        <label>Project Type:</label>
        <select name="projectType">
            @php
            $projectTypeArr = ['Small','Medium','Large','Enterprise'];
            @endphp
            @if (count($projectTypeArr)>0)
            @foreach ($projectTypeArr as $projectTypeOption)
            <option @if ($project->project_type == $projectTypeOption)
                {{"selected"}}
                @endif>{{$projectTypeOption}}</option>
            @endforeach
            @endif

        </select>

        <label>Duration:</label>
        <select name="duration" id="duration">
            <option>
                <=1 month</option>
            <option>
                <=2 months</option>
            <option>
                <=3 months</option>
            <option>
                <=6 months</option>
            <option>
                <=12 months</option>
            <option>Long Term</option>
            <option>Short Term</option>
        </select>

        <label>Total Sprint:</label>
        <input type="number" name="totalSprint" id="totalSprint" value="{{$project->total_sprint}}" readonly />
        <script>
        let totalSprint = document.querySelector('#totalSprint');
        let duration = document.querySelector('#duration');
        duration.addEventListener('change', function() {
            let durationObject = {
                "<=1 month": 2,
                "<=2 months": 4,
                "<=3 months": 6,
                "<=6 months": 12,
                "<=12 months": 24,
                "Long Term": 72,
                "Short Term": 1,
            }
            let durationValue = this.value;
            let sprint = durationObject[durationValue];
            totalSprint.value = sprint;
        });
        </script>

        <label>Start Time:</label>
        <input type="date" name="startTime" value="{{$project->start_time}}">

        <label>Team Size:</label>
        <input type="number" name="teamSize" min="1" step="1" value="{{$project->team_size}}">
        <!-- SkillSet Handling Code -->
        <label for="skillSet">Skill Set:</label>
        <br />
        @php
        $skillsetsArr = explode(',',$project->skill_set);
        @endphp
        <div id="selected-checkboxes" style="height:100px;overflow:scroll;overflow-X:hidden;">
            @if(count($skillsetsArr) > 0)
            @foreach ($skillsetsArr as $skill)
            <label style="display:block;">
                <input type="checkbox" class="skillCheckbox" name="skillSet[]" value="{{ $skill }}" checked>{{ $skill }}
            </label>
            @endforeach
            @endif
        </div>
        <input type="text" id="skillInput" placeholder="Type Skills..." />
        <div class="checkbox-group">
            @if (count($skills) > 0)
            <div style="height:100px;overflow:scroll;overflow-X:hidden" id="skillsContainer">
                @foreach ($skills as $skill)
                <label style="display:block;">
                    <input type="checkbox" class="skillCheckbox" name="skillSet[]" value="{{ $skill->name }}"
                        {{ in_array($skill->name, $skillsetsArr) ? 'checked' : '' }} /> {{ $skill->name }}
                </label>
                @endforeach
            </div>
            @endif
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var skillInput = document.getElementById('skillInput');
            var selectedCheckboxes = document.getElementById('selected-checkboxes');

            skillInput.addEventListener('input', function() {
                var searchText = this.value.toLowerCase();
                var skillCheckboxes = document.querySelectorAll('.skillCheckbox');
                skillCheckboxes.forEach(function(checkbox) {
                    var skillName = checkbox.value.toLowerCase();
                    var label = checkbox.parentElement;
                    if (skillName.includes(searchText)) {
                        label.style.display = 'block';
                    } else {
                        label.style.display = 'none';
                    }
                });
            });

            var checkboxes = document.querySelectorAll('.skillCheckbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Add to selected checkboxes if not already present
                        if (!selectedCheckboxes.querySelector('input[value="' + this.value +
                                '"]')) {
                            var clonedLabel = this.parentElement.cloneNode(true);
                            selectedCheckboxes.appendChild(clonedLabel);
                            clonedLabel.querySelector('input').checked = true;
                            clonedLabel.querySelector('input').addEventListener('change',
                                function() {
                                    if (!this.checked) {
                                        checkbox.checked = false;
                                        selectedCheckboxes.removeChild(clonedLabel);
                                    }
                                });
                        }
                    } else {
                        // Remove from selected checkboxes
                        var labels = selectedCheckboxes.querySelectorAll('label');
                        labels.forEach(function(label) {
                            if (label.querySelector('input').value === checkbox.value) {
                                selectedCheckboxes.removeChild(label);
                            }
                        });
                    }
                });
            });

            // Initial setup for selected checkboxes
            var initiallySelected = document.querySelectorAll('#skillsContainer .skillCheckbox:checked');
            initiallySelected.forEach(function(checkbox) {
                if (!selectedCheckboxes.querySelector('input[value="' + checkbox.value + '"]')) {
                    var clonedLabel = checkbox.parentElement.cloneNode(true);
                    selectedCheckboxes.appendChild(clonedLabel);
                    clonedLabel.querySelector('input').checked = true;
                    clonedLabel.querySelector('input').addEventListener('change', function() {
                        if (!this.checked) {
                            checkbox.checked = false;
                            selectedCheckboxes.removeChild(clonedLabel);
                        }
                    });
                }
            });
        });
        </script>

        <!-- End of the Skillset -->
        <br />

        <label>Manager:</label>
        <select name="manager">
            <option value="">Select</option>
            @if (count($managers) > 0)
            @foreach ($managers as $user)
            <option value="{{$user->id}}" @if($user->id == $project->user_id)
                {{"selected"}}
                @endif
                >
                {{$user->name}} ({{$user->email}})
            </option>
            @endforeach
            @endif
        </select>

        <label>Priority:</label>
        <select name="priority">
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
        </select>

        <label>Contract Type:</label>
        <select name="contractType">
            <option>Fixed</option>
            <option>Hourly</option>
        </select>

        <label>Status:</label>
        <select name="status">
            <option>Open</option>
            <option>To Do</option>
            <option>Pending</option>
            <option>In Progress</option>
            <option>Testing</option>
            <option>Deployment</option>
            <option>Suspended</option>
            <option>Delivered</option>
            <option>Closed</option>
        </select>

        <label>Reference:</label>
        <input type="text" name="reference" value="{{$project->reference}}">

        <label>Attachment:</label>
        <input type="file" name="attachment" value="{{$project->attachment}}">

        <label>Git Repository:</label>
        <input type="text" name="gitRepo" value="{{$project->git_repo}}">

        <label>Client Name:</label>
        <input type="text" name="clientName" value="{{$project->client_name}}">

        <label>Level:</label>
        <select name="level">
            <option>Entry Level</option>
            <option>Intermediate</option>
            <option>Experienced</option>
        </select>

        <label>Project Management Tool:</label>
        <select name="projectManagementTool">
            <option>Open Project</option>
            <option>Bug Tracker Mantis</option>
            <option>JIRA</option>
            <option>Dollibar</option>
            <option>Hubstaff</option>
            <option>Upwork Dashboard</option>
        </select>

        <label>Ticket ID:</label>
        <input type="text" name="ticketId" value="{{$project->ticket_id}}">

        <label>SDLC Model:</label>
        @php
        $modelsArr = ['Waterfall','Agile','Prototype','V Model','Iterative Model'];
        @endphp
        <select name="sdlcModel">
            @if(count($modelsArr)>0)
            @foreach($modelsArr as $modelOptionValue)
            <option @if($modelOptionValue==$project->sdlc_model)
                {{"selected"}}
                @endif
                >{{$modelOptionValue}}</option>
            @endforeach
            @endif

        </select>

        <label>Project Location:</label>
        <select name="projectLocation">
            <option @if($project->project_location=="Remote")
                {{"selected"}}
                @endif >Remote</option>
            <option @if($project->project_location=="Onsite")
                {{"selected"}}
                @endif

                >Onsite</option>
        </select>

        <label>Community:</label>
        @php
        $communityArr = ['Slack','Skype','WhatsApp','Telegram','Trello','JIRA Connect','Teams','Google Meet'];
        @endphp
        <select name="community">
            @if(count($communityArr)>0)
            @foreach($communityArr as $communityOptionValue)
            <option @if($communityOptionValue==$project->community)
                {{"selected"}}
                @endif
                >{{$communityOptionValue}}</option>
            @endforeach
            @endif
        </select>

        <label>Client Contact Number:</label>
        <input type="text" name="clientContactNumber" value="{{$project->client_contact_number}}">

        <label>Client Email Address:</label>
        <input type="email" name="clientEmailAddress" value="{{$project->client_email_address}}">

        <input type="submit" value="Update">
    </form>
</div>
</div>
@endsection
