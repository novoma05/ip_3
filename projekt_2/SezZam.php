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
        header('Location: logout.php');
        include('db_connect.php');
        echo '<a href="logout.php">Odhlásit se</a>';

        $stmt = $pdo->query('SELECT employee_id, employee.name, surname, job, wage, room, phone, room.name as room_name 
FROM employee, room WHERE room.room_id = employee.room ');

        ?>
        <a href="logout.php">Odhlásit se</a>
        <h1>Seznam Zaměstnanců</h1><br>
        <?php
        
        ?>
        <table width="1200" height="350">
            <tr>
                <th width="300">Jméno</th>
                <th width="300">Místnost</th>
                <th width="300">Telefon</th>
                <th width="300">Pozice</th>
            </tr>
            <tr>
<?php
if ($stmt->rowCount() == 0) {
    echo "Záznam neobsahuje žádná data";
} else {
    while ($row = $stmt->fetch()) {
      ?><td><a class="txt" href="Zamestnanec.php?id=<?php echo ($row['employee_id']) ?>"><?php echo ($row['surname'])." ".($row['name'])?></a></td><td><?php echo($row['room_name'])?></td><td><?php echo($row['phone'])?></td><td><?php echo($row['job']); ?></td></tr><tr><?php
    }
}
unset($stmt);
?>
            </tr>
        </table>
    </body>
</html>

        