<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>index</title>
    <link href="bootstrap-5.3.5-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <div class="card shadow" style="width: 370px;">
            <div class="card-body">
                <h2 class="text-primary text-center mb-3">Connexion</h2>
                <?php
                if (isset($_GET['erreur'])) {
                    echo "<div class='alert alert-danger'>".$_GET['erreur']."</div>";
                }
                ?>
                <form method="post" action="traitement_login.php">
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
                    <a href="index.php" class="btn btn-link">Créer un compte</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>