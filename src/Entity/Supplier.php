<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierRepository::class)
 */
class Supplier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="text")
     */
    private $name;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $email;

     /**
     * @ORM\Column(type="integer", length=25)
     */
    private $phone;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mode;

    
    /**
     * @ORM\Column(type="string")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this-> name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this-> email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this-> phone = $phone;
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this-> type = $type;
    }

    public function getMode()
    {
        return $this->mode;
    }
    public function setMode($mode)
    {
        $this-> mode = $mode;
    }

    public function getCreated()
    {
        return $this->created_at;
    }
    public function setCreated($created_at)
    {
        $this-> created_at = $created_at;
    }

    public function getUpdated()
    {
        return $this->updated_at;
    }
    public function setUpdated($updated_at)
    {
        $this-> updated_at = $updated_at;
    }
}
