<?php

use App\Config;
use App\Table\CibleTable;

$pdo = Config::getPDO();
$table = new CibleTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_contacts'));

?>
