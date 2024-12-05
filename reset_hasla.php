<?php
$conn = new mysqli("127.0.0.1", "szefkacpaSQL", "x2J2_6iX$9_#T5", "szefkacpa3");
if ($conn->connect_error) {
    die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $haslo = $_POST['haslo'];

    if (!preg_match('/[a-z]/', $haslo) || !preg_match('/[A-Z]/', $haslo) || !preg_match('/[0-9]/', $haslo) || !preg_match('/[\W]/', $haslo)) {
        echo "Hasło musi zawierać przynajmniej jedną małą literę, dużą literę, cyfrę oraz znak specjalny.";
        exit();
    }

    $stmt = $conn->prepare("SELECT email FROM reset_hasla WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();

    if (!$record) {
        echo "Nieprawidłowy token.";
        exit;
    }

    $email = $record['email'];

    $hashedPassword = hash('sha256', $haslo);
    $stmt = $conn->prepare("UPDATE uzytkownicy SET haslo = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM reset_hasla WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();

    echo "Hasło zostało zmienione. <a href='logowanie.php'>Zaloguj</a>";
} elseif (isset($_GET['token'])) {
    $token = $_GET['token'];
    ?>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zmiana hasła</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="styl_1.css" rel="stylesheet">
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
                        <a class="menu_button nav-link btn btn-outline-primary" href="koszyk.php">
                            <i class="bi bi-cart"></i> Koszyk
                        </a>
                    </li>
                    <?php
                    if(!isset($_SESSION["id"])) {
                        echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='logowanie.php'>Zaloguj się</a> </li>";
                        echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='rejestracja.php'>Zarejestruj się</a> </li>";
                    } elseif ($_SESSION["id"] != 0) {
                        echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='panel_klienta.php'>Twoje konto</a> </li>";
                    } elseif ($_SESSION["id"] == 0) {
                        echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='admin.php'>Panel administratora</a> </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <form method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <label for="haslo">Nowe hasło:</label>
            <input type="password" name="haslo" id="haslo" required>
            <button type="submit">Zmień hasło</button>
        </form>
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

    <?php
} else {
    echo "Nieprawidłowy link.";
}
?>
