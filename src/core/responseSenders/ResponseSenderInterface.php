<?php
declare(strict_types=1);

namespace Core\Responsesenders;

interface ResponseSenderInterface
{
    /**
     * @param object $data
     * @return mixed
     */
    public function sendJson(object $data);

    /**
     * @param int $code
     * @param string $message
     * @return mixed
     */
    public function errorResponse(int $code, string $message);

    /**
     * @param string $view
     * @param array|null $data
     * @return mixed
     */
    public function sendView(string $view, array $data = null);
}