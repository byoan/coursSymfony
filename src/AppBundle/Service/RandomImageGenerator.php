<?php


namespace AppBundle\Service;

class RandomImageGenerator
{
    private $keywords;
    private $width;
    private $height;

    public function __construct($keywords, $width, $height)
    {
        $this->keywords = $keywords;
        $this->width = $width;
        $this->height = $height;
    }

    public function getRandomImageURL()
    {
        $randomIndex = array_rand($this->keywords, 1);

        return "https://loremflickr.com/" . $this->width . "/" . $this->height . "/" . $this->keywords[$randomIndex];
    }
}
