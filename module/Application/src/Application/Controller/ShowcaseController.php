<?php
/**
 * Created by PhpStorm.
 * User: wsadmin
 * Date: 10.07.2018
 * Time: 15:59
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ShowcaseController extends AbstractActionController
{

    public function indexAction()
    {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $offers = $objectManager->getRepository('\Application\Entity\Offer');

        $view = new ViewModel(array('offers' => $offers));

        return $view;
    }

}