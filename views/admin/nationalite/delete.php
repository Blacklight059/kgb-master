<?php

use App\Config;
use App\Table\NationaliteTable;

$pdo = Config::getPDO();
$table = new NationaliteTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_nationalite'));

?>
