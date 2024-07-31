<?php

namespace App\Models;

class Planque {

    private $id;

    private $code;

    private $adresse;
    private $pays_id;
    private $type_planque_id;


    public function getId (): ?int {
        return $this->id;
    }

    public function setId(int $id)
    {
       $this->id = $id;
       return $this;   
    }
 
    public function getCode (): ?string {
        return $this->code;
    }

    public function setCode(string $code): self
    {
       $this->code = $code;
       return $this;   
    }

    public function getAdresse (): ?string {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
       $this->adresse = $adresse;
       return $this;   
    }

    public function getPaysid (): ?string {
        return $this->pays_id;
    }

    public function setPaysid(string $pays_id): self
    {
       $this->pays_id = $pays_id;
       return $this;   
    }

    public function getTypeplanque (): ?string {
        return $this->type_planque_id;
    }

    public function setTypeplanque(string $type_planque_id): self
    {
       $this->type_planque_id = $type_planque_id;
       return $this;   
    }

}