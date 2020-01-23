@extends('layouts.admin')
@section('content')
<br>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tabel Pencairan SPJ</h4>
                    <div class="text-right">
                        <form action="" method="post">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
                        <button class="btn btn-rounded btn-success" >+ tambah Pencairan</button>
                        {{@csrf_field()}}
                        </form>
                    </div>
                <br>
                    <div class="data-tables">
                        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode Transmisi</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12gf</td>
                                    <td>Kopling</td>
                                    <td>
                                        <a href=""class="btn btn-rounded btn-info"> <i class="ti-pencil"></i> </a>
                                        <a href=""class="btn btn-rounded btn-danger"> <i class="ti-trash"></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kode Transmisi</th>
                                    <th>Jenis</th>
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
@endsection
@section('script')
@endsection