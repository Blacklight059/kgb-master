<?php
use App\Config;
use App\HTML\Form;
use App\Models\Contact;
use App\Table\ContactTable;
use App\ObjectHelper;

session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}

$errors = [];
$item = new Contact();
if (!empty($_POST)) {
    $pdo = Config::getPDO();
    $table = new ContactTable($pdo);
    ObjectHelper::hydrate($item, $_POST, ['name', 'firstname', 'nom_de_code', 'nationalite_id', 'mission_id', 'planque_id']);

    if (empty($errors)) {

        $table->create($_POST);
        header('Location: ' . $router->url('admin_contacts'));
        exit();
    }
}

$form = new Form($item, $errors);

?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Le contact n'a pas pu être enregistré, merci de corriger les erreurs.
    </div>
<?php endif ?>


<h1>Créer le contact</h1>
<?php require ('_form.php'); ?>