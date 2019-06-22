<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_db.php');

$link = Db::getDbLink();

// search
$first_name = '';
$last_name = '';
$team_id = 0;
$country_id = 0;

if(isset($_GET['first_name'])) $first_name = $_GET['first_name'];
if(isset($_GET['last_name'])) $last_name = $_GET['last_name'];
if(isset($_GET['team_id'])) $team_id = $_GET['team_id'];
if(isset($_GET['country_id'])) $country_id = $_GET['country_id'];

$q_first_name = '';
$q_last_name = '';
$q_country_id = '';
$q_team_id = '';

$is_search = false;
if (strlen($first_name)>0) {
    $q_first_name = ' AND d.first_name LIKE "%'.$first_name.'%"';
    $is_search = true;
}
if (strlen($last_name)>0) {
    $q_last_name = ' AND d.last_name LIKE "%'.$last_name.'%"';
    $is_search = true;
}
if ($team_id > 0) {
    $q_team_id = ' AND d.team_id='.$team_id;
    $is_search = true;
}
if ($country_id > 0) {
    $q_country_id = ' AND d.country_id='.$country_id;
    $is_search = true;
}
// /search

// pager
$q_drivers_all = 'SELECT COUNT(*) FROM drivers d WHERE 1'.$q_first_name.$q_last_name.$q_team_id.$q_country_id ;
$r_drivers_all = mysqli_query($link, $q_drivers_all);
$drivers_count_all = mysqli_fetch_row($r_drivers_all)[0];
$items_on_page = 22;
$num_pages = ceil($drivers_count_all/$items_on_page);
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page = max(1, min($num_pages, intval($page)));
$par_page = ' LIMIT '.($page-1)*$items_on_page.', '.$items_on_page;
// /pager

// sort
$sort = isset($_GET["sort"]) ? $_GET["sort"] : 'first_name';
$sort_by = isset($_GET["sort_by"]) ? 1 : 0;
if($sort_by==1) { $asc = " DESC"; $desc=" ASC"; $up = 0; $down = 1;}
else { $asc = " ASC"; $desc=" DESC";  $up = 1; $down = 0; }
$sorts = [
    'id'=>['d.id '.$asc, $up],
    'first_name'=>['d.first_name '.$asc, $up],
    'last_name'=>['d.last_name '.$asc, $up],
    'team_id'=>['team_name '.$asc, $up],
    'country_id'=>['country_name '.$asc, $up],
];
$par_sort = ' ORDER BY '.$sorts[$sort][0];
if($sorts[$sort][1]==1) { $order = '&#9650;'; $sortstr = 'возрастающем'; }
else { $order = '&#9660;'; $sortstr = 'убывающем';}
// /sort

$q_drivers = 'SELECT d.*, c.name AS country_name, c.alias AS country_alias, t.name AS team_name FROM drivers d
            LEFT JOIN countries c ON c.id=d.country_id
            LEFT JOIN teams t ON t.id=d.team_id WHERE 1 '.$q_first_name.$q_last_name.$q_team_id.$q_country_id.$par_sort.$par_page;
//echo $q_drivers;
$r_drivers = mysqli_query($link, $q_drivers);
$drivers_count = mysqli_num_rows($r_drivers);
//$drivers_count_all = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formula 1</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body bgcolor="#f5f5f5">

<nav><a href="/index.php">Главная</a> | Гонщики </nav>
<article>
    <div style="text-align: right"><a href="/drivers/add_racer.php">Добавить гонщика</a></div>

    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/drivers/_finder.php'); ?>

    <h2>Список гонщиков</h2>

    <?php
    if ($drivers_count_all == 0) {
        echo '<div class="my-padding">Нету ни одного гонщика</div>';
    }
    ?>

    <div style="width:670px;" class="my-padding">
        <?php
        if(isset($_SESSION['success']))
        {
            echo '<div class="success">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
        $url_params = ['page'];

        if ($drivers_count_all > 0)
            require_once($_SERVER['DOCUMENT_ROOT'] . '/drivers/_driver_table.php');
        ?>

    </div>

</article>
</body>
</html>

<?php
/*
$a = ['first', 'second'];
print_r($a);

unset($a[0]);
print_r($a);

if(!defined('MY_CONST')) define('MY_CONST', 'sdfsdf');

defined('PROFESSIONAL_TYPE_JUNIOR', 'j');
defined('PROFESSIONAL_TYPE_MIDDLE', 'm');
defined('PROFESSIONAL_TYPE_PRO', 'p');



if($row['professional_type']==PROFESSIONAL_TYPE_MIDDLE)
{
    //....
}*/
