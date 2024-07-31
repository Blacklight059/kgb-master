<?php
use App\Config;
use App\HTML\Form;
use App\Table\ContactTable;
use App\ObjectHelper;

session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}
$table = new ContactTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields =  ['name', 'firstname', 'nom_de_code'];

if (!empty($_POST)) {
    ObjectHelper::hydrate($item, $_POST, $fields);

    if (empty($errors)) {
        $table->update([
            'name' => $item->getName(),
            'firstname' => $item->getFirstname(),
            'nom_de_code' => $item->getNomdecode()
        ], $item->getId());
        $success = true;
    }
}

$form = new Form($item, $errors);

?>

<?php if ($success): ?>
    <div class="alert alert-success">
        Le contact a été modifié
    </div>
<?php endif ?>

<?php if (isset($_GET['created'])): ?>
    <div class="alert alert-success">
        Le contact a été créé
    </div>
<?php endif ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Le contact n'a pas pu être modifié, merci de corriger les erreurs.
    </div>
<?php endif ?>


<h1>Editer le contact <?= $params['id'] ?></h1>

<?php require ('_form.php'); ?>