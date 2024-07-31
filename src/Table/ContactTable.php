<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Models\Contact;

final class ContactTable extends Table {

    protected $table = "contacts";
    protected $class = Contact::class;

    public function createContact (Contact $contact)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name, firstname = :firstname, nom_de_code = :nom_de_code");
        $ok = $query->execute([
            'name' => $contact->getName(),
            'firstname' =>$contact->getFirstname(),
            'nom_de_code' =>$contact->getNomdecode()

        ]);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        $contact->setId($this->pdo->lastInsertId());
    }

    public function updateContact (Contact $contact)
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name, firstname = :firstname, nom_de_code = :nom_de_code WHERE id = :id");
        $ok = $query->execute([
            'id' => $contact->getId(),            
            'name' => $contact->getName(),
            'firstname' =>$contact->getFirstname(),
            'nom_de_code' =>$contact->getNomdecode()
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

        $contacts = $paginatedQuery->getItems(Contact::class);
        $contactbyID = [];
        foreach($contacts as $contact) {
            $contactbyID[$contact->getId()] = $contact;
        }
        return [$contacts, $paginatedQuery];

    }
}