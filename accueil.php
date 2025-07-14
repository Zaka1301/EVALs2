<?php
session_start();
if (!isset($_SESSION["id_membre"])) {
    header("Location: login.php");
    exit();
}

 $conn = new mysqli("localhost", "ETU004182", "12p8q4a7", "db_s2_ETU004182");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$filtre_categorie = isset($_GET['categorie']) ? (int) $_GET['categorie'] : 0;

$categories_result = $conn->query("SELECT * FROM categorie_objet");

$sql = "SELECT o.nom_objet, c.nom_categorie, o.date_ajout, 
       (
           SELECT e.date_retour
           FROM emprunt e
           WHERE e.id_objet = o.id_objet
             AND (e.date_retour IS NULL OR e.date_retour >= CURDATE())
           ORDER BY e.date_emprunt DESC
           LIMIT 1
       ) AS date_retour
FROM objet o
JOIN categorie_objet c ON o.id_categorie = c.id_categorie";

if ($filtre_categorie > 0) {
    $sql .= " WHERE o.id_categorie = $filtre_categorie";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link href="bootstrap-5.3.5-dist/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-primary mb-4">Liste des objets</h2>

                
                <form method="get" class="mb-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="categorie" class="col-form-label">Catégorie :</label>
                        </div>
                        <div class="col-auto">
                            <select name="categorie" id="categorie" class="form-select" onchange="this.form.submit()">
                                <option value="0">Toutes</option>
                                <?php while ($cat = $categories_result->fetch_assoc()): ?>
                                    <option value="<?= $cat['id_categorie'] ?>" <?= $filtre_categorie == $cat['id_categorie'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['nom_categorie']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </form>

                
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
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nom_objet']) ?></td>
                                    <td><?= htmlspecialchars($row['nom_categorie']) ?></td>
                                    <td><?= htmlspecialchars($row['date_ajout']) ?></td>
                                    <td><?= $row['date_retour'] ? htmlspecialchars($row['date_retour']) : '-' ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-muted">Aucun objet trouvé.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <a href="logout.php" class="btn btn-primary">Déconnexion</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
