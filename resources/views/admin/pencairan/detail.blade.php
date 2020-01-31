@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
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
                                </tr>
                            </tfoot>
                        </table>
                </div>
                <div class="card-footer text-right">
                    <a href="{{Route('notaCetak',['id'=> $pencairan->id])}}" class="btn btn-sm btn-success"> Cetak Nota</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
    <script>

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
                    ]
                });
            });

              
    </script>
@endsection