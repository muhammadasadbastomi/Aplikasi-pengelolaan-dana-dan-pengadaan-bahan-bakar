@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tabel data Seksi Bidang</h4>
                    <div class="text-right">
                        <button href="" class="btn btn-rounded btn-success " id="tambah" >+ tambah data</button>
                        <a href="" class="btn btn-rounded btn-primary " style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                    </div>
                <br>
                    <div class="data-tables">
                        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode Seksi Bidang</th>
                                    <th>Nama Seksi</th>
                                    <th>Bidang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>LLAJ12</td>
                                    <td>Rekayasa Lalu Lintas</td>
                                    <td>LLAJ</td>
                                    <td>
                                        <a href=""class="btn btn-rounded btn-info"> <i class="ti-pencil"></i> </a>
                                        <a href=""class="btn btn-rounded btn-danger"> <i class="ti-trash"></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kode Seksi Bidang</th>
                                    <th>Nama Seksi</th>
                                    <th>Bidang</th>
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
                    <div class="form-group"><label  class=" form-control-label">Kode Bidang</label><input type="text" id="kd_bidang" name="kd_bidang"  class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Nama Bidang</label><input type="text" id="nm_bidang" name="nm_bidang"  class="form-control"></div>
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
                $('#kd_bidang').val('');
                $('#nm_bidang').val('');  
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })
        });
    </script>
@endsection