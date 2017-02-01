<?php
// src/LotusBundle/Entity/Image

namespace LotusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ORM\Table(name="image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;
    /**
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
    
    /**
     * @ORM\Column(name="original_image",type="string", length=255, nullable=true)
     */
    protected $originalImage;


    
    /**
    * @return int
    */
    public function getId()
    {
        return $this->id;
    }
    
    /**
    * @param string $alt
    */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }
    /**
    * @return string
    */
    public function getAlt()
    {
        return $this->alt;
    }
    
    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;  
    }
    /**
    * @return string
    */
    public function getImage()
    {
        return $this->image;  
    }
    
    /**
     * @param string $originalImage
     */
    public function setOriginalImage($originalImage)
    {
        $this->originalImage = $originalImage;  
    }
    /**
     * @return string
     */
    public function getOriginalImage()
    {
        return $this->originalImage;  
    }
    
    
  
    public function getUploadRootDir()
    {
        // absolute path to your directory where images must be saved
        $path = __DIR__.'/../../../web/'.$this->getUploadDir();
        //echo (is_dir($path)) ? 'oui' : 'non' ;
        return $path ;
        //return '/lotus/web/'.$this->getUploadDir();
    }
    
    public function getUploadDir()
    {
        return 'images/uploads';
    }

    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : '/web/'.$this->getUploadDir().'/'.$this->image;
    }
}