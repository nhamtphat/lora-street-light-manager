@extends('admin.layouts.master')
@section('head')
<!-- DataTables -->
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
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">Bảng điều khiển</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Điều khiển tất cả</h3>
            </div>
            <div class="card-body">
              <dl class="float-left">
                <h4>Trạng thái: <span class="text-yellow text-bold">HỖN HỢP</span></h4> 
                <h4>Độ sáng: <span class="text-yellow text-bold">HỖN HỢP</span></h4>
              </dl>   
              <dl class="float-right">
                <a href="{{route('user.provinces.turn.maxall')}}" class="btn bg-red btn-app">
                  <i class="fas fa-sun"></i> Độ sáng 100%
                </a>
                <a href="{{route('user.provinces.turn.midall')}}" class="btn bg-red btn-app">
                  <i class="far fa-sun"></i> Độ sáng 50%
                </a>
                <a href="{{route('user.provinces.turn.offall')}}" class="btn bg-red btn-app">
                  <i class="fas fa-power-off"></i> Tắt tất cả
                </a>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      @foreach ($provinces as $province)
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-map-marked-alt"></i>
                <span class="ml-2">{{ $province->name }}</span>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if ($province->listOfLampsIsOn()->count() > 0)
              <a class="btn btn-app bg-success">
                <span class="app-number-of-lamp">{{ $province->listOfLampsIsOn()->count() }}</span> Đèn bật
              </a>
              @endif
              @if ($province->listOfLampsIsError()->count() > 0)
              <a class="btn btn-app bg-warning">
                <span class="app-number-of-lamp">{{ $province->listOfLampsIsError()->count() }}</span> Đèn lỗi
              </a>
              @endif
              <a class="btn btn-app bg-default">
                <span class="app-number-of-lamp">{{ $province->listOfLampsIsOff()->count() }}</span> Đèn tắt
              </a>
              <dl class="float-right">
                <a href="{{route('user.provinces.turn.on', ['province'=>$province->id])}}" class="btn btn-app">
                  <i class="fas fa-lightbulb"></i> Bật Đèn
                </a>
                <a href="{{route('user.provinces.turn.off', ['province'=>$province->id])}}" class="btn btn-app">
                  <i class="fas fa-power-off"></i> Tắt Đèn
                </a>
                <a href="{{route('user.provinces.show', ['province'=>$province->id])}}" class="btn btn-app">
                  <i class="fas fa-briefcase"></i> Quản lý
                </a>
              </dl>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      @endforeach
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop

@section('scripts')
<script>
  $(function () {
    $('#example2').DataTable();
  });
</script>
@stop