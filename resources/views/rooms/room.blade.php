@extends('layouts.master')

@section('title', 'Rooms')

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
<a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Room</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="room-datatable">
<thead>
<tr>
<th>Id</th>
<th>Name</th>
<th>Price</th>
<th>Size</th>
<th>Capacity</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- boostrap room model -->
<div class="modal fade" id="room-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="RoomModal"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="RoomForm" name="RoomForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
<div class="errorMsgntainer"></div>   
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="name" name="name" placeholder="Enter Room Name" maxlength="50" required="">
</div>
</div>  
<div class="form-group">
<label class="col-sm-2 control-label">Price</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="price" name="price" placeholder="Enter Price(Per Night)" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Size</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="size" name="size" placeholder="Enter Size e.g 30 ft" required="">
</div>
</div>
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Capacity</label>
<div class="col-sm-12">
<input type="number" class="form-control" id="capacity" name="capacity" placeholder="Enter Capacity" min="1" max="1000000" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Bed</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="bed" name="bed" placeholder="Enter bed e.g King Beds" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Services</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="services" name="services" placeholder="Enter Services e.g Wifi,Television... etc" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Description</label>
<div class="col-sm-12">
<textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3" required="">
</textarea>
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
$('#room-datatable').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('room-datatable') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'price', name: 'price' },
{ data: 'size', name: 'size' },
{ data: 'capacity', name: 'capacity' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
});
function add(){
$('#RoomForm').trigger("reset");
$('#RoomModal').html("Add Room");
$('#room-modal').modal('show');
$('#id').val('');
}   
function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('edit-room') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#RoomModal').html("Edit Room");
$('#room-modal').modal('show');
$('#id').val(res.id);
$('#name').val(res.name);
$('#price').val(res.price);
$('#size').val(res.size);
$('#capacity').val(res.capacity);
$('#bed').val(res.bed);
$('#services').val(res.services);
$('#description').val(res.description);
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
url: "{{ url('delete-room') }}",
data: { id: id },
dataType: 'json',
success: function(res){
var oTable = $('#room-datatable').dataTable();
oTable.fnDraw(false);
}
});
}
}
$('#RoomForm').submit(function(e) {
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
url: "{{ url('store-room')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#room-modal").modal('hide');
var oTable = $('#room-datatable').dataTable();
oTable.fnDraw(false);
$("#btn-save").html('Submit');
$("#btn-save"). attr("disabled", false);
alert('Room has been created successfully');
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