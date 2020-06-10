@extends('master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hẹn giờ tuyến Mậu Thân (trên)</h1>
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
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>Tên nhiệm vụ</th>
                    <th>Thời gian</th>
                    <th>Lệnh</th>
                    <th>Độ sáng</th>
                  </tr>
                  <tr>
                    <td>1.</td>
                    <td>Bật đèn lúc chiều</td>
                    <td>18:00:00</td>
                    <td>
                      <div class="btn btn-success">Bật đèn</div>
                    </td>
                    <td>100%</td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Giảm độ sáng lúc 0h</td>
                    <td>00:00:00</td>
                    <td>
                      <div class="btn btn-info">Chỉnh độ sáng</div>
                    </td>
                    <td>50%</td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Tăng độ sáng lúc 3h</td>
                    <td>03:30:00</td>
                    <td>
                      <div class="btn btn-info">Chỉnh độ sáng</div>
                    </td>
                    <td>100%</td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Tắt đèn vào buổi sáng</td>
                    <td>05:30:00</td>
                    <td>
                      <div class="btn btn-danger">Tắt đèn</div>
                    </td>
                    <td>0%</td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop