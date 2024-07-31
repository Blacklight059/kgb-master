<?php

use App\Config;
use App\Table\TypePlanqueTable;

$pdo = Config::getPDO();
$table = new TypePlanqueTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_typeplanque'));

?>
