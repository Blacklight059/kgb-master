<?php
use App\Config;
use App\HTML\Form;
use App\Table\CibleTable;
use App\Table\PostTable;
use App\ObjectHelper;

session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}
$table = new CibleTable($pdo);
$item = $table->find($params['id']);
$missionTable = new PostTable($pdo);
$missions = $missionTable->listMission();
 $success = false;
$errors = [];
$fields =  ['name', 'firstname', 'nom_de_code', 'date_naissance', 'nationalite_id', 'mission_id' ];

if (!empty($_POST)) {
    ObjectHelper::hydrate($item, $_POST, $fields);

    if (empty($errors)) {
        if (empty($_POST['name'])) {
            $errors['name'][] = 'Lechamps du titre ne peut pas être vide';
        }
        $table->update([
            'name' => $item->getName(),
            'firstname' =>$item->getFirstname(),
            'nom_de_code' =>$item->getNomdecode(),
            'date_naissance' =>$item->getDateofbirth(),
            'nationalite_id' =>$item->getNationaliteid(),
            'mission_id' =>$item->getMissionid()
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


<h1>Editer la cible <?= $params['id'] ?></h1>

<?php require ('_form.php'); ?>