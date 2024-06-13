<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>User List</title>
</head>
<body>
    <div class="link_container">
        <a class="link" href="addUser.php">Add User</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>

            <?php
            include_once "../connect_ddb.php";
            // User list
            $statement = $conn->query("SELECT * FROM users");
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                foreach ($data as $row) {
            ?>
            <tr>
                <td><?=htmlspecialchars($row['user_name'])?></td>
                <td><?=htmlspecialchars($row['user_email'])?></td>
                <td class="image"><a href="modifyUser.php?id=<?=htmlspecialchars($row['user_id'])?>"><img src="../images/write.png" alt=""></a></td>
                <td class="image"><a href="deleteUser.php?id=<?=htmlspecialchars($row['user_id'])?>"><img src="../images/remove.png"></a></td>
            </tr>
            <?php
                 }
                //  var_dump($data);
                } else {
                    echo "<tr><td colspan='4' class='message'>No results!</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>