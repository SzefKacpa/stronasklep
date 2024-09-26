<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Sklep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }

        .container {
            flex: 1; 
        }

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
            margin: 0;
            border-bottom: 1px solid lightgray;
            padding: 10px 0;
        }
        footer {
            background-color: #000;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
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

    <div class="container d-flex justify-content-center align-items-center">
        <div class="logowanie">
            <form method="post">
                <h1>Logowanie</h1>
                    
                <div class="mb-3">
                    <label for="email" class="form-label">Adres email</label>
                    <input type="email" class="form-control" id="email" placeholder="przykład@wp.pl" required>
                </div>

                <div class="mb-3">
                    <label for="haslo" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="haslo" required>
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
        document.getElementById('do_rejestracji').onclick = function(){
            window.location.href = 'rejestracja2.php';
        };
    </script>
</body>
</html>
