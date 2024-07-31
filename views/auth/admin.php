<?php
use App\Config;
session_start();
$pdo = Config::getPDO();// ajout connexion bdd 
//si la session n'est pas créé on redirige vers la page d'acceuil
if(isset($_SESSION['user'])){
    header('Location: ' . $router->url('admin_landing'));
    die();
}
?>
 
<div class="login-form">
             <?php 
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;
                    }
                }

                if(!empty($_POST['email']) && !empty($_POST['password'])) // Si il existe les champs email, password et qu'il sont pas vident
                {
                    $email = htmlspecialchars($_POST['email']); 
                    $password = htmlspecialchars($_POST['password']);
                                        
                    // On regarde si l'utilisateur est inscrit dans la table utilisateurs
                    $check = $pdo->prepare('SELECT pseudo, lastname, firstname, email, password, token FROM utilisateurs WHERE email = ?');
                    $check->execute(array($email));
                    $data = $check->fetch();
                    $row = $check->rowCount();
                    if($row > 0)
                    {
                        // Si le mail est bon niveau format
                        if(filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            // Si le mot de passe est le bon
                            if(password_verify($password, $data['password']))
                            {
                                // On créer la session et on redirige sur landing.php
                                $_SESSION['user'] = $data['token'];
                                header('Location: ' . $router->url('admin_landing'));
                                die();
                            }else{ header('Location: '. $router->url('admin') .'?login_err=password'); die(); }
                        }else{ header('Location: '. $router->url('admin') .'?login_err=email'); die(); }
                    }else{ header('Location: '. $router->url('admin') .'?login_err=already');
                    }
                }

                ?>
            
            <form action="" method="post">
                <h2 class="text-center">Connexion</h2>       
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                </div>   
            </form>
            <p class="text-center"><a href="<?= $router->url('admin_inscription') ?>">Inscription</a></p>
        </div>

 <style>
            .login-form {
                width: 340px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
            }
        </style>
</div>
