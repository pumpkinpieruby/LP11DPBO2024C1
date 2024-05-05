<?php
include_once("model/Template.class.php");
include_once("model/DB.class.php");
include_once("model/Pasien.class.php");
include_once("model/TabelPasien.class.php");
include_once("view/createView.php");

$tp = new createView();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $tp->add($_POST);
    } else if (isset($_POST['update'])) {
        $tp->update($_POST);
    }
}

// Tampilkan form tambah jika tidak ada data yang dikirimkan
$data = $tp->tampil();
echo $data; // Output HTML form
?>
