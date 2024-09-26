<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja_Sklep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        form {
            margin: 15px auto;
            width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        form h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        button {
            width: 100%;
            height: 50px;
            margin-top: 10px;
        }
        .baner {
            text-align: center;
            margin: 30px;
            border-bottom: 1px solid lightgray;
            padding: 10px 0;
        }
        footer {
            background-color: #000;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        footer .social-icons {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        footer .social-icons i {
            font-size: 24px;
            margin: 5px 0;
            color: white;
        }

        footer .social-icons i:hover {
            color: #888;
        }
    </style>
</head>
<body>
    <div class="baner text-center">
        <a href="strona_główna.html">
            <img src="logo.jpg" alt="logo" height="200px" width="auto">
        </a>
    </div>
    
    <div class="container">
        <div class="logowanie d-flex justify-content-center align-items-center full-height">
            <form method="post">
                <h1>Rejestracja</h1>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Adres email</label>
                    <input type="email" class="form-control" id="email" placeholder="przykład@wp.pl" required>
                </div>

                <div class="mb-3">
                    <label for="email2" class="form-label">Powtórz adres email</label>
                    <input type="email" class="form-control" id="email2" placeholder="przykład@wp.pl" required>
                </div>

                <div class="mb-3">
                    <label for="haslo" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="haslo" required>
                </div>

                <div class="mb-3">
                    <label for="haslo2" class="form-label">Powtórz hasło</label>
                    <input type="password" class="form-control" id="haslo2" required>
                </div>

                <div class="mb-3">
                    <label for="imie" class="form-label">Podaj imię</label>
                    <input type="text" class="form-control" id="imie" required>
                </div>

                <div class="mb-3">
                    <label for="nazwisko" class="form-label">Podaj nazwisko</label>
                    <input type="text" class="form-control" id="nazwisko" required>
                </div>

                <div class="mb-3">
                    <label for="adres" class="form-label">Podaj adres</label>
                    <input type="text" class="form-control" id="adres" required>
                </div>

                <div class="mb-3">
                    <label for="kod_pocztowy" class="form-label">Podaj kod pocztowy</label>
                    <input type="text" class="form-control" id="kod_pocztowy" required>
                </div>

                <div class="mb-3">
                    <label for="miasto" class="form-label">Podaj miasto</label>
                    <input type="text" class="form-control" id="miasto" required>
                </div>

                <div class="mb-3">
                    <label for="telefon" class="form-label">Podaj numer telefonu</label>
                    <input type="tel" class="form-control" id="telefon" required>
                </div>

                <button type="submit" class="btn btn-outline-success w-100 mb-3">Utwórz konto</button>

                <h4 class="text-center mb-3">Masz już konto?</h4>
                
                <button type="button" id="do_logowania" class="btn btn-outline-primary w-100">Zaloguj się</button>
            </form>
        </div>
    </div>
    
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('do_logowania').onclick = function(){
            window.location.href = 'logowanie2.php';
        };
    </script>
</body>
</html>
