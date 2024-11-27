<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $adres = $_POST["adres"];
    $kod_pocztowy = $_POST["kod_pocztowy"];
    $miasto = $_POST["miasto"];
    $telefon = $_POST["telefon"];

    if (empty($email) || empty($haslo) || empty($imie) || empty($nazwisko) || empty($adres) || empty($kod_pocztowy) || empty($miasto) || empty($telefon)) {
        $_SESSION['message'] = "Proszę wypełnić wszystkie pola";
        $_SESSION['form_data'] = [
            'email' => $email,
            'haslo' => $haslo,
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'adres' => $adres,
            'kod_pocztowy' => $kod_pocztowy,
            'miasto' => $miasto,
            'telefon' => $telefon,
        ];
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Nieprawidłowy adres email";
        } 
        elseif (!preg_match('/[a-z]/', $haslo) || !preg_match('/[A-Z]/', $haslo) || !preg_match('/[0-9]/', $haslo) || !preg_match('/[\W]/', $haslo)) {
            $_SESSION['message'] = "Hasło musi zawierać przynajmniej jedną małą literę, dużą literę, cyfrę oraz znak specjalny";
            $_SESSION['form_data'] = [
                'email' => $email,
                'imie' => $imie,
                'nazwisko' => $nazwisko,
                'adres' => $adres,
                'kod_pocztowy' => $kod_pocztowy,
                'miasto' => $miasto,
                'telefon' => $telefon,
            ];
        } else {
            $hash_haslo = hash('sha256', $haslo);

            $conn = mysqli_connect("localhost", "root", "", "stronabaza");
            if ($conn->connect_error) {
                die("Błąd połączenia z bazą danych: " . $conn->connect_error);
            }

            $stmt = $conn->prepare('INSERT INTO uzytkownicy (imie, nazwisko, email, haslo, adres, kod_pocztowy, miasto, telefon) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param("ssssssss", $imie, $nazwisko, $email, $hash_haslo, $adres, $kod_pocztowy, $miasto, $telefon);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Rejestracja zakończona sukcesem";
                $_SESSION['form_data'] = [ 
                    'email' => '',
                    'haslo' => '',
                    'imie' => '',
                    'nazwisko' => '',
                    'adres' => '',
                    'kod_pocztowy' => '',
                    'miasto' => '',
                    'telefon' => '',
                ];
            } else {
                $_SESSION['message'] = "Błąd podczas rejestracji";
            }

            $stmt->close();
            $conn->close();
        }
    }

    header("Location: rejestracja.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - TRNShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="styl_1.css">
    <style>
        .logo {
            height: 270px;
            width: auto;
        }
        .navbar {
            text-align: center;
        }
        .alert-container {
            margin: 20px auto; 
            max-width: 600px; 
            padding: 20px; 
            border: 1px solid #007bff;
            border-radius: 5px; 
            background-color: #f0f8ff; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }

        .alert {
            margin: 0; 
        }
    </style>
</head>
<body>
    <div class="baner">
        <a href="index.php">
            <img class="logo" src="logo.jpg" alt="Logo Sklepu">
        </a>
    </div>
    <div class="logowanie d-flex justify-content-center align-items-center full-height">
        <form action="rejestracja.php" method="post"> 
            <h1>Rejestracja</h1>

            <div class="mb-3">
                <label for="email" class="form-label">Adres email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="przykład@wp.pl" value="<?= htmlspecialchars($_SESSION['form_data']['email'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="haslo" class="form-label">Hasło</label>
                <input type="password" class="form-control" id="haslo" name="haslo" value="<?= htmlspecialchars($_SESSION['form_data']['haslo'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="imie" class="form-label">Podaj imię</label>
                <input type="text" class="form-control" id="imie" name="imie" value="<?= htmlspecialchars($_SESSION['form_data']['imie'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="nazwisko" class="form-label">Podaj nazwisko</label>
                <input type="text" class="form-control" id="nazwisko" name="nazwisko" value="<?= htmlspecialchars($_SESSION['form_data']['nazwisko'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="adres" class="form-label">Podaj adres</label>
                <input type="text" class="form-control" id="adres" name="adres" value="<?= htmlspecialchars($_SESSION['form_data']['adres'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="kod_pocztowy" class="form-label">Podaj kod pocztowy</label>
                <input type="text" class="form-control" id="kod_pocztowy" name="kod_pocztowy" value="<?= htmlspecialchars($_SESSION['form_data']['kod_pocztowy'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="miasto" class="form-label">Podaj miasto</label>
                <input type="text" class="form-control" id="miasto" name="miasto" value="<?= htmlspecialchars($_SESSION['form_data']['miasto'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="telefon" class="form-label">Podaj numer telefonu</label>
                <input type="tel" class="form-control" id="telefon" name="telefon" value="<?= htmlspecialchars($_SESSION['form_data']['telefon'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-outline-success w-100 mb-3">Utwórz konto</button>

            <h4 class="text-center mb-3">Masz już konto?</h4>

            <button type="button" id="do_logowania" class="btn btn-outline-primary w-100">Zaloguj się</button>
        </form>
    </div>
    <center>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert-container">
                <div class="alert alert-info">
                    <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
                    <?php unset($_SESSION['message']); ?>
                </div>
            </div>
        <?php endif; ?>
    </center>

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
    <script>
        document.getElementById('do_logowania').onclick = function(){
            window.location.href = 'logowanie.php';
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
