<?php
define('DB_HOST', 'a_level_nix_mysql');
define('DB_USER', 'root');
define('DB_PASSWORD', 'cbece_gead-cebfa');
define('DB_NAME', 'a_level_nix_mysql');

/**
 * @return mysqli
 */
function connect()
{
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$connection) {
        die();
    }

    return $connection;
}

/**
 * @param string $search
 * @param string $sort
 * @return void
 */
function getData($search = '', $sort = '')
{
    $mysql = connect();

    $query = 'SELECT `name`, `price`, `qty` FROM products';

    if (!empty($search)) {
        $query .= ' WHERE `name` LIKE \'%' . $search . '%\'';
    }

    if (!empty($sort)) {
        $query .= ' ORDER BY ' . $sort . ' ASC';
    }

    $data = mysqli_query($mysql, $query);
    $data = mysqli_fetch_all($data, MYSQLI_ASSOC);

    echo json_encode($data);
}

$search = htmlspecialchars(trim(strip_tags($_POST['search'])));
$sort   = htmlspecialchars(trim(strip_tags($_POST['sort'])));

getData($search, $sort);
