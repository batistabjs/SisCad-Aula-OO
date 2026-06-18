# SisCad - Sistema de Controle de Vendas

SisCad é uma aplicação web em PHP puro para gestão de clientes, contatos, produtos, pedidos e usuários. O projeto está organizado em uma arquitetura em camadas inspirada em MVC, roteador próprio, controllers, models/DAOs e views separadas.

## Arquitetura

### Fluxo principal de uma requisição

1. `index.php` inicia a sessão, registra o autoload e configura as rotas.
2. O `core/Router.php` recebe a URI e o método HTTP e despacha para o controller correspondente.
3. O controller consulta os DAOs em `models/`.
4. A view renderiza o HTML, normalmente usando `views/cabecalho.php` e `views/rodape.php` como layout base.
5. Mensagens de feedback são armazenadas em sessão e exibidas como flash messages.

### Camadas

- **Front controller:** `index.php`
  - Centraliza a inicialização da aplicação.
  - Define as rotas.
  - Aplica a trava de autenticação.
  - Remove `index.php` da URI para funcionamento no servidor embutido do PHP.

- **Roteador:** `core/Router.php`
  - Suporta rotas `GET` e `POST`.
  - Aceita handlers no formato `Controller@method`.
  - Retorna erro `404` quando a rota não existe.
  - Captura exceções em `index.php` e exibe erro `500`.

- **Controllers:** `controllers/`
  - Orquestram a lógica de aplicação.
  - Recebem dados de `$_GET`, `$_POST`, `$_FILES` e sessão.
  - Instanciam DAOs.
  - Redirecionam após ações de escrita.
  - Preparam dados para as views.

- **Models e DAOs:** `models/`
  - Entidades representam os dados em memória.
  - DAOs concentram consultas SQL, prepared statements e conversão de resultados para objetos.
  - A conexão com o banco é centralizada em `config/database.php`.

- **Views:** `views/`
  - Templates HTML separados por módulo.
  - `cabecalho.php` contém o menu principal e a exibição de flash messages.
  - `rodape.php` encerra o layout padrão.
  - `landing-page.php` é uma página pública independente.
  - `login.php` é a tela de autenticação.

- **Configuração:** `config/`
  - `database.php`: classe `Database` em padrão Singleton.
  - `api.php`: configuração da chave usada pela API de pedidos.

## Estrutura de pastas

```text
.
├── config/
│   ├── api.php
│   └── database.php
├── controllers/
│   ├── api/
│   │   ├── ApiPedidoController.php
│   │   └── integracao/
│   │       └── ApiDolarApiController.php
│   ├── AuthController.php
│   ├── ClienteController.php
│   ├── ContatoController.php
│   ├── DashboardController.php
│   ├── LandingPageController.php
│   ├── PedidoController.php
│   ├── ProdutoController.php
│   └── UsuarioController.php
├── core/
│   └── Router.php
├── models/
│   ├── Cliente.php
│   ├── ClienteDAO.php
│   ├── Contato.php
│   ├── ContatoDAO.php
│   ├── Pedido.php
│   ├── PedidoDAO.php
│   ├── PedidoItem.php
│   ├── Produto.php
│   ├── ProdutoDAO.php
│   ├── Usuario.php
│   └── UsuarioDAO.php
├── views/
│   ├── cabecalho.php
│   ├── rodape.php
│   ├── landing-page.php
│   ├── login.php
│   ├── clientes/
│   ├── contatos/
│   ├── dashboard/
│   ├── pedidos/
│   ├── produtos/
│   └── usuarios/
├── uploads/
└── bd-scripts/
```

## Módulos do sistema

### Página pública

- `/` redireciona internamente para `/landing`.
- `/landing` exibe a landing page.
- `/login` exibe a tela de autenticação.

### Autenticação

- Login por usuário e senha armazenados na tabela `usuarios`.
- Sessão mantém `user_id`, `usuario` e `perfil`.
- Rotas internas exigem autenticação.
- `/auth/logout` encerra a sessão e redireciona para `/login`.

Credenciais iniciais criadas pelos scripts:

| Usuário | Perfil |
| --- | --- |
| `admin` | `Administrador` |
| `ana` | `Moderador` |
| `bruno` | `Usuario_Comum` |

A senha padrão dos usuários seed é `12345`.

### Dashboard

- `/dashboard`
- Exibe contadores de contatos, clientes, produtos e pedidos.
- Consulta a cotação do dólar via endpoint interno `/api/integracao/dolar`.

### Contatos

Rotas:

| Método | Rota | Ação |
| --- | --- | --- |
| `GET` | `/contatos/lista` | Lista com busca e paginação |
| `GET` | `/contatos/cadastro` | Tela de cadastro/edição |
| `POST` | `/contatos/salvar` | Salva contato |
| `GET` | `/contatos/excluir` | Exclui contato |

### Clientes

Rotas:

| Método | Rota | Ação |
| --- | --- | --- |
| `GET` | `/clientes/lista` | Lista clientes |
| `GET` | `/clientes/cadastro` | Tela de cadastro/edição |
| `POST` | `/clientes/salvar` | Salva cliente |
| `GET` | `/clientes/excluir` | Exclui cliente |

