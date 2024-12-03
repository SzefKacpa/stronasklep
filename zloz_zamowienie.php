<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stronabaza");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$id_klienta = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

$sql = "SELECT id, id_produktu, ilosc FROM koszyk WHERE id_klient = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_klienta);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $zamowieniaDodane = true;

    while ($row = $result->fetch_assoc()) {
        $id_produktu = $row['id_produktu'];
        $ilosc = $row['ilosc'];
        $status = "W realizacji";

        $insert_sql = "INSERT INTO zamowienia (id_klient, id_produkt, ilosc, status) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);

        if ($insert_stmt) {
            $insert_stmt->bind_param("iiis", $id_klienta, $id_produktu, $ilosc, $status);
            if (!$insert_stmt->execute()) {
                $zamowieniaDodane = false;
                echo "Błąd dodawania zamówienia: " . $insert_stmt->error . "<br>";
            }
        } else {
            die("Błąd przygotowania zapytania: " . $conn->error);
        }
    }
    if ($zamowieniaDodane) {
        $delete_sql = "DELETE FROM koszyk WHERE id_klient = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id_klienta);
        $delete_stmt->execute();
        header("Location: potwierdzenie.php");
        exit;
    } else {
        echo "Wystąpił problem z dodaniem zamówień.<br>";
    }
} else {
    echo "Koszyk jest pusty. Nie można złożyć zamówienia.<br>";
}
?>
