<?php
/**
 * Created by PhpStorm.
 * User: wsadmin
 * Date: 06.07.2018
 * Time: 13:09
 */

namespace Application\Controller;


use Application\Entity\Currency;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HeadController extends AbstractActionController
{

    /**
     * Fill db from Xml file
     * @return ViewModel
     */
    public function indexAction()
    {

        $xml_file = 'tmp/import/offer.xml';

//        var_dump($xml_file);

        if(file_exists($xml_file)){
            $xml = simplexml_load_file($xml_file);
            $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }else{
            throw new \Exception('Not Find Xml file');
        }

//        var_dump($xml);

        $json = json_encode($xml);
        $data = json_decode($json,TRUE);


        $currency = $data['shop']['currencies']['currency'];
//        var_dump($currency);

        foreach ($currency as $cur){
//            var_dump($cur['@attributes']);
            $currencies = new Currency();
            $currencies->setVal($cur['@attributes']['id']);
            $currencies->setRate($cur['@attributes']['rate']);

            $objectManager->persist($currencies);
            $objectManager->flush();
//            $this->currencyManager->addNewCurrency($cur['@attributes']);
        }


        $category = $data['shop']['categories']['category'];
//        var_dump($category);
        foreach ($category as $cat){
//            var_dump($cat);
//            $this->categoryManager->addNewCategory($cat);
        }


        $offer = $data['shop']['offers']['offer'];
//        var_dump($offer);
        foreach ($offer as $of){
//            var_dump($of);
//            $this->offerManager->addNewOffer($of);
        }
        return new ViewModel(['data' => $data]);

    }


}