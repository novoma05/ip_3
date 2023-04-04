<?php
include('db_connect.php');

// zkontrolujeme, zda byl formulář odeslán metodou POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // zpracování vstupů z formuláře
    $name = htmlspecialchars($_POST["name"]);
    $password = htmlspecialchars($_POST["password"]);

    // připravení dotazu na vyhledání uživatele v databázi
    $stmt = $pdo->prepare('SELECT * FROM employee WHERE name = ?');
    $stmt->execute([$name]);
    $user = $stmt->fetch();

    // ověření hesla
    if ($user && $password == $user['password']) {
        // úspěšné přihlášení
        session_start();
        $_SESSION['user_id'] = $user['employee_id'];
        header('Location: Prohlizec.php');
        exit;
    } else {
        // chybné jméno nebo heslo
        $error_msg = "Chybné uživatelské jméno nebo heslo.";
    }
}

// Pokud je uživatel již přihlášen, přesměruj ho přímo na dashboard
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: Prohlizec.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Přihlášení</title>
</head>
<body>
<h1>Přihlášení</h1>
<?php
// zobrazíme chybovou zprávu, pokud byla nastavena
if (!empty($error_msg)) {
    echo '<p>' . $error_msg . '</p>';
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Uživatelské jméno:</label>
    <input type="text" name="name" required>
<br>

<label for="password">Heslo:</label>
<input type="password" name="password" required>

<br>

<button type="submit">Přihlásit se</button>
</form>
</body>
</html>