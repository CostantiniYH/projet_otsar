<?php
class Image {
    private $image;
    private $width;
    private $height;
    private $imagePath;
    private $imageType;
    private $imageExtension;
    private $imageSize;
    private $imageMimeType;

    // Constructeur pour charger l'image
    public function __construct($imagePath) {
        if (!is_string($imagePath) || !file_exists($imagePath)) {
            throw new Exception("Fichier introuvable : " . $imagePath);
        }

        $this->imagePath = $imagePath;
        $imageInfo = getimagesize($imagePath);

        if ($imageInfo === false) {
            throw new Exception("Le fichier n'est pas une image valide.");
        }

        $this->width = $imageInfo[0];
        $this->height = $imageInfo[1];
        $this->imageMimeType = $imageInfo['mime'];

        // Déterminer le type d'image
        switch ($this->imageMimeType) {
            case 'image/jpeg':
                $this->image = imagecreatefromjpeg($imagePath);
                $this->imageExtension = "jpg";
                break;
            case 'image/png':
                $this->image = imagecreatefrompng($imagePath);
                $this->imageExtension = "png";
                break;
            case 'image/gif':
                $this->image = imagecreatefromgif($imagePath);
                $this->imageExtension = "gif";
                break;
            default:
                throw new Exception("Format d'image non supporté.");
        }
    }

    // Redimensionner l'image
    public function resize($newWidth, $newHeight) {
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $this->width, $this->height);

        // Remplacer l'image actuelle
        $this->image = $newImage;
        $this->width = $newWidth;
        $this->height = $newHeight;
    }

    // Enregistrer l'image avec un nouveau nom
    public function save($outputPath, $quality = 90) {
        switch ($this->imageExtension) {
            case 'jpg':
                imagejpeg($this->image, $outputPath, $quality);
                break;
            case 'png':
                imagepng($this->image, $outputPath, 9);
                break;
            case 'gif':
                imagegif($this->image, $outputPath);
                break;
        }
    }

    // Obtenir les informations sur l'image
    public function getInfo() {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'mimeType' => $this->imageMimeType,
            'extension' => $this->imageExtension
        ];
    }

    // Libérer la mémoire
    public function __destruct() {
        if ($this->image) {
            imagedestroy($this->image);
        }
    }
}
