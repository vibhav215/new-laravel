@extends('dashboard.admin')

@section('internal-style')
<style>
    .project-management-page .card-footer-left-buttons {
        float: left;
    }

    .project-management-page {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .project-management-page .container {
        width: 90%;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .project-management-page h1 {
        text-align: center;
        color: #333;
    }

    .project-management-page .filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .project-management-page .filters input,
    .project-management-page .filters select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: calc(25% - 10px);
        margin-bottom: 10px;
    }

    .project-management-page .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .project-management-page .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .project-management-page .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .project-management-page .card-header h2 {
        margin: 0;
        font-size: 1.5em;
    }

    .project-management-page .card-body p {
        margin: 10px 0;
    }

    .project-management-page .card-footer {
        text-align: right;
    }

    .project-management-page .card-footer a {
        color: #3498db;
        text-decoration: none;
    }

    .project-management-page .card-footer a:hover {
        text-decoration: underline;
    }

    .project-management-page .badge {
        padding: 5px 10px;
        border-radius: 5px;
        color: #fff;
        text-align: center;
        display: inline-block;
    }

    .project-management-page .badge.small {
        background-color: #3498db;
    }

    .project-management-page .badge.medium {
        background-color: #f1c40f;
    }

    .project-management-page .badge.large {
        background-color: #e67e22;
    }

    .project-management-page .badge.enterprise {
        background-color: #e74c3c;
    }

    .project-management-page .badge.high {
        background-color: #e74c3c;
    }

    .project-management-page .badge.medium {
        background-color: #f1c40f;
    }

    .project-management-page .badge.low {
        background-color: #2ecc71;
    }

    .project-management-page .badge.open {
        background-color: #3498db;
    }

    .project-management-page .badge.todo {
        background-color: #f1c40f;
    }

    .project-management-page .badge.pending {
        background-color: #e67e22;
    }

    .project-management-page .badge.in-progress {
        background-color: #3498db;
    }

    .project-management-page .badge.testing {
        background-color: #9b59b6;
    }

    .project-management-page .badge.completed {
        background-color: #2ecc71;
    }

    .project-management-page .badge.on-hold {
        background-color: #f39c12;
    }

    .project-management-page .badge.cancelled {
        background-color: #e74c3c;
    }

    .project-management-page .badge.entry {
        background-color: #3498db;
    }

    .project-management-page .badge.intermediate {
        background-color: #f1c40f;
    }

    .project-management-page .badge.experienced {
        background-color: #e67e22;
    }

    .project-management-page .badge.remote {
        background-color: #3498db;
    }

    .project-management-page .badge.onsite {
        background-color: #95a5a6;
    }

    .project-management-page .badge.slack {
        background-color: #3498db;
    }

    .project-management-page .badge.skype {
        background-color: #00aff0;
    }

    .project-management-page .badge.whatsapp {
        background-color: #25d366;
    }

    .project-management-page .badge.telegram {
        background-color: #0088cc;
    }

    .project-management-page .badge.trello {
        background-color: #0079bf;
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
<b style="color:green; font-size:20px;">Projects List</b>
<a href="{{url('admin/manage-project/add')}}">
    <button>
        Add Project
    </button>
</a>

<div class="project-management-page">
    <div class="container">
        <h1>Projects Overview</h1>
        <div class="filters">
            <input type="text" placeholder="Search by project name..." id="search-bar">
            <select id="filter-project-type">
                <option value="">All Types</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="Enterprise">Enterprise</option>
            </select>
            <select id="filter-status">
                <option value="">All Status</option>
                <option value="Open">Open</option>
                <option value="To Do">To Do</option>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Testing">Testing</option>
                <option value="Completed">Completed</option>
                <option value="On Hold">On Hold</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            <select id="filter-priority">
                <option value="">All Priorities</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
        <div class="grid">
            <!-- Repeat -->
            @if (count($projects) > 0)
                @foreach ($projects as $project)
                    <div class="card">
                        <div class="card-header">
                            <h2><a href="#">{{$project->project_name}}</a></h2>
                            <span class="badge small">{{$project->project_type}}</span>
                        </div>
                        <div class="card-body">
                            <p><strong>Description:</strong> {{$project->project_description}}</p>
                            <p><strong>Duration:</strong> {{$project->duration}}</p>
                            <p><strong>Start Time:</strong>{{$project->start_time}}</p>
                            <p><strong>Team Size:</strong> {{$project->team_size}}</p>
                            <p style="word-wrap: break-word;"><strong>Skill Set:</strong>{{$project->skill_set}}</p>
                            <p><strong>Priority:</strong> <span class="badge high">{{$project->priority}}</span></p>
                            <p><strong>Status:</strong> <span class="badge in-progress">{{$project->status}}</span></p>
                            <p><strong>Client Name:</strong> <a href="#">{{$project->client_name}}</a></p>
                            <p><strong>Client @:</strong> <a href="#">{{$project->client_email_address}}</a></p>
                            <p><strong>Client Mobile No:</strong> <a href="#">{{$project->client_contact_number}}</a></p>
                        </div>
                        <hr color="grey" size="4" />
                        <div class="card-footer-left-buttons">
                            <a href="{{url('admin/manage-project/edit/' . $project->id)}}">
                                <button style="background:lightgreen;color:green;border:none;cursor:pointer">
                                    Edit</button>
                            </a>
                            <form action="{{url('admin/manage-project/' . $project->id)}}" method="POST"
                                onsubmit="return window.confirm('Do you Really Want to Delete');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:pink;color:red;border:none;cursor:pointer">Delete</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="#">More Details</a>
                            <br />
                             <a href="{{url('admin/manage-project/agreement/' . $project->id)}}">Download Contract</a>
                    </div>
                </div>
            @endforeach
        @endif
        <!-- More cards as needed -->
    </div>
</div>



@endsection
