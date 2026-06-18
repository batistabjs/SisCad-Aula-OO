<?php
session_start();

// Autoload aprimorado para incluir core, config, models e controllers
spl_autoload_register(function ($class) {
    $paths = ['core/', 'config/', 'models/', 'controllers/', 'controllers/api/', 'controllers/api/integracao/'];
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

// Rotas Públicas (Permitidas sem login)
$router->get('/', 'LandingPageController@index');
$router->get('/landing', 'LandingPageController@index');
$router->get('/login', 'AuthController@login');
$router->post('/login/autenticar', 'AuthController@authenticate');

// Rota de Logout
$router->get('/auth/logout', 'AuthController@logout');

// Definição das Rotas - Dashboard
$router->get('/dashboard', 'DashboardController@index');

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

// Definição das Rotas - Módulo de Usuários
$router->get('/usuarios/lista', 'UsuarioController@index');
$router->get('/usuarios/cadastro', 'UsuarioController@create');
$router->post('/usuarios/salvar', 'UsuarioController@store');
$router->get('/usuarios/excluir', 'UsuarioController@delete');

// Definição das Rotas - Módulo de Pedidos
$router->get('/pedidos/lista', 'PedidoController@index');
$router->get('/pedidos/detalhes', 'PedidoController@details');
$router->get('/pedidos/cadastro', 'PedidoController@create');
$router->post('/pedidos/salvar', 'PedidoController@store');
$router->get('/pedidos/cancel', 'PedidoController@cancel');

// Definição das Rotas - API de Pedidos
$router->get('/api/pedidos', 'ApiPedidoController@index');
$router->get('/api/pedidos/porId', 'ApiPedidoController@porId');

// Definição das Rotas - Integrações Externas
$router->get('/api/integracao/dolar', 'ApiDolarApiController@index');

// Captura a página solicitada
// 1. Tenta pegar do parâmetro 'page' (usado pelo .htaccess do Apache)
// 2. Se não houver, usa a URI da requisição (para php -S ou outros servidores)
$uri = $_GET['page'] ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove 'index.php' da URI se estiver presente para evitar erro de rota
$uri = str_replace('/index.php', '', $uri);

// Define rota padrão se a URI for raiz, vazia ou apenas '/'
if ($uri === '/' || empty($uri)) {
    $uri = '/landing';
}

// --- Trava de Autenticação ---
// Definimos quais rotas são públicas
$publicRoutes = ['/', '/landing', '/login', '/login/autenticar', '/api/pedidos', '/api/pedidos/porId', '/api/integracao/dolar'];
if (!isset($_SESSION['user_id']) && !in_array($uri, $publicRoutes)) {
    header('Location: /login');
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

try {
    $router->dispatch($uri, $method);
} catch (Exception $e) {
    http_response_code(500);
    echo "<h1>Erro Interno do Servidor</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
