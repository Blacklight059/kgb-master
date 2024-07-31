<?php

use App\Config;

use App\Auth;
use App\Table\CibleTable;

 // Auth::check();

$title = 'Gestion des cibles';
session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('home'));
    die();
}

$link = $router->url('admin_cibles');
$items = (new CibleTable($pdo))->all();
?>

<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement a bien été supprimer
    </div>
<?php endif ?>

<table class="table">
    <thead>
        <th>#</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Nom de code</th>
        <th><a href="<?= $router->url('admin_cible_new') ?>" class="btn btn-primary">Nouveau</a></th>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
        <tr>
            <td>
                #<?= $item->getId() ?>
            </td>
            <td>
                <a href="<?= $router->url('admin_cible', ['id' => $item->getId()]) ?>">
                    <?= htmlentities($item->getName()); ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('admin_cible', ['id' => $item->getId()]) ?>">
                    <?= htmlentities($item->getFirstname()); ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('admin_cible', ['id' => $item->getId()]) ?>">
                    <?= htmlentities($item->getNomdecode()); ?>
                </a>
            </td>

            <td>
                <a href="<?= $router->url('admin_cible', ['id' => $item->getId()]) ?>" class="btn btn-primary">
                    Editer
                </a>
                <form action="<?= $router->url('admin_cible_delete', ['id' => $item->getId()]) ?>" method="POST"
                onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')" style="display:inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>

    </tbody>
</table>
