<?php
namespace Acelaya;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @author ALejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class IndexController extends AbstractActionController implements FactoryInterface
{
    public function __construct()
    {

    }

    public function indexAction()
    {
        $model = new ViewModel();
        return $model->setTemplate('index');
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new self();
    }
}
