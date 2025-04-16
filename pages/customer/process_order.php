<?php
session_start();

// Pastikan hanya customer yang dapat mengakses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
    header("Location: ../login.php");
    exit();
}

// Ambil data dari form
$name = $_POST['name'];
$phone = $_POST['phone'];
$fruit = $_POST['fruit'];
$quantity = $_POST['quantity'];
$delivery_date = $_POST['delivery_date'];
$payment_method = $_POST['payment_method'];

// Data baru yang akan disimpan
$newOrder = [
    'name' => $name,
    'phone' => $phone,
    'fruit' => $fruit,
    'quantity' => $quantity,
    'delivery_date' => $delivery_date,
    'payment_method' => $payment_method
];

// File JSON tempat menyimpan data pesanan
$jsonFile = '../../data/orders.json';

// Baca data dari file JSON jika ada
if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $orders = json_decode($jsonData, true);
} else {
    $orders = [];
}

// Tambahkan data baru ke array
$orders[] = $newOrder;

// Simpan data kembali ke file JSON
file_put_contents($jsonFile, json_encode($orders, JSON_PRETTY_PRINT));

// Redirect kembali ke dashboard dengan pesan sukses
echo "<script>
        alert('Pesanan berhasil disimpan!');
        window.location.href = 'dashboard.php';
      </script>";
exit();
?>