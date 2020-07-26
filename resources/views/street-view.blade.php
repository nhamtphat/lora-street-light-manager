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
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Nhập thông tin biên nhận</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>UID</th>
                                        <th>Độ sáng</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 50px" ></th>
                                    </tr>
                                    @php $i = 1 @endphp
                                    @foreach($street->lamps as $lamp)
                                    <tr>
                                        <td>{{$i++}}.</td>
                                        <td>{{ $lamp->uid }}</td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-primary"
                                                    style="width: {{ $street->percent *10 }}%"></div>
                                            </div>
                                        </td>
                                        @if($lamp->status == 'normal')
                                        <td><span class="badge bg-success">Bình thường</span></td>
                                        @else
                                        <td><span class="badge bg-danger">Lỗi</span></td>
                                        @endif
                                        <td>
                                            <a href="{{route('user.lamp.on.get', ['id'=>$lamp->id])}}" type="button" class="btn btn-default"><i class="fa fa-lightbulb-o"></i></a>
                                            <a href="{{route('user.lamp.off.get', ['id'=>$lamp->id])}}" type="button" class="btn btn-default"><i class="fa fa-power-off"></i></a>
                                            <a href="{{route('user.lamp.refresh.get', ['id'=>$lamp->id])}}" type="button" class="btn btn-default"><i class="fa fa-refresh"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

@section('scripts')
<script>
$("#add-field").click(function() {
    $("#form-field").append(
        '<div class="form-group"><div class="input-group"><input type="number" name="lamp_uid[]" min="100" max="999" class="form-control" placeholder="UID của đèn" required><span class="input-group-append">\
                    <input type="button" class="btn btn-danger remove-field" value="Xoá dòng này" ></span></div></div>'
    );
});

$(document).on("click", ".remove-field", function() {
    $(this).closest(".form-group").remove();
});
</script>
@stop