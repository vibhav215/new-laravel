@extends('dashboard.admin');

@section('admin-content')
<b>Edit Role</b>
<a href="{{url('admin/manage-role/add')}}">
    <a href="{{url('admin/manage-role')}}">Back</a>
</a>
<form method="POST" action="{{url('admin/manage-role/update/' . $role->id)}}">
    @csrf
    @method('PUT')
    <p>Enter Designation :
        <input type="text" name="designation" value="{{$role->designations}}" required>
        <input type="submit" name="submit" value="Update" />
    </p>
</form>
@endsection