<div>
    <?php
    if ($is_search){
        echo 'Найдено: '.$drivers_count_all. '.   '.'<a href="/drivers/drivers.php">Все гонщики</a>';
    }
    else {
        echo 'Всего гонщиков: '.$drivers_count_all;
    }
    ?>
</div>

<table cellspacing="0" border="1" class="my-table">
    <tr>
        <th width="50"><a href="drivers.php?sort=id<?php echo getParStr($url_params); if($sort=='id' && !$sort_by) echo '&sort_by=1'; ?>">Id<?php if($sort=='id') echo ' <span title="Отсортировано в '.$sortstr.' порядке">'.$order.'</span>'; ?></a></th>
        <th width="200"><a href="drivers.php?sort=first_name<?php echo getParStr($url_params); if($sort=='first_name' && !$sort_by) echo '&sort_by=1'; ?>">Гонщик<?php if($sort=='first_name') echo ' <span title="Отсортировано в '.$sortstr.' порядке">'.$order.'</span>'; ?></a></th>
        <th width="200"><a href="drivers.php?sort=team_id<?php echo getParStr($url_params); if($sort=='team_id' && !$sort_by) echo '&sort_by=1'; ?>">Команда<?php if($sort=='team_id') echo ' <span title="Отсортировано в '.$sortstr.' порядке">'.$order.'</span>'; ?></a></th>
        <th width="150"><a href="drivers.php?sort=country_id<?php echo getParStr($url_params); if($sort=='country_id' && !$sort_by) echo '&sort_by=1'; ?>">Страна<?php if($sort=='country_id') echo ' <span title="Отсортировано в '.$sortstr.' порядке">'.$order.'</span>'; ?></a></th>
    </tr>
    <?php

    for($i=0; $i<$drivers_count; $i++)
    {
        $row = mysqli_fetch_assoc($r_drivers);


        echo '<tr>
                        <td>'.($i+1).'</td>
                        <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                        <td>'.$row['team_name'].'</td>
                        <td><img src="'.getFlag($row['country_alias']).'" width="20"> '.$row['country_name'].'</td>
                        <td>
                            <a href="view_racer.php?id='.$row['id'].'">П</a>
                            <a href="edit_racer.php?id='.$row['id'].'">Р</a>
                            <a href="#" onclick="if(window.confirm(\'Вы действительно хотите удалить гонщика?\')) { window.location = \'delete_racer.php?id='.htmlspecialchars($row['id']).'\'; } return false;">У</a>
                        </td>
                </tr>';
    }

    ?>
</table>

<?php if($num_pages>1) : ?>
    <div style="text-align: center;">
        Страница:
        <?php
        /* for($i=0; $i<$num_pages; $i++) {
             if (($i+1) == $page) {
                 echo ($i+1)." ";
             } else {
                 echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($i+1).'">'.($i+1)."</a> ";
             }
         }*/
        $url_params = ['sort', 'sort_by'];
        $url = 'drivers.php?'.getParStr($url_params);
        makePager($page, $num_pages, 2 , $url) ;
        ?>
    </div>
<?php endif; ?>