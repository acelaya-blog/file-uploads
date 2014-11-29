<?php
namespace Acelaya\Files;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FilesService
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class FilesService implements FilesServiceInterface
{
    /**
     * @var FilesOptions
     */
    protected $options;

    public function __construct(FilesOptions $options)
    {
        $this->options = $options;
    }
}
