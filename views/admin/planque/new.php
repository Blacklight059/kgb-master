<?php
use App\Config;
use App\HTML\Form;
use App\Models\Post;
use App\Table\PostTable;
use App\Table\TypeTable;
use App\Table\SpecialiteTable;
use App\ObjectHelper;

session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}

$errors = [];
$item = new Post();   
$pdo = Config::getPDO();
$typeTable = new TypeTable($pdo);
$specialiteTable = new SpecialiteTable($pdo);
$types = $typeTable->list();
$specialites = $specialiteTable->list();

$item->setDatedebut(date('Y-m-d H:i:s'));
$item->setDatefin(date('Y-m-d H:i:s'));


if (!empty($_POST)) {
    $table = new PostTable($pdo);
    ObjectHelper::hydrate($item, $_POST, ['nom_de_code', 'slug', 'content', 'agents', 'nbres_cibles', 'nbres_contacts', 'date_debut', 'date_fin', 'types_mission', 'specialite', 'statuts_id', 'planque_id']);

    if (empty($errors)) {
        $table->create($_POST);
        header('Location: ' . $router->$url('admin_post', ['id' => $item->getId()]) . '?created=1');
        exit();
    }
}

$form = new Form($item, $errors);

?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        L'article n'a pas pu être enregistré, merci de corriger les erreurs.
    </div>
<?php endif ?>


<h1>Enregistré la mission</h1>
<?php require ('_form.php'); ?>