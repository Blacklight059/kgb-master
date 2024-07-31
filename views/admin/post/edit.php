<?php
use App\Config;
use App\HTML\Form;
use App\Table\PostTable;
use App\ObjectHelper;
use App\Table\TypeTable;
use App\Table\SpecialiteTable;
use App\Table\PlanqueTable;
use App\Table\StatutTable;


session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}

$postTable = new PostTable($pdo);
$typeTable = new TypeTable($pdo);
$statutTable = new StatutTable($pdo);
$planqueTable = new PlanqueTable($pdo);
$specialiteTable = new SpecialiteTable($pdo);

$types = $typeTable->list();
$specialites = $specialiteTable->list();
$planques = $planqueTable->list();
$statuts = $statutTable->list();

$item = $postTable->find($params['id']);
$type = $typeTable->find($params['id']);
$specialite = $specialiteTable->find($params['id']);
$itemId = $item->getId();
$typeId = $type->getId();


$success = false;
$errors = [];
if (!empty($_POST)) {
    ObjectHelper::hydrate($item, $_POST, ['nom_de_code', 'slug', 'content', 'agents', 'nbres_cibles', 'nbres_contacts', 'date_debut', 'date_fin', 'types_mission', 'specialite', 'statuts_id', 'planque_id']);
    if (empty($errors)) {
        $postTable->updatePost($item);
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