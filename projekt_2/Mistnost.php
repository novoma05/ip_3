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
        $stmt =$pdo->query("SELECT * FROM room WHERE room_id=$id");
        $stmt3 =$pdo->query("SELECT employee_id,surname FROM employee,`key` WHERE `key`.room=$id AND employee.employee_id=`key`.employee");
        $stmt2 = $pdo->query("SELECT wage,employee_id,surname FROM employee, room WHERE employee.room= room.room_id AND room_id=$id");
        $row = $stmt->fetch();
        $vypis1=0;
        $i=0;
        $vysledek=0;
        }
        ?>
            <h1>Místnost č:  <?php echo ($row['no']); ?></h1>
            <h5><b>Číslo </b><?php echo ($row['no']); ?></h5>
            <h5><b>Název </b><?php echo ($row['name']); ?></h5>
            <h5><b>Telefon </b><?php echo ($row['phone']); ?></h5>
            <h5><b>Lidé </b></h5>
            <?php 
            while($row2=$stmt2->fetch()){
                if($row2['surname']===null){
                    ?><h5>-</h5><?php
                 }
                 else{
                     ?><h5><li><a class="txt" href="Zamestnanec.php?id=<?php echo ($row2['employee_id']) ?>"><?php echo ($row2['surname'])?></a></li></h5><?php
                        $vypis1=$vypis1+$row2['wage'];
                        $i=$i+1;
                        $vysledek=$vypis1/$i;
                     }
            }
            
            ?>
            
                <h5><b>Průměrná mzda </b><?php echo $vysledek; ?></h5>
            
            <h5><b>Klíče</b></h5>
        <?php
            while($row3=$stmt3->fetch())
            {
                ?><h5><li><a class="txt" href="Zamestnanec.php?id=<?php echo ($row3['employee_id']) ?>"><?php echo ($row3['surname'])?></a></li></h5><?php
            }
        ?>
      
        <a class="brand-text" href="SezMist.php">Seznam Místností</a>
    </body>
</html>