@extends('dashboard.admin')


@section('internal-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
table {
    width: 50%;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

.formcontrol {
    width: 100%;
}

.badge {
    display: inline-block;
    padding: 5px;
    font-size: 10px;
    color: #fff;
    font-weight: bold;
    background-color: grey;
    border-radius: 5px;
    text-align: center;
    font-family: Arial, sans-serif;
    margin: 5px;
}

.loader {
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto;
    margin: 0px auto;
}
</style>
@endsection

@section('admin-content')
<h3>
    Add Member to Team |
    <a href="{{url('admin/manage-team')}}">
        <button>
            back
        </button>
    </a>
</h3>
<form action="{{url('admin/manage-team/add')}}" method="POST">
    @csrf
    <table>
        <tr>
            <th>Select Project</th>
            <td>
                <select class="formcontrol" onchange="handleAjaxProjectForm(this.value);" name="project_id">
                    <option value="">Select Project </option>
                    @if (count($projects) > 0)
                    @foreach ($projects as $project)
                    <option value="{{$project->id}}">{{$project->project_name}}</option>
                    @endforeach
                    @endif
                </select>
            </td>
        </tr>
        <script>
        function handleAjaxProjectForm(project_id) {
            if (project_id.trim() == "") {
                window.alert('Please Select Some Project');
            }

            document.querySelector("#ajax_project_form").innerHTML = `<div class="loader">
    <i class="fas fa-spinner fa-spin fa-3x"></i>
  </div>`;

            let api = fetch(`{{url('api/ajax/project_listing')}}/${project_id}`, {
                headers: {
                    "Content-Type": "application/json;charset=utf-8"
                }
            }).then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Api Error');
                }
            }).then((result) => {
                if (result.code == 200 && result.status == true) {
                    setTimeout(() => {
                        document.querySelector("#ajax_project_form").innerHTML = result.data.html;
                    }, 2000);
                }
            }).catch((error) => {
                console.log('error', error);
            })



        }
        </script>
        <tbody id="ajax_project_form">

        </tbody>

    </table>
</form>
@endsection