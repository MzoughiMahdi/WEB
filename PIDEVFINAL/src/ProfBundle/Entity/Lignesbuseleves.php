<?php

namespace ProfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignesbuseleves
 *
 * @ORM\Table(name="lignesbuseleves", indexes={@ORM\Index(name="idLigne", columns={"idLigne"}), @ORM\Index(name="idEleve", columns={"idEleve"})})
 * @ORM\Entity
 */
class Lignesbuseleves
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
     * @var integer
     *
     * @ORM\Column(name="idLigne", type="integer", nullable=false)
     */
    private $idligne;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEleve", type="integer", nullable=false)
     */
    private $ideleve;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEleve", type="string", length=50, nullable=false)
     */
    private $nomeleve;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomEleve", type="string", length=50, nullable=false)
     */
    private $prenomeleve;


}

