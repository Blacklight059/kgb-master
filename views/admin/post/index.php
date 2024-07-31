<?php

use App\Config;
use App\PaginatedQuery;
use App\Models\Post;


$title = 'Administration';
session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(!isset($_SESSION['user'])){
    header('Location: ' . $router->url('admin'));
    die();
}

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM missions ORDER BY date_debut DESC",
    "SELECT COUNT(id) FROM missions",
    Post::class
);

$posts = $paginatedQuery->getItems();
$link = $router->url('admin_posts');
?>

<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement a bien été supprimer
    </div>
<?php endif ?>

<table class="table">
    <thead>
        <th>#</th>
        <th>Titre</th>
        <th><a href="<?= $router->url('admin_post_new') ?>" class="btn btn-primary">Nouveau</a></th>
    </thead>
    <tbody>
        <?php foreach($posts as $post): ?>
        <tr>
            <td>
                #<?= $post->getId() ?>
            </td>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getId()]) ?>">
                    <?= htmlentities($post->getSlug()); ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getId()]) ?>" class="btn btn-primary">
                    Editer
                </a>
                <form action="<?= $router->url('admin_post_delete', ['id' => $post->getId()]) ?>" method="POST"
                onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')" style="display:inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>

    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->PreviousLink($link); ?>
    <?= $paginatedQuery->nextLink($link); ?>

</div>