<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=$_POST["email"];
        $haslo=$_POST["haslo"];
        $imie=$_POST["imie"];
        $nazwisko=$_POST["nazwisko"];
        $adres=$_POST["adres"];
        $kod_pocztowy=$_POST["kod_pocztowy"];
        $miasto=$_POST["miasto"];
        $telefon=$_POST["telefon"];

        if (empty($email) || empty($haslo) || empty($imie) || empty($nazwisko) || empty($adres) || empty($kod_pocztowy) || empty($miasto) || empty($telefon)) {
            header("Location: rejestracja.php?message=Proszę%20wypełnić%20wszystkie%20pola");
            exit();
        }    

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: rejestracja.php?message=Nieprawidłowy%20adres%20email");
            exit();
        }

        if (!preg_match('/[a-z]/', $haslo) || !preg_match('/[A-Z]/', $haslo) || !preg_match('/[0-9]/', $haslo) || !preg_match('/[\W]/', $haslo)) {
            header("Location: rejestracja.php?message=Hasło%20musi%20zawierać%20przynajmniej%20jedną%20małą%20literę,%20dużą%20literę,%20cyfrę%20oraz%20znak%20specjalny");
            exit();
        }

        $hash_haslo=hash('sha256', $haslo);

        $conn=mysqli_connect("localhost","root","","stronabaza");
        if($conn->connect_error){
            die("Błąd połączenia z bazą danych: ".$conn->connect_error);
        }
        $stmt=$conn->prepare('INSERT INTO uzytkownicy (imie, nazwisko, email, haslo, adres, kod_pocztowy, miasto, telefon) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("ssssssss", $imie, $nazwisko, $email, $hash_haslo, $adres, $kod_pocztowy, $miasto, $telefon);
        if ($stmt->execute()) {
            header("Location: rejestracja.php?message=Rejestracja%20zakończona%20sukcesem");
        } else {
            header("Location: rejestracja.php?message=Błąd%20podczas%20rejestracji");
        }

        $stmt->close();
        $conn->close();
    }
?>