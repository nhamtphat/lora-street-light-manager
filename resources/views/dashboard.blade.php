@extends('master')
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
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Tuyến Mậu Thân (dưới)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-block btn-success btn-lg">Success</button>
                <hr>
                <input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="100"
                data-slider-step="5" data-slider-value="0" data-slider-orientation="horizontal"
                data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                <hr>
                <a class="btn btn-app">
                  <i class="fa fa-play"></i> Chỉnh độ sáng
                </a>
                <a class="btn btn-app">
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
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Tuyến Mậu Thân (trên)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-block btn-warning btn-lg">Lỗi đèn</button>
                <hr>
                <input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="100"
                data-slider-step="5" data-slider-value="0" data-slider-orientation="horizontal"
                data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                <hr>
                <a class="btn btn-app">
                  <i class="fa fa-play"></i> Chỉnh độ sáng
                </a>
                <a class="btn btn-app">
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
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Tuyến 3/2</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-block btn-danger btn-lg">Đang tắt</button>
                <hr>
                <input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="100"
                data-slider-step="5" data-slider-value="0" data-slider-orientation="horizontal"
                data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                <hr>
                <a class="btn btn-app">
                  <i class="fa fa-play"></i> Chỉnh độ sáng
                </a>
                <a class="btn btn-app">
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
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Tuyến Trần Hưng Đạo</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-block btn-danger btn-lg">Đang tắt</button>
                <hr>
                <input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="100"
                data-slider-step="5" data-slider-value="0" data-slider-orientation="horizontal"
                data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                <hr>
                <a class="btn btn-app">
                  <i class="fa fa-play"></i> Chỉnh độ sáng
                </a>
                <a class="btn btn-app">
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @stop