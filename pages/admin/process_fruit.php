<?php
session_start();

// Pastikan hanya admin yang dapat mengakses
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Ambil data dari form
$fruit = $_POST['fruit'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$category = $_POST['category'];
$availability = $_POST['availability'];

// Data baru yang akan disimpan
$newData = [
    'name' => $fruit,
    'price' => $price,
    'stock' => $stock,
    'category' => $category,
    'availability' => $availability
];

// File JSON tempat menyimpan data
$jsonFile = '../../data/fruits.json';

// Baca data dari file JSON jika ada
if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $fruits = json_decode($jsonData, true);
} else {
    $fruits = [];
}

// Tambahkan data baru ke array
$fruits[] = $newData;

// Simpan data kembali ke file JSON
file_put_contents($jsonFile, json_encode($fruits, JSON_PRETTY_PRINT));

// Redirect kembali ke halaman form dengan pesan sukses
echo "<script>
        alert('Data buah berhasil disimpan!');
        window.location.href = 'form.php';
      </script>";
exit();
?>