<?php
use App\Config;
use App\HTML\Form;
use App\Models\Pays;
use App\Table\PaysTable;
use App\ObjectHelper;

session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}

$errors = [];
$item = new Pays();
if (!empty($_POST)) {
    $pdo = Config::getPDO();
    $table = new PaysTable($pdo);
    ObjectHelper::hydrate($item, $_POST, ['name']);

    if (empty($errors)) {

        $table->create($_POST);
        header('Location: ' . $router->url('admin_types'));
        exit();
    }
}

$form = new Form($item, $errors);

?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Le type de mission n'a pas pu être enregistré, merci de corriger les erreurs.
    </div>
<?php endif ?>


<h1>Créer le pays de la mission</h1>
<?php require ('_form.php'); ?>