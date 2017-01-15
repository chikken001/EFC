<?php

namespace Efc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Informations
 *
 * @ORM\Table(name="informations")
 * @ORM\Entity(repositoryClass="Efc\MainBundle\Repository\InformationsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Informations
{
    const UPLOAD_DIR = 'uploads';
    const ABSOLUTE_UPLOAD_DIR = '/var/www/efc/web/uploads';

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
     * @ORM\Column(name="nom_association", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="nom_association est invalide."
     * )
     */
    private $nom_association;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="adresse est invalide."
     * )
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="ville est invalide."
     * )
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="ville est invalide."
     * )
     */
    private $code_postal;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     *
     * @Assert\Email(
     *     message = "Email invalide.",
     *     checkMX = true
     * )
     */
    protected $email;


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
     * @return string
     */
    public function getNomAssociation()
    {
        return $this->nom_association;
    }

    /**
     * @param string $nom_association
     *
     * @return Informations
     */
    public function setNomAssociation($nom_association)
    {
        $this->nom_association = $nom_association;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return informations
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param string $code_postal
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
    }
}