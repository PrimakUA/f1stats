
<form action="/drivers/drivers.php" method="get">

    <div class="form-row">
        <label class="form-label">Имя гонщика</label>
        <input type="text" class="form-field" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" placeholder="Имя гонщика">
    </div>

    <div class="form-row">
        <label class="form-label">Фамилия гонщика</label>
        <input type="text" class="form-field" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" placeholder="Фамилия гонщика">
    </div>

    <div class="form-row">
        <label class="form-label">Команда</span></label>
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
    </div>

    <div class="form-row">
        <label class="form-label">Страна</label>
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
    </div>

    <div class="form-row">
        <div class="form-padding">
            <button type="submit">Найти</button>
        </div>
    </div>
</form>
