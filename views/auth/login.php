<?php

use App\Config;
use App\Models\User;
use App\HTML\Form;
use App\Table\Exception\NotFoundException;
use App\Table\UserTable;

$pdo = Config::getPDO();
$user = new User();
$errors = [];        
$table = new UserTable(Config::getPDO());

if (!empty($_POST)) {
    $user->setPseudo($_POST['pseudo']);
    $errors['password'] = 'Identifiant ou mot de passe incorrect';

    if(!empty($_POST['pseudo']) || !empty($_POST['password'])) {

        $user = htmlspecialchars($_POST['pseudo']); 
        $password = htmlspecialchars($_POST['password']);
        $user = strtolower($user); // email transformé en minuscule

        try {
            $u = $table->findByemail($_POST['pseudo']);

            if (password_verify($_POST['password'], $u->getPassword()) === true) {
                session_start();

                $_SESSION['auth'] = $u->getId();
                header('Location: ' . $router->url('admin_posts'));
                exit();
            }

        } catch (NotFoundException $e) {
        }
    }



}

$form = new Form($user, $errors);
?>
<h1>Se connecter</h1>

<form method="post">
    <?= $form->input('pseudo', 'pseudo de'); ?>
    <?= $form->input('password', 'Mot de passe'); ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>

</form>
