<?php

namespace Acme\HelloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 */
class Location
{
    /**
     * @var integer
     */
    //private $makersId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $avenue;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set makersId
     *
     * @param integer $makersId
     * @return Location
     
    public function setMakersId($makersId)
    {
        $this->makersId = $makersId;
    
        return $this;
    }*/

    /**
     * Get makersId
     *
     * @return integer 
     
    public function getMakersId()
    {
        return $this->makersId;
    }
*/
    /**
     * Set title
     *
     * @param string $title
     * @return Location
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
     * @return Location
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
     * @return Location
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
     * @return Location
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
     * @return Location
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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}