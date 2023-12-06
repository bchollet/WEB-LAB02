<?php
include('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_message = createOrUpdateTask(false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1>Créer une nouvelle tâche</h1>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <!-- Formulaire de création de tâche -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="titre">Titre*:</label>
        <input type="text" name="titre" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description"></textarea>
        <br>
        <label for="categorie">Catégorie*:</label>
        <select name="categorie" required>
            <option value="NONE">Aucune</option>
            <option value="TODO">Tâche</option>
            <option value="SHOPPING">Shopping</option>
            <option value="WORK">Travail</option>
            <option value="FAMILY">Famille</option>
        </select>
        <br>
        <label for="date_echeance">Date d'échéance:</label>
        <input type="date" name="date_echeance">
        <br>
        <label for="etat">État*:</label>
        <select name="etat" required>
            <option value="TODO">À faire</option>
            <option value="DONE">Terminé</option>
        </select>
        <br>
        <input type="submit" value="Sauver">
    </form>

</body>

</html>