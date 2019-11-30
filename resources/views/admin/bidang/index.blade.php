@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
<div class="row">
<div class="col-12 mt-5">
<div class="card">
<div class="card-body">
<h4 class="header-title">Data Table Default</h4>
<div class="data-tables">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
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
    <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
@endsection