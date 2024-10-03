@extends('dashboard.admin');

@section('admin-content')
<b>Add Role</b>
<a href="{{url('admin/manage-role/add')}}">
    <a href="{{url('admin/manage-role')}}">Back</a>
</a>
<form method="POST" action="{{url('admin/manage-role/add')}}">
    @csrf
    <p>Enter Designation :
        <input type="text" name="designation" required>
        <input type="submit" name="submit" value="Add" />
    </p>
</form>
@endsection