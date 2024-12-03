
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stronabaza");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Ustawianie ID klienta
$id_klienta = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $adres = $_POST['adres'];
    $miasto = $_POST['miasto'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("SELECT * FROM koszyk WHERE id_klient = ?");
        if (!$stmt) {
            throw new Exception("Błąd w przygotowaniu zapytania: " . $conn->error);
        }
        $stmt->bind_param("i", $id_klienta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Koszyk jest pusty dla klienta o ID: $id_klienta.");
        }

        while ($row = $result->fetch_assoc()) {
            $id_produkt = $row['id_produktu'] ?? null;
            $ilosc = $row['ilosc'] ?? 0;
            $status = 'Oczekujące';

            if (is_null($id_produkt) || $ilosc <= 0) {
                throw new Exception("Nieprawidłowy produkt w koszyku. ID produktu: $id_produkt, ilość: $ilosc");
            }

            $stmt_insert = $conn->prepare("INSERT INTO zamowienia (id_klient, id_produkt, ilosc, status, imie, nazwisko, adres, miasto, kod_pocztowy, email, telefon) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt_insert) {
                throw new Exception("Błąd w przygotowaniu zapytania: " . $conn->error);
            }
            $stmt_insert->bind_param("iiissssssss", $id_klienta, $id_produkt, $ilosc, $status, $imie, $nazwisko, $adres, $miasto, $kod_pocztowy, $email, $telefon);

            if (!$stmt_insert->execute()) {
                throw new Exception("Błąd podczas dodawania zamówienia: " . $stmt_insert->error);
            }
        }

        $conn->commit();

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'trnshop.kontakt@gmail.com';
            $mail->Password = 'vkzjtloiqnbqznds';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('trnshop.kontakt@gmail.com', 'TRN Shop');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Potwierdzenie zamówienia';
            $mail->Body = "
                <h3>Twoje zamówienie zostało złożone!</h3>
                <p>Dane dostawy:</p>
                <p>Imię i nazwisko: $imie $nazwisko</p>
                <p>Adres: $adres</p>
                <p>Miasto: $miasto</p>
                <p>Kod pocztowy: $kod_pocztowy</p>
                <p>Numer telefonu: $telefon</p>
            ";

            $mail->send();
            header("Location: potwierdzenie.php");
        } catch (Exception $e) {
            echo "Nie udało się wysłać potwierdzenia e-mail: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        $conn->rollback();
        die("Błąd transakcji: " . $e->getMessage());
    }
}
?>
