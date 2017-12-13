<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetRepository")
 */
class Projet
{
    /**
     * One Projet has Many Fiche.
     * @ORM\OneToMany(targetEntity="Fiche", mappedBy="project")
     */
    private $fiches;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="projectName", type="string", length=255)
     */
    private $projectName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBegin", type="date")
     */
    private $dateBegin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="date")
     */
    private $dateEnd;

    public function __construct()
    {
        $this->dateBegin = new \Datetime();
        $this->dateEnd = new \Datetime();
        $this->fiches = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->projectName;
    }

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
     * @return Projet
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
     * Set dateBegin
     *
     * @param \DateTime $dateBegin
     *
     * @return Projet
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return \DateTime
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Projet
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Add fich
     *
     * @param \AppBundle\Entity\Fiche $fich
     *
     * @return Projet
     */
    public function addFich(\AppBundle\Entity\Fiche $fich)
    {
        $this->fiches[] = $fich;

        return $this;
    }

    /**
     * Remove fich
     *
     * @param \AppBundle\Entity\Fiche $fich
     */
    public function removeFich(\AppBundle\Entity\Fiche $fich)
    {
        $this->fiches->removeElement($fich);
    }

    /**
     * Get fiches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiches()
    {
        return $this->fiches;
    }

    public function getProgression()
    {
        $maxProgression = 0;
        foreach ($this->fiches as $fiche) {
            if ($fiche->getProgression() > $maxProgression) {
                $maxProgression = $fiche->getProgression();
            }
        }
        return $maxProgression;
    }
}
