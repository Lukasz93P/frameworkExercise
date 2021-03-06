<?php
declare(strict_types=1);

namespace Application\Controllers\Contentlist;

use Core\Controller\CoreController;
use Core\Upload\CoreUploader;
use Core\Request\Request;

class Listing extends CoreController
{
    public function index(Request $request)
    {
        $testValue = new \stdClass();
        $testValue->name = 'Lukasz';
        $testValue->secondName = 'Franikowski';
        $this->putIntoCache('testkey', $testValue);
        $data['content'] = 'forms/uploadFile';
        $this->sendView('layouts/mainLayout', $data);
        var_dump($request->url);
        echo 'POST';
        var_dump($request->post['middleware_test']);
        var_dump($request->post);
    }

    public function getCache($key)
    {
        $value = $this->cacher->getFromCache($key);
        $this->responseSender->sendJson($value);
    }

    public function showUploadForm()
    {
        $this->responseSender->sendView('forms / uploadFile');
    }

    public function uploadimage()
    {
        $file = $_FILES['test'];
        $destination = BASE_PATCH . 'uploads' . DIRECTORY_SEPARATOR . time() . 'test_name . jpg';
        $uploaded = CoreUploader::uploadFile($file, $destination, true);
        var_dump($uploaded);
    }
}