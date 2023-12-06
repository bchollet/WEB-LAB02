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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <h1>Éditer une tâche</h1>
        </div>

        <div class="row d-flex mb-3">
            <div class="col-2">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php';">Retour à la liste</button>
            </div>
        </div>

        <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>

        <!-- Formulaire d'édition de tâche -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="task_id" value="<?php echo $taskId; ?>">

            <div class="mb-3">
                <label class="form-label" for="titre">Titre*:</label>
                <input class="form-control" type="text" name="titre" value="<?php echo $task['titre']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Description:</label>
                <textarea class="form-control" name="description"><?php echo $task['description']; ?></textarea>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label class="form-label" for="categorie">Catégorie*:</label>
                    <select class="form-select" name="categorie" required>
                        <option value="NONE" <?php if ($task['categorie'] == 'NONE') echo 'selected'; ?>>Aucune</option>
                        <option value="TODO" <?php if ($task['categorie'] == 'TODO') echo 'selected'; ?>>TODO</option>
                        <option value="SHOPPING" <?php if ($task['categorie'] == 'SHOPPING') echo 'selected'; ?>>Shopping</option>
                        <option value="WORK" <?php if ($task['categorie'] == 'WORK') echo 'selected'; ?>>Travail</option>
                        <option value="FAMILY" <?php if ($task['categorie'] == 'FAMILY') echo 'selected'; ?>>Famille</option>
                    </select>
                </div>
                <div class="col-4">
                    <label class="form-label" for="date_echeance" value="<?php echo $task['date_echeance']; ?>">Date d'échéance:</label>
                    <input class="form-control" type="date" name="date_echeance">
                </div>
                <div class="col-4">
                    <label class="form-label" for="etat">État*:</label>
                    <select class="form-select" name="etat" required>
                        <option value="TODO" <?php if ($task['etat'] == 'TODO') echo 'selected'; ?>>À faire</option>
                        <option value="DONE" <?php if ($task['etat'] == 'DONE') echo 'selected'; ?>>Terminé</option>
                    </select>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Sauver">
        </form>
    </div>
</body>

</html>