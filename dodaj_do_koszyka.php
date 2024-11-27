<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stronabaza");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$id_klienta = isset($_SESSION['id']) ? $_SESSION['id'] : 1; 
$id_produktu = $_POST['id_produktu']; 

$sql = "SELECT id FROM koszyk WHERE id_klient = ? AND id_produktu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_klienta, $id_produktu);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql_update = "UPDATE koszyk SET ilosc = ilosc + 1 WHERE id_klient = ? AND id_produktu = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $id_klienta, $id_produktu);
    $stmt_update->execute();
} else {
    $sql_insert = "INSERT INTO koszyk (id_klient, id_produktu, ilosc) VALUES (?, ?, 1)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ii", $id_klienta, $id_produktu);
    $stmt_insert->execute();
}

header("Location: koszyk.php");
exit();
?>
