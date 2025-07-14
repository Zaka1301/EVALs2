<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <div class="card shadow" style="width: 370px;">
            <div class="card-body">
                <h2 class="text-primary text-center mb-3">Connexion</h2>
                <?php
                session_start();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST["email"];
                    $mdp = $_POST["mdp"];
                    $conn = new mysqli("localhost", "root", "", "object");
                    $sql = "SELECT * FROM membre WHERE email='$email'";
                    $result = $conn->query($sql);
                    if ($row = $result->fetch_assoc()) {
                        if (password_verify($mdp, $row["mdp"])) {
                            $_SESSION["id_membre"] = $row["id_membre"];
                            echo "<div class='alert alert-success'>Connexion réussie !</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Mot de passe incorrect.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Email inconnu.</div>";
                    }
                    $conn->close();
                }
                ?>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="mdp" class="form-control form-control-lg" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Se connecter</button>
                </form>
                <div class="text-center">
                    <a href="inscription.php" class="btn btn-link">Créer un compte</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>