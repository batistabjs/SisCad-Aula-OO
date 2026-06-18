# SisCad - Sistema de Cadastro

## Arquitetura do Projeto

O projeto foi refatorado para seguir uma arquitetura em camadas, separando responsabilidades de acesso a dados, lógica de negócio e apresentação.

### Estrutura de Pastas
- `config/`: Contém as configurações do sistema.
  - `database.php`: Implementação da classe `Database` utilizando o padrão **Singleton** para garantir uma única conexão PDO por requisição.
- `models/`: Camada de persistência e entidades.
  - `Contato.php`, `Cliente.php`, `Produto.php`: Classes de Entidade com atributos privados e métodos Getters/Setters (**Encapsulamento**).
  - `ContatoDAO.php`, `ClienteDAO.php`, `ProdutoDAO.php`: Data Access Objects responsáveis pelas queries SQL e conversão de dados para objetos.
- `views/`: Camada de apresentação (Templates).
  - `cabecalho.php`: Template global com Bootstrap e menu de navegação.
  - `rodape.php`: Template global de rodapé usado nas páginas montadas pelos controllers.
  - `landing-page.php`: Página inicial pública de apresentação do sistema de controle de vendas.
  - `dashboard/dashboard.php`: Resumo inicial do sistema após acessar a aplicação.
  - `contatos/`, `clientes/`, `produtos/`: Pastas com arquivos de listagem (`lista.php`) e formulários (`form.php`).
- `uploads/`: Armazenamento de imagens de produtos.
- `rotas.php`: Atua como o **Roteador Central** da aplicação. A rota `/` abre a landing page antes do acesso ao dashboard.
- `controllers/`: Montagem dinâmica das páginas, incluindo `cabecalho.php`, o conteúdo específico e `rodape.php`.

## Como Executar

1.  **Banco de Dados**:
    - Importe os arquivos em `bd-scripts/` no seu MySQL, de acordo com a ordem dos arquivos.
    - Certifique-se de que o banco de dados se chama `sis_cad`.
2.  **Configuração**:
    - Ajuste as credenciais de banco de dados em `config/database.php`.
3.  **Servidor**:
    - Inicie um servidor PHP na raiz do projeto:
      `php -S localhost:8000 index.php`
    - Acesse `http://localhost:8000` no navegador.

## Recursos Implementados
- Landing page pública como homepage do sistema de controle de vendas.
- Dashboard como tela inicial do sistema após acessar a aplicação.
- CRUD completo para Contatos, Clientes e Produtos.
- Busca e Paginação eficiente.
- Upload de imagens com renomeação segura.
- Mensagens de Feedback (Flash Messages) via Sessão.
- Proteção contra SQL Injection via Prepared Statements.
