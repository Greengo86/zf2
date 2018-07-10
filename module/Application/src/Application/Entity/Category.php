<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Offer - представляет категорию товара
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
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
    protected $category_name;

    /**
     * @var string
     * @ORM\Column(type="integer", length=50, nullable=false)
     */
    protected $parent_id;


    //Записываем название категории.
    public function setCategory($category_name)
    {
        $this->category_name = $category_name;
    }

    //Записываем значение(номер) родительской категории
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

}