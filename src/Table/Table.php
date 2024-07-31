<?php
namespace App\Table;

use App\Config;
use App\Table\Exception\NotFoundException;
use \PDO;

abstract class Table {

    protected $pdo;
    protected $class = null;
    protected $table = null;

    public function __construct(PDO $pdo)
    {
        if ($this->table === null) {
            throw new \Exception("La class ". get_class($this) . " n'a pas de propriété \$table");
        }
        if ($this->class === null) {
            throw new \Exception("La class ". get_class($this) . " n'a pas de propriété \$class");
        }
        $this->pdo = $pdo;
    }

    public function find (int $id) 
    {

        $pdo = Config::getPDO();
        $query = $pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch() ?: null;

        
        if ($result === false) {
            throw new NotFoundException($this->table, $id);
        }
        return $result;
    }

    public function exists (string $field, $value, ?int $except = null) :bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} XHERE $field = ?";
        $params = [$value];
        if($except !== null) {
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    public function all (): array 
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
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

    public function create (array $data)
    {
        $sqlfields = [];
        foreach ($data as $key => $value) {
            $sqlfields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET " . implode(',',  $sqlfields));
        $ok = $query->execute($data);
        if ($ok === false)
        {
            throw new \Exception("Impossible de créer l'enregistreemnt dans la table {$this->table}");
        }

        return (int)$this->pdo->lastInsertId();
    }

    public function update (array $data, int $id)
    {
        $sqlfields = [];
        foreach ($data as $k => $v) {
            $sqlfields[] = "$k = :$k";
        }
        $query = $this->pdo->prepare("UPDATE {$this->table} SET  " . implode(',',  $sqlfields) . " WHERE id = :id");
        $ok = $query->execute(array_merge($data, ['id' => $id]));
        if ($ok === false)
        {
            throw new \Exception("Impossible de modifier l'enregistreemnt dans la table {$this->table}");
        }
    }
    
    public function list(): array
    {
        $items = $this->all();
        $results = [];
        foreach($items as $item) {
            $results[$item->getId()] = $item->getName();
        }
        return $results;
    } 

}

?>