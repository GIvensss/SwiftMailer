<?php

namespace Givensss\SwiftMailer\Renderer;

class Renderer
{
    public static function render($templateName, $params = [] ,$pathToTemplate = "src/MessageTemplates/"): string
    {
        ob_start();
        try {
            require($pathToTemplate . $templateName);
            return ob_get_contents();
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }
}