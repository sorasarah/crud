<?php
if (isset($_POST['send'])) {
    if (isset($_POST['username']) && isset($_POST['email']) && $_POST['username'] != "" && $_POST['email'] != "") {
        include_once "../connect_ddb.php";
        extract($_POST);

        // Préparation de la requête SQL pour éviter les injections SQL
        $sql = "INSERT INTO users (user_name, user_email) VALUES (:username, :email)";
        $stmt = $conn->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        // Exécution de la requête et redirection
        if ($stmt->execute()) {
            header("Location: showUser.php");
            exit;
        } else {
            header("Location: addUser.php?message=AddFail");
            exit;
        }
    } else {
        header("Location: addUser.php?message=EmptyFields");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Add User</title>
</head>
<body>
    <form action="" method="post">
        <h1>Ajouter un utilisateur</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="submit" name="send" value="Add">
        <a class="link back" href="showUser.php">Cancel</a>
    </form>
</body>
</html>
