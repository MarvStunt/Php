<?php

class product
{
    // On a pas pu mettre de type pour les variables, car l'hébergeur à une version de php trop ancienne et donc ne l'accepte pas
    private /** string */ $id;
    private /** string */ $name;
    private /** string */ $description;
    private /** float */ $price;
    private /** string */ $img;

    /**
     * Constructeur
     */
    public function __construct(string $id, string $name, float $price, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->img = "/../../assets/img/$image.png";
        $this->description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt, mi eu rhoncus cursus, ante dolor rhoncus ipsum, in consequat libero sapien tincidunt lacus. In porttitor, leo nec iaculis facilisis, lectus magna aliquet nunc, at pharetra orci tellus sit amet odio. Quisque tincidunt imperdiet augue et porttitor.";
    }

    /**
     * Getters
     */

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImg(): string
    {
        return $this->img;
    }
}
