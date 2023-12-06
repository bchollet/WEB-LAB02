<?php
function getConn()
{
    $servername = "127.0.0.1:3306";
    $username = "mariadb";
    $password = "mariadb";
    $database = "mariadb";

    return new mysqli($servername, $username, $password, $database);
}

function getTasks()
{
    $conn = getConn();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM TodoList";
    $result = $conn->query($sql);

    $tasks = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }

    $conn->close();

    return $tasks;
}

function getTaskById($id)
{
    $conn = getConn();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM TodoList WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $task = $result->fetch_assoc();

    $conn->close();

    return $task;
}

function createOrUpdateTask($isUpdate)
{
    if ($isUpdate) {
        $taskId = $_POST['task_id']; // ID de la tâche à éditer
    }

    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $date_echeance = empty($_POST['date_echeance']) ? null : $_POST['date_echeance'];
    $etat = $_POST['etat'];

    if (!is_null($date_echeance)) {
        $date_to_compare = new DateTime($date_echeance);
        $today = new DateTime();
        if ($date_to_compare < $today) {
            return 'La date d\'échéance ne peut pas être inférieur à aujourd\'hui';
        }
    }

    // Validation des champs obligatoires
    if (empty($titre) || empty($categorie) || empty($etat)) {
        $error_message = "Les champs marqués d'une * sont obligatoires.";
    } else {
        // Connexion à la base de données
        $conn = getConn();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($isUpdate) {
            // Préparer la requête SQL de mise à jour
            $sql = "UPDATE TodoList SET titre=?, description=?, categorie=?, date_echeance=?, etat=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $titre, $description, $categorie, $date_echeance, $etat, $taskId);
        } else {
            // Préparer la requête SQL d'insertion
            $sql = "INSERT INTO TodoList (titre, description, categorie, date_echeance, etat) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $titre, $description, $categorie, $date_echeance, $etat);
        }

        // Exécuter la requête SQL
        if ($stmt->execute()) {
            // Rediriger vers index.php après la mise à jour réussie
            header("Location: index.php");
            $conn->close();
            exit();
        } else {
            $error_message = "Erreur lors de la mise à jour de la tâche.";
        }

        // Fermer la connexion à la base de données
        $conn->close();

        return $error_message;
    }
}

function deleteTask($id)
{
    $conn = getConn();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer la requête SQL de suppression
    $sql = "DELETE FROM TodoList WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Exécuter la requête SQL
    $stmt->execute();

    // Fermer la connexion à la base de données
    $conn->close();

    // Rediriger vers index.php après la suppression réussie
    header("Location: index.php");
}
