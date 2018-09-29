<?php
declare(strict_types=1);

namespace Core\Mailers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Core\Mailers\MailerAdapterInterface;
use Core\Mailers\PhpMailerConfigTrait;

class PhpMailerAdapter extends PHPMailer implements MailerAdapterInterface
{
    use PhpMailerConfigTrait;

    /**
     * @param string $sender
     * @param array $recipients
     * @param string $subject
     * @param string $body
     * @param array|null $attachments
     * @param bool $isHTML
     * @param string|null $replyTo
     * @return mixed|void
     */
    public function sendMail(string $sender, array $recipients, string $subject, string $body, array $attachments = null, bool $isHTML = false, string $replyTo = null)
    {
        $this->setSender($sender);
        $this->addRecipients($recipients);
        $this->Subject = $subject;
        $this->Body = $body;
        if (!empty($attachments)) {
            $this->addAttachments($attachments);
        }

        $this->isHTML($isHTML);
        $replyTo ? $this->addReplyTo($replyTo) : $this->addReplyTo($sender);
        $this->send();
    }

    /**
     * @param string $sender
     * @return mixed
     */
    public function setSender(string $sender)
    {
        $params = explode('|', $sender);
        return call_user_func_array([$this, 'setFrom'], $params);
    }

    /**
     * @param array $recipients
     */
    public function addRecipients(array $recipients)
    {
        foreach ($recipients as $recipient) {
            $this->addAddress($recipient);
        }
    }

    /**
     * @param array $attachments
     */
    public function addAttachments(array $attachments)
    {
        foreach ($attachments as $attachment) {
            $attachment = explode('|', $attachment);
            call_user_func_array([$this, 'addAttachment'], $attachment);
        }
    }
}