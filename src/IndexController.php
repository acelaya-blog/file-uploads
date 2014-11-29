<?php
namespace Acelaya;

use Acelaya\Files\FilesServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @author ALejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class IndexController extends AbstractActionController
{
    const CODE_SUCCESS = 'success';
    const CODE_ERROR = 'error';

    /**
     * @var FilesServiceInterface
     */
    protected $filesService;

    public function __construct(FilesServiceInterface $filesService)
    {
        $this->filesService = $filesService;
    }

    public function indexAction()
    {
        $model = new ViewModel();
        return $model->setTemplate('index');
    }

    public function uploadAction()
    {
        $files = $this->params()->fromFiles('files');

        $model = new ViewModel();
        return $model->setTemplate('index');
    }
}
