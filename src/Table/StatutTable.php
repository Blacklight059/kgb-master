<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Statut;

final class StatutTable extends Table {

    protected $table = "statuts";
    protected $class = Statut::class;

    public function createType (Statut $statut)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name");
        $ok = $query->execute([
            'name' => $statut->getName()
        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        $statut->setId($this->pdo->lastInsertId());
    }

    public function updateType (Statut $statut)
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id");
        $ok = $query->execute([
            'id' => $statut->getId(),            
            'name' => $statut->getName()
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

        $statuts = $paginatedQuery->getItems(Type::class);
        $statutById = [];
        foreach($statuts as $statut) {
            $statutById[$statut->getId()] = $statut;
        }
        return [$statuts, $paginatedQuery];

    }

    public function list(): array
    {
        $statuts = $this->all();
        $results = [];
        foreach($statuts as $statut) {
            $results[$statut->getId()] = $statut->getName();
        }
        return $results;
    } 
}