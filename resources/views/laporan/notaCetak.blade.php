<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN</title>
    <style>
    h4,h2{
        font-family:serif;
    }
        body{
            font-family:sans-serif;
        }
        table{
        border-collapse: collapse;
      }
      table, th, td{
        border: 1px solid black;
      }
      th{
        background-color: #708090;
        text-align: center;
        color: white;
      }
      td{
      }
      br{
          margin-bottom: 5px !important;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0px;
         text-align: center;
         height: 150px;
         padding: 0px;
     }
     .pemko{
         width:85px;
     }
     .logo{
         float: left;
         margin-right: 0px;
         width: 15%;
         padding:0px;
         text-align: right;
     }
     .headtext{
         float:right;
         margin-left: 0px;
         width: 75%;
         padding-left:0px;
         padding-right:10%;
     }
     hr{
         margin-top: 10%;
         height: 4px;
         background-color: black;
         width:100%;
     }
     .ttd{
         margin-left:70%;
         text-align: center;
         text-transform: uppercase;
     }
     .text-right{
         text-align:right;
     }
     .isi{
         padding:10px;
     }
    </style>
</head>
<body>
    <div class="header">
            <div class="logo">
                    <img  class="pemko" src="img/logo.png">
            </div>
            <div class="headtext">
                <h4 style="margin:0px;">PEMERINTAH PROVINSI KALIMANTAN </h4>
                <h2 style="margin:0px;">DINAS KEHUTANAN </h2>
                <p style="margin:0px;">Jl.A.yani Timur No.14 Telepon (0511) 4777534 Fax (0511) 47772234</p>
                <p style="margin:0px;">Website:www.dishut.kalselprov.go.id Email: dishutkalsel01@gmail.com Kotak Pos 30</p>
                <p style="margin:0px;">Kode Pos 70713 BANJARBARU</p>
            </div>
            <br>
    </div>
    <hr style="margin-top:1px;">
    <div class="container">
        <div class="isi">
            <h3 style="text-align:;">Data Pencairan</h3>
            <table width="300px">
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
                        <br><br>
                        <h2 style="text-align:center;">RINCIAN PENCAIRAN</h2>
                        <table width="100%" class="table table-hover" id="myTable">
                        <thead>
                        <tr>
                            <th>Kendaraan</th>
                            <th>Nama Item</th>
                            <th>Volume</th>
                            <th>Satuan</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                                <?php $no = 0 ?>
                        @foreach ($rincian as $d)
                        <tr>
                            <td>{{ $d->kendaraan->nopol}}</td>
                            <td>{{ $d->nama_item}}</td>
                            <td>{{ $d->volume}}</td>
                            <td>{{ $d->satuan}}</td>
                            <td>{{ $d->total_harga_item}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                      <br>
                      <!-- <p>Gambar Nota</p>
                      <img style="padding:10%;" class="profile-user-img img-fluid "
                       src="{{asset('/img/nota/'.$pencairan->foto)}}"
                       alt="User profile picture"> -->
                      <br>
                      <div class="ttd">
                        <h5> <p>Banjarbaru, {{ $tgl }}</p></h5>
                       <h5>Mengetahui</h5>
                      <h5>Kepala Dinas Kehutanan Provinsi Kalsel</h5>
                      <br>
                      <br>
                      <h5 style="text-decoration:underline; margin:0px;">Joko Handoyo, S.STP, M.AP</h5>
                      <h5 style="margin:0px;">NIP. 19580726 1984 03 1 007</h5>
                      </div>
                    </div>
             </div>
         </body>
</html>
