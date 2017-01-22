<?php

namespace Efc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="Efc\MainBundle\Repository\TypeRepository")
 */
class Type
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="nom est invalide."
     * )
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="Efc\MainBundle\Entity\Article", mappedBy="type", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @var
     */
    protected $articles;


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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     *
     * @return Type
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @param Article $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * @param Article $article
     */
    public function addArticle(Article $article)
    {
        $article->setType($this);

        $this->articles->add($article);
    }

    /**
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param ArrayCollection $articles
     */
    public function setArticles(\Doctrine\Common\Collections\ArrayCollection $articles)
    {
        $this->articles = $articles;

        foreach ($articles as $article)
        {
            $article->setType($this);
        }
    }
}

