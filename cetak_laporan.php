<!DOCTYPE html>

<?php
include "connection/koneksi.php";
session_start();
ob_start();

$id = $_SESSION['id_user'];


if(isset($_SESSION['edit_order'])){
  //echo $_SESSION['edit_order'];
  unset($_SESSION['edit_order']);

}

if (isset($_SESSION['username'])) {
  $query = "select * from user natural join level where id_user = $id";

  mysqli_query($conn, $query);
  $sql = mysqli_query($conn, $query);

  // Perbaikan: definisikan $query_jumlah sebelum digunakan
  $query_jumlah = "SELECT jumlah_terjual FROM penjualan WHERE id_masakan = ?";

  while ($r = mysqli_fetch_array($sql)) {
      $nama_user = $r['nama_user'];
      $uang = 0;
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Export Laporan</title>
  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="template/dashboard/css/bootstrap.min.css" />
  <link rel="stylesheet" href="template/dashboard/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="template/dashboard/css/fullcalendar.css" />
  <link rel="stylesheet" href="template/dashboard/css/matrix-style.css" />
  <link rel="stylesheet" href="template/dashboard/css/matrix-media.css" />
  <link href="template/dashboard/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="template/dashboard/css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
  <style>

@page{
  size: auto;
}
body {
  background: rgb(204,204,204); 
}

page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.1cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 29.7cm;
  height: 21cm; 
}
page[size="A4"][layout="potrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 19.8cm;  
}
page[size="dipakai"][layout="landscape"] {
  width: 20cm;
  height: 20cm;  
}
@media print {
  body, page {
    margin: auto;
    box-shadow: 0;
  }
}

</style>
</head>

<body>

  <page size="dipakai" layout="landscape">
    <br>
    <div class="container">
      <span id="remove">
        <a class="btn btn-success" id="ct"><span class="icon-print"></span> EXPORT</a>
        <!-- <a class="btn btn-success" href="generate_laporan.php"><span class="icon-chevron-left"></span> KEMBALI</a> -->
      </span>
    </div>
      <center>
        <h4>
          RESTAURANT CARVA
        </h4>
        <span>
          Jl. Panah Hati No. 01 Ds. Asmara, Kec. Kertahati, Kab. Kertahatiraja, Jabar<br>
          Telp. +6289 832 999 013 || E-mail restcarva@gmail.com
        </span>
      </center>
              <hr>
              <div class="widget-title bg_lg"><span class="icon"><i class="icon-th-large"></i></span>
            <h5>Laporan Hari Ini</h5>
          </div>
          <div class="widget-content nopadding" >
            <table class="table table-bordered table-invoice-full">
              <thead>
                <tr>
                  <th class="head0">No.</th>
                  <th class="head0">Nama Menu</th>
                  <th class="head0">Jumlah Terjual</th>
                  <th class="head0 right">Harga</th>
                  <th class="head0 right">Total Masukan</th>
                </tr>
              </thead>
              <?php
                  $no = 1;
                  $query_lihat_menu = "select * from masakan";
                  $sql_lihat_menu = mysqli_query($conn, $query_lihat_menu);

                ?>
                <tbody>
                <?php
                  $no = 1;
                  $query_lihat_menu = "SELECT * FROM masakan";
                  $sql_lihat_menu = mysqli_query($conn, $query_lihat_menu);

                  while ($r_lihat_menu = mysqli_fetch_array($sql_lihat_menu)) {
                ?>
                <tr>
                  <td><center><?php echo $no++;?>.</center></td>
                  <td><?php echo $r_lihat_menu['nama_masakan'];?></td>
                  <td>
                    <center>
                      <?php
                        $id_masakan = $r_lihat_menu['id_masakan'];
                        
                        // Definisikan $query_jumlah di sini
                        $query_jumlah = "SELECT SUM(jumlah_terjual) AS jumlah_terjual FROM masakan WHERE id_masakan = $id_masakan";
                        
                        // Lakukan query
                        $sql_jumlah = mysqli_query($conn, $query_jumlah);
                        
                        // Periksa apakah query berhasil dijalankan
                        if ($sql_jumlah) {
                            $result_jumlah = mysqli_fetch_array($sql_jumlah);
                            
                            $jml = 0;
                            
                            if ($result_jumlah['jumlah_terjual'] !== null) {
                                $jml = $result_jumlah['jumlah_terjual'];
                            }

                            echo $jml;
                        } else {
                            // Tampilkan pesan kesalahan jika query tidak berhasil
                            echo "Error: " . mysqli_error($conn);
                        }
                      ?>
                    </center>
                  </td>
                  <td style="text-align: right">Rp. <?php echo $r_lihat_menu['harga'];?> ,-</td>
                  <td style="text-align: right">Rp. 
                    <?php
                      $harga = $r_lihat_menu['harga'];

                      $total_masukan = $jml * $harga;
                      echo number_format($total_masukan, 0, ',', '.') . ",-";

                      $uang += $total_masukan;
                    ?>
                  </td>
                </tr>
                <?php
                  }
                  //echo $uang;
                ?>
              </tbody>
            </table>
          </div>
  </page>
<?php
    }
    {
    }
    }
?>

<script type="text/javascript">
  document.getElementById('ct').onclick = function(){
    $("#remove").remove();
    window.print();
  }
  $(document).ready(function(){
    $("remove").remove();

  });
 
</script>

<script src="template/dashboard/js/excanvas.min.js"></script> 
<script src="template/dashboard/js/jquery.min.js"></script> 
<script src="template/dashboard/js/jquery.ui.custom.js"></script> 
<script src="template/dashboard/js/bootstrap.min.js"></script> 
<script src="template/dashboard/js/jquery.flot.min.js"></script> 
<script src="template/dashboard/js/jquery.flot.resize.min.js"></script> 
<script src="template/dashboard/js/jquery.peity.min.js"></script> 
<script src="template/dashboard/js/fullcalendar.min.js"></script> 
<script src="template/dashboard/js/matrix.js"></script> 
<script src="template/dashboard/js/matrix.dashboard.js"></script> 
<script src="template/dashboard/js/jquery.gritter.min.js"></script> 
<script src="template/dashboard/js/matrix.interface.js"></script> 
<script src="template/dashboard/js/matrix.chat.js"></script> 
<script src="template/dashboard/js/jquery.validate.js"></script> 
<script src="template/dashboard/js/matrix.form_validation.js"></script> 
<script src="template/dashboard/js/jquery.wizard.js"></script> 
<script src="template/dashboard/js/jquery.uniform.js"></script> 
<script src="template/dashboard/js/select2.min.js"></script> 
<script src="template/dashboard/js/matrix.popover.js"></script> 
<script src="template/dashboard/js/jquery.dataTables.min.js"></script> 
<script src="template/dashboard/js/matrix.tables.js"></script> 
</html>
