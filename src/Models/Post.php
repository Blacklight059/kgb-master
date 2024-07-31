<?php
namespace App\Models;

use App\Helpers\Text;
use DateTime;

class Post {

    private $id;
    private $slug;
    private $title;    
    private $content;
    private $nom_de_code;
    private $nbres_cibles;
    private $agents;
    private $nbres_contacts;
    private $date_debut;
    private $date_fin;
    private $type_mission_id;
    private $specialite_id;
    private $statuts_id;
    private $planque_id;


   public function getTitle(): ?string
   {
      return $this->title;
   }
   public function setTitle(string $title): self
   {
      $this->title = $title;
      return $this;   
   }

   public function getFormattedContent(): ?string
   {
      return nl2br(htmlentities($this->content));
   }

     public function getExcerpt(): ?string
     {
        if ($this->content === null) {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
     }
     public function getDatedebut(): DateTime
     {
        return new DateTime($this->date_debut);
     }
     public function setDatedebut(string $date_debut): self
     {
        $this->date_debut = $date_debut;

        return $this;
   
     }
     public function getDatefin(): DateTime
     {
        return new DateTime($this->date_fin);
     }
     public function setDatefin(string $date_fin): self
     {
        $this->date_fin = $date_fin;

        return $this;
   
     }
     public function getSlug (): ?string
     {
        return $this->slug;
     }
     public function setSlug (string $slug): self
     {
        $this->slug = $slug;
        return $this;
     }
     public function getNomdecode (): ?string
     {
        return $this->nom_de_code;
     }
     public function setNomdecode (string $nom_de_code): self
     {
        $this->nom_de_code = $nom_de_code;
        return $this;
     }
     public function getCibles (): ?string
     {
        return $this->nbres_cibles;
     }
     public function setCibles (string $nbres_cibles): self
     {
        $this->nbres_cibles = $nbres_cibles;
        return $this;
     }
     public function getAgents (): ?string
     {
        return $this->agents;
     }
     public function setAgents (string $agents): self
     {
        $this->agents = $agents;
        return $this;
     }
     public function getContacts (): ?string
     {
        return $this->nbres_contacts;
     }
     public function setContacts (string $nbres_contacts): self
     {
        $this->nbres_contacts = $nbres_contacts;
        return $this;
     }
     public function getContent (): ?string
     {
        return $this->content;
        
     }
     public function setContent (string $content): self
     {
        $this->content = $content;
        return $this;
     }
     public function getId(): ?int
     {
        return $this->id;
     }

     public function setId(int $id): self
     {
      $this->id = $id;
      return $this;     }

      public function getTypesmission (): ?string {
         return $this->type_mission_id;
     }
 
     public function setTypesmission(string $type_mission_id): self
     {
        $this->type_mission_id = $type_mission_id;
        return $this;   
     }

      public function getSpecialite (): ?string {
         return $this->specialite_id;
      }

      public function setSpecialite(string $specialite_id): self
      {
         $this->specialite_id = $specialite_id;
         return $this;   
      }
      public function getStatutsid (): ?string {
         return $this->statuts_id;
      }

      public function setStatusid(string $statuts_id): self
      {
         $this->statuts_id = $statuts_id;
         return $this;   
      }
      public function getPlanqueid (): ?string {
         return $this->planque_id;
      }

      public function setPlanquesid(string $planque_id): self
      {
         $this->planque_id = $planque_id;
         return $this;   
      }

    
}