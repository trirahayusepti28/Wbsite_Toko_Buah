<?php
session_start();
if ($_SESSION['role'] != 'customer') {
    header("Location: ../login.php");
    exit();
}

// File JSON tempat menyimpan data pesanan
$jsonFile = '../../data/orders.json';

// Baca data dari file JSON jika ada
if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $orders = json_decode($jsonData, true);
} else {
    $orders = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
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
        .container {
            max-width: 900px;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .fruit-list {
            margin: 20px 0;
        }
        .fruit-list ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .fruit-list li {
            width: 180px;
            text-align: center;
            background: linear-gradient(to bottom, #ffecd2, #fcb69f);
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .fruit-list li:hover {
            transform: scale(1.05);
        }
        .fruit-list img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .order-form {
            margin-top: 30px;
        }
        .order-form h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .order-form label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .order-form input,
        .order-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .order-form button {
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
        .order-form button:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
        .logout a {
            color: #ff7e5f;
            text-decoration: none;
            font-weight: bold;
        }
        .logout a:hover {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Customer!</h1>
        <div class="fruit-list">
            <h2>Daftar Buah</h2>
            <ul>
                <li>
                    <img src="https://asset.kompas.com/crops/smfd25xgXRE3HpMLb2aamPeulYM=/21x0:1476x970/1200x800/data/photo/2022/08/30/630d7ae5d041f.jpg" alt="Apel">
                    <p>Apel</p>
                    <p>Rp 20.000/kg</p>
                </li>
                <li>
                    <img src="https://desasemoyo.gunungkidulkab.go.id/assets/files/artikel/sedang_1524189176index.jpg" alt="Pisang">
                    <p>Pisang</p>
                    <p>Rp 15.000/kg</p>
                </li>
                <li>
                    <img src="https://mmc.tirto.id/image/2016/08/16/TIRTO-shutterstock_115590688_ratio-16x9.JPG" alt="Jeruk">
                    <p>Jeruk</p>
                    <p>Rp 25.000/kg</p>
                </li>
                <li>
                    <img src="https://asset.kompas.com/crops/MRDIdd5SGfHLkYefSQ-yenftgEk=/102x66:898x598/1200x800/data/photo/2022/08/15/62f9fd394d072.jpg" alt="Anggur">
                    <p>Anggur</p>
                    <p>Rp 50.000/kg</p>
                </li>
            </ul>
        </div>
        <div class="order-form">
            <h2>Pesan Sekarang</h2>
            <form method="POST" action="process_order.php">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>

                <label for="phone">No Telepon:</label>
                <input type="text" id="phone" name="phone" required>

                <label for="fruit">Jenis Buah:</label>
                <select id="fruit" name="fruit" required>
                    <option value="Apel">Apel</option>
                    <option value="Pisang">Pisang</option>
                    <option value="Jeruk">Jeruk</option>
                    <option value="Anggur">Anggur</option>
                </select>

                <label for="quantity">Jumlah (kg):</label>
                <input type="number" id="quantity" name="quantity" min="1" required>

                <label for="delivery_date">Tanggal Pengiriman:</label>
                <input type="date" id="delivery_date" name="delivery_date" required>

                <label for="payment_method">Metode Pembayaran:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">COD (Bayar di Tempat)</option>
                </select>

                <button type="submit">Pesan Sekarang</button>
            </form>
        </div>

        <?php if (count($orders) > 0): ?>
            <div class="order-history">
                <h2>Riwayat Pesanan</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Jenis Buah</th>
                            <th>Jumlah (kg)</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order['name']); ?></td>
                                <td><?= htmlspecialchars($order['phone']); ?></td>
                                <td><?= htmlspecialchars($order['fruit']); ?></td>
                                <td><?= htmlspecialchars($order['quantity']); ?> kg</td>
                                <td><?= htmlspecialchars($order['delivery_date']); ?></td>
                                <td><?= htmlspecialchars($order['payment_method']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Tidak ada pesanan yang ditemukan.</p>
        <?php endif; ?>

        <div class="logout">
            <a href="../../includes/logout.php">Logout</a>
        </div>
    </div>
</body>
</html>