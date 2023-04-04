<!DOCTYPE html>

<html>
    <head>
        
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }
        include('db_connect.php');

        echo '<a href="logout.php">Odhlásit se</a>';
        
        $stmt = $pdo->query('SELECT * FROM room');

        ?><h1>Seznam Místností</h1><br><?php

        ?>
        <table width="1200" height="350">
            <tr>
                <th width="400">Název</th>
                <th width="400">Číslo</th>
                <th width="400">Telefon</th>
            </tr>
            <tr>
<?php
if ($stmt->rowCount() == 0) {
    echo "Záznam neobsahuje žádná data";
} else {
    while ($row = $stmt->fetch()) {
      ?><td><a class="txt" href="Mistnost.php?id=<?php echo ($row['room_id']) ?>"><?php echo ($row['name'])?></a></td><td><?php echo($row['no'])?></td><td><?php echo($row['phone']); ?></td></tr><tr><?php
    }
}
unset($stmt);
?>
            </tr>
        </table>
        <?php
        
        
        ?>
    </body>
</html>