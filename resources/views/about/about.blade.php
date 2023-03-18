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
<a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create About</a>
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
<th>Title</th>
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
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Title</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" maxlength="50" required="">
</div>
</div>  
<div class="form-group">
<label class="col-sm-2 control-label">History</label>
<div class="col-sm-12">
<textarea class="form-control" id="history" name="history" placeholder="Enter History" rows="3" required="">
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
let TotalImages = $('#images')[0].files.length; //Total Images
let images = $('#images')[0];
for (let i = 0; i < TotalImages; i++) {
formData.append('images' + i, images.files[i]);
}
formData.append('TotalImages', TotalImages);
$.ajax({
type:'POST',
url: "{{ url('store-about')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#about-modal").modal('hide');
var oTable = $('about-datatable').dataTable();
oTable.fnDraw(false);
$("#btn-save").html('Submit');
$("#btn-save"). attr("disabled", false);
alert('About has been created successfully');
},
error: function(data){
console.log(data);
}
});
});
</script>
@endsection