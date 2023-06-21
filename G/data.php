<?php 
include 'menu.php';
include '../link.php'; 
?>

<?php
// Program Utama MENU SKP
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "add":
            add($conn);
            break;
        case "updateData":
            updateData($conn);
            break;
        case "delete":
            delete($conn);
            break;
        case "detail":
            detail($conn);
            break;
        case "addFormulirSKP":
            addFormulirSKP($conn);
            break;
        case "deleteformSKP":
            deleteformSKP($conn);
            break;
        case "updateformSKP":
            updateformSKP($conn);
            break;
        case "addNilaiKinerja":
            addNilaiKinerja($conn);
            break;
        default:
            view($conn);
        }
} else {
    view($conn);
}
?>

<?php 
// fungsi view data
function view($conn){ ?>
    <div>
        <ul class='breadcrumb'>
        <li class='breadcrumb-item'><a href='index.php'><i class='fas fa-home'></i></a></li>
        <li class='breadcrumb-item'><a href='#'>SKP</a></li>
        </ul>
        </div>
    <div class='container'>
    <div class="card">    
    <div class="card-header text-center">SASARAN KERJA PEGAWAI NEGERI SIPIL</div>
        <div class="card-body">
        <a href="data.php?aksi=add" class="btn-sm btn-success"> 
        <i class="fa fa-plus-circle"> </i> Tambah </a>

        <table class="table table-bordered table-hover table-responsive-sm mt-2">
            <thead class="bg-dark text-white">
                <tr class="text-center">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $queri="SELECT * FROM data ORDER BY id DESC";
                $sql=mysqli_query($conn,$queri);
                while($hasil=mysqli_fetch_array($sql)){
                  $periode_awal_ind=tanggal_indo($hasil['periode_awal']);
                  $periode_akhir_ind=tanggal_indo($hasil['periode_akhir']);
                ?>
                <tr>
                    <td>1</td> 
                    <td><?php echo $hasil['nama_peg']; ?></td>
                    <td><?php echo $hasil['nip_peg']; ?></td>
                    <td><?php echo $periode_awal_ind."&nbsp s.d &nbsp".$periode_akhir_ind ; ?></td>

                    <td>
                    <a href='data.php?aksi=detail&id=<?php echo $hasil['id']; ?>'>
                    <i class="btn-sm btn-primary fas fa-eye"></i></a>
                    &nbsp; &nbsp; &nbsp;
                   
                        
                    <a href="data.php?aksi=delete&id=<?php echo $hasil['id'];?>" onclick="javascript:return confirm('Seluruh data SKP periode ini akan terhapus.\n Anda Yakin untuk menghapus data ini?')" class="btn-sm btn-danger fas fa-trash-alt mt-1"> </a>
                        
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
<?php } 
// end fungsi view data
?>

<?php 
// fungsi tambahdata
function add($conn){ ?>
<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="data.php">SKP</a></li>
    <li class="breadcrumb-item"><a href="#">Tambah data SKP</a></li>
  </ul>
</div>

<div class="container-fluid">
<div class="card">
    <div class="card-header text-center bg-dark text-white">DATA SASARAN KERJA PEGAWAI</div>
    <div class="card-body">
        <form action='' method="POST">
            <div class="alert alert-warning" role="alert">
            PNS YANG DINILAI
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name='nama' value="<?php echo $_SESSION['nama'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name='nip' value="<?php echo $_SESSION['nip'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="pangkat" class="col-sm-2 col-form-label">Pangkat / Gol. Ruang</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="pangkat" name='pangkat'>
                </div>
            </div>
            <div class="form-group row">
                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan" name='jabatan'>
                </div>
            </div>
            <div class="form-group row">
                <label for="unit" class="col-sm-2 col-form-label">Unit Kerja</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="unit" name='unit'>
                </div>
            </div>
            <div class="form-group row">
                <label for="periode_awal" class="col-sm-2 col-form-label">Periode Penilaian</label>
                <div class="col-sm-4">
                <input type="date" class="form-control" id="periode_awal" name='periode_awal'>
                </div>
                <h6 class="col-sm-2 mt-2 mb-1 text-center text-danger">sampai dengan</h6>
                <div class="col-sm-4">
                <input type="date" class="form-control" id="periode_akhir" name='periode_akhir'>
                </div>
            </div>
            <hr>

            <div class="alert alert-success" role="alert">
                PEJABAT PENILAI
            </div>
            <div class="form-group row">
                <label for="nama_pen" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_pen" name='nama_pen'>
                </div>
            </div>
            <div class="form-group row">
                <label for="nip_pen" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip_pen" name='nip_pen'>
                </div>
            </div>
            <div class="form-group row">
                <label for="pangkat_pen" class="col-sm-2 col-form-label">Pangkat / Gol. Ruang</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="pangkat_pen" name='pangkat_pen'>
                </div>
            </div>
            <div class="form-group row">
                <label for="jabatan_pen" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan_pen" name='jabatan_pen'>
                </div>
            </div>
            <div class="form-group row">
                <label for="unit_pen" class="col-sm-2 col-form-label">Unit Kerja</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_pen" name='unit_pen'>
                </div>
            </div>
            <hr>

            <div class="alert alert-primary" role="alert">
                ATASAN PEJABAT PENILAI
            </div>
            <div class="form-group row">
                <label for="nama_ats" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_ats" name='nama_ats'>
                </div>
            </div>
            <div class="form-group row">
                <label for="nip_ats" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip_ats" name='nip_ats'>
                </div>
            </div>
            <div class="form-group row">
                <label for="pangkat_ats" class="col-sm-2 col-form-label">Pangkat / Gol. Ruang</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="pangkat_ats" name='pangkat_ats'>
                </div>
            </div>
            <div class="form-group row">
                <label for="jabatan_ats" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan_ats" name='jabatan_ats'>
                </div>
            </div>
            <div class="form-group row">
                <label for="unit_ats" class="col-sm-2 col-form-label">Unit Kerja</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_ats" name='unit_ats'>
                </div>
            </div>
            <hr>
         
            <div class="text-center">
            <button type="submit" class="btn btn-success mb-2 mr-4" name='simpan'><i class="fa fa-floppy-o" style="font-size:24px;"></i> Simpan</button>
            
            <a class="btn btn-danger mb-2" href="data.php" role="button"><i class="fa fa-close" style="font-size:24px"></i> Batal</a>
            
            </div>
        </form>
    </div>
</div>
</div>

<?php
    if(isset($_POST['simpan'])){
    $nama=$_POST['nama'];
    $nip= $_POST['nip'];
    $pangkat= $_POST['pangkat'];
    $jabatan= $_POST['jabatan'];
    $unit= $_POST['unit'];
    $periode_awal= $_POST['periode_awal'];
    $periode_akhir= $_POST['periode_akhir'];
    $nama_pen=$_POST['nama_pen'];
    $nip_pen= $_POST['nip_pen'];
    $pangkat_pen= $_POST['pangkat_pen'];
    $jabatan_pen= $_POST['jabatan_pen'];
    $unit_pen= $_POST['unit_pen'];
    $nama_ats=$_POST['nama_ats'];
    $nip_ats= $_POST['nip_ats'];
    $pangkat_ats= $_POST['pangkat_ats'];
    $jabatan_ats= $_POST['jabatan_ats'];
    $unit_ats= $_POST['unit_ats'];
    
    $query="INSERT INTO data(nip_peg, nama_peg, pangkat_peg, jabatan_peg, unit_peg, nama_pen, nip_pen, pangkat_pen, jabatan_pen, unit_pen, nama_ats, nip_ats, pangkat_ats, jabatan_ats, unit_ats, periode_awal, periode_akhir) VALUES ('$nip','$nama','$pangkat','$jabatan','$unit','$nama_pen','$nip_pen','$pangkat_pen','$jabatan_pen','$unit_pen','$nama_ats','$nip_ats','$pangkat_ats','$jabatan_ats','$unit_ats','$periode_awal','$periode_akhir')";

    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan data SKP baru!'); window.location='data.php'; </script>" ;
    }else {
        echo "terjadi kesalahan selama penyimpanan";
    }
    }
?>
<?php } 
// endFungsiTambahdata
?> 


<?php 
// Fungsi hapus data
function delete($conn){
    if(isset($_GET['aksi']) && isset($_GET['id']) ){
        $id=$_GET['id'];
        $queri="DELETE FROM data WHERE id=$id ";
        $queri2="DELETE FROM skp WHERE id_data=$id ";

        $sql=mysqli_query($conn,$queri);
        $sql2=mysqli_query($conn,$queri2);


        if($sql){
            echo "<script>alert('Berhasil menghapus seluruh data SKP');window.location='data.php'; </script>";
        }
    }
}
// end Fungsi hapus data

// *********END MENU SKP********
?>



<?php 
// Fungsi updateDataSkp
function updateData($conn){ ?>
  <div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="data.php?aksi=detail&id=<?php echo $_GET['id']; ?>">SKP</a></li>
    <li class="breadcrumb-item"><a href="#">Update data SKP</a></li>
  </ul>
</div>

<div class="container-fluid">
<div class="card">
    <div class="card-header text-center bg-dark text-white">UPDATE DATA SASARAN KERJA PEGAWAI</div>
    <div class="card-body">
        <form action='' method="POST">
            <div class="alert alert-warning" role="alert">
            PNS YANG DINILAI
            </div>
            <?php
            $idupdate=$_GET['id'];
            $queriupdate="SELECT * FROM data WHERE id=$idupdate";
            $sqlupdate=mysqli_query($conn,$queriupdate);
            $resupdate=mysqli_fetch_assoc($sqlupdate);

            ?>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name='nama' value="<?php echo $resupdate['nama_peg'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name='nip' value="<?php echo $resupdate['nip_peg'] ?>" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="pangkat" class="col-sm-2 col-form-label">Pangkat / Gol. Ruang</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="pangkat" name='pangkat' value="<?php echo $resupdate['pangkat_peg'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan" name='jabatan' value="<?php echo $resupdate['jabatan_peg'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="unit" class="col-sm-2 col-form-label">Unit Kerja</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="unit" name='unit' value="<?php echo $resupdate['unit_peg'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="periode_awal" class="col-sm-2 col-form-label">Periode penilaian</label>
                <div class="col-sm-4">
                <input type="date" class="form-control" id="periode_awal" name='periode_awal' value="<?php echo $resupdate['periode_awal'] ?>" disabled>
                </div>
                <h6 class="col-sm-2 mt-2 mb-1 text-center text-danger">sampai dengan</h6>
                <div class="col-sm-4">
                <input type="date" class="form-control" id="periode_akhir" name='periode_akhir' value="<?php echo $resupdate['periode_akhir'] ?>" disabled>
                </div>
            </div>
            <hr>

            <div class="alert alert-success" role="alert">
                PEJABAT PENILAI
            </div>
            <div class="form-group row">
                <label for="nama_pen" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_pen" name='nama_pen' value="<?php echo $resupdate['nama_pen'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nip_pen" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip_pen" name='nip_pen' value="<?php echo $resupdate['nip_pen'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="pangkat_pen" class="col-sm-2 col-form-label">Pangkat / Gol. Ruang</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="pangkat_pen" name='pangkat_pen' value="<?php echo $resupdate['pangkat_pen'] ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="jabatan_pen" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan_pen" name='jabatan_pen' value="<?php echo $resupdate['jabatan_pen'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="unit_pen" class="col-sm-2 col-form-label">Unit Kerja</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_pen" name='unit_pen' value="<?php echo $resupdate['unit_pen'] ?>">
                </div>
            </div>
            <hr>

            <div class="alert alert-primary" role="alert">
                ATASAN PEJABAT PENILAI
            </div>
            <div class="form-group row">
                <label for="nama_ats" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_ats" name='nama_ats' value="<?php echo $resupdate['nama_ats'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nip_ats" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip_ats" name='nip_ats' value="<?php echo $resupdate['nip_ats'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="pangkat_ats" class="col-sm-2 col-form-label">Pangkat / Gol. Ruang</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="pangkat_ats" name='pangkat_ats' value="<?php echo $resupdate['pangkat_ats'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="jabatan_ats" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan_ats" name='jabatan_ats' value="<?php echo $resupdate['jabatan_ats'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="unit_ats" class="col-sm-2 col-form-label">Unit Kerja</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="unit_ats" name='unit_ats' value="<?php echo $resupdate['unit_ats'] ?>">
                </div>
            </div>
            <hr>
         
            <div class="text-center">
            <button type="submit" class="btn btn-success mb-2 mr-4" name='update_data'><i class="fas fa-archive"></i>
            Update</button>
            

            <a class="btn btn-danger mb-2" href="data.php?aksi=detail&id=<?php echo $_GET['id']; ?>" role="button"><i class="fa fa-close" style="font-size:24px"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
</div>

<?php
    if(isset($_POST['update_data'])){
    $nama=$_POST['nama'];
    $nip= $_POST['nip'];
    $pangkat= $_POST['pangkat'];
    $jabatan= $_POST['jabatan'];
    $unit= $_POST['unit'];
    // $periode_awal= $_POST['periode_awal'];
    // $periode_akhir= $_POST['periode_akhir'];
    $nama_pen=$_POST['nama_pen'];
    $nip_pen= $_POST['nip_pen'];
    $pangkat_pen= $_POST['pangkat_pen'];
    $jabatan_pen= $_POST['jabatan_pen'];
    $unit_pen= $_POST['unit_pen'];
    $nama_ats=$_POST['nama_ats'];
    $nip_ats= $_POST['nip_ats'];
    $pangkat_ats= $_POST['pangkat_ats'];
    $jabatan_ats= $_POST['jabatan_ats'];
    $unit_ats= $_POST['unit_ats'];
    
    $queryubah="UPDATE data set nama_peg='$nama',pangkat_peg='$pangkat',jabatan_peg='$jabatan',unit_peg='$unit',nama_pen='$nama_pen',nip_pen='$nip_pen',pangkat_pen='$pangkat_pen',jabatan_pen='$jabatan_pen',unit_pen='$unit_pen',nama_ats='$nama_ats',nip_ats='$nip_ats',pangkat_ats='$pangkat_ats',jabatan_ats='$jabatan_ats',unit_ats='$unit_ats' WHERE id=$idupdate";
    
    $sqlubah=mysqli_query($conn,$queryubah);

    if($sqlubah){
        echo "<script> alert ('Berhasil Mengubah data SKP!'); window.location='data.php?aksi=detail&id=$idupdate'; </script>" ;
    }else {
        echo "<script> alert ('Terjadi kesalahan selama penyimpanan'); </script>" ;
    }
    }
?>
<?php } 
// End Fungsi updateDataSkp 
?>

<?php 
//  =========Menu detail SKP============
// fungsiDetail
function detail($conn){ 
    $id=$_GET['id'];
    $qDet="SELECT * FROM data WHERE id=$id";
    $sqlDet=mysqli_query($conn,$qDet);
    $resDet=mysqli_fetch_assoc($sqlDet); 

    $periode_awal=tanggal_indo($resDet['periode_awal']);
    $periode_akhir=tanggal_indo($resDet['periode_akhir']);
?>

<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="data.php">SKP</a></li>
    <li class="breadcrumb-item"><a href="#">Detail SKP</a></li>
  </ul>
</div>

<div class="container-fluid">
    <!-- Nav tabs -->
    <nav class="mb-4">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-data-tab" data-toggle="tab" href="#nav-data" role="tab" aria-controls="nav-data" aria-selected="true">Data SKP</a>
        <a class="nav-item nav-link" id="nav-formulir-tab" data-toggle="tab" href="#nav-formulir" role="tab" aria-controls="nav-formulir" aria-selected="false">Formulir SKP</a>
        <a class="nav-item nav-link" id="nav-penilaian-tab" data-toggle="tab" href="#nav-penilaian" role="tab" aria-controls="nav-penilaian" aria-selected="false">Penilaian SKP</a>
        <a class="nav-item nav-link" id="nav-penilaian_kinerja-tab" data-toggle="tab" href="#nav-penilaian_kinerja" role="tab" aria-controls="nav-penilaian_kinerja" aria-selected="false">Penilaian Kinerja</a>
    </div>
    </nav>
</div>
<!-- Tab panes -->
<div class="tab-content" id="nav-tabContent">
  <!-- dataSKP -->
  <div class="tab-pane fade show active" id="nav-data" role="tabpanel" aria-labelledby="nav-data-tab">
  
  <!-- view data SKP -->
    <div class="container-fluid">
    <div class="card border-primary">
      <h5 class="card-header text-center bg-dark text-white">DATA SASARAN KERJA PEGAWAI</h5>
      <div class="card-body">
        <h6>Periode penilaian &nbsp : <?php echo $periode_awal." &nbsp sampai dengan &nbsp ". $periode_akhir;   ?></h6>
      <table class="table table-bordered table-responsive-sm">
        <thead class="bg-warning">
          <tr>
            <th scope="col">1</th>
            <th colspan="2">PNS YANG DINILAI</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th rowspan="5"></th>
            <td>a. &nbsp  Nama</td>
            <td>: <?php echo $resDet['nama_peg'] ?>  </td>
          </tr>
          <tr>
            <td>b. &nbsp NIP</td>
            <td>: <?php echo $resDet['nip_peg'] ?>  </td>
          </tr>
          <tr>
            <td>c. &nbsp Pangkat/ Gol. Ruang</td>
            <td>: <?php echo $resDet['pangkat_peg'] ?>  </td>
          </tr>
          <tr>
            <td>d. &nbsp  Jabatan</td>
            <td>: <?php echo $resDet['jabatan_peg'] ?>  </td>
          </tr>
          <tr>
            <td>d. &nbsp  Unit</td>
            <td>: <?php echo $resDet['unit_peg'] ?>  </td>
          </tr>
        </tbody>

        <thead class="bg-success">
          <tr>
            <th scope="col">2</th>
            <th colspan="2">PEJABAT PENILAI</th>
          </tr>
        </thead>
      <tbody>
        <tr>
          <th rowspan="5"></th>
          <td>a. &nbsp  Nama</td>
          <td>: <?php echo $resDet['nama_pen'] ?>  </td>
        </tr>
        <tr>
          <td>b. &nbsp NIP</td>
          <td>: <?php echo $resDet['nip_pen'] ?>  </td>
        </tr>
        <tr>
          <td>c. &nbsp Pangkat/ Gol. Ruang</td>
          <td>: <?php echo $resDet['pangkat_pen'] ?>  </td>
        </tr>
        <tr>
          <td>d. &nbsp  Jabatan</td>
          <td>: <?php echo $resDet['jabatan_pen'] ?>  </td>
        </tr>
        <tr>
          <td>d. &nbsp  Unit</td>
          <td>: <?php echo $resDet['unit_pen'] ?>  </td>
        </tr>
      </tbody>

      <thead class="bg-primary">
        <tr>
          <th scope="col">3</th>
          <th colspan="2">ATASAN PEJABAT PENILAI</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th rowspan="5"></th>
          <td>a. &nbsp  Nama</td>
          <td>: <?php echo $resDet['nama_ats'] ?>  </td>
        </tr>
        <tr>
          <td>b. &nbsp NIP</td>
          <td>: <?php echo $resDet['nip_ats'] ?>  </td>
        </tr>
        <tr>
          <td>c. &nbsp Pangkat/ Gol. Ruang</td>
          <td>: <?php echo $resDet['pangkat_ats'] ?>  </td>
        </tr>
        <tr>
          <td>d. &nbsp  Jabatan</td>
          <td>: <?php echo $resDet['jabatan_ats'] ?>  </td>
        </tr>
        <tr>
          <td>d. &nbsp  Unit</td>
          <td>: <?php echo $resDet['unit_ats'] ?>  </td>
        </tr>
      </tbody>
    </table>

        <div class="text-center">
        <a href="#" class="btn btn-primary mr-4"><i class="fa fa-print" style="font-size:24px"></i> Cetak</a>

        <a href="data.php?aksi=updateData&id=<?php echo $resDet['id']; ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" style="font-size:24px"></i> Ubah</a>
        
        </div>

      </div>
    </div>
    </div>
  </div>
   <!-- End dataSKP -->

<!-- Tab Formulir SKP -->
  
<div class="tab-pane fade" id="nav-formulir" role="tabpanel" aria-labelledby="nav-formulir-tab">

<div class="container-fluid">
<div class="card mb-2">
    <div class="card-header text-center bg-dark text-white">SKP Tenaga Kependidikan</div>
    <div class="card-body">
    <div>
       <span class='mr-5'><?php echo $resDet['unit_peg'] ?></span>
       <span class='mr-5 ml-5'></span> 
        <span class='ml-5'>PERIODE PENILAIAN : <?php echo $periode_awal." &nbsp s.d &nbsp ". $periode_akhir;   ?> </span>
</div>
    <table class="table table-bordered table-responsive-sm table-striped">
    <tr class="text-center bg-secondary">
      <td colspan='2'>PEGAWAI YANG DINILAI</td>
      <td colSPAN='2'>PEJABAT PENILAI KINERJA</td>
    </tr>
    <tr>
      <td>NAMA</td>
      <td><?php echo $resDet['nama_peg'] ?></td>
      <td>NAMA</td>
      <td><?php echo $resDet['nama_pen'] ?></td>
    </tr>
    <tr>
      <td>NIP</th>
      <td><?php echo $resDet['nip_peg'] ?></td>
      <td>NIP</th>
      <td><?php echo $resDet['nip_pen'] ?></td>
    </tr>
    <tr>
        <td>PANGKAT / GOL. RUANG</td>
      <td><?php echo $resDet['pangkat_peg'] ?></td>
      <td>PANGKAT / GOL. RUANG</td>
      <td><?php echo $resDet['pangkat_pen'] ?></td>
    </tr>
    <tr>
      <td>JABATAN</th>
      <td><?php echo $resDet['jabatan_peg'] ?></td>
      <td>JABATAN</th>
      <td><?php echo $resDet['jabatan_pen'] ?></td>
    </tr>
    <tr>
      <td>UNIT KERJA</th>
      <td><?php echo $resDet['unit_peg'] ?></td>
      <td>UNIT KERJA</th>
      <td><?php echo $resDet['unit_pen'] ?></td>
    </tr>
</table>

<a href="data.php?aksi=addFormulirSKP&id=<?php echo $id ?>" class="btn-sm btn-success mb-2">
<i class="fa fa-plus-circle"></i> Tambah</a> 
<table class='table table-bordered table-responsive-sm mt-2 table-hover'>
    <tr class='text-center bg-secondary text-white'>
        <th>No. </th>
        <th>Rencana kinerja atasan langsung</th>
        <th>Rencana kinerja</th>
        <th>Aspek</th>
        <th>Indikator kinerja individu</th>
        <th colspan='2'>Target</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no='';
    $query4="SELECT * FROM skp WHERE id_data=$id";
    
    $sql4=mysqli_query($conn,$query4);
    $cek=mysqli_num_rows($sql4);
    if($cek<1){
        echo "<br>Belum ada data";
    };
    while($hasil4=mysqli_fetch_array($sql4)){
    $no++;
    ?>
 
    <tr>
        <td rowspan='3'><?php echo $no; ?> </td>
        <td rowspan='3'><?php echo $hasil4['kinerja_ats'] ?></td>
        <td rowspan='3'><?php echo $hasil4['kinerja'] ?></td>
        <td>Kuantitas</td>
        <td><?php echo $hasil4['kuantitas'] ?></td>
        <td><?php echo $hasil4['target_kuan'] ?></td>
        <td><?php echo $hasil4['satuan_kuan_target'] ?></td>
        <td rowspan='3'>
        <a href="data.php?aksi=updateformSKP&id=<?php echo $hasil4['id'];?>" class="btn-sm btn-primary fas fa-edit mr-2 mb-1"></a>

        <a href="data.php?aksi=deleteformSKP&id=<?php echo $hasil4['id'];?>" onclick="javascript:return confirm('Anda Yakin untuk menghapus data ini?')" class="btn-sm btn-danger fas fa-trash-alt mt-1"> </a>

        </td>
    </tr>
    <tr>
        <td>Kualitas</td>
        <td><?php echo $hasil4['kualitas'] ?></td>
        <td><?php echo $hasil4['target_kual'] ?></td>
        <td><?php echo $hasil4['satuan_kual_target'] ?></td>
    </tr>
    <tr>
        <td>Waktu</td>
        <td><?php echo $hasil4['waktu'] ?></td>
        <td><?php echo $hasil4['target_waktu'] ?></td>
        <td><?php echo $hasil4['satuan_target_waktu'] ?></td>
    </tr>
    <?php } ?>
</table>

    </div>
</div>
</div>
</div>
<!-- End Tab Formulir SKP -->


<!-- Tab Penilaian SKP -->
<div class="tab-pane fade" id="nav-penilaian" role="tabpanel" aria-labelledby="nav-penilaian-tab">

<div class="container-fluid">
<div class="card mb-2">
    <div class="card-header text-center bg-dark text-white">PENILAIAN SKP JA/ JF</div>
    <div class="card-body">
    <div>
       <span class='mr-5'><?php echo $resDet['unit_peg'] ?></span>
       <span class='mr-5 ml-5'></span> 
        <span class='ml-5'>PERIODE PENILAIAN : <?php echo $periode_awal." &nbsp s.d &nbsp ". $periode_akhir;   ?> </span>
</div>
    <table class="table table-bordered table-responsive-sm">
    <tr class="text-center bg-secondary">
      <td colspan='2'>PEGAWAI YANG DINILAI</td>
      <td colSPAN='2'>PEJABAT PENILAI KINERJA</td>
    </tr>
    <tr>
      <td>NAMA</td>
      <td><?php echo $resDet['nama_peg'] ?></td>
      <td>NAMA</td>
      <td><?php echo $resDet['nama_pen'] ?></td>
    </tr>
    <tr>
      <td>NIP</th>
      <td><?php echo $resDet['nip_peg'] ?></td>
      <td>NIP</th>
      <td><?php echo $resDet['nip_pen'] ?></td>
    </tr>
    <tr>
        <td>PANGKAT / GOL. RUANG</td>
      <td><?php echo $resDet['pangkat_peg'] ?></td>
      <td>PANGKAT / GOL. RUANG</td>
      <td><?php echo $resDet['pangkat_pen'] ?></td>
    </tr>
    <tr>
      <td>JABATAN</th>
      <td><?php echo $resDet['jabatan_peg'] ?></td>
      <td>JABATAN</th>
      <td><?php echo $resDet['jabatan_pen'] ?></td>
    </tr>
    <tr>
      <td>UNIT KERJA</th>
      <td><?php echo $resDet['unit_peg'] ?></td>
      <td>UNIT KERJA</th>
      <td><?php echo $resDet['unit_pen'] ?></td>
    </tr>
</table>

<table class='table table-bordered table-responsive-sm mt-2 table-hover'>
    <tr class='text-center bg-secondary text-white'>
        <th rowspan='2'>No. </th>
        <th rowspan='2'>Rencana kinerja atasan langsung</th>
        <th rowspan='2'>Rencana kinerja</th>
        <th rowspan='2'>Aspek</th>
        <th rowspan='2'>Indikator kinerja individu</th>
        <th rowspan='2'>Target</th>
        <th rowspan='2'>Realisasi</th>
        <th rowspan='2'>Capaian IKI <br> (dalam %)</th>
        <th rowspan='2'>Kategori Capaian IKI</th>
        <th colspan='3'>Capaian Rencana Kinerja</th>
    </tr>
    <tr class='text-center bg-secondary text-white'>
        <th>Kategori</th>
        <th>Nilai</td>
        <th>Nilai Tertimbang</th>
    </tr>
    <?php
    $no='';
    $query4="SELECT * FROM skp WHERE id_data=$id";
    
    $sql4=mysqli_query($conn,$query4);
    $cek=mysqli_num_rows($sql4);
        if($cek<1){
            echo "<br>Belum ada data";
        };
    while($hasil4=mysqli_fetch_array($sql4)){
    $no++;
    ?>

    <tr>
        <td rowspan='3'><?php echo $no; ?> </td>
        <td rowspan='3'><?php echo $hasil4['kinerja_ats'] ?></td>
        <td rowspan='3'><?php echo $hasil4['kinerja'] ?></td>
        <td>Kuantitas</td>
        <td><?php echo $hasil4['kuantitas'] ?></td>
        <td><?php echo $hasil4['target_kuan'] ?></td>
        <td><?php echo $hasil4['realisasi_kuan'] ?></td>
        </td>

        <td><?php echo $hasil4['capaian_kuan_iki'] ?></td>
        <td><?php echo $hasil4['kategori_kuan_iki'] ?></td>
        <td rowspan='3' class='text-center'><?php echo $hasil4['kategori'] ?></td>
        <td rowspan='3' class='text-center'><?php echo $hasil4['nilai'] ?></td>
        <td rowspan='3' class='text-center'><?php echo $hasil4['nilai_ter'] ?></td>
    </tr>
    <tr>
        <td>Kualitas</td>
        <td><?php echo $hasil4['kualitas'] ?></td>
        <td><?php echo $hasil4['target_kual'] ?></td>
        <td><?php echo $hasil4['realisasi_kual'] ?></td>
        <td><?php echo $hasil4['capaian_kual_iki'] ?></td>
        <td><?php echo $hasil4['kategori_kual_iki'] ?></td>
    </tr>
    <tr>
        <td>Waktu</td>
        <td><?php echo $hasil4['waktu'] ?></td>
        <td><?php echo $hasil4['target_waktu'] ?></td>
        <td><?php echo $hasil4['realisasi_waktu'] ?></td>
        <td><?php echo $hasil4['capaian_waktu_iki'] ?></td>
        <td><?php echo $hasil4['kategori_waktu_iki'] ?></td>
    </tr>

    <?php } 
    
      // rumus Nilai Kinerja Utama
      $sql_nilaiku="SELECT AVG(nilai_ter) AS avg_nilaiku FROM skp";
      $queri_nilaiku=mysqli_query($conn,$sql_nilaiku);
      $res_nilaiku=mysqli_fetch_assoc($queri_nilaiku);
      $nilai_ku=$res_nilaiku['avg_nilaiku'];
        $nilaiku=round($nilai_ku,2);
      // End rumus Nilai Kinerja Utama
    ?>

    <tr class="bg-secondary text-white">
        <td colspan='11'>  Nilai Kinerja Utama</td>
        <td><?php echo $nilaiku?></td>
    </tr>
    <tr class="bg-secondary text-white">
        <?php $nilaikt=0; ?>
        <td colspan='11'>  Nilai Kinerja Tambahan</td>
        <td> - </td>
    </tr>
    <tr class="bg-secondary text-white">
        <?php
        if($nilaikt!=0){
            $nilai_akhir_SKP=($nilaiku+$nilaikt)/2;
            if($nilai_akhir_SKP>=120){
                $nilai_akhir_SKP=120;
            }
        }elseif($nilaikt==0){
            $nilai_akhir_SKP=$nilaiku;
        }elseif($nilaiku>=120){
            $nilai_akhir_SKP=120;
            }
        ?>
        <td colspan='11'> Nilai Akhir SKP</td>
        <td><?php echo round($nilai_akhir_SKP,2); ?></td>
    </tr>
    <tr class="bg-secondary text-white">
        <td colspan='11'>  Keterangan</td>
        <td>-</td>
    </tr>
</table>

    </div>
</div>
</div>

</div>
<!-- End Tab Penilaian SKP -->


<!-- Tab Penilaian Kinerja -->
<div class="tab-pane fade" id="nav-penilaian_kinerja" role="tabpanel" aria-labelledby="nav-penilaian_kinerja-tab">

<div class="container-fluid">
<div class="card mb-2">
    <div class="card-header text-center bg-dark text-white">
        <h5>PENILAIAN KINERJA PNS </h5>
        <span class=''>PERIODE PENILAIAN : <?php echo $periode_awal." &nbsp s.d &nbsp ". $periode_akhir;   ?> </span>
    </div>
    
    <div class="card-body">
    <table class="table table-bordered table-responsive-sm">
    <tr class="text-center bg-secondary">
      <td colspan='2'>PEJABAT PENILAI KINERJA</td>
      <td colSPAN='2'>PEGAWAI YANG DINILAI</td>
    </tr>
    <tr>
      <td>NAMA</td>
      <td><?php echo $resDet['nama_pen'] ?></td>
      <td>NAMA</td>
      <td><?php echo $resDet['nama_peg'] ?></td>
    </tr>
    <tr>
      <td>NIP</th>
      <td><?php echo $resDet['nip_pen'] ?></td>
      <td>NIP</th>
      <td><?php echo $resDet['nip_peg'] ?></td>
    </tr>
    <tr>
        <td>PANGKAT / GOL. RUANG</td>
      <td><?php echo $resDet['pangkat_pen'] ?></td>
      <td>PANGKAT / GOL. RUANG</td>
      <td><?php echo $resDet['pangkat_peg'] ?></td>
    </tr>
    <tr>
      <td>JABATAN</th>
       <td><?php echo $resDet['jabatan_pen'] ?></td>
      <td>JABATAN</th>
     <td><?php echo $resDet['jabatan_peg'] ?></td>
    </tr>
    <tr>
      <td>UNIT KERJA</th>
      <td><?php echo $resDet['unit_pen'] ?></td>
      <td>UNIT KERJA</th>
      <td><?php echo $resDet['unit_peg'] ?></td>
    </tr>
</table>


<?php 
$id_data=$_GET['id'];
$sqlki="SELECT * FROM kinerja WHERE id_data=$id_data";
$queriki=mysqli_query($conn,$sqlki);
$cek=mysqli_num_rows($queriki);
if($cek!=0){
    echo '<a href="data.php?aksi=updateNilaiKinerja" class="btn btn-warning text-dark"> <i class="fa fa-edit"> </i> Update Penilaian </a>';
}else{
    echo "<a href='data.php?aksi=addNilaiKinerja&id=$id_data' class='btn btn-primary'> <i class='fa fa-plus-circle'> </i> Berikan Penilaian </a> "; 
}
?>


<table class="table table-bordered table-responsive-sm table-striped table-hover mt-2">
    <tr class="text-center bg-secondary text-white">
      <td>UNSUR YANG DINILAI</td>
      <td colspan='2'>NILAI</td>
    </tr>
    <tr>
      <td>A. SASARAN KINERJA PEGAWAI (SKP)</td>
      <td>105.50</td>
      <td>BAIK TO</td>
    </tr>
    <tr>
      <td>B. PERILAKU KERJA PEGAWAI :</td>
      <td>91</td>
      <td>BAIK LAI</td>
    </tr>
    <tr>
      <td> &nbsp &nbsp &nbsp &nbsp 1. Orientasi Pelayanan</td>
      <td>93</td>
      <td>BAIK LAI</td>
    </tr>
    <tr>
      <td>&nbsp &nbsp &nbsp &nbsp 2. Inisiatif Kerja</td>
      <td>93</td>
      <td>BAIK LAI</td>
    </tr>
    <tr>
      <td>&nbsp &nbsp &nbsp &nbsp 3. Komitmen</td>
      <td>93</td>
      <td>BAIK LAI</td>
    </tr>
    <tr>
      <td>&nbsp &nbsp &nbsp &nbsp 4. Kerjasama</td>
      <td>93</td>
      <td>BAIK LAI</td>
    </tr>
    <tr>
      <td>&nbsp &nbsp &nbsp &nbsp 5. Kepemimpinan</td>
      <td>93</td>
      <td>BAIK LAI</td>
    </tr>
    <tr>
        <td>&nbsp &nbsp NILAI KINERJA PNS</td>
        <td colspan='2'>99.34</td>
    </tr>
    <tr>
        <td>C. IDE BARU</td>
        <td colspan='2'>00.00</td>
    </tr>
    <tr>
        <td>NILAI AKHIR</td>
        <td colspan='2'>00.00</td>
    </tr>
    <tr>
        <td>PREDIKAT</td>
        <td colspan='2'>BAIK</td>
    </tr>
</table>


</div>
</div>
</div>
<!-- End Tab Penilaian Kinerja -->


</div>
  <!-- End Tab panes -->
</div> 
<!-- End container-fluid -->

<?php 
} 
// endFungsiDetail
// ========END Menu detail SKP==================== 
?>


<?php 
// tambahFormulirSKP
function addFormulirSKP($conn){   
    $id=$_GET['id'];
    $qDet="SELECT * FROM data WHERE id=$id";
    $sqlDet=mysqli_query($conn,$qDet);
    $resDet=mysqli_fetch_assoc($sqlDet); 

    $periode_awal=tanggal_indo($resDet['periode_awal']);
    $periode_akhir=tanggal_indo($resDet['periode_akhir']);
?>
<div class="container-fluid">
<div class="card">
    <div class="card-header text-center bg-dark text-white">SKP Tenaga Kependidikan</div>
    <div class="card-body">
        <form action='' method="POST">
            <div class="alert alert-warning" role="alert">
            <div class="form-group row">
              <h6>Periode penilaian &nbsp : <?php echo $periode_awal." &nbsp sampai dengan &nbsp ". $periode_akhir;?></h6>    
            </div>
            </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name='nama' value="<?php echo $_SESSION['nama'] ?>" readonly>
            </div>
        </div>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name='nip' value="<?php echo $_SESSION['nip'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="kerja_ats" class="col-sm-2 col-form-label">Rencana Kinerja Atasan Langsung</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="kerja_ats" name='kerja_ats' rows="3" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="kerja" class="col-sm-2 col-form-label">Rencana Kerja Individu</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="kerja" name='kerja' rows="3" required></textarea>
                </div>
            </div>

            <div class="alert alert-secondary" role="alert">
            INDIKATOR KINERJA INDIVIDU
            </div>
            
            <div class="row">
                <div class="col-5">
                <div class="form-group row">
                    <label for="kuantitas" class="col-sm-3 col-form-label">Aspek Kuantitas</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="kuantitas" name='kuantitas' rows="13" required></textarea>
                    </div>
                </div>
                </div>
                <div class="col-7">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="target_kuan">Target</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="target_kuan" name='target_kuan' required>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="satuan_kuan_target" name='satuan_kuan_target' placeholder="satuan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="realisasi_kuan">Realisasi</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="realisasi_kuan" name='realisasi_kuan' required>
                        </div>
                    </div>

                    <div class="card border-warning mb-3">
                        <div class="h6 card-header bg-warning text-center">INISIASI/ PENETAPAN SKP</div>
                        <div class="card-body text-dark">
                            <div class="form-group row">    
                                <div class="col-sm-3">
                                    <label for="target_kuan_min">Target Minimum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kuan_min"name='target_kuan_min' required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="target_kuan_max">Target Maximum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kuan_max" name='target_kuan_max' required>
                                </div>
                            </div>

                            <div class="form-group row">  
                                <div class="col-sm-3">
                                <label for="kondisi_kuan">Kondisi</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="kondisi_kuan" name='kondisi_kuan'>
                                    <option>Normal</option>
                                    <option>Khusus</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="metode_kuan">Metode KU/ Bobot KT</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="metode_kuan" name='metode_kuan'>
                                        <option>Direct</option>
                                        <option>Non Direct</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-5">
                <div class="form-group row">
                    <label for="kualitas" class="col-sm-3 col-form-label">Aspek Kualitas</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="kualitas" name='kualitas' rows="13" required></textarea>
                    </div>
                </div>
                </div>
                <div class="col-7">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="target_kual">Target</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="target_kual" name='target_kual' required>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="satuan_kual_target" name='satuan_kual_target' placeholder="satuan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="realisasi_kual">Realisasi</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="realisasi_kual" name='realisasi_kual' required>
                        </div>
                    </div>
                    
                    <div class="card border-warning mb-3">
                        <div class="h6 card-header bg-warning text-center">INISIASI/ PENETAPAN SKP</div>
                        <div class="card-body text-dark">
                            <div class="form-group row">    
                                <div class="col-sm-3">
                                    <label for="target_kual_min">Target Minimum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kual_min" name='target_kual_min' required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="target_kual_max">Target Maximum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kual_max" name='target_kual_max' required>
                                </div>
                            </div>

                            <div class="form-group row">  
                                <div class="col-sm-3">
                                <label for="kondisi_kual">Kondisi</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="kondisi_kual" name='kondisi_kual'>
                                    <option>Normal</option>
                                    <option>Khusus</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="metode_kual">Metode KU/ Bobot KT</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="metode_kual" name='metode_kual'>
                                        <option>Direct</option>
                                        <option>Non Direct</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-5">
                <div class="form-group row">
                    <label for="waktu" class="col-sm-3 col-form-label">Aspek Waktu</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="waktu" name='waktu' rows="13" required></textarea>
                    </div>
                </div>
                </div>
                <div class="col-7">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="target_waktu">Target</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="target_waktu" name='target_waktu' required>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="satuan_waktu_target" name='satuan_waktu_target' placeholder="satuan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="realisasi_waktu">Realisasi</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="realisasi_waktu" name='realisasi_waktu' required>
                        </div>
                    </div>

                    <div class="card border-warning mb-3">
                        <div class="h6 card-header bg-warning text-center">INISIASI/ PENETAPAN SKP</div>
                        <div class="card-body text-dark">
                            <div class="form-group row">    
                                <div class="col-sm-3">
                                    <label for="target_waktu_min">Target Minimum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_waktu_min" name='target_waktu_min' required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="target_waktu_max">Target Maximum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_waktu_max" name='target_waktu_max' required>
                                </div>
                            </div>

                            <div class="form-group row">  
                                <div class="col-sm-3">
                                <label for="kondisi_waktu">Kondisi</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="kondisi_waktu" name='kondisi_waktu'>
                                    <option>Normal</option>
                                    <option>Khusus</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="metode_waktu">Metode KU/ Bobot KT</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="metode_waktu" name='metode_waktu'>
                                        <option>Direct</option>
                                        <option>Non Direct</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-center mt-5">
            <button type="submit" class="btn btn-success mb-2 mr-4" name='simpan_formulir'><i class="fas fa-archive"></i> Simpan</button>

            <a class="btn btn-danger mb-2" href="data.php?aksi=detail&id=<?php echo $id ?>" role="button"><i class="fa fa-close" style="font-size:24px"></i> Batal</a>
            </div>
        </form>
    </div>
  </div>
</div>


<?php
    // Process tambahFormulirSKP
    if(isset($_POST['simpan_formulir'])){
        $id_data=$id;
        $nip_peg=$_POST['nip'];
        $kinerja=$_POST['kerja'];
        $kinerja_atas=$_POST['kerja_ats'];
        $kuantitas=$_POST['kuantitas'];
        $target_kuan= $_POST['target_kuan'];
        $satuan_kuan_target= $_POST['satuan_kuan_target'];
        $realisasi_kuan= $_POST['realisasi_kuan'];
        $target_kuan_min= $_POST['target_kuan_min'];
        $target_kuan_max= $_POST['target_kuan_max'];
        $kondisi_kuan= $_POST['kondisi_kuan'];
        $metode_kuan= $_POST['metode_kuan'];
        $kualitas= $_POST['kualitas'];
        $target_kual= $_POST['target_kual'];
        $satuan_kual_target= $_POST['satuan_kual_target'];
        $realisasi_kual=$_POST['realisasi_kual'];
        $target_kual_min= $_POST['target_kual_min'];
        $target_kual_max= $_POST['target_kual_max'];
        $kondisi_kual= $_POST['kondisi_kual'];
        $metode_kual= $_POST['metode_kual'];
        $waktu= $_POST['waktu'];
        $target_waktu= $_POST['target_waktu'];
        $satuan_waktu_target= $_POST['satuan_waktu_target'];
        $realisasi_waktu= $_POST['realisasi_waktu'];
        $target_waktu_min= $_POST['target_waktu_min'];
        $target_waktu_max= $_POST['target_waktu_max'];
        $kondisi_waktu= $_POST['kondisi_waktu'];
        $metode_waktu= $_POST['metode_waktu'];

        $periode_awal=$resDet['periode_awal'];
        $periode_akhir=$resDet['periode_akhir'];
        $tanggal=date('Y-m-d');


        $qForm="INSERT INTO skp(id_data, nip_peg, kinerja, kinerja_ats, kuantitas, target_kuan, satuan_kuan_target, target_kuan_min, target_kuan_max, kondisi_kuan, metode_kuan, realisasi_kuan, capaian_kuan_iki, kategori_kuan_iki, kualitas, target_kual, satuan_kual_target, target_kual_min, target_kual_max, kondisi_kual, metode_kual, realisasi_kual, capaian_kual_iki, kategori_kual_iki, waktu, target_waktu, satuan_target_waktu, target_waktu_min, target_waktu_max, kondisi_waktu, metode_waktu, realisasi_waktu, capaian_waktu_iki, kategori_waktu_iki, kategori, nilai, nilai_ter, nilai_ku, nilai_kt, nilai_skp, periode_awal, periode_akhir, tanggal) VALUES ('$id_data','$nip_peg','$kinerja','$kinerja_atas','$kuantitas','$target_kuan','$satuan_kuan_target','$target_kuan_min','$target_kuan_max','$kondisi_kuan','$metode_kuan','$realisasi_kuan','','','$kualitas','$target_kual','$satuan_kual_target','$target_kual_min','$target_kual_max','$kondisi_kual','$metode_kual','$realisasi_kual','','','$waktu','$target_waktu','$satuan_waktu_target','$target_waktu_min','$target_waktu_max','$kondisi_waktu','$metode_waktu','$realisasi_waktu','','','','','','','','','$periode_awal','$periode_akhir','$tanggal')";

        $sqlForm=mysqli_query($conn,$qForm);

        if($sqlForm){
          echo "<script> alert ('Berhasil menambahkan Formulir SKP!'); window.location='data.php?aksi=detail&id=$id'; </script>" ;
      }else {
          echo "<script> alert ('Terjadi Kesalahan selama penyimpanan'); window.location='data.php?aksi=detail&id=$id'; </script>" ;
      }
    }
    ?>

<?php
// End process tambahFormulirSKP  
} 
// End tambahFormulirSKP
?> 


<?php 
// Fungsi hapus data FormulirSKP
function deleteformSKP($conn){
    if(isset($_GET['aksi']) && isset($_GET['id']) ){
        $id=$_GET['id'];
        $queri="DELETE FROM skp WHERE id=$id ";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location=history.go(-1) </script>";
        }
    }
}
// end Fungsi hapus data
?>

<?php 
// Fungsi update FormulirSKP
function updateformSKP($conn){  
    $id=$_GET['id'];
    $qDet="SELECT * FROM skp WHERE id=$id";
    $sqlDet=mysqli_query($conn,$qDet);
    $resDet=mysqli_fetch_assoc($sqlDet); 

    $periode_awal=tanggal_indo($resDet['periode_awal']);
    $periode_akhir=tanggal_indo($resDet['periode_akhir']);
?>
<div class="container-fluid">
<div class="card">
    <div class="card-header text-center bg-dark text-white">UPDATE SKP Tenaga Kependidikan</div>
    <div class="card-body">
        <form action='' method="POST">
          <?php $id_data= $resDet['id_data'] ?>

            <div class="alert alert-warning" role="alert">
            <div class="form-group row">
              <h6>Periode penilaian &nbsp : <?php echo $periode_awal." &nbsp sampai dengan &nbsp ". $periode_akhir;?></h6>    
            </div>
            </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name='nama' value="<?php echo $_SESSION['nama'] ?>" readonly>
            </div>
        </div>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name='nip' value="<?php echo $_SESSION['nip'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="kerja_ats" class="col-sm-2 col-form-label">Rencana Kinerja Atasan Langsung</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="kerja_ats" name='kerja_ats' rows="3" required><?php echo $resDet['kinerja_ats'] ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="kerja" class="col-sm-2 col-form-label">Rencana Kerja Individu</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="kerja" name='kerja' rows="3" required><?php echo $resDet['kinerja'] ?></textarea>
                </div>
            </div>

            <div class="alert alert-secondary" role="alert">
            INDIKATOR KINERJA INDIVIDU
            </div>
            
            <div class="row">
                <div class="col-5">
                <div class="form-group row">
                    <label for="kuantitas" class="col-sm-3 col-form-label">Aspek Kuantitas</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="kuantitas" name='kuantitas' rows="13" required><?php echo $resDet['kuantitas'] ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-7">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="target_kuan">Target</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="target_kuan" name='target_kuan' value="<?php echo $resDet['target_kuan'] ?>" required>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="satuan_kuan_target" name='satuan_kuan_target' placeholder="satuan" value="<?php echo $resDet['satuan_kuan_target'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="realisasi_kuan">Realisasi</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="realisasi_kuan" name='realisasi_kuan' value="<?php echo $resDet['realisasi_kuan'] ?>" required>
                        </div>
                    </div>
                    
                    <div class="card border-warning mb-3">
                        <div class="h6 card-header bg-warning text-center">INISIASI/ PENETAPAN SKP</div>
                        <div class="card-body text-dark">
                            <div class="form-group row">    
                                <div class="col-sm-3">
                                    <label for="target_kuan_min">Target Minimum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kuan_min"name='target_kuan_min' value="<?php echo $resDet['target_kuan_min'] ?>" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="target_kuan_max">Target Maximum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kuan_max" name='target_kuan_max' value="<?php echo $resDet['target_kuan_max'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">  
                                <div class="col-sm-3">
                                <label for="kondisi_kuan">Kondisi</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="kondisi_kuan" name='kondisi_kuan'>
                                    <option value='Normal' <?php if($resDet['kondisi_kuan']=='Normal'){echo 'selected';} ?>>Normal</option>
                                    <option value='Khusus' <?php if($resDet['kondisi_kuan']=='Khusus'){echo 'selected';} ?>>Khusus</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="metode_kuan">Metode KU/ Bobot KT</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="metode_kuan" name='metode_kuan'>
                                        <option <?php if($resDet['metode_kuan']=='Direct'){echo 'selected';} ?>>Direct</option>
                                        <option <?php if($resDet['metode_kuan']=='Non Direct'){echo 'selected';} ?>>Non Direct</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-5">
                <div class="form-group row">
                    <label for="kualitas" class="col-sm-3 col-form-label">Aspek Kualitas</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="kualitas" name='kualitas' rows="13" required><?php echo $resDet['kualitas'] ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-7">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="target_kual">Target</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="target_kual" name='target_kual' value='<?php echo $resDet['target_kual'] ?>' required>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="satuan_kual_target" name='satuan_kual_target' value='<?php echo $resDet['satuan_kual_target'] ?>' required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="realisasi_kual">Realisasi</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="realisasi_kual" name='realisasi_kual' value='<?php echo $resDet['realisasi_kual'] ?>' required>
                        </div>
                    </div>

                    <div class="card border-warning mb-3">
                        <div class="h6 card-header bg-warning text-center">INISIASI/ PENETAPAN SKP</div>
                        <div class="card-body text-dark">
                            <div class="form-group row">    
                                <div class="col-sm-3">
                                    <label for="target_kual_min">Target Minimum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kual_min" name='target_kual_min' value='<?php echo $resDet['target_kual_min'] ?>' required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="target_kual_max">Target Maximum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_kual_max" name='target_kual_max' value='<?php echo $resDet['target_kual_max'] ?>' required>
                                </div>
                            </div>

                            <div class="form-group row">  
                                <div class="col-sm-3">
                                <label for="kondisi_kual">Kondisi</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="kondisi_kual" name='kondisi_kual'>
                                    <option <?php if($resDet['kondisi_kual']=='Normal'){echo 'selected';} ?>>Normal</option>
                                    <option <?php if($resDet['kondisi_kual']=='Khusus'){echo 'selected';} ?>>Khusus</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="metode_kual">Metode KU/ Bobot KT</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="metode_kual" name='metode_kual'>
                                        <option <?php if($resDet['metode_kual']=='Direct'){echo 'selected';} ?>>Direct</option>
                                        <option <?php if($resDet['metode_kual']=='Non Direct'){echo 'selected';} ?>>Non Direct</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-5">
                <div class="form-group row">
                    <label for="waktu" class="col-sm-3 col-form-label">Aspek Waktu</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="waktu" name='waktu' rows="13" required><?php echo $resDet['waktu'] ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-7">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="target_waktu">Target</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="target_waktu" name='target_waktu' value='<?php echo $resDet['target_waktu'] ?>' required>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="satuan_target_waktu" name='satuan_target_waktu' placeholder="satuan" value='<?php echo $resDet['satuan_target_waktu'] ?>' required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="realisasi_waktu">Realisasi</label>             
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="realisasi_waktu" name='realisasi_waktu' value='<?php echo $resDet['realisasi_waktu'] ?>' required>
                        </div>
                    </div>

                    <div class="card border-warning mb-3">
                        <div class="h6 card-header bg-warning text-center">INISIASI/ PENETAPAN SKP</div>
                        <div class="card-body text-dark">
                            <div class="form-group row">    
                                <div class="col-sm-3">
                                    <label for="target_waktu_min">Target Minimum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_waktu_min" name='target_waktu_min' value='<?php echo $resDet['target_waktu_min'] ?>' required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="target_waktu_max">Target Maximum</label>             
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" id="target_waktu_max" name='target_waktu_max' value='<?php echo $resDet['target_waktu_max'] ?>' required>
                                </div>
                            </div>

                            <div class="form-group row">  
                                <div class="col-sm-3">
                                <label for="kondisi_waktu">Kondisi</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="kondisi_waktu" name='kondisi_waktu'>
                                    <option value='Normal' <?php if($resDet['kondisi_waktu']=='Normal'){echo 'selected';} ?>>Normal</option>

                                    <option value='Khusus' <?php if($resDet['kondisi_waktu']=='Khusus'){echo 'selected';} ?> >Khusus</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="metode_waktu">Metode KU/ Bobot KT</label>             
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="metode_waktu" name='metode_waktu'>
                                        <option <?php if($resDet['metode_waktu']=='Direct'){echo 'selected';} ?>>Direct</option>
                                        <option <?php if($resDet['metode_waktu']=='Non Direct'){echo 'selected';} ?>>Non Direct</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-center mt-5">
            <button type="submit" class="btn btn-success mb-2 mr-4" name='update_formulir'><i class="fas fa-archive"></i> Update</button>
           
            <input type="button" value='Batal' onClick='history.back();'class='btn btn-danger mb-2' />
        </form>
    </div>
  </div>
</div>


    <?php
    // Process updateFormulirSKP 
    if(isset($_POST['update_formulir'])){
        $id=$id;
        $kinerja=$_POST['kerja'];
        $kinerja_ats=$_POST['kerja_ats'];
        $kuantitas=$_POST['kuantitas'];
        $target_kuan= $_POST['target_kuan'];
        $satuan_kuan_target= $_POST['satuan_kuan_target'];
        $realisasi_kuan= $_POST['realisasi_kuan'];
        $target_kuan_min= $_POST['target_kuan_min'];
        $target_kuan_max= $_POST['target_kuan_max'];
        $kondisi_kuan= $_POST['kondisi_kuan'];
        $metode_kuan= $_POST['metode_kuan'];
        $kualitas= $_POST['kualitas'];
        $target_kual= $_POST['target_kual'];
        $satuan_kual_target= $_POST['satuan_kual_target'];
        $realisasi_kual=$_POST['realisasi_kual'];
        $target_kual_min= $_POST['target_kual_min'];
        $target_kual_max= $_POST['target_kual_max'];
        $kondisi_kual= $_POST['kondisi_kual'];
        $metode_kual= $_POST['metode_kual'];
        $waktu= $_POST['waktu'];
        $target_waktu= $_POST['target_waktu'];
        $satuan_target_waktu= $_POST['satuan_target_waktu'];
        $realisasi_waktu= $_POST['realisasi_waktu'];
        $target_waktu_min= $_POST['target_waktu_min'];
        $target_waktu_max= $_POST['target_waktu_max'];
        $kondisi_waktu= $_POST['kondisi_waktu'];
        $metode_waktu= $_POST['metode_waktu'];

        // $periode_awal=$resDet['periode_awal'];
        // $periode_akhir=$resDet['periode_akhir'];
        // $tanggal=date('Y-m-d');

        // rumus capaian IKI Kuantitas
        if($realisasi_kuan>=$target_kuan_min AND $realisasi_kuan<=$target_kuan_max){
            $capaian_kuan_iki=100;
        }
        elseif ($realisasi_kuan<=$target_kuan_min){
            $capaian_kuan_iki=($realisasi_kuan/$target_kuan_min)*100;
        }elseif ($realisasi_kuan>=$target_kuan_max){
            $capaian_kuan_iki=($realisasi_kuan/$target_kuan_max)*100;
        };
        // End rumus capaian IKI Kuantitas

        // rumus kategori capaian IKI kuantitas
        if ($capaian_kuan_iki==100){
            $kategori_kuan_iki="Baik";
        }
        elseif ($capaian_kuan_iki<=99 && $capaian_kuan_iki>=80 ){
            $kategori_kuan_iki="Cukup";
        }
        elseif ($capaian_kuan_iki<=79 && $capaian_kuan_iki>=60){
            $kategori_kuan_iki="Kurang";
        }
        elseif ($capaian_kuan_iki<=59 && $capaian_kuan_iki>=0){
            $kategori_kuan_iki="Sangat Kurang";
        }
        elseif ($capaian_kuan_iki>'101' ) {
            $kategori_kuan_iki="Sangat Baik";
        }   
         // End rumus kategori capaian IKI kuantitas

        // rumus capaian IKI kualitas
        if($realisasi_kual>=$target_kual_min AND $realisasi_kual<=$target_kual_max ){
            $capaian_kual_iki=100;
        }elseif ($realisasi_kual<=$target_kual_min){
            $capaian_kual_iki=($realisasi_kual/$target_kual_min)*100;
        }elseif ($realisasi_kual>=$target_kual_max){
            $capaian_kual_iki=($realisasi_kual/$target_kual_max)*100;
        };
        // End rumus capaian IKI kualitas

        // rumus kategori capaian IKI kualitas
        if($capaian_kual_iki==100){
            $kategori_kual_iki="Baik";
            }else if ($capaian_kual_iki<=99 AND $capaian_kual_iki>=80){
            $kategori_kual_iki="Cukup";
            }else if ($capaian_kual_iki<=79 AND $capaian_kual_iki>=60){
            $kategori_kual_iki="Kurang";
            }else if ($capaian_kual_iki<=59 AND $capaian_kual_iki>=0){
            $kategori_kual_iki="Sangat Kurang";
            }else{
                $kategori_kual_iki="Sangat Baik"; 
            }      
        // End rumus kategori capaian IKI kualitas

        // rumus capaian IKI waktu
        if($realisasi_waktu==0){
            $capaian_waktu_iki='-';
        }
        elseif ($realisasi_waktu>=$target_waktu_min AND $realisasi_waktu<=$target_waktu_max ){
            $capaian_waktu_iki=100;
        }elseif ($realisasi_waktu<=$target_waktu_min AND $realisasi_waktu!=0 ){
            $capaian_waktu_iki=($target_waktu_min/$realisasi_waktu)*100;
        }elseif ($realisasi_waktu>=$target_waktu_max){
            $capaian_waktu_iki=($target_waktu_max/$realisasi_waktu)*100;
        };
        // End rumus capaian IKI waktu

        // rumus kategori capaian IKI Waktu
        if($capaian_waktu_iki>=101){
            $kategori_waktu_iki="Sangat Baik";
        }
        elseif($capaian_waktu_iki==100){
            $kategori_waktu_iki="Baik";
        }
        elseif($capaian_waktu_iki<=99 AND $capaian_waktu_iki>=80){
            $kategori_waktu_iki="Cukup";
        }
        elseif($capaian_waktu_iki>=60){
            $kategori_waktu_iki="Kurang";
        }
        elseif($capaian_waktu_iki<=59){
            $kategori_waktu_iki="Sangat Kurang";
        }
        // End rumus kategori capaian IKI Waktu

        $kategori=$kategori_kuan_iki;

        // rumus NILAI capaian rencana kinerja
        if($kategori=='Sangat Baik'){
            $nilai=120;
            $nilai_ter=120;
        } elseif($kategori=='Baik'){
            $nilai=100;
            $nilai_ter=100;
        } elseif($kategori=='Cukup'){
            $nilai=80;
            $nilai_ter=80;
        }  elseif($kategori=='Kurang'){
            $nilai=60;
            $nilai_ter=60;
        } elseif($kategori=='Sangat Kurang'){
            $nilai=25;
            $nilai_ter=25;
        }
        // End rumus NILAI capaian rencana kinerja

        $qupdate="UPDATE skp SET kinerja_ats='$kinerja_ats', kinerja='$kinerja', kuantitas='$kuantitas',target_kuan='$target_kuan',satuan_kuan_target='$satuan_kuan_target',realisasi_kuan='$realisasi_kuan',target_kuan_min='$target_kuan_min',target_kuan_max='$target_kuan_max', kondisi_kuan='$kondisi_kuan', metode_kuan='$metode_kuan', 
        capaian_kuan_iki='$capaian_kuan_iki', kategori_kuan_iki='$kategori_kuan_iki', kualitas='$kualitas', target_kual='$target_kual',satuan_kual_target='$satuan_kual_target', realisasi_kual='$realisasi_kual',target_kual_min='$target_kual_min',target_kual_max='$target_kual_max',kondisi_kual='$kondisi_kual',metode_kual='$metode_kual',capaian_kual_iki='$capaian_kual_iki', kategori_kual_iki='$kategori_kual_iki', waktu='$waktu', target_waktu='$target_waktu', satuan_target_waktu='$satuan_target_waktu',realisasi_waktu='$realisasi_waktu', target_waktu_min='$target_waktu_min',target_waktu_max='$target_waktu_max',kondisi_waktu='$kondisi_waktu',metode_waktu='$metode_waktu', capaian_waktu_iki='$capaian_waktu_iki', kategori_waktu_iki='$kategori_waktu_iki', kategori='$kategori', nilai='$nilai', nilai_ter='$nilai_ter'   
        WHERE id=$id";
     
        $sqlupd=mysqli_query($conn,$qupdate);

        if($sqlupd){
          echo "<script> alert ('Berhasil mengupdate Formulir SKP!'); window.location='data.php?aksi=detail&id=$id_data'; </script>" ;
      }else {
          echo "<script> alert ('Terjadi Kesalahan selama penyimpanan'); window.location='data.php?aksi=detail&id=$id_data'; </script>" ;
      }
    }
    // End Process updateFormulirSKP  
 } 
//  End Fungsi update FormulirSKP
 ?>


<?php 
// Fungsi addNilaiKinerja
function addNilaiKinerja($conn){  
    $id=$_GET['id'];
    echo $id. '<br>';
    echo "tambah nilai kinerja";
}
?>

<?php include '../footer.php'; ?> 