<?php
use App\Config;
use App\HTML\Form;
use App\ObjectHelper;
use App\Table\PlanqueTable;
use App\Table\PaysTable;
use App\Table\TypePlanqueTable;


session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}
$table = new PlanqueTable($pdo);
$paysTable = new PaysTable($pdo);
$typeplanqueTable = new TypePlanqueTable($pdo);

$item = $table->list();
$pays = $paysTable->list();
$typeplanques = $typeplanqueTable->list();

$item = $table->find($params['id']);

$success = false;
$errors = [];
if (!empty($_POST)) {
    ObjectHelper::hydrate($item, $_POST, ['code', 'adresse', 'pays_id', 'type_planque']);
    if (empty($errors)) {
        $table->updatePlanque($item);
        $typeId === $itemId;
        $success = true;
    }
}

$form = new Form($item, $errors);

?>

<?php if ($success): ?>
    <div class="alert alert-success">
        L'article a été modifié
    </div>
<?php endif ?>

<?php if (isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'article a été créé
    </div>
<?php endif ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        L'article n'a pas pu être modifié, merci de corriger les erreurs.
    </div>
<?php endif ?>


<h1>Editer la mission <?= $params['id'] ?></h1>

<?php require ('_form.php'); ?>