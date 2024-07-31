<?php

use App\Config;
use App\Table\PostTable;

$pdo = Config::getPDO();
$table = new PostTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_posts' . '?delete=1'));

?>
