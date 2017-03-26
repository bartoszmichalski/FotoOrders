<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Paper
 *
 * @ORM\Table(name="paper")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaperRepository")
 */
class Paper
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commission", mappedBy="paper")
     */
    private $commissions;


    public function __construct()
    {
        $this->commissions = new ArrayCollection();
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

    /**
     * Set description
     *
     * @param string $description
     * @return Paper
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
     * Add commissions
     *
     * @param \AppBundle\Entity\Commission $commissions
     * @return Paper
     */
    public function addCommission(\AppBundle\Entity\Commission $commissions)
    {
        $this->commissions[] = $commissions;

        return $this;
    }

    /**
     * Remove commissions
     *
     * @param \AppBundle\Entity\Commission $commissions
     */
    public function removeCommission(\AppBundle\Entity\Commission $commissions)
    {
        $this->commissions->removeElement($commissions);
    }

    /**
     * Get commissions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommissions()
    {
        return $this->commissions;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Paper
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
}
