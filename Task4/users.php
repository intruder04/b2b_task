<?php
require_once('db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 *
 * Изменения:
 * 1. В предложенном коде подключение создавалось для каждого user id, вынес подключение из цикла в отдельный файл
 * 2. Добавил проверку на пустоту и на наличие только цифр\запятых у $_GET['user_ids'], так же можно было добавить
 * удаление лидирующей нулей
 * 3. SELECT только нужных столбцов вместо *
 * 4. Один SELECT, а не для каждого пользователя
 * 5. Объявил массив data для ясности
 *
 */


/**
 * @param $user_ids - IDs from $_GET
 * @param $db - DB connection variable from db.php
 * @return array
 */

function load_users_data($user_ids, $db) {
    $data = [];
    $sql = mysqli_query($db, "SELECT id, name FROM users WHERE id IN ($user_ids)");
    while($obj = $sql->fetch_object()){
        $data[$obj->id] = $obj->name;
    }
    return $data;
}

/**
 * regex to check for numbers/commas in $_GET['user_ids']
 */

$regex = '/^[0-9,]+$/';
$usersFromGet = $_GET['user_ids'];

if (($usersFromGet != '') && (preg_match($regex, $usersFromGet) === 1)) {
    $userData = load_users_data($_GET['user_ids'], $db );
    foreach ($userData as $user_id=>$name) {
        echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
    }
} else {
    echo "empty or not numbers"; //debug
}

mysqli_close($db);
