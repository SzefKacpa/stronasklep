<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email=$_POST["email"];
        $haslo=$_POST["haslo"];
        $hash_haslo=hash('sha256', $haslo);

        $conn=new mysqli("localhost","root","","stronabaza");
        if($conn->connect_error){
            die("Błąd podczas łączenia z bazą danych: ".$conn->connect_error);
        }

        $stmt=$conn->prepare("SELECT id, haslo FROM uzytkownicy WHERE `email`=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows>0) {
            $stmt->bind_result($id, $haslo_baza);
            $stmt->fetch();
            if ($hash_haslo===$haslo_baza) {
                $_SESSION["id"] = $id;
                header("Location: logowanie.php?message=Zalogowano%20pomyślnie.");
            }elseif($email=="admin"&&$haslo=="admin"){
                $_SESSION["id"] = $id;
                header("Location: admin.php");
            }else{
                header("Location: logowanie.php>message=Nieprawidłowe%20hasło.");
            }
        }else{
            header("Location: logowanie.php?message=Nie%20znaleziono%20użytkownika.");
        }
        $stmt->close();
        $conn->close();
    }
?>