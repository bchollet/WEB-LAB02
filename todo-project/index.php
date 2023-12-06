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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <h1>Ma liste de tâche trop funky</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-2">
                <button type="button" class="btn btn-primary" onclick="window.location.href='create.php';">Ajouter une tâche</button>
            </div>
        </div>
        <i class="fa fa-family"></i>

        <!-- Affichage des tâches -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Échéance</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Effectuée</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="fs-5">
                <?php
                foreach ($tasks as $task) {
                    echo "<tr>";
                    echo "<th scope=\"row\">{$task['date_echeance']}</th>";
                    echo "<td>{$task['titre']}</td>";
                    echo "<td>{$task['description']}</td>";
                    echo "<td><i class=\"fa fa-";
                    switch ($task['categorie']) {
                        case 'FAMILY':
                            echo "users";
                            break;
                        case 'SHOPPING':
                            echo "shopping-cart";
                            break;
                        case 'WORK':
                            echo "suitcase";
                            break;
                        case 'TODO':
                        case 'NONE':
                        default:
                            echo "calendar-check-o";
                            break;
                    }
                    echo "\"></i></td>";
                    echo "<td class=\"fs-5\">";
                    if ($task['etat'] == 'DONE') {
                        echo "<i class=\"text-success fa fa-check\"></i>";
                    }
                    echo "</td>";
                    echo "<td class=\"fs-5\"><a class=\"text-secondary\" href=\"edit.php?id={$task['id']}\"><i class=\"fa fa-edit\"></i></a>      ";
                    echo "<a class=\"text-danger\" href=\"index.php?delete_id={$task['id']}\"><i class=\"fa fa-trash\"></i></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>