<?php
declare(strict_types=1);

namespace Application\Controllers\Contentlist;

use Core\Controller\CoreController;
use Core\Upload\CoreUploader;

class Listing extends CoreController
{
    public function index($testArg)
    {
        $testValue = new \stdClass();
        $testValue->name = 'Lukasz';
        $testValue->secondName = 'Franikowski';
        $this->putIntoCache('testkey', $testValue);
        $data['content'] = 'forms/uploadFile';
        $this->sendView('layouts/mainLayout', $data);
        var_dump($testArg);
        var_dump($_POST['middleware_test']);
    }

    public function getCache($key)
    {
        $value = $this->cacher->getFromCache($key);
        $this->responseSender->sendJson($value);
    }

    public function showUploadForm()
    {
        $this->responseSender->sendView('forms/uploadFile');
    }

    public function uploadimage()
    {
        $file = $_FILES['test'];
        $destination = BASE_PATCH . 'uploads' . DIRECTORY_SEPARATOR . time() . 'test_name.jpg';
        $uploaded = CoreUploader::uploadFile($file, $destination, true);
        var_dump($uploaded);
    }
}