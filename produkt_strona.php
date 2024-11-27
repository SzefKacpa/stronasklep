<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "stronabaza");
    if ($conn->connect_error) {
        die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
    }

    $id = isset($_GET["id_produktu"]) ? (int)$_GET["id_produktu"] : 0;

    $result = $conn->prepare('SELECT * FROM produkty WHERE id = ?');
    $result->bind_param('i', $id);
    $result->execute();
    $q_result = $result->get_result();

    if ($q_result->num_rows > 0) {
        $produkt = $q_result->fetch_assoc();
    } else {
        header("Location: index.php?message=Produkt%20nie%20znaleziony");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="styl_1.css" rel="stylesheet">
        <style>
            body {
                background-color: #222; 
                color: #f5f5f5; 
                font-family: Arial, sans-serif;
            }

            .container {
                width: 80%;
                margin: auto;
                background: #333; 
                padding: 20px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
                border-radius: 8px; 
            }

            .image-section {
                float: left;
                width: 40%;
                padding-right: 20px;
            }

            .image-section img {
                width: 100%;
                border-radius: 5px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            }

            .product-info {
                float: left;
                width: 60%;
                color: #f5f5f5; 
            }

            .product-info h2 {
                color: #28a745; 
                font-size: 24px;
            }

            .product-info p {
                padding: 15px;
                border: 1px solid #444; 
                border-radius: 5px; 
                background-color: #444; /
                color: #f5f5f5; 
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
                margin: 20px;
            }

            .btn-success {
                background-color: #28a745;
                border-color: #28a745;
                color: white; 
            }

            .btn-success:hover {
                background-color: #218838;
                border-color: #1e7e34;
            }

            .product-title {
                font-size: 18px;
                font-weight: bold;
            }

            .product-price {
                font-size: 16px;
                color: #28a745; 
            }

            footer a {
                color: #f5f5f5;
                text-decoration: none;
                margin: 0 10px;
            }

            footer a:hover {
                color: #8b8b8b; 
            }

            footer {
                text-align: center;
                padding: 10px;
                background-color: #222; 
                margin-top: 30px;
                border-top: 1px solid #444;
            }

            .social-icons i {
                font-size: 24px;
                color: #ccc; 
                margin: 0 10px;
            }

            .social-icons i:hover {
                color: #8b8b8b; 
            }

            .navbar {
                background-color: #222; 
                border-bottom: 1px solid #444; 
                margin-bottom: 20px;
            }

            .navbar-brand img {
                max-height: 80px; 
            }

            .navbar-nav .nav-item .nav-link {
                color: #f5f5f5; 
                font-weight: bold;
                padding: 10px 15px;
            }

            .navbar-nav .nav-item .nav-link:hover {
                color: #8b8b8b; 
                background-color: #444; 
                border-radius: 5px; 
            }

            .navbar-toggler {
                border-color: #444; 
            }

            .navbar-toggler-icon {
                background-color: #f5f5f5; 
            }

            .menu_button {
                font-size: 16px;
            }

            .navbar-light .navbar-nav .nav-link {
                color: #f5f5f5;
            }

            .navbar-light .navbar-nav .nav-link:hover {
                color: #8b8b8b; 
            }

            .image-section h1 {
                text-align: center;
                font-size: 2em;
                color: #f5f5f5; 
                margin-bottom: 15px;
            }
        </style>
        <title><?php echo htmlspecialchars($produkt['nazwa']); ?></title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="logo.jpg" alt="Logo Sklepu">
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="menu_button nav-link btn btn-outline-light" href="index.php">Strona Główna</a>
                        </li>
                        <?php
                            if(!isset($_SESSION["id"])) {
                                echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' id='do_logowania' href='logowanie.php'>Zaloguj się</a> </li>";
                                echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' id='do_rejestracji' href='rejestracja.php'>Zarejestruj się</a> </li>";
                            }elseif($_SESSION["id"]!=0){
                                echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' id='do_panelu_klienta' href='panel_klienta.php'>Twoje konto</a> </li>";
                            }elseif($_SESSION["id"]=0){
                                echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' id='do_panelu_administratora' href='admin.php'>Panel administratora</a> </li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="main-content">
                <div class="image-section">
                    <h1><?php echo htmlspecialchars($produkt['nazwa']); ?></h1> 
                    <img src="zdjecia_prod/<?php echo htmlspecialchars($produkt['id']);?>.jpg" alt="<?php echo htmlspecialchars($produkt['nazwa']); ?>">
                </div>

                <div class="product-info">
                    <h2>Cena: <?php echo number_format($produkt['cena'], 2); ?> zł</h2>
                    <form method="POST" action="dodaj_do_koszyka.php">
                        <input type="hidden" name="id_produktu" value="<?php echo $produkt['id']; ?>">
                        <button type="submit" class="btn btn-primary">Dodaj do koszyka</button>
                    </form>
                    <p><?php echo nl2br(htmlspecialchars($produkt['opis'])); ?></p>
                    
                    <a href="index.php" class="btn btn-primary">Powrót do listy produktów</a>
                </div>
            </div>
        </div>


        <footer>
            <div>© 2024 Sklep</div>
            <div>
                <a href="o_nas.php">O nas</a>
                |
                <a href="regulamin.php">Regulamin</a></div>
            <p>Kontakt: <a href="mailto:kontakt@sklep.pl">kontakt@sklep.pl</a> | Telefon: 123-456-789</p>
            <div class="social-icons">
                <div><span>link_facebook</span> <i class="bi bi-facebook"></i></div>
                <div><span>link_instagram</span> <i class="bi bi-instagram"></i></div>
                <div><span>link_tiktok</span> <i class="bi bi-tiktok"></i></div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
