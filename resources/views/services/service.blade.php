@extends('layouts.master')

@section('title', 'Services')

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
<a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Service</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="service-datatable">
<thead>
<tr>
<th>Id</th>
<th>Name</th>
<th>Description</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- boostrap service model -->
<div class="modal fade" id="service-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="ServiceModal"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="ServiceForm" name="ServiceForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="name" class="col-sm-6 control-label"> Title</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" maxlength="50" required="">
</div>
</div> 
<div class="form-group">
<label for="name" class="col-sm-6 control-label"> Description</label>
<div class="col-sm-12">
<textarea class="form-control" id="description" name="description" placeholder="Enter Description" maxlength="50" rows="3" required="">
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
$('#service-datatable').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('service-datatable') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'description', name: 'description' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
});
function add(){
$('#ServiceForm').trigger("reset");
$('#ServiceModal').html("Add Service");
$('#service-modal').modal('show');
$('#id').val('');
}   
function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('edit-service') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#ServiceModal').html("Edit Service");
$('#service-modal').modal('show');
$('#id').val(res.id);
$('#title').val(res.title);
$('#description').val(res.description);
}
});
}  
function deleteFunc(id){
if (confirm("Delete Record?") == true) {
var id = id;
// ajax
$.ajax({
type:"POST",
url: "{{ url('delete-service') }}",
data: { id: id },
dataType: 'json',
success: function(res){
var oTable = $('#service-datatable').dataTable();
oTable.fnDraw(false);
}
});
}
}
$('#ServiceForm').submit(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: "{{ url('store-service')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#service-modal").modal('hide');
var oTable = $('#service-datatable').dataTable();
oTable.fnDraw(false);
$("#btn-save").html('Submit');
$("#btn-save"). attr("disabled", false);
},
error: function(data){
console.log(data);
}
});
});
</script>
@endsection