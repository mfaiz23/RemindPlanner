<?php

namespace App\Libraries;

class Email
{
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    public function send($to, $subject, $message)
    {
        $this->email->setTo($to);
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if (!$this->email->send()) {
            throw new \Exception($this->email->printDebugger(['headers']));
        }
    }
}
