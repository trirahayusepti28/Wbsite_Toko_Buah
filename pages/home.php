<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Toko Buah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #ff9a9e, #fad0c4);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .hero {
            background: linear-gradient(to bottom, #ffffff, #ffe6e6);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            gap: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 1200px;
            width: 90%;
        }
        .hero img {
            max-width: 50%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .hero-content {
            max-width: 50%;
            text-align: left;
        }
        .hero-content h1 {
            font-size: 2.5rem;
            color: #ff6600;
            margin: 20px 0 10px;
        }
        .hero-content p {
            font-size: 1.2rem;
            color: #333;
            margin: 10px 0;
        }
        .hero-content .cta {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            display: inline-block;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .hero-content .cta:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="hero">
        <img src="https://png.pngtree.com/thumb_back/fh260/background/20230411/pngtree-fruit-on-the-counter-of-the-store-food-photo-image_2376463.jpg" alt="Pusat Buah Segar">
        <div class="hero-content">
            <h1>SELAMAT DATANG DI PUSAT BUAH</h1>
            <p>Buah-buahan sangat bermanfaat untuk kesehatan karena kaya akan vitamin, mineral, serat, dan antioksidan. 
                Konsumsi buah secara rutin dapat membantu mencegah penyakit, menjaga berat badan, meningkatkan sistem kekebalan tubuh, dan meningkatkan kesehatan pencernaan. 
            <p>Kami menyediakan berbagai macam buah berkualitas yang segar dengan harga terjangkau.</p>
            <p><strong>Harga Mulai Rp. 15.000</strong></p>
            <a href="../pages/login.php" class="cta">Login</a>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>