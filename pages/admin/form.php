<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// File JSON tempat menyimpan data
$jsonFile = '../../data/fruits.json';

// Baca data dari file JSON jika ada
if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $fruits = json_decode($jsonData, true);
} else {
    $fruits = [];
}

// Proses penghapusan data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $index = $_POST['index'];
    if (isset($fruits[$index])) {
        unset($fruits[$index]);
        $fruits = array_values($fruits); // Reindex array
        file_put_contents($jsonFile, json_encode($fruits, JSON_PRETTY_PRINT));
        header("Location: form.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #ff9a9e, #fad0c4);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
        }
        .form-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="radio"] {
            margin-right: 5px;
        }
        .form-container .radio-group {
            margin-bottom: 15px;
        }
        .form-container button {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            transition: background 0.3s;
        }
        .form-container button:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
        }
        .form-container a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #ff7e5f;
            text-decoration: none;
            font-weight: bold;
        }
        .form-container a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            color: #333;
        }
        .delete-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .delete-button:hover {
            background-color: #ff1a1a;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Form Admin</h1>
        <form method="POST" action="process_fruit.php">
            <label for="fruit">Nama Buah:</label>
            <input type="text" id="fruit" name="fruit" placeholder="Masukkan nama buah" required>

            <label for="price">Harga per Kg:</label>
            <input type="number" id="price" name="price" placeholder="Masukkan harga per kg" required>

            <label for="stock">Banyaknya Stok:</label>
            <input type="number" id="stock" name="stock" placeholder="Masukkan jumlah stok" required>

            <label for="category">Kategori:</label>
            <select id="category" name="category" required>
                <option value="citrus">Citrus</option>
                <option value="berries">Berries</option>
                <option value="tropical">Tropical</option>
            </select>

            <div class="radio-group">
                <label>Ketersediaan:</label>
                <input type="radio" id="available" name="availability" value="available" required>
                <label for="available">Tersedia</label>
                <input type="radio" id="not-available" name="availability" value="not-available">
                <label for="not-available">Tidak Tersedia</label>
            </div>

            <button type="submit">Submit</button>
        </form>

        <!-- Tampilkan data dari file JSON -->
        <?php if (count($fruits) > 0): ?>
            <h2>Data Buah yang Telah Disimpan</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Buah</th>
                        <th>Harga per Kg</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Ketersediaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fruits as $index => $fruit): ?>
                        <tr>
                            <td><?= htmlspecialchars($fruit['name']); ?></td>
                            <td>Rp <?= number_format($fruit['price'], 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($fruit['stock']); ?> kg</td>
                            <td><?= htmlspecialchars($fruit['category']); ?></td>
                            <td><?= htmlspecialchars($fruit['availability'] == 'available' ? 'Tersedia' : 'Tidak Tersedia'); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="index" value="<?= $index; ?>">
                                    <button type="submit" name="delete" class="delete-button">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="../../includes/logout.php">Logout</a>
    </div>
</body>
</html>