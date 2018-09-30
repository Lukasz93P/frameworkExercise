<?php
declare(strict_types=1);

namespace Core\Request;

class Request
{
    /**
     * @var array|null
     */
    public $post;

    /**
     * @var array|null
     */
    public $url;

    /**
     * Request constructor.
     * @param array|null $url
     * @param array|null $post
     */
    public function __construct(array $url = null, array $post = null)
    {
        $this->url = $url;
        if (!$post) {
            $this->getPostFormData();
            $this->getJsonPostData();
        } else {
            $this->post = $post;
        }
    }

    protected function getPostFormData()
    {
        if (!empty($_POST)) {
            $this->bindPostData($_POST);
        }
    }

    protected function getJsonPostData()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!empty($data)) {
            $this->bindPostData($data);
        }
    }

    /**
     * @param array $data
     */
    protected function bindPostData(array $data)
    {
        $postDataKeys = array_keys($data);
        foreach ($postDataKeys as $key) {
            if (gettype($data[$key]) === 'string') {
                $this->post[$key] = filter_var($data[$key], FILTER_SANITIZE_STRING);
            } else {
                $this->post[$key] = $data[$key];
            }
        }
    }
}