@extends('admin.layouts.master')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{secure_asset('plugins/datatables/dataTables.bootstrap4.css')}}">
<style>
  .btn-app {
    height: unset;
  }

  .app-number-of-lamp {
    display: block;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    font-size: 2rem;
  }
</style>
@stop
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Bảng điều khiển</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      @foreach ($provinces as $province)
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-map-marker"></i>
                {{ $province->name }}
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a class="btn btn-app float-right bg-default">
                <span class="app-number-of-lamp">{{ $province->listOfLampsIsOff()->count() }}</span> Đèn tắt
              </a>
              <a class="btn btn-app float-right bg-success">
                <span class="app-number-of-lamp">{{ $province->listOfLampsIsOn()->count() }}</span> Đèn bật
              </a>
              <dl>
                <dt>Description lists</dt>
                <dd>A description list is perfect for defining terms.</dd>
              </dl>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      @endforeach
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- DataTables -->
<script src="{{secure_asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{secure_asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    $('#example2').DataTable();
  });
</script>
@stop