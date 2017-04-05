<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiscountCoupon
 *
 * @ORM\Table(name="discount_coupon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiscountCouponRepository")
 */
class DiscountCoupon
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
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @var bool
     *
     * @ORM\Column(name="used", type="boolean")
     */
    private $used;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="value_in_percent", type="integer")
     */
    private $valueInPercent;

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
     * Set code
     *
     * @param string $code
     * @return DiscountCoupon
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set used
     *
     * @param boolean $used
     * @return DiscountCoupon
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return boolean 
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return DiscountCoupon
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
     * Set valueInPercent
     *
     * @param integer $valueInPercent
     * @return DiscountCoupon
     */
    public function setValueInPercent($valueInPercent)
    {
        $this->valueInPercent = $valueInPercent;

        return $this;
    }

    /**
     * Get valueInPercent
     *
     * @return integer 
     */
    public function getValueInPercent()
    {
        return $this->valueInPercent;
    }
}
