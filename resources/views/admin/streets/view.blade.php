@extends('admin.layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">Danh sách tuyến đèn</h1>
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
                    <th>UID</th>
                    <th>Độ sáng</th>
                    <th>Tình trạng</th>
                    <th>Trạng thái</th>
                    <th style="width: 50px"></th>
                  </tr>
                  @foreach($street->lamps as $lamp)
                  <tr>
                    <td>{{ $lamp->uid }}</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-primary" style="width: {{ $street->level *10 }}%"></div>
                      </div>
                    </td>
                    <td>
                      @if($lamp->state == 'normal')
                      <span class="badge bg-success">Bình thường</span>
                      @else
                      <span class="badge bg-danger">Lỗi</span>
                      @endif
                    </td>
                    <td>
                      @if($lamp->status == 'on')
                      <span class="badge bg-success">Bật</span>
                      @else
                      <span class="badge bg-danger">Tắt</span>
                      @endif
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="{{route('user.lamp.on.get', ['id'=>$lamp->id])}}" type="button"
                          class="btn btn-default"><i class="fa fa-lightbulb-o"></i></a>
                        <a href="{{route('user.lamp.off.get', ['id'=>$lamp->id])}}" type="button"
                          class="btn btn-default"><i class="fa fa-power-off"></i></a>
                        <a href="{{route('user.lamp.reset.get', ['id'=>$lamp->id])}}" type="button"
                          class="btn btn-default"><i class="fa fa-refresh"></i></a>
                      </div>
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