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
              <!-- form start -->
              <form role="form" action="{{route('user.street.edit.post', ['id'=>$street->id])}}" method="post">
                {{csrf_field()}}
                <div class="card-body" id="form-field">
                  <div class="form-group">
                    <label for="name">Tên tuyến đường:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Tên tuyến đường hoặc cụm đèn" value="{{$street->name}}" required>
                  </div>
                  <div class="form-group">
                    <label for="cpu">Ấn nút để thêm đèn</label>
                  </div>
                  @foreach($street->lamps as $lamp)
                  <div class="form-group">
                    <div class="input-group">
                      <input type="number" name="lamp_uid[]" min="100" max="999" class="form-control" placeholder="UID của đèn" value="{{$lamp->uid}}" required>
                      <span class="input-group-append">
                        <input type="button" class="btn btn-danger remove-field" value="Xoá dòng này" >
                      </span>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div class="card-body">
                    <div id="add-field" type="submit" class="btn btn-default">Thêm đèn</div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Lưu thông tin đường</button>
                </div>
              </form>
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
    $("#form-field").append('<div class="form-group"><div class="input-group"><input type="number" name="lamp_uid[]" min="100" max="999" class="form-control" placeholder="UID của đèn" required><span class="input-group-append">\
                    <input type="button" class="btn btn-danger remove-field" value="Xoá dòng này" ></span></div></div>');
  });

  $(document).on("click", ".remove-field", function() {
    $(this).closest(".form-group").remove();
  });
  </script>
@stop