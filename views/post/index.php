<?php
use App\Models\Post;
use App\PaginatedQuery;


$title = 'Accueil';

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM missions ORDER BY date_debut DESC",
    "SELECT COUNT(id) FROM missions",
    Post::class
);


$posts = $paginatedQuery->getItems();
$link = $router->url('home');
?>

<div class="row">
    <?php foreach($posts as $post): ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlentities($post->getSlug()) ?></h5>
                    <p class="text-muted"><?=$post->getDatedebut()->format('d F Y') ?> </p>
                    <p><?= $post->getExcerpt() ?></p>
                    <p>
                        <a href="<?= $router->url('mission', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <div class="d-flex justify-content-between my-4">
        <?= $paginatedQuery->PreviousLink($link) ?>
        <?= $paginatedQuery->nextLink($link) ?>

    </div>
</div>