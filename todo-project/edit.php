<?php
include('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $task = getTaskById($taskId);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_message = createOrUpdateTask(true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer une tâche</title>
</head>

<body>
    <h1>Éditer une tâche</h1>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <!-- Formulaire de création ou d'édition de tâche -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="task_id" value="<?php echo $taskId; ?>">
        <label for="titre">Titre*:</label>
        <input type="text" name="titre" value="<?php echo $task['titre']; ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description"><?php echo $task['description']; ?></textarea>
        <br>
        <label for="categorie">Catégorie*:</label>
        <select name="categorie" required>
            <option value="NONE" <?php if ($task['categorie'] == 'NONE') echo 'selected'; ?>>Aucune</option>
            <option value="TODO" <?php if ($task['categorie'] == 'TODO') echo 'selected'; ?>>TODO</option>
            <option value="SHOPPING" <?php if ($task['categorie'] == 'SHOPPING') echo 'selected'; ?>>Shopping</option>
            <option value="WORK" <?php if ($task['categorie'] == 'WORK') echo 'selected'; ?>>Travail</option>
            <option value="FAMILY" <?php if ($task['categorie'] == 'FAMILY') echo 'selected'; ?>>Famille</option>
        </select>
        <br>
        <label for="date_echeance">Date d'échéance:</label>
        <input type="date" name="date_echeance" value="<?php echo $task['date_echeance']; ?>">
        <br>
        <label for="etat">État*:</label>
        <select name="etat" required>
            <option value="TODO" <?php if ($task['etat'] == 'TODO') echo 'selected'; ?>>À faire</option>
            <option value="DONE" <?php if ($task['etat'] == 'DONE') echo 'selected'; ?>>Terminé</option>
        </select>
        <br>
        <input type="submit" value="Sauver">
    </form>
</body>

</html>