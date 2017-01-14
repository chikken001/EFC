<?php

namespace Efc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Efc\MainBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article
{
    const UPLOAD_DIR = 'uploads/articles/';
    const ABSOLUTE_UPLOAD_DIR = '/var/www/efc/web/uploads/articles/';

    public function __construct()
    {
        $this->isPublished = false ;
        $this->date_creation = new \DateTime() ;
    }

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
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="titre est invalide."
     * )
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="introduction est invalide."
     * )
     */
    private $introduction;

    /**
     * @var string
     *
     * @ORM\Column(name="anotation", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="anotation est invalide."
     * )
     */
    private $anotation;

    /**
     * @var text
     *
     * @ORM\Column(name="paragraphe1", type="text", nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="paragraphe1 est invalide."
     * )
     */
    private $paragraphe1;

    /**
     * @var text
     *
     * @ORM\Column(name="paragraphe2", type="text", nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="paragraphe2 est invalide."
     * )
     */
    private $paragraphe2;

    /**
     * @var text
     *
     * @ORM\Column(name="paragraphe3", type="text", nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="paragraphe3 est invalide."
     * )
     */
    private $paragraphe3;

    /**
     * @var text
     *
     * @ORM\Column(name="paragraphe4", type="text", nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="paragraphe4 est invalide."
     * )
     */
    private $paragraphe4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_published", type="boolean", nullable=false)
     *
     * @Assert\Type(
     *     type="bool",
     *     message="isPublished est invalide."
     * )
     */
    private $isPublished;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Efc\MainBundle\Entity\User", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $auteur;

    /**
     * @var Datetime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=false)
     *
     * @Assert\DateTime()
     */
    protected $date_creation;

    /**
     * @var Datetime
     *
     * @ORM\Column(name="date_evenement", type="datetime", nullable=false)
     *
     * @Assert\DateTime()
     */
    protected $date_evenement;

    /**
     * @ORM\OneToMany(targetEntity="Efc\MainBundle\Entity\Document", mappedBy="article", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     * @var type
     */
    protected $documents;

    // Photo principale

    /**
     * @var string
     *
     * @ORM\Column(name="nom_photo_principale", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="nom_photo_principale est invalide."
     * )
     */
    private $nom_photo_principale;

    /**
     * @var string
     *
     * @ORM\Column(name="type_photo_principale", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="type_photo_principale est invalide."
     * )
     */
    private $type_photo_principale;

    /**
     * @var
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg","image/png","image/jpg","image/gif"},
     *     mimeTypesMessage = "Veuillez utiliser une image valide (.jpeg .png .jpg .gif)",
     *     maxSizeMessage = "Fichier trop volumineux"
     * )
     */
    private $fichier_photo_principale;

    /**
     * @var
     */
    private $temp_photo_principale;

    // Photo

    /**
     * @var string
     *
     * @ORM\Column(name="nom_photo", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="nom_photo est invalide."
     * )
     */
    private $nom_photo;

    /**
     * @var string
     *
     * @ORM\Column(name="type_photo", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="type_photo est invalide."
     * )
     */
    private $type_photo;

    /**
     * @var
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg","image/png","image/jpg","image/gif"},
     *     mimeTypesMessage = "Veuillez utiliser une image valide (.jpeg .png .jpg .gif)",
     *     maxSizeMessage = "Fichier trop volumineux"
     * )
     */
    private $fichier_photo;

    /**
     * @var
     */
    private $temp_photo;



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
     * @return User $auteur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param User $auteur
     *
     * @return Article
     */
    public function setAuteur(User $auteur)
    {
        $this->auteur = $auteur;

        return $this;
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
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * @param string $introduction
     *
     * @return Article
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnotation()
    {
        return $this->anotation;
    }

    /**
     * @param string $anotation
     *
     * @return Article
     */
    public function setAnotation($anotation)
    {
        $this->anotation = $anotation;

        return $this;
    }

    /**
     * @return string
     */
    public function getParagraphe1()
    {
        return $this->paragraphe1;
    }

    /**
     * @param string $paragraphe
     *
     * @return Article
     */
    public function setParagraphe1($paragraphe)
    {
        $this->paragraphe1 = $paragraphe;

        return $this;
    }

    /**
     * @return string
     */
    public function getParagraphe2()
    {
        return $this->paragraphe2;
    }

    /**
     * @param string $paragraphe
     *
     * @return Article
     */
    public function setParagraphe2($paragraphe)
    {
        $this->paragraphe2 = $paragraphe;

        return $this;
    }

    /**
     * @return string
     */
    public function getParagraphe3()
    {
        return $this->paragraphe3;
    }

    /**
     * @param string $paragraphe
     *
     * @return Article
     */
    public function setParagraphe3($paragraphe)
    {
        $this->paragraphe3 = $paragraphe;

        return $this;
    }

    /**
     * @return string
     */
    public function getParagraphe4()
    {
        return $this->paragraphe4;
    }

    /**
     * @param string $paragraphe
     *
     * @return Article
     */
    public function setParagraphe4($paragraphe)
    {
        $this->paragraphe4 = $paragraphe;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param boolean $isPublished
     *
     * @return Article
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * @param Document $document
     */
    public function removeDocument(Document $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * @param Document $document
     */
    public function addDocument(Document $document)
    {
        $document->setCentre($this);

        $this->documents->add($document);
    }

    /**
     * @return ArrayCollection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param ArrayCollection $documents
     */
    public function setDocuments(\Doctrine\Common\Collections\ArrayCollection $documents)
    {
        $this->documents = $documents;

        foreach ($documents as $document)
        {
            $document->setCentre($this);
        }
    }

    // Photo principale

    /**
     * Set nomPhotoPrincipale
     *
     * @param string $filename
     *
     * @return Article
     */
    public function SetNomPhotoPrincipale($filename)
    {
        $this->nom_photo_principale = $filename;

        return $this;
    }

    /**
     * Get nomPhotoPrincipale
     *
     * @return string
     */
    public function getNomPhotoPrincipale()
    {
        return $this->nom_photo_principale;
    }

    /**
     * Set typePhotoPrincipale
     *
     * @param string $filetype
     *
     * @return Article
     */
    public function setTypePhotoPrincipale($filetype)
    {
        $this->type_photo_principale = $filetype;

        return $this;
    }

    /**
     * Get typePhotoPrincipale
     *
     * @return string
     */
    public function getTypePhotoPrincipale()
    {
        return $this->type_photo_principale;
    }

    /**
     * Set fichierPhotoPrincipale
     *
     * @param $file
     * @return Article
     */
    public function setFichierPhotoPrincipale(UploadedFile $file)
    {
        $this->fichier_photo_principale = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (!empty($this->fichier_photo_principale))
        {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->temp_photo_principale = $this->nom_photo_principale.'.'.$this->type_photo_principale;

            // On réinitialise les valeurs des attributs url et alt
            $this->type_photo_principale = null;
            $this->nom_photo_principale = null;
        }
    }

    /**
     * Get fichierPhotoPrincipale
     *
     * @return mixed
     */
    public function getFichierPhotoPrincipale()
    {
        return $this->fichier_photo_principale;
    }

    // Photo

    /**
     * Set nomPhoto
     *
     * @param string $filename
     *
     * @return Article
     */
    public function SetNomPhoto($filename)
    {
        $this->nom_photo = $filename;

        return $this;
    }

    /**
     * Get nomPhoto
     *
     * @return string
     */
    public function getNomPhoto()
    {
        return $this->nom_photo;
    }

    /**
     * Set typePhoto
     *
     * @param string $filetype
     *
     * @return Article
     */
    public function setTypePhoto($filetype)
    {
        $this->type_photo = $filetype;

        return $this;
    }

    /**
     * Get typePhoto
     *
     * @return string
     */
    public function getTypePhoto()
    {
        return $this->type_photo;
    }

    /**
     * Set fichierPhoto
     *
     * @param $file
     * @return Article
     */
    public function setFichierPhoto(UploadedFile $file)
    {
        $this->fichier_photo = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (!empty($this->fichier_photo))
        {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->temp_photo = $this->nom_photo.'.'.$this->type_photo;

            // On réinitialise les valeurs des attributs url et alt
            $this->type_photo = null;
            $this->nom_photo = null;
        }
    }

    /**
     * Get fichierPhoto
     *
     * @return mixed
     */
    public function getFichierPhoto()
    {
        return $this->fichier_photo;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        $fichiers = array('photo_principale', 'photo') ;

        foreach($fichiers as $fichier)
        {
            $file = 'fichier_'.$fichier ;

            if(!empty($this->$file))
            {
                $nom = 'nom_'.$fichier ;
                $type = 'type_'.$fichier ;

                $this->$type = $this->$file->guessExtension();
                $filename = uniqid($this->$file->getClientOriginalName());
                $this->$nom = substr($filename, 0, strpos($filename, '.'));
            }
        }
    }

    /**
     * Upload file
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        $fichiers = array('photo_principale', 'photo') ;

        foreach($fichiers as $fichier)
        {
            $file = 'fichier_'.$fichier ;

            if(!empty($this->$file))
            {
                $temp = 'temp_'.$fichier ;
                $nom = 'nom_'.$fichier ;
                $type = 'type_'.$fichier ;

                if (!empty($this->$temp))
                {
                    $oldFile = $this->getUploadRootDir().'/'.$this->$temp;
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $this->$file->move(
                    $this->getUploadRootDir(),
                    $this->$nom.'.'.$this->$type
                );
            }
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUploads()
    {
        $dirPath = $this->getUploadRootDir() ;

        if (is_dir($dirPath))
        {
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                $dirPath .= '/';
            }

            $files = glob($dirPath . '*', GLOB_MARK);

            foreach ($files as $file)
            {
                if (is_dir($file))
                {
                    self::deleteDir($file);
                }
                else
                {
                    unlink($file);
                }
            }

            rmdir($dirPath);
        }
    }

    /**
     * Get upload directory
     * @return string
     */
    public function getUploadDir()
    {
        if(!empty($this->id))
        {
            return self::UPLOAD_DIR.$this->id.'/';
        }

        return false ;
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
     * Get file path
     * @return string
     */
    public function getPath($fichier = 'photo_principale', $relatif = true)
    {
        $nom_fichier = 'nom_'.$fichier ;

        if(isset($this->$nom_fichier))
        {
            $type_fichier = 'type_'.$fichier ;

            if($relatif)
            {
                return $this->getUploadDir().'/'.$this->$fichier.'.'.$this->$type_fichier;
            }
            else
            {
                return $this->getUploadRootDir().'/'.$this->$fichier.'.'.$this->$type_fichier;
            }
        }

        return false ;
    }
}