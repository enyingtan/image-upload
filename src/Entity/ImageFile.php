<?php

namespace App\Entity;

use App\Repository\ImageFileRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Service\UploaderHelper;
use App\Service\UploadHelper;

/**
 * @ORM\Entity(repositoryClass=ImageFileRepository::class)
 */
class ImageFile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pathName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getPathName(): ?string
    {
        return $this->pathName;
    }

    public function setPathName(string $pathName): self
    {
        $this->pathName = $pathName;

        return $this;
    }

    public function getImagePath()
    {
        return UploadHelper::IMAGE_PATH.'/'.$this->getPathName();
    }
}
