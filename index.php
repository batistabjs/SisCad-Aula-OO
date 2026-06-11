<?php
session_start();

// Autoload aprimorado para incluir core, config, models e controllers
spl_autoload_register(function ($class) {
    $paths = ['core/', 'config/', 'models/', 'controllers/'];
    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Helper para Flash Messages
function setFlash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

// Inicialização do Roteador
$router = new Router();

// Definição das Rotas - Módulo de Contatos
$router->get('/contatos/lista', 'ContatoController@index');
$router->get('/contatos/cadastro', 'ContatoController@create');
$router->post('/contatos/salvar', 'ContatoController@store');
$router->get('/contatos/excluir', 'ContatoController@delete');

// Definição das Rotas - Módulo de Clientes
$router->get('/clientes/lista', 'ClienteController@index');
$router->get('/clientes/cadastro', 'ClienteController@create');
$router->post('/clientes/salvar', 'ClienteController@store');
$router->get('/clientes/excluir', 'ClienteController@delete');

// Definição das Rotas - Módulo de Produtos
$router->get('/produtos/lista', 'ProdutoController@index');
$router->get('/produtos/cadastro', 'ProdutoController@create');
$router->post('/produtos/salvar', 'ProdutoController@store');
$router->get('/produtos/excluir', 'ProdutoController@delete');

// Captura a página solicitada via GET 'page' para simular rotas amigáveis
$uri = $_GET['page'] ?? '/contatos/lista';
$method = $_SERVER['REQUEST_METHOD'];

try {
    $router->dispatch($uri, $method);
} catch (Exception $e) {
    http_response_code(500);
    echo "<h1>Erro Interno do Servidor</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
