<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Format
 *
 * @ORM\Table(name="format")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormatRepository")
 */
class Format
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
     * @var string
     *
     * @ORM\Column(name="recommended_resolution", type="string", length=255)
     */    
    private $recommendedResolution;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commission", mappedBy="format")
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
     * @return Format
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
     * @return Format
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
     * Set recommendedResolution
     *
     * @param string $recommendedResolution
     * @return Format
     */
    public function setRecommendedResolution($recommendedResolution)
    {
        $this->recommendedResolution = $recommendedResolution;

        return $this;
    }

    /**
     * Get recommendedResolution
     *
     * @return string 
     */
    public function getRecommendedResolution()
    {
        return $this->recommendedResolution;
    }
}
