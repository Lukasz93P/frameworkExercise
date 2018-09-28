<?php
declare(strict_types=1);

namespace Core\Mailers;

trait PhpMailerConfigTrait
{
    /**
     * PhpMailerConfigTrait constructor.
     * @param bool $exceptionMode
     */
    public function __construct(bool $exceptionMode = false)
    {
        parent::__construct($exceptionMode);
        $this->SMTPDebug = 2;
        $this->isSMTP();
        $this->Host = 'smtp.mailgun.org';
        $this->SMTPAuth = true;
        $this->Username = 'postmaster@sandbox5c99320ecea54e9492d4c8b877486f7b.mailgun.org';
        $this->Password = MAILGUN_PASSWORD;
        $this->SMTPSecure = 'tls';
        $this->Port = 587;
    }
}