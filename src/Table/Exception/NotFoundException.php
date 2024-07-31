<?php
namespace App\Table\Exception;

class NotFoundException extends \Exception {

    public function __construct(string $table)
    {
        $this->message = "Aucun enregistrement ne correspond dans la table '$table'";
    }
}