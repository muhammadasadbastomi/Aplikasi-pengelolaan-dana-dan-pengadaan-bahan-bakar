@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tabel Data Status Transmisi</h4>
                    <div class="text-right">
                        <button href="" class="btn btn-rounded btn-success " id="tambah" >+ tambah data</button>
                        <a href="" class="btn btn-rounded btn-primary " style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                    </div>
                <br>
                    <div class="data-tables">
                        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Objek Transmisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>DA 6402 PAD</td>
                                    <td>Kompling</td>
                                    <td>Cukup</td>
                                    <td>
                                        <a href=""class="btn btn-rounded btn-info"> <i class="ti-pencil"></i> </a>
                                        <a href=""class="btn btn-rounded btn-danger"> <i class="ti-trash"></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Objek Transmisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- modal -->
<div class="modal fade" id="mediumModal"  role="dialog" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" action="">
                    <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Pilih Kendaraan</label>
                        <select class="form-control" name="kendaraan_id" id="kendaraan_id">
                            <option value="">ini ngambil dari dara kendaraan</option>
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">Pilih objek Transmisi</label>
                        <select class="form-control" name="kendaraan_id" id="kendaraan_id">
                            <option value="">ini ngambil dari data objek transmisi</option>
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">Status</label><br>          
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" checked id="customRadio4" name="customRadio2" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio4">Bagus</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadio5" name="customRadio2" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio5">Cukup</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio"  id="customRadio6" name="customRadio2" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio6">Kurang</label>
                    </div>
                    </div>
            <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                    <button id="btn-form" type="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
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
        $(document).ready(function() {
            $('#example').DataTable();

            $('#tambah').click(function(){
                $('.modal-title').text('Tambah Data');
                $('#kd_seksi').val('');
                $('#nm_seksi').val('');  
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })
        });
    </script>
@endsection