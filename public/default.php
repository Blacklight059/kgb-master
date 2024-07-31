<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'kgb' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <lnk rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/style.css">    
</head>
<body class="d-flex flex-column h-100">
<header class="container-fluid header">
        <a href="img/logo.jpg" target="" class="col header-logo">
            <img src="img/logo.jpg" alt="Logo du site" id="logo">
        </a>
        <nav class="row row-cols-2-lg navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar bg-dark">
        
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>
   
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <div class="nav-item dropdown">
                           <a href="<?= $router->url('home') ?>" class="nav-item nav-link col">Accueil</a>
                       </div>
                       <div class="nav-item dropdown">
                           <a href="<?= $router->url('admin') ?>" class="nav-item nav-link col">Administration</a>
                       </div>
                       <?php if(isset($_SESSION['user'])): ?>
                        
                                <div class="nav-item dropdown">
                                    <a href="<?= $router->url('admin_posts') ?>" class="nav-link dropdown-toggle col" data-bs-toggle="dropdown">Missions et personnes</a>
                                    <div class="dropdown-menu">
                                        <a href="<?= $router->url('admin_posts') ?>" class="dropdown-item">Missions</a>
                                        <a href="<?= $router->url('admin_contacts') ?>" class="dropdown-item">Contact</a>
                                        <a href="<?= $router->url('admin_cibles') ?>" class="dropdown-item">Cibles</a>
                                    </div>
                                </div>
            
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle col" data-bs-toggle="dropdown">Données de mission</a>
                                        <div class="dropdown-menu">
                                            <a href="<?= $router->url('admin_types') ?>" class="dropdown-item">Type de mission</a>
                                            <a href="<?= $router->url('admin_nationalites') ?>" class="dropdown-item">Natioonalités</a>
                                            <a href="<?= $router->url('admin_specialites') ?>" class="dropdown-item">Spécialités</a>
                                            <a href="<?= $router->url('admin_planques') ?>" class="dropdown-item">Planques</a>
                                            <a href="<?= $router->url('admin_payss') ?>" class="dropdown-item">Pays</a>
                                            <a href="<?= $router->url('admin_typeplanques') ?>" class="dropdown-item">Type de planque</a>

                                        </div>
                                    </div>
                            <?php endif ?>

                       </div>
               </div>
                   
           </nav>

    </header>
<div class="container mt-4">
        <?= $content ?>
    </div>
</body>
</html>