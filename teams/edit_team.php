<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');

$team_id = 0;
if(isset($_GET['id'])) $team_id = $_GET['id'];
if(isset($_POST['id'])) $team_id = $_POST['id'];

$link = Db::getDbLink();

$query = 'SELECT * FROM teams WHERE id='.add_slashes($team_id);
$result = mysqli_query($link, $query);
$team = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0) {

    $team_name = $team['name'];
    $constructor = $team['constructor'];
    $country_id = $team['country_id'];
    $team_info = $team['team_info'];
    $team_id = $team['id'];

    $errors = [];
    if (isset($_POST['send'])) {
        if (isset($_POST['team_name'])) $team_name = $_POST['team_name'];
        if (isset($_POST['constructor'])) $constructor = $_POST['constructor'];
        if (isset($_POST['country_id'])) $country_id = $_POST['country_id'];
        $team_info = (isset($_POST['team_info'])) ? $_POST['team_info'] : '';

        if (strlen($team_name) <= 0) $errors['team_name'] = 'Поле "Название команды" не заполнено.';
        if (strlen($constructor) <= 0) $errors['constructor'] = 'Поле "Конструктор" не заполнено.';
        if ($country_id <= 0) $errors['country_id'] = 'Страна не выбрана';

        if (count($errors) <= 0) {
            $link = Db::getDbLink();

            $query = 'UPDATE teams SET name = "'.add_slashes($team_name).'", constructor = "'.add_slashes($constructor).'", country_id = '.add_slashes($country_id).', team_info = "'.add_slashes($team_info).'" WHERE id = '.$team_id;

            $update = mysqli_query($link, $query);
            if ($update) {
                $_SESSION['success'] = 'Команда успешно изменена.';
                Header('Location: teams.php');
                exit;
            }
            else
            {
                die('Ошибка при сохранении гонщика');
            }
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
<body bgcolor="#f5f5f5">

<nav><a href="/index.php">Главная</a> | <a href="/teams/teams.php">Команды</a> | Редактировать команду</nav>
<article>
    <div style="text-align: right"><a href="/teams/add_team.php">Добавить команду</a></div>

<?php if(mysqli_num_rows($result)>0) : ?>
    <h2>Редактирование команды "<?= $team['name']; ?>"</h2>

    <form action="/teams/edit_team.php" method="post">
        <input type="hidden" name="send" value="1">
        <input type="hidden" name="id" value="<?php echo $team_id; ?>">
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

<?php endif; ?>

</article>
</body>
</html>