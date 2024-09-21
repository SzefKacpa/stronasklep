<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $imie=$_POST["imie"];
        $nazwisko=$_POST["nazwisko"];
        $email=$_POST["email"];
        $haslo=$_POST["haslo"];
        $adres=$_POST["adres"];
        $kod_pocztowy=$_POST["kod_pocztowy"];
        $miasto=$_POST["miasto"];
        $telefon=$_POST["telefon"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("Niepoprawny adres email");
        }

        if(!preg_match('/[a-z]/', $haslo)||!preg_match('/[A-Z]/', $haslo)||!preg_match('/[0-9]/', $haslo)||!preg_match('/[\W]/', $haslo)){
            die("Hasło musi zaiwerać przynajmniej jedna małą literę, jedną dużą literę, cyfrę i znak specjalny");
        }

        $hash_haslo=hash('sha256', $haslo);

        $conn=mysqli_connect("localhost","root","","stronasklep");
        if($conn->connect_error){
            die("Błąd połączenia z bazą danych: ".$conn->connect_error);
        }
        $stmt=$conn->prepare('INSERT INTO uzytkownicy (imie, nazwisko, emai, haslo, adres, kod_pocztowy, miasto, telefon) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("sssssss", $imie, $nazwisko, $email, $hash_haslo, $adres, $kod_pocztowy, $miasto, $telefon);
        if ($stmt->execute()) {
            echo "Rejestracja zakończona sukcesem.";
        } else {
            echo "Błąd: ".$stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>