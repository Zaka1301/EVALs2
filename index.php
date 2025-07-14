<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <div class="card shadow" style="width: 400px;">
            <div class="card-body">
                <h2 class="text-primary text-center mb-3">Inscription</h2>
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
                        echo "<div class='alert alert-success'>Inscription réussie ! <a href='login.php'>Se connecter</a></div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erreur lors de l'inscription.</div>";
                    }
                    $conn->close();
                }
                ?>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_naissance" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genre</label>
                        <select name="genre" class="form-select form-select-lg">
                            <option value="M">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ville</label>
                        <input type="text" name="ville" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="mdp" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image profil</label>
                        <input type="text" name="image_profil" class="form-control form-control-lg">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">S'inscrire</button>
                </form>
                <div class="text-center">
                    <a href="login.php" class="btn btn-link">Déjà inscrit ? Se connecter</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>