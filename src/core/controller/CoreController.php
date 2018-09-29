<?php
declare(strict_types=1);

namespace Core\Controller;

use Core\Cache\CacherInterface;
use Core\Responsesenders\ResponseSenderInterface;

abstract class CoreController
{
    /**
     * @var CacherInterface
     */
    protected $cacher;

    /**
     * @var ResponseSenderInterface
     */
    protected $responseSender;

    /**
     * CoreController constructor.
     * @param CacherInterface $cacher
     */
    public function __construct(CacherInterface $cacher, ResponseSenderInterface $responseSender)
    {
        $this->cacher = $cacher;
        $this->responseSender = $responseSender;
    }

    /**
     * @param $methodName
     * @param $args
     * @return mixed
     * @throws \Exception
     */
    public function __call($methodName, $args)
    {
        if (isset($methodName)) {
            if (method_exists($this->responseSender, $methodName)) {
                return call_user_func_array([$this->responseSender, $methodName], $args);
            } else if (method_exists($this->cacher, $methodName)) {
                return call_user_func_array([$this->cacher, $methodName], $args);
            }
        }
        throw new \Exception("Method does not exists");
    }
}