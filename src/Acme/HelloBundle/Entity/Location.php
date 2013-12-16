<?php

namespace Acme\HelloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class location
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="maker_id", type="integer")
     */
    private $makerId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=15)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=20)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="avenue", type="string", length=20)
     */
    private $avenue;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=15)
     */
    private $contact;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set makerId
     *
     * @param integer $makerId
     * @return Entity
     */
    public function setMakerId($makerId)
    {
        $this->makerId = $makerId;
    
        return $this;
    }

    /**
     * Get makerId
     *
     * @return integer 
     */
    public function getMakerId()
    {
        return $this->makerId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Entity
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Entity
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set avenue
     *
     * @param string $avenue
     * @return Entity
     */
    public function setAvenue($avenue)
    {
        $this->avenue = $avenue;
    
        return $this;
    }

    /**
     * Get avenue
     *
     * @return string 
     */
    public function getAvenue()
    {
        return $this->avenue;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Entity
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Entity
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }
}
