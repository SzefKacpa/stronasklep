<?php
    session_start();
?>
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
<form method="GET" action="index.php" class="mb-4">
        <div class="d-flex justify-content-between">
            <input type="text" name="search" id="searchInput" class="form-control w-75" placeholder="Wpisz nazwę produktu...">
            <select name="sort" id="sortSelect" class="form-control w-25">
                <option value="name_asc">Sortuj po nazwie (A-Z)</option>
                <option value="name_desc">Sortuj po nazwie (Z-A)</option>
                <option value="price_asc">Sortuj po cenie (rosnąco)</option>
                <option value="price_desc">Sortuj po cenie (malejąco)</option>
            </select>
            <button type="submit" class="btn btn-primary ml-3">Filtruj i sortuj</button>
        </div>
    </form>
<div class="container mt-5">
    <div class="row">
    <?php
        $conn = new mysqli("localhost", "root", "", "stronabaza");

        if ($conn->connect_error) {
            die("Błąd połączenia z bazą danych: " . $conn->connect_error);
        }

        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';  

        $where = "";
        if ($search !== '') {
            $search = $conn->real_escape_string($search);
            $where = "WHERE nazwa LIKE '%$search%'";
        }
        switch ($sort) {
            case 'name_asc':
                $order = "ORDER BY nazwa ASC";
                break;
            case 'name_desc':
                $order = "ORDER BY nazwa DESC";
                break;
            case 'price_asc':
                $order = "ORDER BY cena ASC";
                break;
            case 'price_desc':
                $order = "ORDER BY cena DESC";
                break;
            default:
                $order = "ORDER BY nazwa ASC";  
        }

        $sql = "SELECT id, nazwa, cena FROM produkty $where $order";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $nazwa = htmlspecialchars($row['nazwa']);
                $cena = number_format($row['cena'], 2, ',', ' ');
                echo '
                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <a href="produkt_strona.php?id_produktu=' . $id . '" class="product-icon">
                            <i class="bi bi-search"></i>
                        </a>
                        <img src="zdjecia_prod/'.$id.'.jpg" alt="Obrazek produktu" class="product-image">
                        <div class="product-info">
                            <div class="product-title">' . $nazwa . '</div>
                            <div class="product-price">' . $cena . ' PLN</div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">Brak produktów spełniających kryteria wyszukiwania.</p>';
        }

        $conn->close();
    ?>
    </div>
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
