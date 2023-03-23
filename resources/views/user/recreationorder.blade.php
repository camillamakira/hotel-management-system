@extends('layouts.master')

@section('title', 'My Recreation Facility Orders')

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
<!-- <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Room</a> -->
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="recreationorder-datatable">
<thead>
<tr>
<th>Id</th>
<th>Facility</th>
<th>Price</th>
<th>Ordered On</th>
</tr>
</thead>
</table>
</div>
</div>
<script type="text/javascript">
$(document).ready( function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('#recreationorder-datatable').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('recreationorder-datatable') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'recreation', name: 'recreation.name' },
{ data: 'price', name: 'recreation.price' },
{ data: 'created_at', name: 'created_at' },
],
order: [[0, 'desc']]
});
});
</script>
@endsection