<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Commission;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commission", mappedBy="user")
     */
    private $commissions;


    public function __construct()
    {
        parent::__construct();
        $this->commissions = new ArrayCollection();
    }

    /**
     * Add commissions
     *
     * @param \AppBundle\Entity\Commission $commissions
     * @return User
     */
    public function addCommission(Commission $commissions)
    {
        $this->commissions[] = $commissions;

        return $this;
    }

    /**
     * Remove commissions
     *
     * @param \AppBundle\Entity\Commission $commissions
     */
    public function removeCommission(Commission $commissions)
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
}
