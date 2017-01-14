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
     * @ORM\Column(name="sous_titre", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="sous_titre est invalide."
     * )
     */
    private $sous_titre;

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

    // Photo 1

    /**
     * @var string
     *
     * @ORM\Column(name="nom_photo1", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="nom_photo1 est invalide."
     * )
     */
    private $nom_photo1;

    /**
     * @var string
     *
     * @ORM\Column(name="type_photo1", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="type_photo1 est invalide."
     * )
     */
    private $type_photo1;

    /**
     * @var
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg","image/png","image/jpg","image/gif"},
     *     mimeTypesMessage = "Veuillez utiliser une image valide (.jpeg .png .jpg .gif)",
     *     maxSizeMessage = "Fichier trop volumineux"
     * )
     */
    private $fichier_photo1;

    /**
     * @var
     */
    private $temp_photo1;

    // Photo 2

    /**
     * @var string
     *
     * @ORM\Column(name="nom_photo2", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="nom_photo2 est invalide."
     * )
     */
    private $nom_photo2;

    /**
     * @var string
     *
     * @ORM\Column(name="type_photo2", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="type_photo2 est invalide."
     * )
     */
    private $type_photo2;

    /**
     * @var
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg","image/png","image/jpg","image/gif"},
     *     mimeTypesMessage = "Veuillez utiliser une image valide (.jpeg .png .jpg .gif)",
     *     maxSizeMessage = "Fichier trop volumineux"
     * )
     */
    private $fichier_photo2;

    /**
     * @var
     */
    private $temp_photo2;

    // Document

    /**
     * @var string
     *
     * @ORM\Column(name="nom_document", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="nom_fichier est invalide."
     * )
     */
    private $nom_document;

    /**
     * @var string
     *
     * @ORM\Column(name="type_document", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="type_document est invalide."
     * )
     */
    private $type_document;

    /**
     * @var
     * @Assert\File(
     *     maxSize = "2M",
     *     maxSizeMessage = "Fichier trop volumineux"
     * )
     */
    private $fichier_document;

    /**
     * @var
     */
    private $temp_document;


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
    public function getSousTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $sous_titre
     *
     * @return Article
     */
    public function setSousTitre($sous_titre)
    {
        $this->sous_titre = $sous_titre;

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
            $this->temp_photo_principale = $this->fichier_photo_principale.'.'.$this->type_photo_principale;

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

    // Photo 1

    /**
     * Set nomPhoto1
     *
     * @param string $filename
     *
     * @return Article
     */
    public function SetNomPhoto1($filename)
    {
        $this->nom_photo1 = $filename;

        return $this;
    }

    /**
     * Get nomPhoto1
     *
     * @return string
     */
    public function getNomPhoto1()
    {
        return $this->nom_photo1;
    }

    /**
     * Set typePhoto1
     *
     * @param string $filetype
     *
     * @return Article
     */
    public function setTypePhoto1($filetype)
    {
        $this->type_photo1 = $filetype;

        return $this;
    }

    /**
     * Get typePhoto1
     *
     * @return string
     */
    public function getTypePhoto1()
    {
        return $this->type_photo1;
    }

    /**
     * Set fichierPhoto1
     *
     * @param $file
     * @return Article
     */
    public function setFichierPhoto1(UploadedFile $file)
    {
        $this->fichier_photo1 = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (!empty($this->fichier_photo1))
        {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->temp_photo1 = $this->fichier_photo1.'.'.$this->type_photo1;

            // On réinitialise les valeurs des attributs url et alt
            $this->type_photo1 = null;
            $this->nom_photo1 = null;
        }
    }

    /**
     * Get fichierPhoto1
     *
     * @return mixed
     */
    public function getFichierPhoto1()
    {
        return $this->fichier_photo1;
    }

    // Photo 2

    /**
     * Set nomPhoto2
     *
     * @param string $filename
     *
     * @return Article
     */
    public function SetNomPhoto2($filename)
    {
        $this->nom_photo2 = $filename;

        return $this;
    }

    /**
     * Get nomPhoto2
     *
     * @return string
     */
    public function getNomPhoto2()
    {
        return $this->nom_photo2;
    }

    /**
     * Set typePhoto2
     *
     * @param string $filetype
     *
     * @return Article
     */
    public function setTypePhoto2($filetype)
    {
        $this->type_photo2 = $filetype;

        return $this;
    }

    /**
     * Get typePhoto2
     *
     * @return string
     */
    public function getTypePhoto2()
    {
        return $this->type_photo2;
    }

    /**
     * Set fichierPhoto2
     *
     * @param $file
     * @return Article
     */
    public function setFichierPhoto2(UploadedFile $file)
    {
        $this->fichier_photo2 = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (!empty($this->fichier_photo2))
        {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->temp_photo2 = $this->fichier_photo2.'.'.$this->type_photo2;

            // On réinitialise les valeurs des attributs url et alt
            $this->type_photo2 = null;
            $this->nom_photo2 = null;
        }
    }

    /**
     * Get fichierPhoto2
     *
     * @return mixed
     */
    public function getFichierPhoto2()
    {
        return $this->fichier_photo2;
    }

    // Document

    /**
     * Set nomDocument
     *
     * @param string $filename
     *
     * @return Article
     */
    public function SetNomDocument($filename)
    {
        $this->nom_document = $filename;

        return $this;
    }

    /**
     * Get nomDocument
     *
     * @return string
     */
    public function getNomDocument()
    {
        return $this->nom_document;
    }

    /**
     * Set typeDocument
     *
     * @param string $filetype
     *
     * @return Article
     */
    public function setTypeDocument($filetype)
    {
        $this->type_document = $filetype;

        return $this;
    }

    /**
     * Get typeDocument
     *
     * @return string
     */
    public function getTypeDocument()
    {
        return $this->type_document;
    }

    /**
     * Set fichierDocument
     *
     * @param $file
     * @return Article
     */
    public function setFichierDocument(UploadedFile $file)
    {
        $this->fichier_document = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (!empty($this->fichier_document))
        {
            $this->temp_document = $this->fichier_document.'.'.$this->type_document;
            $this->type_document = null;
            $this->nom_document = null;
        }
    }

    /**
     * Get fichierDocument
     *
     * @return mixed
     */
    public function getFichierDocument()
    {
        return $this->fichier_document;
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        $fichiers = array('photo_principale', 'photo1', 'photo2', 'document') ;

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
        $fichiers = array('photo_principale', 'photo1', 'photo2', 'document') ;

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