<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stronabaza");
if ($conn->connect_error) {
    die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
}

$result = $conn->query('SELECT tresc FROM informacje WHERE id=2');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep - Regulamin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="styl_1.css" rel="stylesheet">
    <style>
        .container {
            font-size: 30px;
        }
    </style>
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
    <?php
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo htmlspecialchars($row['tresc']);
    } else {
        echo "Brak wyników do wyświetlenia.";
    }

    $result->free_result();

    $conn->close();
    ?>
</div>


<footer>
    <div>© 2024 Sklep</div>
    <div>
        <a href="o_nas.php">O nas</a>
        |
        <a href="regulamin.php">Regulamin</a></div>
    <p>Kontakt: <a href="mailto:trnshop.kontakt@gmail.com">trnshop.kontakt@gmail.com</a> | Telefon: 123-456-789</p>
    <div class="social-icons">
        <div><span>link_facebook</span> <i class="bi bi-facebook"></i></div>
        <div><span>link_instagram</span> <i class="bi bi-instagram"></i></div>
        <div><span>link_tiktok</span> <i class="bi bi-tiktok"></i></div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('do_logowania').onclick = function() {
        window.location.href = 'logowanie.php';
    };

    document.getElementById('do_rejestracji').onclick = function() {
        window.location.href = 'rejestracja.php';
    };
</script>
</body>
</html>
