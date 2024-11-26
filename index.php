<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep - Strona Główna</title>
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
    <?php if (isset($_GET['message'])): ?><p align="center" style="font-size: 175%"><?php echo htmlspecialchars($_GET['message']);?></p><?php endif; ?>
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
