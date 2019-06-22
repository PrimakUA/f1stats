<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');

$racer_id = $_GET['id'];

$link = Db::getDbLink();

$query = 'SELECT d.*, c.name AS country_name, c.alias AS country_alias, t.name AS team_name FROM drivers d
            LEFT JOIN countries c ON c.id=d.country_id
            LEFT JOIN teams t ON t.id=d.team_id WHERE d.id= '.$racer_id.'';

$result = mysqli_query($link, $query);
$racer = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formula 1</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body bgcolor="#f5f5f5">

<nav><a href="/index.php">Главная</a> | <a href="/drivers/drivers.php">Гонщики</a> | Просмотр</nav>
<article>
    <div style="text-align: right"><a href="/drivers/add_racer.php">Добавить гонщика</a></div>

    <?php if(mysqli_num_rows($result)>0) : ?>
        <h2>Гонщик "<?= $racer['first_name'].' '.$racer['last_name']; ?>"</h2>
        <div class="my-padding">

            <table width="600" cellspacing="0" border="1" class="my-table">
                <tr>
                    <td width="200"><b>Полное имя</b></td>
                    <td><?= $racer['first_name'].' '.$racer['last_name']; ?></td>
                </tr>
                <tr>
                    <td><b>команда</b></td>
                    <td><?= $racer['team_name']; ?></td>
                </tr>
            </table>
        </div>
    <?php else : ?>
        <div>Команда не найдена.</div>
    <?php endif; ?>

</article>
</body>
</html>