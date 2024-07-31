<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Nationalite;

final class NationaliteTable extends Table {

    protected $table = "nationalite";
    protected $class = Nationalite::class;

    public function createNationalite (Nationalite $nationalite)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name");
        $ok = $query->execute([
            'name' => $nationalite->getName()
        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        $nationalite->setId($this->pdo->lastInsertId());
    }

    public function updateNationalite (Nationalite $nationalite)
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id");
        $ok = $query->execute([
            'id' => $nationalite->getId(),            
            'name' => $nationalite->getName()
        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de modifier l'enregistreemnt dans la table {$this->table}");
        }
    }

    public function delete (int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $ok = $query->execute([$id]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de supprimer l'enregistreemnt $id dans la table {$this->table}");
        }
    }


    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery (
            "SELECT * FROM {$this->table} ORDER BY date_debut DESC",
            "SELECT COUNT(id) FROM {$this->table}",
            Nationalite::class
    
        );

       return;

        $nationalites = $paginatedQuery->getItems(Nationalite::class);
        $nationaliteById = [];
        foreach($nationalites as $nationalite) {
            $nationaliteById[$nationalite->getId()] = $nationalite;
        }
        return [$nationalites, $paginatedQuery];

    }
}