<?php
namespace Acelaya;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @author ALejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $model = new ViewModel();
        return $model->setTemplate('index');
    }
}
