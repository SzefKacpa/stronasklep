<?php
session_start();
$conn = new mysqli("127.0.0.1", "szefkacpaSQL", "x2J2_6iX$9_#T5", "szefkacpa3");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$id_klienta = isset($_SESSION['id']) ? $_SESSION['id'] : 1; 

echo "ID klienta: " . $id_klienta . "<br>";

if (isset($_GET['usun'])) {
    $id_zamowienia_do_usuniecia = $_GET['usun'];

    echo "ID zamówienia do usunięcia: " . $id_zamowienia_do_usuniecia . "<br>";

    if (is_numeric($id_zamowienia_do_usuniecia) && $id_klienta > 0) {
        $delete_sql = "DELETE FROM koszyk WHERE id = ? AND id_klient = ?";
        $delete_stmt = $conn->prepare($delete_sql);

        if (!$delete_stmt) {
            die("Błąd przygotowania zapytania: " . $conn->error);
        }

        $delete_stmt->bind_param("ii", $id_zamowienia_do_usuniecia, $id_klienta);

        if ($delete_stmt->execute()) {
            echo "Usunięto zamówienie o ID: " . $id_zamowienia_do_usuniecia . "<br>";
            header("Location: koszyk.php");
            exit;
        } else {
            echo "Błąd usuwania zamówienia: " . $delete_stmt->error . "<br>";
        }
    } else {
        echo "Nieprawidłowe ID zamówienia lub klienta.<br>";
    }
} else {
    echo "Brak ID zamówienia do usunięcia.<br>";
}
?>
