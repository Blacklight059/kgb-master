<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Planque;

final class PlanqueTable extends Table {

    protected $table = "planques";
    protected $class = Planque::class;

    public function createPlanque (Planque $planque)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name");
        $ok = $query->execute([
            'name' => $planque->getCode()
        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        $planque->setId($this->pdo->lastInsertId());
    }

    public function updatePlanque (Planque $planque)
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id");
        $ok = $query->execute([
            'id' => $planque->getId(),            
            'name' => $planque->getCode()
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
            Planque::class
    
        );

       return;

        $planques = $paginatedQuery->getItems(Planque::class);
        $PlanqueById = [];
        foreach($planques as $planque) {
            $planqueById[$planque->getId()] = $planque;
        }
        return [$planques, $paginatedQuery];

    }

    public function list(): array
    {
        $types = $this->all();
        $results = [];
        foreach($types as $type) {
            $results[$type->getId()] = $type->getCode();
        }
        return $results;
    } 
}