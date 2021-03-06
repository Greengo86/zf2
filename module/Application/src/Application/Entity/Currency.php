<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This Class represents currency
 * @ORM\Entity
 * @ORM\Table(name="currency")
 */
class Currency
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    public $val;

    /**
     * @var int
     * @ORM\Column(type="integer", length=10, nullable=false)
     */
    public $rate;

    /**
     * @ORM\OneToOne(targetEntity="Offer", mappedBy="currency")
     */
    public $offer;


    /**
     * Set val for this currency
     * @param $val
     */
    public function setVal($val)
    {
        $this->val = $val;
    }


    /**
     * Set rate for this currency
     * @param $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

}