@extends('admin.layouts.master')
@section('head')
<!-- bootstrap slider -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-slider/css/bootstrap-slider.min.css') }}">
@stop
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">Các tuyến đèn đường</h1>
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
        <div class="col-xl-4 col-lg-6 col-sm-12">
          <div class="card card-default">
            <div class="card-header" id="street{{$street->id}}">
              <h3 class="card-title">{{$street->name}}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
              <div class="mt-3 info-box">
                @foreach($street->lamps as $lamp)
                @php
                if($lamp->state == 'error') {
                  $color='bg-warning';
                } else {
                  if($lamp->is_on()) {
                    $color='bg-success';
                  } else {
                    $color='bg-default';
                  }
                }
                @endphp
                <span title="UID: {{$lamp->uid}}" class="mx-1 info-box-icon {{$color}}" id="lamp{{$lamp->id}}"><i
                    class="fas fa-lightbulb"></i></span>
                @endforeach
              </div>
              @if($street->is_error())
              <button type="button" class="btn btn-block btn-warning btn-lg">Mất kết nối</button>
              @elseif($street->is_on())
              <button type="button" class="btn btn-block btn-success btn-lg">Đang bật</button>
              @else
              <button type="button" class="btn btn-block btn-danger btn-lg">Đang tắt</button>
              @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="slider-red">
                <input type="text" id="percentof{{$street->id}}" value="" class="slider form-control" data-slider-min="0" data-slider-max="10"
                           data-slider-step="1" data-slider-value="{{$street->level}}" data-slider-orientation="horizontal"
                           data-slider-selection="before" data-slider-tooltip="show">
              </div>
              <hr>
              <div id="btn{{$street->id}}">
                <a class="btn btn-app" onclick="setPercent({{$street->id}})">
                  <i class="fas fa-play"></i> Chỉnh độ sáng
                </a>
                <a class="btn btn-app" onclick="setOn({{$street->id}})">
                  <i class="fas fa-lightbulb"></i> Bật Đèn
                </a>
                <a class="btn btn-app" onclick="setOff({{$street->id}})">
                  <i class="fas fa-power-off"></i> Tắt Đèn
                </a>
                <a href="{{route('user.streets.show', ['street'=>$street->id])}}" class="btn btn-app">
                  <i class="fas fa-briefcase"></i> Quản lý
                </a>
                <a href="{{route('user.streets.reset', ['street'=>$street->id])}}" class="btn btn-app">
                  <i class="fas fa-retweet"></i> Reset
                </a>
              </div>
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
<!-- Bootstrap slider -->
<script src="{{ asset('plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>
<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').bootstrapSlider()
  });
</script>
<!-- AJAX STREET CONTROLLER -->
<script>
  function setPercent(id) {
    var onoff = document.getElementById("btn" + id);
    onoff.innerHTML = onoff.innerHTML.replace('<i class="fas fa-play"></i>', '<i class="fas fa-spinner fa-spin fa-3x"></i>');
    var value = $('#percentof' + id).val();
    $.get('/api/streets/' + id + '/level/' + value, function(result) {
        onoff.innerHTML = onoff.innerHTML.replace('<i class="fas fa-spinner fa-spin fa-3x"></i>', '<i class="fas fa-play"></i>');
        console.log(result)
    });
  }

  function setOn(id) {
    var onoff = document.getElementById("btn" + id);
    onoff.innerHTML = onoff.innerHTML.replace('<i class="fas fa-lightbulb"></i>', '<i class="fas fa-spinner fa-spin fa-3x"></i>');
    $.get('/api/streets/' + id + '/on', function(result) {
        console.log(result);
        var element = document.getElementById("street" + id);
        if (result.state == "normal") {
            if (result.status == "on") {
              element.innerHTML = element.innerHTML.replace(/bg-default/gi, 'bg-success')
                                                  .replace(/btn-danger/gi, 'btn-success')
                                                  .replace('Đang tắt', 'Đang bật');
            }
        } else if (result.state == "error") {
            element.innerHTML = element.innerHTML.replace(/bg-default/gi, 'bg-default')
                                                .replace(/btn-danger/gi, 'btn-warning')
                                                .replace('Đang bật', 'Mất kết nối') 
                                                .replace('Đang tắt', 'Mất kết nối');
        }
        
        onoff.innerHTML = onoff.innerHTML.replace('<i class="fas fa-spinner fa-spin fa-3x"></i>', '<i class="fas fa-lightbulb"></i>');
        
    }).fail( function(xhr, textStatus, errorThrown) {
      location.reload();
    });
  }

  function setOff(id) {
    var onoff = document.getElementById("btn" + id);
    onoff.innerHTML = onoff.innerHTML.replace('<i class="fas fa-power-off"></i>', '<i class="fas fa-spinner fa-spin fa-3x"></i>');
    $.get('/api/streets/' + id + '/off', function(result) {
        console.log(result);
        var element = document.getElementById("street" + id);
        if (result.state == "normal" && result.status == "off") {
          element.innerHTML = element.innerHTML.replace(/bg-success/gi, 'bg-default')
                                              .replace(/btn-success/gi, 'btn-danger')
                                              .replace('Đang bật', 'Đang tắt');
        }
        
        else if (result.state == "error") {
          element.innerHTML = element.innerHTML.replace(/bg-default/gi, 'bg-default')
                                              .replace(/btn-danger/gi, 'btn-warning')
                                              .replace('Đang bật', 'Mất kết nối') 
        }
        
        onoff.innerHTML = onoff.innerHTML.replace('<i class="fas fa-spinner fa-spin fa-3x"></i>', '<i class="fas fa-power-off"></i>');
        
    }).fail( function(xhr, textStatus, errorThrown) {
      location.reload();
    });
  }
</script>

<!-- AJAX AUTO CHECK ERROR LAMPS -->
<script>
  $( document ).ready(function() {
    console.log('ready!');
    setInterval(() => {
        $.get('/api/streets/errorlamps', function(ketqua) {
            ketqua.forEach(element => {
                var lamp = document.getElementById("lamp" + element);
                var newhtml = lamp.outerHTML.replace('bg-default', 'bg-warning').replace('bg-success', 'bg-warning');
                lamp.outerHTML = newhtml;
            });
        });
    }, 3000);
  });
</script>
@stop