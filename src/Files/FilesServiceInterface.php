<?php
namespace Acelaya\Files;

/**
 * Interface FilesServiceInterface
 * @author Alejandro Celaya Alastrué
 * @link http://www.wonnova.com
 */
interface FilesServiceInterface
{
    const CODE_SUCCESS = 'success';
    const CODE_ERROR = 'error';

    /**
     * @return \SplFileInfo[]
     */
    public function getFiles();

    /**
     * @param array $files
     * @return string
     */
    public function persistFiles(array $files);
}
