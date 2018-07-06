<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Offer - представляет товар
 * @ORM\Entity
 * @ORM\Table(name="offer")
 */
class Offer
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $picture;

    /**
     * @var string
     * @ORM\Column(type="integer", length=50, nullable=false)
     */
    protected $categoryId;

    /**
     * @var int
     * @ORM\Column(type="integer", length=10, nullable=false)
     */
    protected $price;

    /**
     * @var int
     * @ORM\Column(type="integer", length=10, nullable=false)
     */
    protected $modified_datetime;

    /**
     * @var int
     * @ORM\Column(type="integer", length=10, nullable=false)
     */
    protected $currencyId;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $brand_name;


    //Записываем имя товара.
    public function setName($name)
    {
        $this->name = $name;
    }

    //Записываем описание товара.
    public function setDescription($description)
    {
        $this->description = $description;
    }

    //Записываем картинку.
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    //Записываем id категории
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    //Записываем цену товара
    public function setPrice($price)
    {
        $this->price = $price;
    }

    //Записываем время добавления товара
    public function setModified_datetime($modified_datetime)
    {
        $this->modified_datetime = $modified_datetime;
    }

    //Записываем id вылюты
    public function setCurrencyId($currencyId)
    {
        if(is_null($currencyId)){
            $currencyId = 'RUB';
        }

        $this->currencyId = $currencyId;
    }

    //Записываем бренд товара
    public function setBrand_name($brand_name)
    {
        $this->brand_name = $brand_name;
    }



}