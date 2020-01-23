@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tabel data Pencairan</h4>
                    <div class="text-right">
                        <button href="" class="btn btn-rounded btn-success " id="tambah" >+ tambah data</button>
                        <a href="{{Route('kendaraanCetak')}}" class="btn btn-rounded btn-primary " style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                    </div>
                <br>
                    <div class="data-tables">
                    <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kebutuhan</th>
                                    <th>Tanggal Pencairan</th>
                                    <th>total </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kebutuhan</th>
                                    <th>Tanggal Pencairan</th>
                                    <th>total </th>
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
<div class="modal fade" id="mediumModal"  role="dialog"  >
                    <div class="modal-dialog modal-lg" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Pencairan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
                            <div class="modal-footer">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                                {{@csrf_field()}}
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('script')
    <script>
        hapus = (uuid, nopol) =>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus  Data kendaraan " + nopol,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'hapus data',
                        cancelButtonText: 'batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url : "{{ url('/api/pencairan')}}" + '/' + uuid,
                                type : "POST",
                                data : {'_method' : 'DELETE', '_token' :csrf_token},
                                success: function (response) {
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            $('#datatable').DataTable().ajax.reload(null, false);
                        },
                    })
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        Swal.fire(
                        'Dibatalkan',
                        'data batal dihapus',
                        'error'
                        )
                    }
                })
            }
            //event btn tambah klik
            $('#tambah').click(function(){
                $('.modal-title').text('Tambah Data');
                $('#keperluan').val('');
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })
          
            //fungsi render datatable
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.pencairan.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "keperluan"},
                        {"data": "created_at"},
                        {"data": "total"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let nopol = row.nopol;
                            return type === 'display'  ?
                            '<a class="btn btn-sm btn-outline-primary" href="/pencairan/detail/'+ uuid +'"> <i class="ti-eye"></i></a> <button onClick="hapus(\'' + uuid + '\',\'' + nopol + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></button>':
                        data;
                        }}
                    ]
                });
                } );
    </script>
@endsection