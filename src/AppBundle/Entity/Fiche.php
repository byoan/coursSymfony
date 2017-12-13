<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fiche
 *
 * @ORM\Table(name="fiche")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FicheRepository")
 */
class Fiche
{
    /**
     * Many Fiches have One Manager.
     * @ORM\ManyToOne(targetEntity="Manager", inversedBy="fiches")
     * @ORM\JoinColumn(name="manager_id", referencedColumnName="id")
     */
    private $manager;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * Many Fiches have One Project.
     * @ORM\ManyToOne(targetEntity="Projet", inversedBy="fiches")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ficheDate", type="date")
     */
    private $ficheDate;

    /**
     * @var float
     *
     * @ORM\Column(name="nbDayDone", type="float")
     * @Assert\GreaterThan(0)
     */
    private $nbDayDone;

    /**
     * @var float
     *
     * @ORM\Column(name="nbDaySold", type="float")
     * @Assert\GreaterThan(0)
     */
    private $nbDaySold;

    /**
     * @var float
     *
     * @ORM\Column(name="progression", type="float")
     * @Assert\GreaterThanOrEqual(0)
     */
    private $progression;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Fiche
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set ficheDate
     *
     * @param \DateTime $ficheDate
     *
     * @return Fiche
     */
    public function setFicheDate($ficheDate)
    {
        $this->ficheDate = $ficheDate;

        return $this;
    }

    /**
     * Get ficheDate
     *
     * @return \DateTime
     */
    public function getFicheDate()
    {
        return $this->ficheDate;
    }

    /**
     * Set nbDayDone
     *
     * @param float $nbDayDone
     *
     * @return Fiche
     */
    public function setNbDayDone($nbDayDone)
    {
        $this->nbDayDone = $nbDayDone;

        return $this;
    }

    /**
     * Get nbDayDone
     *
     * @return float
     */
    public function getNbDayDone()
    {
        return $this->nbDayDone;
    }

    /**
     * Set nbDaySold
     *
     * @param float $nbDaySold
     *
     * @return Fiche
     */
    public function setNbDaySold($nbDaySold)
    {
        $this->nbDaySold = $nbDaySold;

        return $this;
    }

    /**
     * Get nbDaySold
     *
     * @return float
     */
    public function getNbDaySold()
    {
        return $this->nbDaySold;
    }

    /**
     * Set progression
     *
     * @param float $progression
     *
     * @return Fiche
     */
    public function setProgression($progression)
    {
        $this->progression = $progression;

        return $this;
    }

    /**
     * Get progression
     *
     * @return float
     */
    public function getProgression()
    {
        return $this->progression;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Fiche
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Fiche
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set manager
     *
     * @param \AppBundle\Entity\Manager $manager
     *
     * @return Fiche
     */
    public function setManager(\AppBundle\Entity\Manager $manager = null)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return \AppBundle\Entity\Manager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Projet $project
     *
     * @return Fiche
     */
    public function setProject(\AppBundle\Entity\Projet $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Projet
     */
    public function getProject()
    {
        return $this->project;
    }

    public function __toString()
    {
        return $this->comment;
    }
}
