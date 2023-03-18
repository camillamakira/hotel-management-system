@extends('layouts.master')

@section('title', 'Users')

@section('content')

<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="float-left">
    <ol class="breadcrumb float-sm-right">
      @if (Auth::user()->role == 'admin')
      <li class="breadcrumb-item"><a href="{{url('admin_dashboard')}}">Home</a></li>
      @elseif(Auth::user()->role == 'manager')
      <li class="breadcrumb-item"><a href="{{url('manager_dashboard')}}">Home</a></li> 
      @else
      <li class="breadcrumb-item"><a href="{{url('user_dashboard')}}">Home</a></li> 
      @endif
      <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
</div>
<div class="float-right mb-2">
<a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create User</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="user-datatable">
<thead>
<tr>
<th>Id</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- boostrap user model -->
<div class="modal fade" id="user-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="UserModal"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="UserForm" name="UserForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
<div class="errorMsgntainer"></div>   
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="name" class="col-sm-2 control-label">First Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" maxlength="50" required="">
</div>
</div>
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Last Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" maxlength="50" required="">
</div>
</div>  
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Email</label>
<div class="col-sm-12">
<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="50" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Role</label>
<div class="col-sm-12">
     <select name="role" id="role" class="form-control" maxlength="50" required="">
        <option value="user">User</option>
        <option value="manager">Manager</option>
        <option value="admin">Administrator</option>
      </select>
</div>
</div>
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Phone Number</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Format 07XXXXXXXXX"maxlength="10" >
</div>
</div> 
<div class="col-md-12">
<div class="form-group">
<input type="file" name="images[]" id="images" placeholder="Choose images" multiple >
</div>
<div class="col-md-12">
<div class="mt-1 text-center">
<div class="show-multiple-image-preview"> </div>
</div>  
</div>
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary" id="btn-save">Save changes
</button>
</div>
</form>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
<!-- end bootstrap model -->
<script type="text/javascript">
$(document).ready( function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$(function() {
// Multiple images preview with JavaScript
var ShowMultipleImagePreview = function(input, imgPreviewPlaceholder) {
if (input.files) {
var filesAmount = input.files.length;
for (i = 0; i < filesAmount; i++) {
var reader = new FileReader();
reader.onload = function(event) {
$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
}
reader.readAsDataURL(input.files[i]);
}
}
};
$('#images').on('change', function() {
ShowMultipleImagePreview(this, 'div.show-multiple-image-preview');
});
});
$('#user-datatable').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('user-datatable') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'first_name', name: 'first_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'email', name: 'email' },
{ data: 'role', name: 'role' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
});
function add(){
$('#UserForm').trigger("reset");
$('#UserModal').html("Add User");
$('#user-modal').modal('show');
$('#id').val('');
}   
function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('edit-user') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#UserModal').html("Edit User");
$('#user-modal').modal('show');
$('#id').val(res.id);
$('#first_name').val(res.first_name);
$('#last_name').val(res.last_name);
$('#email').val(res.email);
$('#role').val(res.role);
$('#phone_no').val(res.phone_no);
$('#photo').val(res.photo);
}
});
}  
function deleteFunc(id){
if (confirm("Delete Record?") == true) {
var id = id;
// ajax
$.ajax({
type:"POST",
url: "{{ url('delete-user') }}",
data: { id: id },
dataType: 'json',
success: function(res){
var oTable = $('#user-datatable').dataTable();
oTable.fnDraw(false);
}
});
}
}
$('#UserForm').submit(function(e) {
e.preventDefault();
var formData = new FormData(this);
let TotalImages = $('#images')[0].files.length; //Total Images
let images = $('#images')[0];
for (let i = 0; i < TotalImages; i++) {
formData.append('images' + i, images.files[i]);
}
formData.append('TotalImages', TotalImages);
$.ajax({
type:'POST',
url: "{{ url('store-user')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#user-modal").modal('hide');
var oTable = $('#user-datatable').dataTable();
oTable.fnDraw(false);
$("#btn-save").html('Submit');
$("#btn-save"). attr("disabled", false);
alert('User has been created successfully');
},
error: function(data){
  let error = data.responseJSON;
$.each(error.errors, function (index, value) {
    $('.errorMsgntainer').append('<span class="text-danger">'+value+'<span>'+'<br>');
});
console.log(data);
}
});
});
</script>
@endsection