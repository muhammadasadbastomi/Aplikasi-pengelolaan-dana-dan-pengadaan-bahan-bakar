@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tabel Data Status transmisi</h4>
                    <div class="text-right">
                        <button href="" class="btn btn-rounded btn-success " id="tambah" >+ tambah data</button>
                        <a href="{{Route('statusTransmisiCetak')}}" class="btn btn-rounded btn-primary " style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                    </div>
                <br>
                    <div class="data-tables">
                        <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Objek Transmisi</th>
                                    <th>Status Transmisi</th>
                                    <th>pemeriksaan Terakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                        
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Objek Transmisi</th>
                                    <th>Status Transmisi</th>
                                    <th>pemeriksaan Terakhir</th>
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
                            <option value="">-- pilih kendaraan --</option>
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">Pilih Item Kendaraan</label>
                        <select class="form-control" name="objek_transmisi_id" id="objek_transmisi_id">
                            <option value="">-- pilih item --</option>
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">Status</label><br>          
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio"  id="customRadio4" value="Bagus" name="status" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio4">Bagus</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadio5" value="cukup" name="status" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio5">Cukup</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio"  id="customRadio6" value="kurang" name="status" class="custom-control-input">
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
        //fungsi get data kendaraan
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
        //fungsi get data  item kedaraan
        getItemKendaraan = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/objek')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#objek_transmisi_id').append(
                            '<option value="'+value.uuid+'">'+value.jenis+'</option>'
                        )
                    })
                }
            })
        }
        getKendaraan();
        getItemKendaraan();
        //fungsi hapus 
        hapus = (uuid, nama) =>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus  Data kelengkapan  kendaraan " + nama,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'hapus data',
                        cancelButtonText: 'batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url : "{{ url('/api/status')}}" + '/' + uuid,
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
                $('#kendaraan_id').val('');
                $('#objek_transmisi').val('');  
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })

            //event btn edit klik
            edit = uuid =>{
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/status')}}" + '/' + uuid,
                    beforeSend: false,
                    success : function(returnData) {
                        $('.modal-title').text('Edit Data');
                        $('#id').val(returnData.data.uuid);
                        $('#kendaraan_id').val(returnData.data.kendaraan.uuid);
                        $('#objek_transmisi_id').val(returnData.data.objek_transmisi.uuid);
                        $("input[name=status][value=" + returnData.data.status + "]").attr('checked', 'checked');
                        $('#btn-form').text('Ubah Data');
                        $('#mediumModal').modal('show');
                    }
                })
            }

            //fungsi rebder datatable
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.status.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "kendaraan.nopol"},
                        {"data": "objek_transmisi.jenis"},
                        {"data": "status"},
                        {"data": "updated_at"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let nama = row.kendaraan.nopol;
                            return type === 'display'  ?
                            '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></button>':
                        data;
                        }}
                    ]
                });

                //event form klik
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                    if($('.modal-title').text() == 'Edit Data'){
                        let url = '{{route("API.status.update", '')}}'
                        let id = $('#id').val();
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
                            url: "{{Route('API.status.create')}}",
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