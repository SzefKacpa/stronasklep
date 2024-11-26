<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "stronabaza");
    if ($conn->connect_error) {
        die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
    }

    $id=isset($_GET["id_produktu"])?(int)$_GET["id_produktu"]:0;

    $result = $conn->prepare('SELECT * FROM produkty WHERE id=?');
    $result->bind_param('i',$id);
    $result->execute();
    $q_result=$result->get_result();
    $produkt=$q_result->fetch_assoc();
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
            .container {
                width: 80%;
                margin: auto;
                background: #fff;
                padding: 20px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            header {
                text-align: center;
                margin-bottom: 20px;
            }

            .image-section {
                float: left;
                width: 40%;
                padding-right: 20px;
            }

            .image-section img {
                width: 100%;
                border-radius: 5px;
            }

            .product-info {
                float: left;
                width: 60%;
            }

            .product-info h2 {
                color: #e60000;
            }
        </style>
        <title><?php echo $_GET['nazwa_produktu']; ?></title>
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
                        <li class="nav-item">
                            <a class="menu_button nav-link btn btn-outline-primary" id="do_logowania" href="logowanie.php">Zaloguj się</a>
                        </li>
                        <li class="nav-item">
                            <a class="menu_button nav-link btn btn-outline-success" id="do_rejestracji" href="rejestracja.php">Zarejestruj się</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <header>
                <h1><?php echo htmlspecialchars($produkt['nazwa']); ?></h1>
            </header>

            <div class="main-content">
                <div class="image-section">
                    <img src="<?php echo htmlspecialchars($produkt['id']); ?>.jpg" alt="<?php echo htmlspecialchars($produkt['nazwa']); ?>">
                </div>

                <div class="product-info">
                    <h2>Cena: <?php echo number_format($produkt['cena'], 2); ?> zł</h2>
                    <button>Dodaj do koszyka</button>
                    <p><?php echo nl2br(htmlspecialchars($produkt['opis'])); ?></p>
                </div>
            </div>
        </div>
        <a href="index.php" class="btn btn-primary">Powrót do listy produktów</a>

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