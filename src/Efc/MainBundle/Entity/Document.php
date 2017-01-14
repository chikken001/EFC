<?php

namespace Efc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="Efc\MainBundle\Repository\DocumentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Document
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
     * @ORM\ManyToOne(targetEntity="Efc\MainBundle\Entity\Article", inversedBy="documents", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="titre est invalide."
     * )
     */
    private $titre;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="description est invalide."
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="titre est invalide."
     * )
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="filetype", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="titre est invalide."
     * )
     */
    private $filetype;

    /**
     * @var File
     *
     * @Assert\File(
     *     maxSize = "2M",
     *     maxSizeMessage = "Fichier trop volumineux"
     * )
     */
    private $file;

    /**
     * @var
     */
    private $tempFilename;



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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     *
     * @return Document
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Document
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param Article $article
     *
     * @return Document
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Document
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filetype
     *
     * @param string $filetype
     *
     * @return Document
     */
    public function setFiletype($filetype)
    {
        $this->filetype = $filetype;

        return $this;
    }

    /**
     * Get filetype
     *
     * @return string
     */
    public function getFiletype()
    {
        return $this->filetype;
    }

    /**
     * Set file
     *
     * @param $file
     * @return $this
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if ($this->filetype !== null)
        {
            $this->tempFilename = $this->filename.'.'.$this->filetype;
            $this->filetype = null;
            $this->filename = null;
        }
    }

    /**
     * Get file
     *
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }

        $this->filetype = $this->file->guessExtension();
        $filename = uniqid($this->file->getClientOriginalName());
        $this->filename = substr($filename, 0, strpos($filename, '.'));

    }

    /**
     * Upload file
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file || empty($this->article)) {
            return;
        }

        if ($this->tempFilename !== null) {
            $oldFile = $this->article->$this->getUploadRootDir().'/'.$this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $this->file->move(
            $this->article->getUploadRootDir(),
            $this->filename.'.'.$this->filetype
        );
    }
}