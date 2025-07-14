<?php
session_start();
if (!isset($_SESSION["id_membre"])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "object");
    /*if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

$sql = "SELECT o.nom_objet, c.nom_categorie, o.date_ajout, e.date_retour
        FROM objet o
        JOIN categorie_objet c ON o.id_categorie = c.id_categorie
        LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour >= CURDATE()";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>index</title>
    <link href="bootstrap-5.3.5-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-primary mb-4">Liste des objets</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Date d'ajout</th>
                            <th>Date de retour (si emprunt)</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nom_objet']) ?></td>
                                <td><?= htmlspecialchars($row['nom_categorie']) ?></td>
                                <td><?= htmlspecialchars($row['date_ajout']) ?></td>
                                <td>
                                    <?= $row['date_retour'] ? htmlspecialchars($row['date_retour']) : '-' ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                </table>
                <a href="logout.php" class="btn btn-danger">Déconnexion</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>