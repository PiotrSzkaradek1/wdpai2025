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

    /**
     * Sprawdza, czy bieżące żądanie to GET
     */
    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    /**
     * Sprawdza, czy bieżące żądanie to POST
     */
    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    /**
     * Renderuje widok
     * @param string|null $template - nazwa pliku widoku w public/views
     * @param array $variables - tablica zmiennych do przekazania do widoku
     */
    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            // Tworzymy zmienne lokalne z tablicy
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    /**
     * Funkcja pomocnicza do sprawdzania, czy użytkownik jest zalogowany
     */
    protected function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Funkcja pomocnicza do wymuszenia logowania
     */
    protected function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /index');
            exit;
        }
    }
}
