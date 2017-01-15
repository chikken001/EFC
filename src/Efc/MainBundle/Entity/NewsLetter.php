<?php

namespace Efc\MainBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * NewsLetter
 *
 * @ORM\Table(name="newsLetter")
 * @ORM\Entity(repositoryClass="Efc\MainBundle\Repository\NewsLetterRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="Email déjà inscrite à la newsLetter."
 * )
 * @ORM\HasLifecycleCallbacks
 */
class NewsLetter
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
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Newsletter
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

}