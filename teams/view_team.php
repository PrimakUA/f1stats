<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');

$team_id = $_GET['id'];

$link = Db::getDbLink();

$query = 'SELECT * FROM teams WHERE id='.$team_id;
//echo $query;
$result = mysqli_query($link, $query);
$team = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formula 1</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body bgcolor="#f5f5f5">

<nav><a href="/index.php">Главная</a> | <a href="/teams/teams.php">Команды</a> | Просмотр</nav>
<article>
    <div style="text-align: right"><a href="/teams/add_team.php">Добавить команду</a></div>

    <?php if(mysqli_num_rows($result)>0) : ?>
        <h2>Команда "<?= $team['name']; ?>"</h2>
        <div class="my-padding">

            <table width="600" cellspacing="0" border="1" class="my-table">
                <tr>
                    <td width="200"><b>Название команды</b></td>
                    <td><?= $team['name']; ?></td>
                </tr>
                <tr>
                    <td><b>Конструктор</b></td>
                    <td><?= $team['constructor']; ?></td>
                </tr>
            </table>
        </div>
    <?php else : ?>
        <div>Команда не найдена.</div>
    <?php endif; ?>

</article>
</body>
</html>