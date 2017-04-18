<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commission
 *
 * @ORM\Table(name="commission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommissionRepository")
 */
class Commission
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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var int
     *
     * @ORM\Column(name="creationTime", type="integer")
     */
    private $creationTime;

    /**
     * @var int
     *
     * @ORM\Column(name="completionTime", type="integer", nullable=true)
     */
    private $completionTime;

    /**
     * @var int
     *
     * @ORM\Column(name="copies", type="integer", nullable=false)
     */
    private $copies;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="commissions")
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\State", inversedBy="commissions")
     */
    private $state;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Paper", inversedBy="commissions")
     */
    private $paper;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Format", inversedBy="commissions")
     */
    private $format;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Shipment", inversedBy="commissions")
     */
    private $shipment;
    
    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float", nullable=false)
     */
    private $value;
    
    /**
     *
     * @ORM\Column(name="discount_coupon", type="string", length=255, nullable=true)
     */
    private $discountCoupon;
    
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
     * @return Commission
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
     * Set filename
     *
     * @param string $filename
     * @return Commission
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set creationTime
     *
     * @param integer $creationTime
     * @return Commission
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return integer 
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set completionTime
     *
     * @param integer $completionTime
     * @return Commission
     */
    public function setCompletionTime($completionTime)
    {
        $this->completionTime = $completionTime;

        return $this;
    }

    /**
     * Get completionTime
     *
     * @return integer 
     */
    public function getCompletionTime()
    {
        return $this->completionTime;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Commission
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set copies
     *
     * @param integer $copies
     * @return Commission
     */
    public function setCopies($copies)
    {
        $this->copies = $copies;

        return $this;
    }

    /**
     * Get copies
     *
     * @return integer 
     */
    public function getCopies()
    {
        return $this->copies;
    }

    /**
     * Set state
     *
     * @param \AppBundle\Entity\Commission $state
     * @return Commission
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \AppBundle\Entity\Commission 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set paper
     *
     * @param \AppBundle\Entity\Paper $paper
     * @return Commission
     */
    public function setPaper(\AppBundle\Entity\Paper $paper)
    {
        $this->paper = $paper;

        return $this;
    }

    /**
     * Get paper
     *
     * @return \AppBundle\Entity\Paper 
     */
    public function getPaper()
    {
        return $this->paper;
    }

    /**
     * Set format
     *
     * @param \AppBundle\Entity\Format $format
     * @return Commission
     */
    public function setFormat(\AppBundle\Entity\Format $format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return \AppBundle\Entity\Format 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set shipment
     *
     * @param \AppBundle\Entity\Shipment $shipment
     * @return Commission
     */
    public function setShipment(\AppBundle\Entity\Shipment $shipment)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * Get shipment
     *
     * @return \AppBundle\Entity\Shipment 
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return Commission
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set discountCoupon
     *
     * @param string $discountCoupon
     * @return Commission
     */
    public function setDiscountCoupon($discountCoupon)
    {
        $this->discountCoupon = $discountCoupon;

        return $this;
    }

    /**
     * Get discountCoupon
     *
     * @return string 
     */
    public function getDiscountCoupon()
    {
        return $this->discountCoupon;
    }
    
    
}
