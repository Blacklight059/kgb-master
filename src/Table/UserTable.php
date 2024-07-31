<?php

namespace App\Table;

use App\Models\User;
use App\Table\Exception\NotFoundException;

final class UserTable extends Table {

    protected $table = "utilisateurs";
    protected $class = User::class;

    public function findByemail (string $user)
    {

        $query = $this->pdo->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE pseudo = :pseudo');
        $query->execute(['pseudo' => $user]);
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();

        if ($result === false) {
            throw new NotFoundException($this->table, $user);
        }
        return $result; 
    }


}