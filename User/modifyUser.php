<?php
    $user_id = $_GET['id'];

    if (isset($_POST['send'])) {
        if (isset($_POST['username']) && isset($_POST['email']) && $_POST['username'] != "" && $_POST['email'] != "") {
            include_once "../connect_ddb.php";
            extract($_POST);

            // Préparation de la requête SQL pour éviter les injections SQL
            $sql = "UPDATE users SET user_name = :username, user_email = :email WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            
            // Liaison des paramètres
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            // Exécution de la requête et redirection
            if ($stmt->execute()) {
                header("Location: showUser.php");
                exit;
            } else {
                header("Location: showUser.php?message=EditFail");
                exit;
            }
        } else {
            header("Location: showUser.php?message=EmptyFields");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Edit User</title>
</head>
<body>
    <?php
        include_once "../connect_ddb.php";

        // Sélection de l'utilisateur à éditer
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
    ?>
    <form action="" method="post">
        <h1>Editer un utilisateur</h1>
        <input type="text" name="username" value="<?= htmlspecialchars($row['user_name']) ?>" placeholder="Username">
        <input type="email" name="email" value="<?= htmlspecialchars($row['user_email']) ?>" placeholder="Email">
        <input type="submit" name="send" value="Edit">
        <a class="link back" href="showUser.php">Cancel</a>
    </form>
    <?php
        } else {
            echo "<p class='message'>User not found!</p>";
        }
    ?>
</body>
</html>
