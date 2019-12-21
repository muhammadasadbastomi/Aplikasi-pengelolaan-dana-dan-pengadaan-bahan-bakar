@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tabel data Kendaraan</h4>
                    <div class="text-right">
                        <button href="" class="btn btn-rounded btn-success " id="tambah" >+ tambah data</button>
                        <a href="{{Route('kendaraanCetak')}}" class="btn btn-rounded btn-primary " style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                    </div>
                <br>
                    <div class="data-tables">
                        <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nopol</th>
                                    <th>Merk</th>
                                    <th>Tipe</th>
                                    <th>Jenis</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>nomor Mesin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nopol</th>
                                    <th>Merk</th>
                                    <th>Tipe</th>
                                    <th>Jenis</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>nomor Mesin</th>
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
                                <p> <b>Data kendaraan</b></p>
                                <hr>
                                <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                                <div class="form-group"><label  class=" form-control-label">Pemegang</label>
                                    <select name="karyawan_id" class="form-control" id="karyawan_id">
                                        <option value="">-- pilih Karyawan --</option>
                                    </select>
                                </div>                                
                                <div class="form-group"><label for="vat" class=" form-control-label">Nopol</label><input type="text" id="nopol" name="nopol" placeholder="Nomor Polisi" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Merk</label><input type="text" id="merk" name="merk" placeholder="Merk" class="form-control"></div>
                                <div class="form-group"><label for="postal-code" class=" form-control-label">Tipe Jenis</label><br>
                                    <div class="row">
                                    <div class="col-6">
                                        <input type="text" id="tipe" placeholder="Tipe Kendaraan" name="tipe" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="jenis" placeholder="Jenis Kendaraan" name="jenis" class="form-control">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group"><label for="postal-code" class=" form-control-label">Model / Tahun Pembuatan</label><br>
                                    <div class="row">
                                    <div class="col-6">
                                        <input type="text" id="model" placeholder="Model Kendaraan" name="model" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" id="tahun_pembuatan" name="tahun_pembuatan" class="form-control">
                                    </div>
                                    </div>
                                </div>        
                                <p> <b>Data Mesin</b></p>
                                <hr>
                                <div class="form-group"><label for="city" class=" form-control-label">Isi Silinder</label><input type="text" id="isi_silinder" name="isi_silinder"placeholder="isi_silinder" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Warna Kendaraan</label><input type="text" id="warna_kendaraan"name="warna_kendaraan" placeholder="warna kendaraan" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Bahan Bakar</label><input type="text" id="bahan_bakar"name="bahan_bakar" placeholder="bahan_bakar" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Warna TNKB</label><input type="text" id="warna_tnkb"name="warna_tnkb" placeholder="warna_tnkb" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Tahun Registrasi</label><input type="date" id="tahun_registrasi"name="tahun_registrasi" placeholder="tahun registrasi" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Nomor Mesin</label><input type="text" id="no_mesin"name="no_mesin" placeholder="Nomor Mesin" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Nomor BPKB</label><input type="text" id="no_bpkb"name="no_bpkb" placeholder="Nomor BPKB" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Tercatat KIB</label><input type="text" id="tercatat_kib"name="tercatat_kib" placeholder="tercatat kib" class="form-control"></div>
                                      
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
        //fungsi get data karyawan
        getKaryawan = ()=>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/karyawan')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#karyawan_id').append(
                            '<option value="'+value.uuid+'">'+value.user.name+'</option>'
                        )
                    })
                }
            })
        }
        getKaryawan();
        //fungsi hapus
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
                                url : "{{ url('/api/kendaraan')}}" + '/' + uuid,
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
                $('#karyawan_id').val('');
                $('#nopol').val('');
                $('#merk').val('');  
                $('#tipe').val('');  
                $('#jenis').val('');  
                $('#model').val('');  
                $('#tahun_pembuatan').val('');  
                $('#isi_silinder').val('');  
                $('#warna_kendaraan').val('');  
                $('#bahan_bakar').val('');  
                $('#warna_tnkb').val('');  
                $('#tahun_registrasi').val('');  
                $('#no_mesin').val('');
                $('#no_bpkb').val('');    
                $('#tercatat_kib').val('');  
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })
            //event btn edit klik
            edit = uuid =>{
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/kendaraan')}}" + '/' + uuid,
                    beforeSend: false,
                    success : function(returnData) {
                        $('.modal-title').text('Edit Data');
                        $('#id').val(returnData.data.uuid);
                        $('#karyawan_id').val(returnData.data.karyawan.uuid);
                        $('#nopol').val(returnData.data.nopol);
                        $('#merk').val(returnData.data.merk);  
                        $('#tipe').val(returnData.data.tipe);  
                        $('#jenis').val(returnData.data.jenis);  
                        $('#model').val(returnData.data.model);  
                        $('#tahun_pembuatan').val(returnData.data.tahun_pembuatan);  
                        $('#isi_silinder').val(returnData.data.isi_silinder);  
                        $('#warna_kendaraan').val(returnData.data.warna_kendaraan);  
                        $('#bahan_bakar').val(returnData.data.bahan_bakar);  
                        $('#warna_tnkb').val(returnData.data.warna_tnkb);  
                        $('#tahun_registrasi').val(returnData.data.tahun_registrasi);  
                        $('#no_mesin').val(returnData.data.no_mesin);
                        $('#no_bpkb').val(returnData.data.no_bpkb);    
                        $('#tercatat_kib').val(returnData.data.tercatat_kib);  
                        $('#btn-form').text('Ubah Data');
                        $('#mediumModal').modal('show');
                    }
                })
            }

            //fungsi render datatable
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.kendaraan.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "nopol"},
                        {"data": "merk"},
                        {"data": "tipe"},
                        {"data": "jenis"},
                        {"data": "tahun_pembuatan"},
                        {"data": "no_mesin"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let nopol = row.nopol;
                            return type === 'display'  ?
                            '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nopol + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></button>':
                        data;
                        }}
                    ]
                });
                //event form submit
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                    if($('.modal-title').text() == 'Edit Data'){
                        let url = '{{route("API.kendaraan.update", '')}}'
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
                            url: "{{Route('API.kendaraan.create')}}",
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