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
<b>Roles List</b>
<a href="{{ url('admin/manage-role/add') }}">
    <button class="btn-custom">
        Add Role
    </button>
</a>
@if (count($roles) > 0)
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->designations}}</td>
                <td>
                    <a href="{{ url('admin/manage-role/edit/' . $role->id) }}" class="btn-custom">Edit</a>
                </td>
                <td>
                    <form action="{{ url('admin/manage-role/' . $role->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="submit" value="Delete" class="btn-custom">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection