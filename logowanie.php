<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logowanie - TRNShop</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="styl_1.css">
        <style>
            .logo{
                height: 270px;
                width: auto;
            }
            .navbar{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="baner">
            <a href="index.php">
                <img class="logo" src="logo.jpg" alt="Logo Sklepu">
            </a>
        </div>

            <div class="logowanie d-flex justify-content-center align-items-center full-height content">
                <form action="logowanie-PHP.php" method="post">
                    <h1>Logowanie</h1>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adres email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="przykład@wp.pl" required>
                    </div>

                    <div class="mb-3">
                        <label for="haslo" class="form-label">Hasło</label>
                        <input type="password" class="form-control" id="haslo" name="haslo" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox">
                        <label class="form-check-label" for="checkbox">Zapamiętaj mnie</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">Zaloguj się</button>

                    <h4 class="text-center mb-3">Nie masz jeszcze konta?</h4>

                    <button type="button" class="btn btn-outline-success w-100" id="do_rejestracji">Zarejestruj się</button>
                </form>
            </div>
            <center><?php if (isset($_GET['message'])): ?>
                <p><?php echo htmlspecialchars($_GET['message']);?>
                    </p><?php endif; ?></center>
            <footer>
                <div>© 2024 Sklep</div>
                <div>
                    <a href="polityka_prywatnosci.html">Polityka prywatności</a>
                    |
                    <a href="regulamin.html">Regulamin</a></div>
                <p>Kontakt: <a href="mailto:kontakt@sklep.pl">kontakt@sklep.pl</a> | Telefon: 123-456-789</p>
                <div class="social-icons">
                    <div><span>link_facebook</span> <i class="bi bi-facebook"></i></div>
                    <div><span>link_instagram</span> <i class="bi bi-instagram"></i></div>
                    <div><span>link_tiktok</span> <i class="bi bi-tiktok"></i></div>
                </div>
            </footer>
        <script>
            document.getElementById('do_rejestracji').onclick = function(){
                window.location.href = 'rejestracja.php';
            };
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
