<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');

$team_name = '';
$constructor = '';
$country_id = 0;
$team_info = '';

$errors = [];
if(isset($_POST['send']))
{
    if(isset($_POST['team_name'])) $team_name = $_POST['team_name'];
    if(isset($_POST['constructor'])) $constructor = $_POST['constructor'];
    if(isset($_POST['country_id'])) $country_id = $_POST['country_id'];
    $team_info = (isset($_POST['team_info'])) ? $_POST['team_info'] : '';

    if(strlen($team_name)<=0) $errors['team_name'] = 'Поле "Название команды" не заполнено.';
    if(strlen($constructor)<=0) $errors['constructor'] = 'Поле "Конструктор" не заполнено.';
    if($country_id<=0) $errors['country_id'] = 'Страна не выбрана';

    if(count($errors)<=0)
    {
        $link = Db::getDbLink();

        $query = 'INSERT INTO teams (name, constructor, country_id, team_info) VALUES ("'.add_slashes($team_name).'", "'.add_slashes($constructor).'", '.$country_id.', "'.add_slashes($team_info).'")';
        $result = mysqli_query($link, $query);
        if($result)
        {
            $_SESSION['success'] = 'Команда успешно добавлена.';
            Header('Location: /teams/teams.php');
            exit;
        }
        else
        {
            die('Ошибка при сохранении гонщика');
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formula 1</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<nav><a href="/index.php">Главная</a> | <a href="/teams/teams.php">Команды</a> | Новая команда</nav>
<article>
    <h2>Создание новой команды</h2>

    <form action="/teams/add_team.php" method="post">
        <input type="hidden" name="send" value="1">
        <div class="form-row">
            <label class="form-label">Имя команды<span class="form-star">*</span></label>
            <input type="text" class="form-field-text" name="team_name" value="<?php echo htmlspecialchars($team_name); ?>" placeholder="Введите название команды">
            <?php
            if(isset($errors['team_name']))
            {
                echo '<div class="form-padding form-error">'.$errors['team_name'].'</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Конструктор<span class="form-star">*</span></label>

            <input type="text" class="form-field-text" name="constructor" value="<?php echo htmlspecialchars($constructor); ?>" placeholder="Конструктор">
            <?php
            echo '<div class="form-padding form-error';
            if(!isset($errors['constructor'])) echo ' hidden';
            echo '">';
            if(isset($errors['constructor'])) echo $errors['constructor'];
            echo '</div>';
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Страна<span class="form-star">*</span></label>
            <select class="form-field" name="country_id">
                <option value="0">Выберите страну</option>
                <?php
                $countries = getCountries();
                foreach ($countries as $key =>$value) {
                    echo '<option value="'.$key.'"';
                    if($country_id==$key) echo ' selected="selected"';
                    echo '>'.$value.'</option>';
                }
                ?>
            </select>
            <?php
            if(isset($errors['country_id']))
            {
                echo '<div class="form-padding form-error">'.$errors['country_id'].'</div>';
            }
            ?>
        </div>

        <div class="form-row">
            <label class="form-label">Информация о команде</label>
            <textarea class="form-field-text" placeholder="Введите информацию о команде" name="team_info"><?= htmlspecialchars($team_info); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-padding">
                <input type="submit" value="Сохранить" >
                <input type="reset" value="Очистить" >
            </div>
        </div>
    </form>
</article>
</body>
</html>