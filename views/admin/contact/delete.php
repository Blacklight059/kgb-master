<?php

use App\Config;
use App\Table\ContactTable;

$pdo = Config::getPDO();
$table = new ContactTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_contacts'));

?>
