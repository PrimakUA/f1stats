<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');

$racer_id = $_GET['id'];

$link = Db::getDbLink();

$query = 'SELECT * FROM drivers WHERE id='.$racer_id;

if($racer_id>0) {

    $query = 'DELETE FROM drivers WHERE id='.$racer_id;
    $update = mysqli_query($link, $query);
    if ($query) {
        $_SESSION['success'] = 'Гонщик удален.';
        Header('Location: drivers.php');
        exit;
    }
}
