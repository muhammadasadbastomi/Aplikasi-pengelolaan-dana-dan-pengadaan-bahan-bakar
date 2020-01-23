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
                       <h5>Pencairan :{{$pencairan->keperluan}}</h5>
                       <h5>Tanggal Pencairan :{{$pencairan->created_at}}</h5>
                       <h5>Total Pencairan : Rp.{{$pencairan->total}}</h5>
                       <br>
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
                    <a href="" class="btn btn-sm btn-success"> Cetak Nota</a>
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
                        {"data": "harga_satuan"},
                        {"data": "total_harga_item"}
                    ]
                });
            });

              
    </script>
@endsection