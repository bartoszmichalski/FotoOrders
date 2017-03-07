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
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

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
     * Set status
     *
     * @param integer $status
     * @return Commission
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
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
    public function setUser(\AppBundle\Entity\User $user = null)
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
}
