<?php
namespace Acelaya\Files;

use Zend\Filter\File\RenameUpload;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\File\Size;

/**
 * Class FilesInputFilter
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class FilesInputFilter extends InputFilter
{
    const FILE = 'file';

    public function __construct(FilesOptions $options)
    {
        $input = new FileInput(self::FILE);
        $input->getValidatorChain()->attach(new Size(['max' => $options->getMaxSize()]));
        $input->getFilterChain()->attach(new RenameUpload([
            'overwrite'         => false,
            'use_upload_name'   => true,
            'target'            => $options->getBasePath()
        ]));

        $this->add($input);
    }
}
