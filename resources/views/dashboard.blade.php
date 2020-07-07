@extends('master')
@section('head')
<script>
  function setPercent(id) {
    var value=$('#percentof'+id).val();
    $.get('/streets/'+id+'/percent/'+value, function(ketqua) {
      alert(ketqua);
		});
  }

  
</script>
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
        <div class="row">
          @foreach($streets as $street)
          <div class="col-xl-3 col-lg-6 col-sm-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">{{$street->name}}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
                <div class="mt-3 info-box">
                  @foreach($street->lamps as $lamp)
                    @if($lamp->status == 'error')
                      <span title="UID: {{$lamp->uid}}" class="mx-1 info-box-icon bg-warning"><i class="fa fa-lightbulb-o"></i></span>
                    @else
                    @if($street->is_on())
                      <span title="UID: {{$lamp->uid}}" class="mx-1 info-box-icon bg-success"><i class="fa fa-lightbulb-o"></i></span>
                    @else
                      <span title="UID: {{$lamp->uid}}" class="mx-1 info-box-icon bg-default"><i class="fa fa-lightbulb-o"></i></span>
                    @endif
                    @endif
                  @endforeach
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if($street->is_error())
                <button type="button" class="btn btn-block btn-warning btn-lg">Có lỗi</button>
                @elseif($street->is_on())
                <button type="button" class="btn btn-block btn-success btn-lg">Đang bật</button>
                @else
                <button type="button" class="btn btn-block btn-danger btn-lg">Đang tắt</button>
                @endif
                <hr>
                <input type="text" id="percentof{{$street->id}}" value="" class="slider form-control" data-slider-min="0" data-slider-max="10"
                data-slider-step="1" data-slider-value="{{$street->percent}}" data-slider-orientation="horizontal"
                data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                <hr>
                <a class="btn btn-app" onclick="setPercent({{$street->id}})">
                  <i class="fa fa-play"></i> Chỉnh độ sáng
                </a>
                <a href="{{route('user.street.onoff.get', ['id'=>$street->id])}}" class="btn btn-app">
                  <i class="fa fa-power-off"></i> Bật/Tắt Đèn
                </a>
                <a class="btn btn-app">
                  <i class="fa fa-clock-o"></i> Hẹn Giờ
                </a>
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

@section('script')
<script>
</script>
@stop