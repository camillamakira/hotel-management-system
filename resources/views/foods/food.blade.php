@extends('layouts.master')

@section('title', 'Foods')

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
<a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Food</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="food-datatable">
<thead>
<tr>
<th>Id</th>
<th>Name</th>
<th>Price</th>
<th>Created at</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- boostrap food model -->
<div class="modal fade" id="food-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="FoodModal"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="FoodForm" name="FoodForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Food Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="name" name="name" placeholder="Enter Food Name" maxlength="50" required="">
</div>
</div>  
<div class="form-group">
<label class="col-sm-2 control-label">Price</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" required="">
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
$('#food-datatable').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('food-datatable') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'price', name: 'price' },
{ data: 'created_at', name: 'created_at' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
});
function add(){
$('#FoodForm').trigger("reset");
$('#FoodModal').html("Add Food");
$('#food-modal').modal('show');
$('#id').val('');
}   
function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('edit-food') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#FoodModal').html("Edit Food");
$('#food-modal').modal('show');
$('#id').val(res.id);
$('#name').val(res.name);
$('#price').val(res.price);
}
});
}  
function deleteFunc(id){
if (confirm("Delete Record?") == true) {
var id = id;
// ajax
$.ajax({
type:"POST",
url: "{{ url('delete-food') }}",
data: { id: id },
dataType: 'json',
success: function(res){
var oTable = $('#food-datatable').dataTable();
oTable.fnDraw(false);
}
});
}
}
$('#FoodForm').submit(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: "{{ url('store-food')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#food-modal").modal('hide');
var oTable = $('#food-datatable').dataTable();
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