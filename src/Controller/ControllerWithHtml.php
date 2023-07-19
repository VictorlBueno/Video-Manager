<?php

namespace Alura\Mvc\Controller;

// importa automaticamente o viewer de cada controller
abstract class ControllerWithHtml implements Controller
{
    // endereço das views padrão
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';

    protected function renderTemplate(string $templateName, array $context = []): string
    {
        // extrai a lista da array para poder ser utilizada
        extract($context);

        // Buffer: armazena tudo que seria armazenado após o código (require_once) e salva para ser retornar
        ob_start();

        // retorna o endereço correto de cada controller
        require_once self::TEMPLATE_PATH . $templateName . '.php';

        // Buffer: pega o conteúdo e limpa o buffer
        return ob_get_clean();
    }
}