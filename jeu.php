<?PHP
session_start();
include('Personnage.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["creer"])) {
        $nom = $_POST["nom"];
        $metier = $_POST["metier"];

        $personnage = new Personnage($nom, $metier);
        $_SESSION['personnage'] = serialize($personnage);
    }

    if (isset($_POST["niveauSuivant"])) {
        $personnage = unserialize($_SESSION['personnage']);
        $personnage->niveauSuivant();
        $_SESSION['personnage'] = serialize($personnage);
    }

    if (isset($_POST["ajouterArme"])) {
        $personnage = unserialize($_SESSION['personnage']);
        $arme = new Arme("Épée en bois", 2, "Guerrier", 5);
        $personnage->ajouterEquipement($arme);
        $_SESSION['personnage'] = serialize($personnage);
    }
}

$personnage = isset($_SESSION['personnage']) ? unserialize($_SESSION['personnage']) : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Créer un personnage</title>
</head>

<body>
    <h1>Créer un personnage</h1>
    <form action="jeu.php" method="post">
        <label for="nom">Nom du personnage:</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="metier">Métier du personnage:</label>
        <input type="text" id="metier" name="metier" required><br>
        <input type="submit" name="creer" value="Créer le personnage">
    </form>

    <?php if ($personnage): ?>
        <h2>Détails du personnage</h2>
        <?php $personnage->affichage(); ?>

        <form action="jeu.php" method="post">
            <input type="submit" name="niveauSuivant" value="Augmenter Niveau">
            <input type="submit" name="ajouterArme" value="Ajouter une Arme">
        </form>
    <?php endif; ?>
</body>

</html>