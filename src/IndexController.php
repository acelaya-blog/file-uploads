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
        $model = new ViewModel([
            'files' => $this->filesService->getFiles()
        ]);
        return $model->setTemplate('index');
    }

    public function uploadAction()
    {
        $files = $this->params()->fromFiles('files');
        $code = $this->filesService->persistFiles($files);

        return new JsonModel([
            'code' => $code
        ]);
    }
}
