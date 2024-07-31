<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Specialite;

final class SpecialiteTable extends Table {

    protected $table = "specialite";
    protected $class = Specialite::class;

    public function createType (Specialite $specialite)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name");
        $ok = $query->execute([
            'name' => $specialite->getName()
        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        $specialite->setId($this->pdo->lastInsertId());
    }

    public function updateType (Specialite $specialite)
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id");
        $ok = $query->execute([
            'id' => $specialite->getId(),            
            'name' => $specialite->getName()
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
            "SELECT * FROM {$this->table} ORDER BY id",
            "SELECT COUNT(id) FROM {$this->table}",
            Specialite::class
    
        );

       return;

        $specialites = $paginatedQuery->getItems(Specialite::class);
        $typeById = [];
        foreach($specialites as $specialite) {
            $typeById[$specialite->getId()] = $specialite;
        }
        return [$specialites, $paginatedQuery];

    }

    public function list(): array
    {
        $types = $this->all();
        $results = [];
        foreach($types as $type) {
            $results[$type->getId()] = $type->getName();
        }
        return $results;
    } 
}