<?php

namespace ProfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seance
 *
 * @ORM\Table(name="seance", indexes={@ORM\Index(name="FK_CLASSE", columns={"classe"}), @ORM\Index(name="FK_HORAIRE", columns={"horaire"}), @ORM\Index(name="FK_PROF", columns={"prof"}), @ORM\Index(name="FK_JOUR", columns={"jour"}), @ORM\Index(name="FK_MATIERE", columns={"matiere"}), @ORM\Index(name="FK_SALLE", columns={"salle"})})
 * @ORM\Entity
 */
class Seance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Classe
     *
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="classe", referencedColumnName="id")
     * })
     */
    private $classe;

    /**
     * @var \Horaire
     *
     * @ORM\ManyToOne(targetEntity="Horaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="horaire", referencedColumnName="id")
     * })
     */
    private $horaire;

    /**
     * @var \Jour
     *
     * @ORM\ManyToOne(targetEntity="Jour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jour", referencedColumnName="id")
     * })
     */
    private $jour;

    /**
     * @var \Matiere
     *
     * @ORM\ManyToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matiere", referencedColumnName="id")
     * })
     */
    private $matiere;

    /**
     * @var \Prof
     *
     * @ORM\ManyToOne(targetEntity="Prof")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prof", referencedColumnName="id")
     * })
     */
    private $prof;

    /**
     * @var \Salle
     *
     * @ORM\ManyToOne(targetEntity="Salle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="salle", referencedColumnName="id")
     * })
     */
    private $salle;


}

