<?php
use App\Models\Post;
use App\Config;
use App\Models\Agent;
use App\Models\Contact;
use App\Models\Cible;
use App\Models\Specialite;
use App\Models\Statut;
use App\Models\Type;


$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Config::getPDO();
$query = $pdo->prepare("SELECT * FROM missions WHERE id = :id");
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false */
$post = $query->fetch();
if($post === false) {
    throw new Exception('Aucun article ne correspond à cet ID');
}


if ($post->getSlug() !== $slug) {
    $url = $router->url('mission', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}

$query = $pdo->prepare("
SELECT c.id, c.nom_de_code, c.name, c.firstname, c.date_naissance, c.nationalite_id
FROM cibles c
WHERE mission_id = :id");
$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Cible::class);
/** @var Cible|false  */
$cible = $query->fetch();
if($cible === false) {
    throw new Exception('Aucune cible ne correspond à cet ID');
}


$query = $pdo->prepare("
SELECT * 
FROM specialite s
WHERE id = :id");

$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Specialite::class);
/** @var Specialite|false  */

$specialite = $query->fetch();

if($specialite === false) {
    throw new Exception('Aucune specialite ne correspond à cet ID');
}

$query = $pdo->prepare("
SELECT * 
FROM statuts
WHERE id = :id");

$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Statut::class);
/** @var Statut|false  */

$statut = $query->fetch();

if($statut === false) {
    throw new Exception('Aucun statut ne correspond à cet ID');
}

$query = $pdo->prepare("
SELECT * 
FROM types_mission
WHERE id = :id");

$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Type::class);
/** @var tYPE|false  */

$type = $query->fetch();

if($statut === false) {
    throw new Exception('Aucun statut ne correspond à cet ID');
}



$query = $pdo->prepare("
SELECT a.id, a.nom_de_code, a.name, a.firstname 
FROM agents a
WHERE mission_id = :id");
$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Agent::class);
/** @var Cible|false  */
$agent = $query->fetch();
if($agent === false) {
    throw new Exception('Aucun agent ne correspond à cet ID');
}

$query = $pdo->prepare("
SELECT c.id, c.nom_de_code, c.name, c.firstname 
FROM contacts c
WHERE mission_id = :id");
$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Contact::class);
/** @var Contact|false  */
$contact = $query->fetch();
if($contact === false) {
    throw new Exception('Aucun contact ne correspond à cet ID');
}

?>

<div class="card">
    <div class="card-body">
        <h1 class="card-title"><?= htmlentities($post->getSlug()) ?></h1>
        <h3 class="text-muted">Date de début de mission : <?=$post->getDatedebut()->format('d F Y') ?></h3>
        <h3>Cible : <?= htmlentities($cible->getNomdecode()) ?></h3>
        <h3>Agent : <?= htmlentities($agent->getNomdecode()) ?></h3>
        <h3>Contact : <?= htmlentities($contact->getNomdecode()) ?></h3>
        <h3>Specialite : <?= htmlentities($specialite->getName()) ?></h3>
        <h3>Date de fin de mission : <?= $post->getDatefin()->format('d F Y') ?></h3>
        <h3>Type de mission : <?= htmlentities($type->getName()) ?></h3>
        <h3>Statut de la mission : <?= htmlentities($statut->getName()) ?></h3>
        <p><?= $post->getFormattedContent() ?></p>

    </div>

</div>

