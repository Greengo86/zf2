<?php

namespace Application\Controller;


use Application\Entity\Offer;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;

class ShowcaseController extends AbstractActionController
{

    private $offersTable;

    public function indexAction()
    {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

//        $offers = $objectManager->getRepository('\Application\Entity\Offer');
//        $q = $objectManager->createQuery('SELECT * from \Application\Entity\Offer');

//        $posts = $objectManager ->getRepository('\Application\Entity\Offer')->findAll();
        $posts = $objectManager ->getRepository('\Application\Entity\Offer')->findAll();


//        var_dump($posts);

        $pagi = new Paginator(new ArrayAdapter($posts));

        $pagi->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $pagi->setPageRange(5);
//        $pagi->setItemCountPerPage(10);

//        var_dump($pagi);
        //        $c = count($page);
//        foreach ($page as $post) {
//            echo $post->getHeadline() . "\n";
////        }

//        $page1->setItemCountPerPage(10);

        $view = new ViewModel;

        $view->setVariable('pagi', $pagi);

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

    public function getOffersTable()
    {
        if (!$this->offersTable){
            $this->offersTable = new TableGateway(
                'offers',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }

        return $this->offersTable;

    }

}