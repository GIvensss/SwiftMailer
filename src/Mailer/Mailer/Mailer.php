<?php

namespace Givensss\SwiftMailer\Mailer;

use Exception;
use Givensss\SwiftMailer\Renderer\Renderer;
use Givensss\SwiftMailer\TransportInterface;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
class Mailer implements TransportInterface
{
    private string $subject;
    private string $body = "Somthing cool";
    private string $receiver;
    private string $receiverName;


    public function __construct($subject, $receiver, $receiverName)
    {
        $this->subject = $subject;
        $this->receiver = $receiver;
        $this->receiverName = $receiverName;
    }

    /**
     * @param string $templateName
     * @param array $params
     * @throws Exception
     */
    public function setBody(string $templateName, array $params): void
    {
        $this->body = Renderer::render($templateName, $params);
    }

    /**
     * @param $host
     * @param $port
     * @param $encryption
     * @param $username
     * @param $password
     */
    public function transport($host, $port, $encryption, $username, $password)
    {
        $transport = (new Swift_SmtpTransport($host, $port, $encryption))
            ->setUsername($username)
            ->setPassword($password);
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message($this->subject))
            ->setFrom([$username => 'John Doe'])
            ->setTo([$this->receiver => $this->receiverName])
            ->setBody($this->body)
        ;
        $result = $mailer->send($message);
    }
}