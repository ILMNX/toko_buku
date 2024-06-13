<?php
session_start();

// Pastikan admin sudah login
// Misalnya, admin memiliki session "role" yang bernilai "admin"
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("location:login_admin.php");
    exit();
}

// Include file konfigurasi database
include("../config.php");

// Ambil id_pembayaran dari parameter GET
if (isset($_GET['id'])) {
    $id_pembayaran = $_GET['id'];

    // Update status pembayaran menjadi "dikonfirmasi"
    $sql = "UPDATE pembayaran SET status = 'dikonfirmasi' WHERE id_pembayaran = '$id_pembayaran'";
    $query = mysqli_query($connect, $sql);

    if ($query) {
        // Ambil id_customer terkait pembayaran ini
        $sql_customer = "SELECT id_customer FROM pembayaran WHERE id_pembayaran = '$id_pembayaran'";
        $query_customer = mysqli_query($connect, $sql_customer);
        $data_customer = mysqli_fetch_assoc($query_customer);

        // Redirect ke proses_cart.php dengan menyertakan id_customer untuk update status pembayaran customer
        header("location:../process_cart.php?id_customer=" . $data_customer['id_customer']);
        exit();
    } else {
        echo "Gagal melakukan konfirmasi pembayaran.";
    }
} else {
    echo "ID Pembayaran tidak ditemukan.";
}
?>
