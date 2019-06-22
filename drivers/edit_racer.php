<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');

$racer_id = 0;
if(isset($_GET['id'])) $racer_id = $_GET['id'];
if(isset($_POST['id'])) $racer_id = $_POST['id'];

$link = Db::getDbLink();

$query = 'SELECT * FROM drivers WHERE id='.add_slashes($racer_id);
$result = mysqli_query($link, $query);
$racer = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0) {

    $racer_name = $racer['first_name'];
    $racer_last_name = $racer['last_name'];
    $country_id = $racer['country_id'];
    $team_id = $racer['team_id'];
    $racer_id = $racer['id'];
    $racer_info = $racer['info'];

    $errors = [];
    if (isset($_POST['send'])) {
        if (isset($_POST['first_name'])) $racer_name = $_POST['first_name'];
        if (isset($_POST['last_name'])) $racer_last_name = $_POST['last_name'];
        if (isset($_POST['country_id'])) $country_id = $_POST['country_id'];
        if (isset($_POST['team_id'])) $team_id = $_POST['team_id'];
        $racer_info = (isset($_POST['info'])) ? $_POST['info'] : '';

        if (strlen($racer_name) <= 0) $errors['first_name'] = 'Поле "Имя гонщика" не заполнено.';
        if (strlen($racer_last_name) <= 0) $errors['last_name'] = 'Поле "Фамилия" не заполнено.';
        if ($country_id <= 0) $errors['country_id'] = 'Страна не выбрана';
        if ($team_id <= 0) $errors['team_id'] = 'Команда не выбрана';

        if (count($errors) <= 0) {
            $link = Db::getDbLink();

            $query = 'UPDATE drivers SET first_name = "'.add_slashes($racer_name).'", last_name = "'.add_slashes($racer_last_name).'", country_id = '.add_slashes($country_id).', info = "'.add_slashes($racer_info).'" , team_id = "'.$team_id.'" WHERE id = '.add_slashes($racer_id);

            echo $query;
            $update = mysqli_query($link, $query);

            //var_dump($result); die();

            if ($update) {
                $_SESSION['success'] = 'Гонщик успешно изменен.';
                Header('Location: drivers.php');
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

<nav><a href="/index.php">Главная</a> | <a href="/drivers/drivers.php">Гонщики</a> | Редактировать гонщика</nav>
<article>
    <div style="text-align: right"><a href="/drivers/add_racer.php">Добавить гонщика</a></div>

    <?php if(mysqli_num_rows($result)>0) : ?>
        <h2>Редактирование гонщика "<?= $racer['first_name'].' '.$racer['last_name']; ?>"</h2>

        <form action="/drivers/edit_racer.php" method="post">
            <input type="hidden" name="send" value="1">
            <input type="hidden" name="id" value="<?php echo $racer_id; ?>">
            <div class="form-row">
                <label class="form-label">Имя<span class="form-star">*</span></label>
                <input type="text" class="form-field-text" name="first_name" value="<?php echo htmlspecialchars($racer_name); ?>" placeholder="Введите имя гонщика">
                <?php
                if(isset($errors['first_name']))
                {
                    echo '<div class="form-padding form-error">'.$errors['first_name'].'</div>';
                }
                ?>
            </div>

            <div class="form-row">
                <label class="form-label">Фамилия<span class="form-star">*</span></label>
                <input type="text" class="form-field-text" name="last_name" value="<?php echo htmlspecialchars($racer_last_name); ?>" placeholder="Фамилия">
                <?php
                echo '<div class="form-padding form-error';
                if(!isset($errors['last_name'])) echo ' hidden';
                echo '">';
                if(isset($errors['last_name'])) echo $errors['last_name'];
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
                <label class="form-label">Команда<span class="form-star">*</span></label>
                <select class="form-field" name="team_id">
                    <option value="0">Выберите команду</option>
                    <?php
                    $teams = getTeams();
                    foreach ($teams as $key =>$value) {
                        echo '<option value="'.$key.'"';
                        if($team_id==$key) echo ' selected="selected"';
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
                <label class="form-label">Информация о гонщике</label>
                <textarea class="form-field-text" placeholder="Введите информацию о гонщике" name="info"><?= htmlspecialchars($racer_info); ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-padding">
                    <input type="submit" value="Сохранить" >
                    <input type="reset" value="Отменить" >
                </div>
            </div>
        </form>

    <?php endif; ?>

</article>
</body>
</html>