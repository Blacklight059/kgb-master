<?php
namespace App\Models;

class Contact {

    private $id;
    private $name;
    private $firstname;
    private $nom_de_code;
    private $nationalite_id;
    private $mission_id;
    private $planque_id;

    public function getId (): ?int {
        return $this->id;
    }

    public function setId(int $id)
    {
       $this->id = $id;
       return $this;   
    }
 
    public function getName (): ?string {
        return $this->name;
    }

    public function setName(string $name): self
    {
       $this->name = $name;
       return $this;   
    }
 
    public function getFirstname (): ?string {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
       $this->firstname = $firstname;
       return $this;   
    }

    public function getNomdecode (): ?string {
        return $this->nom_de_code;
    }
    
    public function setNomdecode(string $nom_de_code): self
    {
       $this->nom_de_code = $nom_de_code;
       return $this;   
    }

    public function getNationaliteid (): ?string {
        return $this->nationalite_id;
    }
    
    public function setNationaliteid(string $nationalite_id): self
    {
       $this->nationalite_id = $nationalite_id;
       return $this;   
    }

    public function getMissionid (): ?string {
        return $this->mission_id;
    }
    
    public function setMissionid(string $mission_id): self
    {
       $this->mission_id = $mission_id;
       return $this;   
    }

    public function getPlanqueid (): ?string {
        return $this->planque_id;
    }
    
    public function setPlanqueid(string $planque_id): self
    {
       $this->planque_id = $planque_id;
       return $this;   
    }

}