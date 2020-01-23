@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header"><h4 class="header-title">Tambah Pencairan {{$setuuid->keperluan}}</h4></div>
                <div class="card-body">
                        <form id="form1" action="" method="post">
                        <input type="text" class="form-control" name="pencairan_id" id="pencairan_id" value="{{$setuuid->uuid}}">
                        <div class="form-group">
                                <label for="">kendaraan</label>
                                <select class="form-control" name="kendaraan_id" id="kendaraan_id">
                                    <option value="">-- pilih kendaraan --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Item</label>
                                <input type="text" class="form-control" name="nama_item" id="nama_item">
                            </div>
                            <div class="form-group">
                                <label for="">satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan">
                            </div>                      
                            <div class="form-group">
                                <label for="">harga</label>
                                <input type="text" class="form-control" name="harga_satuan" id="harga_satuan">
                            </div>
                            <div class="form-group">
                                <label for="">volume</label>
                                <input type="number" class="form-control" name="volume" id="volume">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi">
                            </div>
                            <div class="text-right">
                            <button class="btn btn-sm btn-primary" type="submit" >+ tambah rincian</button>
                            </div>
                            <br>
                        </form>
                        <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Nama Item</th>
                                    <th>Volume</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Nama Item</th>
                                    <th>Volume</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                </div>
                <div class="card-footer text-right">
                    <form  id="form2" action="post">
                        <input type="hidden" name="id_pencairan" value="{{$setuuid->id}}">
                        <button type="submit" name="submit" class="btn btn-success">Selesai, buat pencairan</button>
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
                                url : "{{ url('/api/rincian')}}" + '/' + uuid,
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


          //fungsi render datatable            
          $(document).ready(function() {
                let id = $('#pencairan_id').val();
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{ url('/api/rincian/get')}}" + '/' + id,
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "kendaraan.nopol" },
                        {"data": "nama_item"},
                        {"data": "volume"},
                        {"data": "satuan"},
                        {"data": "harga_satuan"},
                        {"data": "total_harga_item"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let jabatan = row.jabatan;
                            return type === 'display'  ?
                            '<button onClick="hapus(\'' + uuid + '\',\'' + jabatan + '\')" class="btn btn-sm btn-danger" > <i class="mdi mdi-popcorn"></i>hapus</button>':
                        data;
                        }}
                    ]
                });
            });

                //event form submit            
                $("#form1").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        let url = '{{route("API.rincian.create")}}'
                        let id = $('#id').val();
                        $.ajax({
                            url: url,
                            type: "post",
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
                } );

                  //event form submit            
                $("#form2").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        let url = '{{route("API.pencairan.create")}}'
                        let id = $('#id').val();
                        $.ajax({
                            url: url,
                            type: "post",
                            data: $(this).serialize(),
                            success: function (response) {
                                window.location.replace("/pencairan/index");
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                } );
    </script>
@endsection