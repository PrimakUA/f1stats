<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');

$team_id = $_GET['id'];

$link = Db::getDbLink();

$query = 'SELECT * FROM teams WHERE id='.$team_id;

if($team_id>0) {

    $query = 'DELETE FROM `teams` WHERE id='.$team_id;
     $update = mysqli_query($link, $query);
    if ($query) {
        $_SESSION['success'] = 'Команда удалена.';
        Header('Location: teams.php');
        exit;
    }



}
