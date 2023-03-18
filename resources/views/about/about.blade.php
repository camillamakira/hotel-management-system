@extends('layouts.master')

@section('title', 'About Us')

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
<!-- <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create About</a> -->
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="about-datatable">
<thead>
<tr>
<th>Id</th>
<th>Name</th>
<th>History</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- boostrap about model -->
<div class="modal fade" id="about-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="AboutModal"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="AboutForm" name="AboutForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
<div class="errorMsgntainer"></div>   
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="name" class="col-sm-6 control-label"> Title</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" maxlength="50" required="">
</div>
</div> 
<div class="form-group">
<label for="name" class="col-sm-6 control-label"> History</label>
<div class="col-sm-12">
<textarea class="form-control" id="history" name="history" placeholder="Enter History"  rows="3" required="">
</textarea>
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
$('#about-datatable').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('about-datatable') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'history', name: 'history' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
});
function add(){
$('#AboutForm').trigger("reset");
$('#AboutModal').html("Add About");
$('#about-modal').modal('show');
$('#id').val('');
}   
function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('edit-about') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#AboutModal').html("Edit About");
$('#about-modal').modal('show');
$('#id').val(res.id);
$('#title').val(res.title);
$('#history').val(res.history);
}
});
}  
function deleteFunc(id){
if (confirm("Delete Record?") == true) {
var id = id;
// ajax
$.ajax({
type:"POST",
url: "{{ url('delete-about') }}",
data: { id: id },
dataType: 'json',
success: function(res){
var oTable = $('#about-datatable').dataTable();
oTable.fnDraw(false);
}
});
}
}
$('#AboutForm').submit(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: "{{ url('store-about')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#about-modal").modal('hide');
var oTable = $('#about-datatable').dataTable();
oTable.fnDraw(false);
$("#btn-save").html('Submit');
$("#btn-save"). attr("disabled", false);
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