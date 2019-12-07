@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tabel data Karyawan</h4>
                    <div class="text-right">
                        <button href="" class="btn btn-rounded btn-success " id="tambah" >+ tambah data</button>
                        <a href="" class="btn btn-rounded btn-primary " style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                    </div>
                <br>
                    <div class="data-tables">
                        <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
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
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" enctype="multipart/form-data" method="post">
                                <p> <b>Data karyawan</b></p>
                                <hr>
                                <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                                <div class="form-group"><label for="company" class=" form-control-label">NIP</label><input type="text" id="NIP" name="NIP" placeholder="NIP" class="form-control"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Nama</label><input type="text" id="name" name="name" placeholder="Nama Karyawan" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">No Tlp</label><input type="text" id="telepon" name="telepon" placeholder="nomor Telepon" class="form-control"></div>
                                <div class="form-group"><label for="postal-code" class=" form-control-label">Tempat /Tempat Lahir</label><br>
                                    <div class="row">
                                    <div class="col-6">
                                        <input type="text" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
                                    </div>
                                    </div>
                                </div>     
                                <div class="form-group"><label for="city" class=" form-control-label">Alamat</label><textarea name="alamat" id="alamat" class="form-control"></textarea></div>
                                <div class="form-group"><label  class=" form-control-label">Seksi</label>
                                    <select name="seksi_id" class="form-control" id="seksi_id">
                                        <option value="">-- pilih bidang --</option>
                                    </select>
                                </div>
                                <p> <b>Data user</b></p>
                                <hr>
                                <div class="form-group"><label for="city" class=" form-control-label">Email</label><input type="email" id="email" name="email"placeholder="Email" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Password</label><input type="text" id="password"name="password" placeholder="" class="form-control"></div>
                                      
                            <div class="modal-footer">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('script')
<script>
getSeksi();
function getSeksi(){
    $.ajax({
            type: "GET",
            url: "{{ url('/api/seksi')}}",
            beforeSend: false,
            success : function(returnData) {
                $.each(returnData.data, function (index, value) {
				$('#seksi_id').append(
					'<option value="'+value.uuid+'">'+value.nama+'</option>'
				)
			})
        }
    })
}

function hapus(uuid, nama){
    var csrf_token=$('meta[name="csrf_token"]').attr('content');
    Swal.fire({
                title: 'apa anda yakin?',
                text: " Menghapus  Data Bidang " + nama,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'hapus data',
                cancelButtonText: 'batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url : "{{ url('/api/bidang')}}" + '/' + uuid,
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
    $('#tambah').click(function(){
        $('.modal-title').text('Tambah Data');
        $('#kode_bidang').val('');
        $('#nama').val('');  
        $('#btn-form').text('Simpan Data');
        $('#mediumModal').modal('show');
    })
    function edit(uuid){
        $.ajax({
            type: "GET",
            url: "{{ url('/api/karyawan')}}" + '/' + uuid,
            beforeSend: false,
            success : function(returnData) {
                $('.modal-title').text('Edit Data');
                $('#id').val(returnData.data.uuid);
                $('#NIP').val(returnData.data.NIP);
                $('#name').val(returnData.data.user.name);
                $('#telepon').val(returnData.data.telepon);  
                $('#tempat_lahir').val(returnData.data.tempat_lahir);  
                $('#tanggal_lahir').val(returnData.data.tanggal_lahir);  
                $('#seksi_id').val(returnData.data.seksi.uuid);
                $('#alamat').val(returnData.data.alamat);    
                $('#email').val(returnData.data.user.email);  
                $('#password').val(returnData.data.user.password);  
                $('#btn-form').text('Ubah Data');
                $('#mediumModal').modal('show');
            }
        })
    }
$(document).ready(function() {
    $('#datatable').DataTable( {
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            "type": "GET",
            "url": "{{route('API.karyawan.get')}}",
            "dataSrc": "data",
            "contentType": "application/json; charset=utf-8",
            "dataType": "json",
            "processData": true
        },
        columns: [
            {"data": "NIP"},
            {"data": "user.name"},
            {"data": "tempat_lahir"},
            {"data": "tanggal_lahir"},
            {"data": "seksi.nama"},
            {"data": "telepon"},
            {data: null , render : function ( data, type, row, meta ) {
                var uuid = row.uuid;
                var nama = row.nama;
                return type === 'display'  ?
                '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></button>':
            data;
            }}
        ]
    });
    $("form").submit(function (e) {
        e.preventDefault()
        var form = $('#modal-body form');
        if($('.modal-title').text() == 'Edit Data'){
            var url = '{{route("API.karyawan.update", '')}}'
            var id = $('#id').val();
            $.ajax({
                url: url+'/'+id,
                type: "put",
                data: $(this).serialize(),
                success: function (response) {
                    form.trigger('reset');
                    $('#mediumModal').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data Berhasil Tersimpan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error:function(response){
                    console.log(response);
                }
            })
        }else{
            $.ajax({
                url: "{{Route('API.karyawan.create')}}",
                type: "post",
                data: $(this).serialize(),
                success: function (response) {
                    form.trigger('reset');
                    $('#mediumModal').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data Berhasil Disimpan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error:function(response){
                    console.log(response);
                }
            })
        }
    } );
    } );
    </script>
@endsection