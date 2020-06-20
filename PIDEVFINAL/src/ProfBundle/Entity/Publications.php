<?php

namespace ProfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publications
 *
 * @ORM\Table(name="publications", indexes={@ORM\Index(name="idAuteur", columns={"idAuteur"})})
 * @ORM\Entity
 */
class Publications
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPublication", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpublication;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAuteur", type="integer", nullable=false)
     */
    private $idauteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime", nullable=true)
     */
    private $datepublication;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=true)
     */
    private $contenu;


}

