<?php
    session_start();
    if (!isset($_SESSION["id"]) || $_SESSION["id"] != "0") {
        header("Location: logowanie.php?message=Proszę się zalogować jako administrator.");
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "stronabaza");
    if ($conn->connect_error) {
        die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
    }

    // Fetching orders
    $zamowienia = [];
    $result = $conn->query("SELECT * FROM zamowienia");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $zamowienia[] = $row;
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styl_1.css">
        <title>Zarządzaj Zamówieniami</title>
    </head>
    <body>
        <h1>Zarządzaj Zamówieniami</h1>

        <h2>Lista Zamówień</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Klient ID</th>
                <th>Data Zamówienia</th>
                <th>Całkowita Kwota</th>
            </tr>
            <?php foreach ($zamowienia as $zamowienie): ?>
            <tr>
                <td><?php echo $zamowienie['id']; ?></td>
                <td><?php echo $zamowienie['klient_id']; ?></td>
                <td><?php echo $zamowienie['data_zamowienia']; ?></td>
                <td><?php echo $zamowienie['calkowita_kwota']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
