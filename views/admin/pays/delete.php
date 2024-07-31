<?php

use App\Config;
use App\Table\PaysTable;

$pdo = Config::getPDO();
$table = new PaysTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_pays'));

?>