### Produtos

Rotas:

| Método | Rota | Ação |
| --- | --- | --- |
| `GET` | `/produtos/lista` | Lista produtos |
| `GET` | `/produtos/cadastro` | Tela de cadastro/edição |
| `POST` | `/produtos/salvar` | Salva produto |
| `GET` | `/produtos/excluir` | Exclui produto |

Recursos:

- Upload opcional de imagem.
- Extensões permitidas: `jpg`, `jpeg`, `png` e `webp`.
- Arquivos são salvos em `uploads/` com nome único.

### Usuários

Rotas:

| Método | Rota | Ação |
| --- | --- | --- |
| `GET` | `/usuarios/lista` | Lista usuários |
| `GET` | `/usuarios/cadastro` | Tela de cadastro/edição |
| `POST` | `/usuarios/salvar` | Salva usuário |
| `GET` | `/usuarios/excluir` | Exclui usuário |

### Pedidos

Rotas:

| Método | Rota | Ação |
| --- | --- | --- |
| `GET` | `/pedidos/lista` | Lista pedidos |
| `GET` | `/pedidos/detalhes?id=...` | Exibe detalhes do pedido |
| `GET` | `/pedidos/cadastro` | Tela de criação de pedido |
| `POST` | `/pedidos/salvar` | Salva pedido e itens |
| `GET` | `/pedidos/cancel?id=...` | Cancela pedido e restaura estoque |

Recursos:

- Pedido vinculado a cliente.
- Múltiplos itens por pedido.
- Cálculo de subtotal e total geral no formulário.
- Status: `Novo`, `Pendente`, `Entregue` e `Cancelado`.
- Cancelamento restaura a quantidade dos produtos no estoque.
- Salva pedido e itens em transação.

## API

### API de pedidos

Rotas públicas:

| Método | Rota | Parâmetro | Descrição |
| --- | --- | --- | --- |
| `GET` | `/api/pedidos` | - | Lista pedidos |
| `GET` | `/api/pedidos/porId` | `id` | Busca pedido por ID com itens |

Requisitos:

- Exige o cabeçalho `chave_nossa_api`.
- A chave é configurada em `config/api.php`.
- Retorna `401` quando a chave está ausente ou inválida.
- Retorna `400` quando o ID não é informado.
- Retorna `404` quando o pedido não é encontrado.

### Integração com cotação do dólar

Rota pública:

| Método | Rota | Descrição |
| --- | --- | --- |
| `GET` | `/api/integracao/dolar` | Busca a cotação USD/BRL em `dolarapi.com` |

Resposta:

```json
{
  "valor": 0.00,
  "moeda": "USD",
  "data": "2026-06-18"
}
```

## Banco de dados

O banco utilizado é `sis_cad`. Os scripts devem ser executados em ordem no MySQL/MariaDB:

```text
bd-scripts/00_estrutura.sql
bd-scripts/01_sementes.sql
bd-scripts/02_idx_contatos.sql
bd-scripts/03_alter_produtos.sql
bd-scripts/04_usuarios.sql
bd-scripts/05_usuarios_seeds.sql
bd-scripts/06_pedidos.sql
bd-scripts/07_add_status_pedidos.sql
```

### Tabelas principais

- `contatos`
- `clientes`
- `produtos`
- `usuarios`
- `pedidos`
- `pedidos_itens`

### Configuração da conexão

A conexão padrão está em `config/database.php`:

```php
$host = 'localhost';
$db   = 'sis_cad';
$user = 'root';
$pass = '';
```

Para produção, altere essas credenciais e evite manter usuário `root` sem senha.

## Como executar

### Pré-requisitos

- PHP 7.4+ ou superior.
- MySQL ou MariaDB.
- Servidor web ou servidor embutido do PHP.

### Passos

1. Crie o banco de dados e execute os scripts SQL em ordem.
2. Ajuste as credenciais em `config/database.php`, se necessário.
3. Ajuste a chave da API em `config/api.php`, se for usar a API de pedidos.
4. Inicie o servidor na raiz do projeto:

```bash
php -S localhost:8000 index.php
```

5. Acesse:

```text
http://localhost:8000
```

## Recursos implementados

- Arquitetura em camadas com front controller e roteador próprio.
- Autoload simples para `core/`, `config/`, `models/` e `controllers/`.
- Login com sessão.
- Proteção de rotas internas por autenticação.
- Layout compartilhado com cabeçalho, menu e rodapé.
- Flash messages via sessão.
- CRUD de contatos, clientes, produtos, usuários e pedidos.
- Busca e paginação em contatos.
- Upload de imagens de produtos.
- Pedidos com múltiplos itens.
- Transações no cadastro e cancelamento de pedidos.
- Cancelamento de pedidos com restauração de estoque.
- API REST de pedidos com validação por chave.
- Integração pública com API externa de cotação do dólar.
- Uso de prepared statements para consultas SQL.

## Observações

- O projeto não utiliza Composer, Laravel, Symfony ou outro framework PHP.
- O servidor embutido do PHP funciona diretamente pela rota da URI.
- As páginas internas usam caminhos absolutos como `/dashboard`, `/produtos/lista` e `/pedidos/cadastro`.
