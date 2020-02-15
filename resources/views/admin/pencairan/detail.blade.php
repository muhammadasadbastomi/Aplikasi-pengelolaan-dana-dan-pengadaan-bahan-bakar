@extends('layouts.admin')
@section('content')
<br>
<div id="print"  class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                       <div class="text-center">
                       <h1>Detail Pencairan</h1><br>
                       </div>
                       <input type="hidden" id="pencairan_id" value="{{$pencairan->uuid}}">
                       <div class="col-4">
                        <table  class="table table-bordered">
                            <tr>
                                <td>Pencairan</td>
                                <td>: {{$pencairan->keperluan}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pencairan</td>
                                <td>: {{$pencairan->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Total Pencairan</td>
                                <td>: Rp.{{$pencairan->total}}</td>
                            </tr>
                        </table>
                       </div>
                       <br>
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
                        <br>
                        <h5>Nota pembelian</h5>
                        <img style="padding:10%;" class="profile-user-img img-fluid "
                       src="{{asset('/img/nota/'.$pencairan->foto)}}"
                       alt="User profile picture">
                </div>
                <div class="card-footer text-right">
                    <a href="{{Route('notaCetak',['id'=> $pencairan->id])}}" class="btn btn-sm btn-success"> Cetak Nota</a>
                    <input type="button" value="Cetak Detail Pencairan" onclick="PrintDiv();"  class="btn btn-sm btn-primary"/>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<!-- modal -->

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
                            <input type="hidden" name="uuid" id="uuid">
                            <div class="form-group">
                                <label for="">Nama item</label>
                                <input class="form-control" type="text" name="nama_item" id="nama_item">
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <input class="form-control" type="text" name="satuan" id="satuan">
                            </div>
                            <div class="form-group">
                                <label for="">Harga Satuan</label>
                                <input class="form-control" type="text" name="harga_satuan" id="harga_satuan">
                            </div>
                            <div class="form-group">
                                <label for="">Volume</label>
                                <input class="form-control" type="text" name="volume" id="volume">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Transaksi</label>
                                <input class="form-control" type="date" name="tanggal_transaksi" id="tanggal_transaksi">
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

    function PrintDiv() {
       var divToPrint = document.getElementById('print');
       var popupWin = window.open();
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }

            edit = uuid =>{
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/rincian')}}" + '/' + uuid,
                    beforeSend: false,
                    success : function(returnData) {
                        $('.modal-title').text('Edit Data');
                        $('#uuid').val(returnData.data.uuid);
                        $('#nama_item').val(returnData.data.nama_item);
                        $('#satuan').val(returnData.data.satuan);
                        $('#harga_satuan').val(returnData.data.harga_satuan);
                        $('#volume').val(returnData.data.volume);
                        $('#tanggal_transaksi').val(returnData.data.tanggal_transaksi);
                        $('#btn-form').text('Ubah Data');
                        $('#mediumModal').modal('show');
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
                        {data: null , render : function ( data, type, row, meta ) {
                            return '<p> Rp.'+ row.harga_satuan +'<p>';
                            }},
                        {data: null , render : function ( data, type, row, meta ) {
                            return '<p> Rp.'+ row.total_harga_item +'<p>';
                            }},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            return type === 'display'  ?
                            '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i>':
                        data;
                        }}
                    ]
                });
            });

              //event form submit
              $("form").submit(function (e) {
                    e.preventDefault()
                        let form = $('#modal-body form');
                        let url = '{{route("API.rincian.update", '')}}'
                        let id = $('#uuid').val();
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
                                    title: 'Data Berhasil Diubah',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                } );
    </script>
@endsection
