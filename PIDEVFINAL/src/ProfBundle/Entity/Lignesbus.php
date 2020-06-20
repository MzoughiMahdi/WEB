<?php

namespace ProfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignesbus
 *
 * @ORM\Table(name="lignesbus")
 * @ORM\Entity
 */
class Lignesbus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLigne", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idligne;

    /**
     * @var string
     *
     * @ORM\Column(name="NomPrenomChauff", type="string", length=250, nullable=false)
     */
    private $nomprenomchauff;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseDepart", type="string", length=255, nullable=true)
     */
    private $adressedepart;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacite", type="integer", nullable=true)
     */
    private $capacite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDepart", type="datetime", nullable=true)
     */
    private $heuredepart;


}

