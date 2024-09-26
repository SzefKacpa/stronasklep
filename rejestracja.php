<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - TRNShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styl_1.css">
</head>
<body>
    <div class="baner">
        <img src="logo.jpg" alt="logo" height="200px" width="auto">
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
    <footer class="stopka row text-start mt-5">
        <div class="col-md-4">
            <h1>hello</h1>
        </div>

        <div class="col-md-4 text-center">
            <h1>word</h1>
        </div>

        <div class="media col-md-4 text-md-end">
            <div class="d-flex align-items-center justify-content-end">
                <p class="mb-0 me-2">Facebook_link</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                </svg>
            </div>
            <div class="d-flex align-items-center justify-content-end">
                <p class="mb-0 me-2">Instagram_link</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-instagram" viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                </svg>
            </div>
            <div class="d-flex align-items-center justify-content-end"> 
                <p class="mb-0 me-2">Tiktok_link</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-tiktok" viewBox="0 0 16 16">
                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                </svg>
            </div>
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