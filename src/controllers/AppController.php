<?php

class AppController {

    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];

        // Start sesji, jeśli jeszcze nie została uruchomiona
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }


    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }


    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    protected function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }


    protected function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /index');
            exit;
        }
    }
}
