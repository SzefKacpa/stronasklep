<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rejestracja - TRNShop</title>
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
        <div class="logowanie d-flex justify-content-center align-items-center full-height">
            <form action="rejestracja-PHP.php" method="post">
                <h1>Rejestracja</h1>

                <div class="mb-3">
                    <label for="email" class="form-label">Adres email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="przykład@wp.pl">
                </div>

                <div class="mb-3">
                    <label for="haslo" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="haslo" name="haslo">
                </div>

                <div class="mb-3">
                    <label for="imie" class="form-label">Podaj imię</label>
                    <input type="text" class="form-control" id="imie" name="imie">
                </div>

                <div class="mb-3">
                    <label for="nazwisko" class="form-label">Podaj nazwisko</label>
                    <input type="text" class="form-control" id="nazwisko" name="nazwisko">
                </div>

                <div class="mb-3">
                    <label for="adres" class="form-label">Podaj adres</label>
                    <input type="text" class="form-control" id="adres" name="adres">
                </div>

                <div class="mb-3">
                    <label for="kod_pocztowy" class="form-label">Podaj kod pocztowy</label>
                    <input type="text" class="form-control" id="kod_pocztowy" name="kod_pocztowy">
                </div>

                <div class="mb-3">
                    <label for="miasto" class="form-label">Podaj miasto</label>
                    <input type="text" class="form-control" id="miasto" name="miasto">
                </div>

                <div class="mb-3">
                    <label for="telefon" class="form-label">Podaj numer telefonu</label>
                    <input type="tel" class="form-control" id="telefon" name="telefon">
                </div>

                <button type="submit" class="btn btn-outline-success w-100 mb-3">Utwórz konto</button>

                <h4 class="text-center mb-3">Masz już konto?</h4>

                <button type="button" id="do_logowania" class="btn btn-outline-primary w-100">Zaloguj się</button>
            </form>
        </div>
        <center><?php if (isset($_GET['message'])): ?>
            <p><?php echo htmlspecialchars($_GET['message']); ?></p>
            <?php endif; ?></center>
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
            document.getElementById('do_logowania').onclick = function(){
                window.location.href = 'logowanie.php';
            };
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>