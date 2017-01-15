<?php

namespace Efc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partenaire
 *
 * @ORM\Table(name="partenaire")
 * @ORM\Entity(repositoryClass="Efc\MainBundle\Repository\PartenaireRepository")
 */
class Partenaire
{
    const UPLOAD_DIR = 'uploads/partenaires';
    const ABSOLUTE_UPLOAD_DIR = '/var/www/efc/web/uploads/partenaires';

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
     *     mimeTypes = {"image/jpeg","image/png","image/jpg","image/gif"},
     *     mimeTypesMessage = "Veuillez utiliser une image valide (.jpeg .png .jpg .gif)",
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     *
     * @return Partenaire
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Partenaire
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
     * @return Partenaire
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
     * @return Partenaire
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
        $filename = $this->file->getClientOriginalName();
        $this->filename = substr($filename, 0, strpos($filename, '.'));

    }

    /**
     * Upload file
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        if ($this->tempFilename !== null) {
            $oldFile = self::ABSOLUTE_UPLOAD_DIR.$this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $this->file->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->filetype
        );
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->filetype;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->filename != null) {
            if (file_exists($this->tempFilename)) {
                // On supprime le fichier
                unlink($this->tempFilename);
            }
        }
    }

    /**
     * Get upload directory
     * @return string
     */
    public function getUploadDir()
    {
        return self::UPLOAD_DIR;
    }

    /**
     * Get upload root directory
     * @return string
     */
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    /**
     * Get web path
     * @return string
     */
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->id.'.'.$this->getFiletype();
    }

    /**
     * Get full path file
     * @return string
     */
    public function getPath()
    {
        return $this->getUploadRootDir().'/'.$this->id.'.'.$this->getFiletype();
    }
}

