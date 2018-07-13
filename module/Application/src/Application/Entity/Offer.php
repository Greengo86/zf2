<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

/**
 * Class Offer - представляет товар
 * @ORM\Entity
 * @ORM\Table(name="offer")
 */
class Offer
{

    private $tableGateway;

//    public function __construct(TableGatewayInterface $tableGateway)
//    {
//        $this->tableGateway = $tableGateway;
//    }

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $picture;

    /**
     * @var string
     * @ORM\Column(type="integer", length=50, nullable=false)
     */
    public $categoryId;

    /**
     * @var int
     * @ORM\Column(type="integer", length=10, nullable=false)
     */
    public $price;

    /**
     * @var int
     * @ORM\Column(type="integer", length=10, nullable=false)
     */
    public $modified_datetime;

    /**
     * @var string
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    public $currencyId;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    public $brand_name;


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

    public function fetchAll($paginated = false)
    {
        if ($paginated) {
            return $this->fetchPaginateResults();
        }

        return $this->tableGateway->select();
    }

    /**
     * @return string
     */
    public function fetchPaginateResults()
    {

        $select = new Select($this->tableGateway->getTable());

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Offer());

        // Create a new pagination adapter object:
        $paginatorAdapter = new DbSelect(
        // our configured select object:
            $select,
            // the adapter to run it against:
            $this->tableGateway->getAdapter(),
            // the result set to hydrate:
            $resultSetPrototype
        );

        $paginator = new Paginator($paginatorAdapter);
        return $paginator;

    }

}