<?php

namespace Application\Controller;


use Doctrine\ORM\Tools\Pagination\Paginator;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ShowcaseController extends AbstractActionController
{

    public function indexAction()
    {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $offers = $objectManager->getRepository('\Application\Entity\Offer');

        $page = new Paginator($offers, $fetchJoinCollection = true);

        //        $c = count($page);
        foreach ($page as $post) {
            echo $post->getHeadline() . "\n";
        }

        $view = new ViewModel(array('page' => $page));


        return $view;
    }

    public function viewAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id && $id == 0) {
            throw new \Exception('Wrong id parametr :(');
            return new ViewModel();
        }

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $offer = $objectManager->getRepository('\Application\Entity\Offer')->findOneBy(array('id' => $id));

        if(!$offer){
            throw new \Exception('Oops - Something Error :(');
            return new ViewModel();
        }

        $view = new ViewModel(array('offer' => $offer));

        return $view;


    }

}