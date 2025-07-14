<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $conn = new mysqli("localhost", "root", "", "object");
    /*if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/
    $sql = "SELECT * FROM membre WHERE email='$email'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        if (password_verify($mdp, $row["mdp"])) {
            $_SESSION["id_membre"] = $row["id_membre"];
            header("Location: accueil.php");
            exit();
        } else {
            header("Location: login.php?erreur=Mot de passe incorrect.");
            exit();
        }
    } else {
        header("Location: login.php?erreur=Email inconnu.");
        exit();
    }
    $conn->close();
} else {
    header("Location: login.php");
    exit();
}