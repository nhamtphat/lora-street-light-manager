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
            @if (session('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-check"></i> Thành công!</h5>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Nhập thông tin biên nhận</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('user.street.edit.post', ['id'=>$street->id])}}"
                            method="post">
                            {{csrf_field()}}
                            <div class="card-body" id="form-field">
                                <div class="form-group">
                                    <label for="province_id">Tỉnh / Thành phố</label>
                                    <select name="province_id" id="province_id" onchange="getDistrictList()"
                                        class="form-control" required>
                                        <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{$province->id}}" @if($province->id == $street->province->id)
                                            selected @endif>{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="district_id">Quận/Huyện</label>
                                    <select id="district_id" name="district_id" onchange="getWardList()"
                                        class="form-control" required>
                                        <option value="{{$street->district->id}}" selected>{{$street->district->name}}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ward_id">Phường/Xã</label>
                                    <select id="ward_id" name="ward_id" class="form-control" required>
                                        <option value="{{$street->ward->id}}" selected>{{$street->ward->name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên tuyến đường:</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Tên tuyến đường hoặc cụm đèn" value="{{$street->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="domain">Tên miền / Địa chỉ IP:</label>
                                    <input name="domain" type="text" class="form-control" id="domain"
                                        placeholder="Tên miền / Địa chỉ IP" value="{{$street->domain}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="cpu">Ấn nút để thêm đèn</label>
                                </div>
                                @foreach($street->lamps as $lamp)
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" name="lamp_uid[]" class="form-control"
                                            placeholder="UID của đèn" value="{{$lamp->uid}}" required>
                                        <span class="input-group-append">
                                            <input type="button" class="btn btn-danger remove-field"
                                                value="Xoá dòng này">
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
    $("#form-field").append(
        '<div class="form-group"><div class="input-group"><input type="number" name="lamp_uid[]" class="form-control" placeholder="UID của đèn" required><span class="input-group-append">\
                    <input type="button" class="btn btn-danger remove-field" value="Xoá dòng này" ></span></div></div>');
});

$(document).on("click", ".remove-field", function() {
    $(this).closest(".form-group").remove();
});
</script>

<script>
    function getDistrictList() {
      var matp = document.getElementById("province_id").value;
      $.ajax({url: '/api/getdistricts/'+matp}).done(function(data) {
        $("#district_id").html('<option value="" disabled selected>Chọn quận/huyện</option>');
          var obj  =JSON.parse(data);
        obj.forEach(function(element) {
          $("#district_id").append('<option value="'+element['id']+'">'+element['name']+'</option>');
        });
      });;
    }
    function getWardList() {
      var maqh = document.getElementById("district_id").value;
      $.ajax({url: '/api/getwards/'+maqh}).done(function(data) {
        $("#ward_id").html('<option value="" disabled selected>Chọn xã/phường/thị trấn</option>');
          var obj  =JSON.parse(data);
        obj.forEach(function(element) {
          $("#ward_id").append('<option value="'+element['id']+'">'+element['name']+'</option>');
        });
      });;
    }
</script>
@stop