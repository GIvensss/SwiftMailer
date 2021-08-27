<?php

namespace Givensss\SwiftMailer;

interface TransportInterface
{
    public function transport($host, $port, $encryption, $username, $password);
}