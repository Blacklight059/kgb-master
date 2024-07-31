<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Post;

final class PostTable extends Table {

    protected $table = "missions";
    protected $class = Post::class;

    public function createPost (Post $post): void
    {
        $id = $this->create([
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'nom_de_code' => $post->getNomdecode(),
            'agents' => $post->getAgents(),
            'cibles' => $post->getCibles(),
            'contacts' => $post->getContacts(),
            'date_debut' => $post->getDatedebut(),
            'date_fin' => $post->getDatefin(),
            'specialite_id' => $post->getSpecialite(),
            'type_mission_id' => $post->getTypesmission(),
            'statuts_id' => $post->getStatutsid(),
            'planque_id' => $post->getPlanqueid()

        ]);
        $post->setId($id);
    }

    public function updatePost (Post $post): void
    {
        $this->update([
            'id' => $post->getId(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'nom_de_code' => $post->getNomdecode(),
            'agents' => $post->getAgents(),
            'cibles' => $post->getCibles(),
            'contacts' => $post->getContacts(),
            'date_debut' => $post->getDatedebut(),
            'date_fin' => $post->getDatefin(),
            'specialite_id' => $post->getSpecialite(),
            'type_mission_id' => $post->getTypesmission(),
            'statuts_id' => $post->getStatutsid(),
            'planque_id' => $post->getPlanqueid(),

        ], $post->getId());
    }

    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery (
            "SELECT * FROM missions ORDER BY id",
            "SELECT COUNT(id) FROM missions",
            Post::class
    
        );

       return;

        $posts = $paginatedQuery->getItems(Post::class);
        $postsbyID = [];
        foreach($posts as $post) {
            $postsbyID[$post->getId()] = $post;
        }
        return [$posts, $paginatedQuery];

    }

    public function listMission(): array
    {
        $types = $this->all();
        $results = [];
        foreach($types as $type) {
            $results[$type->getId()] = $type->getNomdecode();
        }
        return $results;
    } 

}