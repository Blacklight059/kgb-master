<header class="container-fluid header">
        <a href="img/logo.jpg" target="" class="col header-logo">
            <img src="img/logo.jpg" alt="Logo du site" id="logo">
        </a>
        <nav class="row  row-cols-2-lg main-nav container-fluid navbar navbar-expand-md navbar-dark bg-dark">
               
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
                       <div class="nav-item dropdown">
                           <a href="<?= $router->url('admin_posts') ?>" class="nav-link dropdown-toggle col" data-bs-toggle="dropdown">Missions et personnes</a>
                           <div class="dropdown-menu">
                               <a href="<?= $router->url('admin_posts') ?>" class="dropdown-item">Missions</a>
                               <a href="<?= $router->url('admin_contacts') ?>" class="dropdown-item">Contact</a>
                               <a href="<?= $router->url('admin_cibles') ?>" class="dropdown-item">Cibles</a>
                           </div>
                       </div>
   
                           <div class="nav-item dropdown">
                               <a href="" class="nav-link dropdown-toggle col" data-bs-toggle="dropdown">Donées de missions</a>
                               <div class="dropdown-menu">
                                   <a href="<?= $router->url('admin_types') ?>" class="dropdown-item">Type de mission</a>
                                   <a href="<?= $router->url('admin_nationalites') ?>" class="dropdown-item">Natioonalités</a>
                                   <a href="<?= $router->url('admin_specialites') ?>" class="dropdown-item">Spécialités</a>
                                   <a href="<?= $router->url('admin_planques') ?>" class="dropdown-item">Planques</a>
                                   <a href="<?= $router->url('admin_payss') ?>" class="dropdown-item">Pays</a>
                                   <a href="<?= $router->url('admin_typeplanques') ?>" class="dropdown-item">Type de planque</a>

                               </div>
                           </div>
                       </div>
               </div>
                   
           </nav>

    </header>

