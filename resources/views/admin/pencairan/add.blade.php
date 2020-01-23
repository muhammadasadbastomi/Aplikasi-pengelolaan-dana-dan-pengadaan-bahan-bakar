@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header"><h4 class="header-title">Tabel data Objek Transmisi</h4></div>
                <div class="card-body">
                        <form action="" method="post">
                        <input type="hidden" class="form-control" name="pencairan_id" id="pencairan_id" >
                        <div class="form-group">
                                <label for="">kendaraan</label>
                                <select class="form-control" name="kendaraan_id" id="kendaraan_id">
                                    <option value="">-- pilih kendaraan --</option>
                                </select>
                            </div>
                        <div class="form-group">
                                <label for="">Kepeluan</label>
                                <select class="form-control" name="keperluan" id="keperluan">
                                    <option value="">-- pilih keperluan --</option>
                                    <option value="BBM">BBM</option>
                                    <option value="Servis Mesin">Servis Mesin</option>
                                    <option value="beli sparepate">beli sparepate</option>
                                    <option value="lain-lain">lain-lain</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Item</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="">satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan">
                            </div>                      <div class="form-group">
                                <label for="">harga</label>
                                <input type="text" class="form-control" name="harga" id="harga">
                            </div>
                            <div class="text-right">
                            <button class="btn btn-sm btn-primary" type="submit" >+ tambah rincian</button>
                            </div>
                            <br>
                        </form>
                        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode Transmisi</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12gf</td>
                                    <td>Kopling</td>
                                    <td>
                                        <a href=""class="btn btn-rounded btn-info"> <i class="ti-pencil"></i> </a>
                                        <a href=""class="btn btn-rounded btn-danger"> <i class="ti-trash"></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kode Transmisi</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                </div>
                <div class="card-footer text-right">
                    <form action="">
                        <input type="hidden">
                        <button class="btn btn-sm btn-success">Selesai, buat pencairan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
    <script>
          getKendaraan = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/kendaraan')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#kendaraan_id').append(
                            '<option value="'+value.uuid+'">'+value.nopol+'</option>'
                        )
                    })
                }
            })
        }
        getKendaraan();
    </script>
@endsection