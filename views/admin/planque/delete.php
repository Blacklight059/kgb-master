<?php

use App\Config;
use App\Table\StatutTable;

$pdo = Config::getPDO();
$table = new StatutTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_satuts' . '?delete=1'));

?>
