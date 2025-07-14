<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $date_naissance = $_POST["date_naissance"];
    $genre = $_POST["genre"];
    $email = $_POST["email"];
    $ville = $_POST["ville"];
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    $image_profil = $_POST["image_profil"];

    $conn = new mysqli("localhost", "root", "", "object");
    $sql = "INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil)
            VALUES ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp', '$image_profil')";
    if ($conn->query($sql)) {
        header("Location: index.php?success=Inscription réussie ! Vous pouvez vous connecter.");
        exit();
    } else {
        header("Location: index.php?erreur=Erreur lors de l'inscription.");
        exit();
    }
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}