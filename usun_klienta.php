<?php
    session_start();
    if (!isset($_SESSION["id"]) || $_SESSION["id"] != "0") {
        header("Location: logowanie.php?message=Proszę się zalogować jako administrator.");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        $conn = new mysqli("localhost", "root", "", "stronabaza");
        if ($conn->connect_error) {
            die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM uzytkownicy WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: klienci.php?message=Klient%20usunięty%20pomyślnie.");
        } else {
            header("Location: klienci.php?message=Nie%20udało%20się%20usunąć%20klienta.");
        }

        $stmt->close();
        $conn->close();
    }
?>
