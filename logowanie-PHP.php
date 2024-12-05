<?php
    session_start();
    ob_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $haslo = $_POST["haslo"];
        $hash_haslo = hash('sha256', $haslo);

        if($email=="admin@admin.admin" && $haslo=="admin"){
            $_SESSION["id"] = 0;
            header("Location: admin.php");
            exit();
        }

        $conn=new mysqli("127.0.0.1", "szefkacpaSQL", "x2J2_6iX$9_#T5", "szefkacpa3");
        if($conn->connect_error){
            die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
        }

        $stmt=$conn->prepare("SELECT id, haslo FROM uzytkownicy WHERE `email`=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            $stmt->bind_result($id, $haslo_baza);
            $stmt->fetch();
            if($hash_haslo===$haslo_baza){
                $_SESSION["id"] = $id;
                $_SESSION["message"] = "Zalogowano pomyślnie.";
                header("Location: index.php?message=Witaj!");
                exit();
            }else{
                header("Location: logowanie.php?message=Nieprawidłowe%20hasło.");
                exit();
            }
        }else{
            header("Location: logowanie.php?message=Nie%20znaleziono%20użytkownika.");
            exit();
        }

        $stmt->close();
        $conn->close();
    }

    ob_end_flush();
?>
