<?php
include('functions.php');

$tasks = getTasks();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    deleteTask($deleteId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO List</title>
</head>

<body>
    <h1>TODO List</h1>

    <!-- Affichage des tâches -->
    <ul>
        <?php
        foreach ($tasks as $task) {
            echo "<li>{$task['titre']} - {$task['description']} - {$task['categorie']} - {$task['etat']} - Date d'échéance: {$task['date_echeance']}";
            echo " <a href=\"edit.php?id={$task['id']}\">Éditer</a>";
            echo " <a href=\"index.php?delete_id={$task['id']}\">Supprimer</a></li>";
        }
        ?>
    </ul>

    <!-- Bouton pour créer une nouvelle tâche -->
    <a href="create.php">Créer une nouvelle tâche</a>
</body>

</html>