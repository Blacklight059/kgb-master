<?php
namespace App\Models;

class User {

    private $id;
    private $pseudo;
    private $lastname;
    private $firstname;
    private $email;
    private $password;

    public function getId (): ?int {
        return $this->id;
    }

    public function setId(int $id)
    {
       $this->id = $id;
       return $this;   
    }
 
    public function getPseudo ()
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
       $this->pseudo = $pseudo;
       return $this;   
    }

    public function getLastname (): ?string {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
       $this->lastname = $lastname;
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

    public function getEmail (): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
       $this->email = $email;
       return $this;   
    }

    public function getPassword (): ?string {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
       $this->password = $password;
       return $this;   
    }

}