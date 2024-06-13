<?php
    $user_id = $_GET['id'];
    include_once "../connect_ddb.php";

    // Préparation de la requête SQL pour éviter les injections SQL
    $sql = "DELETE FROM users WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    // Exécution de la requête et redirection
    if ($stmt->execute()) {
        header("Location: showUser.php?message=DeleteSuccess");
        exit;
    } else {
        header("Location: showUser.php?message=DeleteFail");
        exit;
    }
?>
