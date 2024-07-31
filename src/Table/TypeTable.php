<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Type;

final class TypeTable extends Table {

    protected $table = "types_mission";
    protected $class = Type::class;

    public function createType (Type $type)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name");
        $ok = $query->execute([
            'name' => $type->getName()
        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        $type->setId($this->pdo->lastInsertId());
    }

    public function updateType (Type $type)
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id");
        $ok = $query->execute([
            'id' => $type->getId(),            
            'name' => $type->getName()
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
            Type::class
    
        );

       return;

        $types = $paginatedQuery->getItems(Type::class);
        $typeById = [];
        foreach($types as $type) {
            $typeById[$type->getId()] = $type;
        }
        return [$types, $paginatedQuery];

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