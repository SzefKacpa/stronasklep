<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$conn = new mysqli("localhost", "root", "", "stronabaza");
if ($conn->connect_error) {
    die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "Podaj poprawny adres e-mail.";
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM uzytkownicy WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Nie znaleziono użytkownika z tym adresem e-mail.";
        exit;
    }

    $token = bin2hex(random_bytes(32));

    $stmt = $conn->prepare("DELETE FROM reset_hasla WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO reset_hasla (email, token) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    $resetLink = "http://93.105.113.153/reset_hasla.php?token=$token";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'trnshop.kontakt@gmail.com';
        $mail->Password = 'vkzjtloiqnbqznds';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('trnshop.kontakt@gmail.com', 'TRN Shop');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Resetowanie hasła';
        $mail->Body    = "Kliknij w poniższy link, aby zresetować hasło: <a href='$resetLink'>$resetLink</a>";

        $mail->send();
        echo 'Wysłano wiadomość e-mail z linkiem do zmiany hasła.';
    } catch (Exception $e) {
        echo "Wystąpił błąd podczas wysyłania wiadomości e-mail: {$mail->ErrorInfo}";
    }
}
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
        <label for="email">Podaj swój adres e-mail:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Wyślij link do zmiany hasla</button>
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
