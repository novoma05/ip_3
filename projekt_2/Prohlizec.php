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
        ?>  
        <a href="logout.php">Odhlásit se</a>
        <a href="PassChng.php">Změnit heslo</a>
        <h1>Prohlížeč Databáze</h1>
        <p></p>
        <a class="brand-text" href="SezMist.php">Seznam Místností</a>
        <p></p>
        <a class="brand-text" href="SezZam.php">Seznam Zaměstnanců</a>
    </body>
</html>
