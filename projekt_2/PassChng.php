<?php
session_start();

// Zkontrolujeme, zda je uživatel přihlášen
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db_connect.php');
$user_id = intval($_SESSION['employee_id']);
$_SESSION['employee_id'] = $user['employee_id'];
$user_id = $_SESSION['employee_id'];

// Načteme uživatelské jméno na základě ID uživatele
$stmt = $pdo->prepare('SELECT * FROM employee WHERE employee_id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Zpracujeme vstupy z formuláře
    $current_password = htmlspecialchars($_POST['current_password']);
    $new_password = htmlspecialchars($_POST['new_password']);
    $confirm_new_password = htmlspecialchars($_POST['confirm_new_password']);

    // Zkontrolujeme, zda byly všechny položky vyplněny
    if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
        $error_msg = 'Prosím, vyplňte všechny položky.';
    } else {
        // Načteme aktuální heslo z databáze
        $stmt = $pdo->prepare('UPDATE employee SET password = ? WHERE employee_id = ?');
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        // Zkontrolujeme, zda zadané aktuální heslo odpovídá heslu v databázi
        if (!password_verify($current_password, $user['password'])) {
            $error_msg = 'Zadané heslo není správné.';
        } else {
            // Zkontrolujeme, zda nová hesla jsou stejná
            if ($new_password !== $confirm_new_password) {
                $error_msg = 'Nová hesla se neshodují.';
            } else {
                // Aktualizujeme heslo v databázi
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('SELECT * FROM employee WHERE employee_id = ?');
                $stmt->execute([password_hash($new_password, PASSWORD_DEFAULT), $employee_id]);

                // Přesměrujeme uživatele na úvodní stránku
                header('Location: index.php');
                exit;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
