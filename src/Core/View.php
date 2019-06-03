<?php

declare(strict_types=1);

namespace JiraTasks\Core;

class View
{
    private const TEMPLATE_MAIN = 'main';
    private const TEMPLATE_EXTENSION = 'php';

    /**
     * @var App
     */
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function render(string $template, array $vars = []) : void
    {
        ob_start();
        $data = [
            'body' => $this->html($template, $vars),
            'header' => $this->getHeaderData(),
        ];
        extract($data, EXTR_OVERWRITE);
        require $this->getTemplate(self::TEMPLATE_MAIN);
        $html = ob_get_clean();
        echo $html;
    }

    public function html(string $template, array $vars = []) : string
    {
        ob_start();
        extract(['vars' => $vars], EXTR_OVERWRITE);
        require $this->getTemplate($template);
        $html = ob_get_clean();
        return $html;
    }

    public function json(array $vars) : void
    {
        echo json_encode($vars);
    }

    private function getTemplate(string $template)
    {
        $templateName = $template . '.' . self::TEMPLATE_EXTENSION;
        $templatePath = TEMPLATE_PATH . DS . $templateName;
        if (!file_exists($templatePath) && is_readable($templatePath)) {
            throw new \RuntimeException(sprintf('Template [%s] not found', $templateName));
        }
        return $templatePath;
    }

    private function getHeaderData() : array
    {
        return [
            'js' => $this->app->getConfig()['js'],
            'css' => $this->app->getConfig()['css'],
            'meta' => $this->app->getConfig()['meta'],
        ];
    }
}
