<?php

use App\Config;
use App\Table\TypeTable;

$pdo = Config::getPDO();
$table = new TypeTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_speciallite'));

?>
