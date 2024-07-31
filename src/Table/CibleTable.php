<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Cible;

final class CibleTable extends Table {

    protected $table = "cibles";
    protected $class = Cible::class;

    public function createCible (Cible $cible)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name, firstname = :firstname, nom_de_code = :nom_de_code");
        $ok = $query->execute([
            'name' => $cible->getName(),
            'firstname' =>$cible->getFirstname(),
            'nom_de_code' =>$cible->getNomdecode(),
            'date_naissance' =>$cible->getDatenaissance(),
            'nationalite_id' =>$cible->getNationaliteid(),
            'mission_id' =>$cible->getMissionid()

        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        $cible->setId($this->pdo->lastInsertId());
    }

    public function updateCible (Cible $cible)
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name, firstname = :firstname, nom_de_code = :nom_de_code WHERE id = :id");
        $ok = $query->execute([
            'id' => $cible->getId(),            
            'name' => $cible->getName(),
            'firstname' =>$cible->getFirstname(),
            'nom_de_code' =>$cible->getNomdecode(),
            'date_naissance' =>$cible->getDatenaissance(),
            'nationalite_id' =>$cible->getNationaliteid(),
            'mission_id' =>$cible->getMissionid()
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
            "SELECT * FROM missions ORDER BY date_debut DESC",
            "SELECT COUNT(id) FROM missions",
            Contact::class
    
        );

       return;

        $cibles = $paginatedQuery->getItems(Contact::class);
        foreach($cibles as $cible) {
            $contactbyID[$cible->getId()] = $cible;
        }
        return [$cibles, $paginatedQuery];

    }
}