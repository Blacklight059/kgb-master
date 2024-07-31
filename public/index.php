<?php
require '../vendor/autoload.php';
$router = new AltoRouter(); 

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if (isset($_GET['page']) && $_GET['page'] === '1') {
    //réécrire l'url
    $uri = explode("?", $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query)) {
        $uri = $uri. '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

$router = new App\Router(dirname(__DIR__) . '/');
$router
    ->get('/', 'views/post/index', 'home')
    ->get('/[*:slug]-[i:id]', 'views/post/mission', 'mission')
    // ADMIN
    ->match('/admin', 'views/auth/admin', 'admin')
    ->match('/admin_inscription', 'views/auth/inscription', 'admin_inscription')
    ->match('/admin_inscription_traitement', 'views/auth/inscription_traitement', 'admin_inscription_traitement')
    ->match('/admin_landing', 'views/post/landing', 'admin_landing')
    ->match('/admin_deconnexion', 'views/auth/deconnexion', 'admin_deconnexion')



    // Gestion des missions
    ->match('/admin_posts', 'views/admin/post/index', 'admin_posts')
    ->match('/post/[i:id]', 'views/admin/post/edit', 'admin_post')
    ->post('/post/[i:id]/delete', 'views/admin/post/delete', 'admin_post_delete')
    ->match('/post/new', 'views/admin/post/new', 'admin_post_new')
    
    // Gestion des contacts
    ->get('/admin_contacts', 'views/admin/contact/index', 'admin_contacts')
    ->match('/admin/contact/[i:id]', 'views/admin/contact/edit', 'admin_contact')
    ->post('/admin/contact/[i:id]/delete', 'views/admin/contact/delete', 'admin_contact_delete')
    ->match('/admin/contact/new', 'views/admin/contact/new', 'admin_contact_new')
    
    // Gestion des nationalités
    ->get('/admin_nationalites', 'views/admin/nationalite/index', 'admin_nationalites')
    ->match('/admin/nationalite/[i:id]', 'views/admin/nationalite/edit', 'admin_nationalite')
    ->post('/admin/nationalite/[i:id]/delete', 'views/admin/nationalite/delete', 'admin_nationalite_delete')
    ->match('/admin/nationalite/new', 'views/admin/nationalite/new', 'admin_nationalite_new')
    
    // Gestion des types
    ->get('/admin_types', 'views/admin/type/index', 'admin_types')
    ->match('/admin/type/[i:id]', 'views/admin/type/edit', 'admin_type')
    ->post('/admin/type/[i:id]/delete', 'views/admin/type/delete', 'admin_type_delete')
    ->match('/admin/type/new', 'views/admin/type/new', 'admin_type_new')

    // Gestion des specialites
    ->get('/admin_specialites', 'views/admin/specialite/index', 'admin_specialites')
    ->match('/admin/specialite/[i:id]', 'views/admin/specialite/edit', 'admin_specialite')
    ->post('/admin/specialite/[i:id]/delete', 'views/admin/specialite/delete', 'admin_specialite_delete')
    ->match('/admin/specialite/new', 'views/admin/specialite/new', 'admin_specialite_new')

    // Gestion des cibles
    ->get('/admin_cibles', 'views/admin/cible/index', 'admin_cibles')
    ->match('/admin/cible/[i:id]', 'views/admin/cible/edit', 'admin_cible')
    ->post('/admin/cible/[i:id]/delete', 'views/admin/cible/delete', 'admin_cible_delete')
    ->match('/admin/cible/new', 'views/admin/cible/new', 'admin_cible_new')


    // Gestion des agents
    ->get('/admin_agents', 'views/admin/agent/index', 'admin_agents')
    ->match('/admin/agent/[i:id]', 'views/admin/agent/edit', 'admin_agent')
    ->post('/admin/agent/[i:id]/delete', 'views/admin/agent/delete', 'admin_agent_delete')
    ->match('/admin/agent/new', 'views/admin/agent/new', 'admin_agent_new')

    // Gestion des planques
    ->get('/admin_planques', 'views/admin/planque/index', 'admin_planques')
    ->match('/admin/planque/[i:id]', 'views/admin/planque/edit', 'admin_planque')
    ->post('/admin/planque/[i:id]/delete', 'views/admin/planque/delete', 'admin_planque_delete')
    ->match('/admin/planque/new', 'views/admin/planque/new', 'admin_planque_new')
    
    // Gestion des statuts de mission
    ->get('/admin_statuts', 'views/admin/statut/index', 'admin_statuts')
    ->match('/admin/statut/[i:id]', 'views/admin/statut/edit', 'admin_statut')
    ->post('/admin/statut/[i:id]/delete', 'views/admin/statut/delete', 'admin_statut_delete')
    ->match('/admin/statut/new', 'views/admin/statut/new', 'admin_statut_new')
        
    // Gestion des pays de la mission
    ->get('/admin_payss', 'views/admin/pays/index', 'admin_payss')
    ->match('/admin/pays/[i:id]', 'views/admin/pays/edit', 'admin_pays')
    ->post('/admin/pays/[i:id]/delete', 'views/admin/pays/delete', 'admin_pays_delete')
    ->match('/admin/pays/new', 'views/admin/pays/new', 'admin_pays_new')
      
    // Gestion des types de planque mission
    ->get('/admin_typeplanques', 'views/admin/typeplanque/index', 'admin_typeplanques')
    ->match('/admin/typeplanque/[i:id]', 'views/admin/typeplanque/edit', 'admin_typeplanque')
    ->post('/admin/typeplanque/[i:id]/delete', 'views/admin/typeplanque/delete', 'admin_typeplanque_delete')
    ->match('/admin/typeplanque/new', 'views/admin/typeplanque/new', 'admin_typeplanque_new')
    
    ->run();    

?>