@extends('dashboard.admin')

@section('internal-style')
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 50%;
    margin: auto;
    overflow: hidden;
    padding: 20px;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 30px;
}

h2 {
    text-align: center;
    color: #333;
}

label {
    display: inline;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="date"],
input[type="email"],
input[type="file"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

textarea {
    height: 100px;
}

input[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #4cae4c;
}
</style>
@endsection


@section('admin-content')
<div class="container">
    <h2>Project Information Form</h2>
    <form action="{{url('admin/manage-project/add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Project Name:</label>
        <input type="text" name="projectName">

        <label>Project Description:</label>
        <textarea name="projectDescription"></textarea>

        <label>Project Type:</label>
        <select name="projectType">
            <option>Small</option>
            <option>Medium</option>
            <option>Large</option>
            <option>Enterprise</option>
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
        <input type="number" name="totalSprint" id="totalSprint" readonly />
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
        <input type="date" name="startTime">

        <label>Team Size:</label>
        <input type="number" name="teamSize" min="1" step="1">
        <!-- SkillSet Handling Code -->
        <label for="skillSet">Skill Set:</label>
        <br />
        <div id="selected-checkboxes" style="height:100px;overflow:scroll;overflow-X:hidden;"></div>
        <input type="text" id="skillInput" placeholder="Type Skills..." />
        <div class="checkbox-group">
            @if (count($skills) > 0)
            <div style="height:100px;overflow:scroll;overflow-X:hidden" id="skillsContainer">
                @foreach ($skills as $skill)
                <label style="display:block;">
                    <input type="checkbox" class="skillCheckbox" name="skillSet[]"
                        value="{{$skill->name}}">{{$skill->name}}
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
                        var clonedLabel = this.parentElement.cloneNode(true);
                        selectedCheckboxes.appendChild(clonedLabel);
                    } else {
                        var labelToRemove = selectedCheckboxes.querySelector('label[value="' +
                            this.value + '"]');
                        if (labelToRemove) {
                            selectedCheckboxes.removeChild(labelToRemove);
                        }
                    }
                });
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
            <option value="{{$user->id}}">
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
        <input type="text" name="reference">

        <label>Attachment:</label>
        <input type="file" name="attachment">

        <label>Git Repository:</label>
        <input type="text" name="gitRepo">

        <label>Client Name:</label>
        <input type="text" name="clientName">

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
        <input type="text" name="ticketId">

        <label>SDLC Model:</label>
        <select name="sdlcModel">
            <option>Waterfall</option>
            <option>Agile</option>
            <option>Prototype</option>
            <option>V Model</option>
            <option>Iterative Model</option>
        </select>

        <label>Project Location:</label>
        <select name="projectLocation">
            <option>Remote</option>
            <option>Onsite</option>
        </select>

        <label>Community:</label>
        <select name="community">
            <option>Slack</option>
            <option>Skype</option>
            <option>WhatsApp</option>
            <option>Telegram</option>
            <option>Trello</option>
            <option>JIRA Connect</option>
            <option>Teams</option>
            <option>Google Meet</option>
        </select>

        <label>Client Contact Number:</label>
        <input type="text" name="clientContactNumber">

        <label>Client Email Address:</label>
        <input type="email" name="clientEmailAddress">

        <input type="submit" value="Submit">
    </form>
</div>
@endsection