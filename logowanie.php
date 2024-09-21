<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $haslo = $_POST["haslo"];
        $hash_haslo=hash('sha256', $haslo);

        $conn=new mysqli("localhost","root","","stronasklep");
        if($conn->connect_error){
            die("Błąd podczas łączenia z bazą danych: ".$conn->connect_error);
        }

        $stmt=$conn->prepare("SELECT * FROM uzytkownicy WHERE `email`=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows>0){
            $stmt->bind_result($id, $imie, $nazwisko, $haslo);
            $stmt->fetch();
            if($hash_haslo===$haslo){
                $_SESSION["id"]=$id;
                $_SESSION["imie"]=$imie;
                $_SESSION["nazwisko"]=$nazwisko;
                echo "Logowanie udane. Witaj ".$imie."!";
            }else{
                echo "Nieprawidłowe hasło.";
            }
        }else{
            echo "Nie znaleziono użytkownika o podanym adresie e-mail.";
        }
        $stmt->close();
        $conn->close();
    }
?>