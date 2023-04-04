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

        if(isset($_GET['id'])){
            $id=($_GET['id']);
            $stmt =$pdo->query("SELECT * FROM employee WHERE employee_id=$id");
            $row = $stmt->fetch();
            $stmt2 =$pdo->query("SELECT room.room_id,room.name FROM room,`key` WHERE `key`.employee=$id AND room.room_id= `key`.room");
            $stmt3 = $pdo->query("SELECT room.room_id,room.name FROM employee, room WHERE room.room_id = employee.room AND employee_id=$id");
            $row3 = $stmt3->fetch();
        }
        ?>
            <h1>Karta osoby: <?php echo ($row['surname']); ?></h1>
            <h5><b>Jméno </b><?php echo ($row['name']); ?></h5>
            <h5><b>Příjmení </b><?php echo ($row['surname']); ?></h5>
            <h5><b>Pozice </b><?php echo ($row['job']); ?></h5>
            <h5><b>Mzda </b><?php echo ($row['wage']); ?></h5>
            <h5><b>Místnost </b><a class="txt" href="Mistnost.php?id=<?php echo ($row3['room_id']) ?>"><?php echo ($row3['name'])?></a></h5>
            <h5><b>Klíče </b>
            <ul type="none">
        <?php
        while($row2=$stmt2->fetch())
        {
            ?><li><a class="txt" href="Mistnost.php?id=<?php echo ($row2['room_id']) ?>"><?php echo ($row2['name'])?></a></li><?php
        }
        unset($stmt);
        unset($stmt2);
        unset($stmt3);
        ?>
        </ul>
        <a class="brand-text" href="SezZam.php">Zpět na Seznam Zaměstnanců</a>
    </body>
</html>