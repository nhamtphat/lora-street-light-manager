@extends('master')
@section('head')
<script>
function setPercent(id) {
    var onoff = document.getElementById("btn" + id);
    onoff.innerHTML = onoff.innerHTML.replace('<i class="fa fa-play"></i>', '<i class="fa fa-spinner fa-spin fa-3x"></i>');
    var value = $('#percentof' + id).val();
    $.get('/streets/' + id + '/percent/' + value, function(ketqua) {
        onoff.innerHTML = onoff.innerHTML.replace('<i class="fa fa-spinner fa-spin fa-3x"></i>', '<i class="fa fa-play"></i>');
        alert(ketqua);
    });
}

function setOnoff(id) {
    var onoff = document.getElementById("btn" + id);
    onoff.innerHTML = onoff.innerHTML.replace('<i class="fa fa-power-off"></i>', '<i class="fa fa-spinner fa-spin fa-3x"></i>');
    $.get('/streets/' + id + '/onoff', function(ketqua) {
        console.log(ketqua);
        var element = document.getElementById("street" + id);
        if (ketqua.state == "off") {
            element.innerHTML = element.innerHTML.replace(/bg-success/gi, 'bg-default')
                                                .replace(/btn-success/gi, 'btn-danger')
                                                .replace('Đang bật', 'Đang tắt');
        } else if (ketqua.state == "on") {
            element.innerHTML = element.innerHTML.replace(/bg-default/gi, 'bg-success')
                                                .replace(/btn-danger/gi, 'btn-success')
                                                .replace('Đang tắt', 'Đang bật');
        } else if (ketqua.state == "error") {
            element.innerHTML = element.innerHTML.replace(/bg-default/gi, 'bg-default')
                                                .replace(/btn-danger/gi, 'btn-warning')
                                                .replace('Đang bật', 'Mất kết nối') 
                                                .replace('Đang tắt', 'Mất kết nối');
        }
        onoff.innerHTML = onoff.innerHTML.replace('<i class="fa fa-spinner fa-spin fa-3x"></i>', '<i class="fa fa-power-off"></i>');
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
                <div class="col-xl-3 col-lg-6 col-sm-12" >
                    <div class="card card-default">
                        <div class="card-header" id="street{{$street->id}}">
                            <h3 class="card-title">{{$street->name}}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                        class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                            <div class="mt-3 info-box">
                                @foreach($street->lamps as $lamp)
                                @php
                                    if($lamp->status == 'error') {
                                    $color='bg-warning';
                                    } else {
                                        if($street->is_on()) { 
                                            $color='bg-success'; 
                                        } else { 
                                            $color='bg-default'; 
                                        }
                                    }
                                @endphp
                                <span title="UID: {{$lamp->uid}}" class="mx-1 info-box-icon {{$color}}" id="lamp{{$lamp->id}}"><i
                                        class="fa fa-lightbulb-o"></i></span>
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
                            <input type="text" id="percentof{{$street->id}}" value="" class="slider form-control"
                                data-slider-min="0" data-slider-max="10" data-slider-step="1"
                                data-slider-value="{{$street->percent}}" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                            <hr>
                            <div id="btn{{$street->id}}">
                                <a class="btn btn-app" onclick="setPercent({{$street->id}})">
                                    <i class="fa fa-play"></i> Chỉnh độ sáng
                                </a>
                                <a class="btn btn-app" onclick="setOnoff({{$street->id}})">
                                    <i class="fa fa-power-off"></i> Bật/Tắt Đèn
                                </a>
                                <a href="{{route('user.street.view.get', ['id'=>$street->id])}}" class="btn btn-app">
                                    <i class="fa fa-briefcase"></i> Quản lý
                                </a>
                                <a href="{{route('user.street.refresh.get', ['id'=>$street->id])}}">F5</a>
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
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        console.log('dom ok');
        setInterval(() => {
            $.get('/streets/checkerror', function(ketqua) {
                ketqua.forEach(element => {
                    var lamp = document.getElementById("lamp" + element);
                    var newhtml = lamp.outerHTML.replace('bg-default', 'bg-warning').replace('bg-success', 'bg-warning');
                    lamp.outerHTML = newhtml;
                });
            });
        }, 1000);
    });
</script>
@stop