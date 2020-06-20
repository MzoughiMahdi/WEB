<?php

namespace ProfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Abs
 *
 * @ORM\Table(name="abs")
 * @ORM\Entity
 */
class Abs
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
     * @ORM\Column(name="matiere", type="string", length=255)
     */
    private $matiere;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", length=255)
     */
    private $classe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="hdep", type="string", length=255)
     *@Assert\LessThan(
     *     propertyPath="hfin"
     * )
     */
    private $hdep;

    /**
     * @var string
     *
     * @ORM\Column(name="hfin", type="string", length=255)
     *@Assert\GreaterThan(
     *     propertyPath="hdep"
     * )
     */
    private $hfin;


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
     * Set matiere
     *
     * @param string $matiere
     *
     * @return Abs
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }



    /**
     * Set classe
     *
     * @param string $classe
     *
     * @return Abs
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Abs
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set hdep
     *
     * @param string $hdep
     *
     * @return Abs
     */
    public function setHdep($hdep)
    {
        $this->hdep = $hdep;

        return $this;
    }

    /**
     * Get hdep
     *
     * @return string
     */
    public function getHdep()
    {
        return $this->hdep;
    }

    /**
     * Set hfin
     *
     * @param string $hfin
     *
     * @return Abs
     */
    public function setHfin($hfin)
    {
        $this->hfin = $hfin;

        return $this;
    }

    /**
     * Get hfin
     *
     * @return string
     */
    public function getHfin()
    {
        return $this->hfin;
    }
}
