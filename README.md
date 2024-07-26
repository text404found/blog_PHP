### Stack Aleatória: LAMP (Linux, Apache, MySQL, PHP)

## Desafio: Sistema de Blog

### Descrição

Crie um sistema de blog onde os usuários possam criar uma conta, fazer login e publicar artigos. Cada usuário deve ser capaz de criar, editar e excluir seus próprios artigos. O sistema deve ter uma interface amigável e responsiva.

### Requisitos

### Front-end

- **Tecnologias**: HTML, CSS, JavaScript (com alguma biblioteca de front-end se desejar, como jQuery)
- **Funcionalidades**:
    - Tela de registro de usuário
    - Tela de login
    - Tela principal com a lista de artigos publicados
    - Funcionalidades para adicionar, editar e excluir artigos
    - Interface responsiva

### Back-end

- **Tecnologias**: PHP com Apache
- **Funcionalidades**:
    - Rotas para registro e autenticação de usuários
    - Rotas CRUD (Create, Read, Update, Delete) para os artigos
    - Validação de entrada de dados
    - Proteção das rotas com autenticação (por exemplo, usando sessões)

### Banco de Dados

- **Tecnologias**: MySQL
- **Funcionalidades**:
    - Tabela de usuários com campos para nome, email e senha (criptografada)
    - Tabela de artigos com campos para título, conteúdo, data de publicação e referência ao usuário dono do artigo

### Estrutura de Diretórios

**Front-end (HTML, CSS, JavaScript)**

```
/public
  /css
    - styles.css
  /js
    - scripts.js
  - index.html
  - login.html
  - register.html
  - dashboard.html
  - article.html

```

**Back-end (PHP com Apache)**

```
/src
  /controllers
    - authController.php
    - articleController.php
  /models
    - User.php
    - Article.php
  /views
    - auth
      - loginView.php
      - registerView.php
    - articles
      - articleListView.php
      - articleFormView.php
  - routes.php
  - config.php
  - database.php
  - index.php

```

### Dicas

- Para autenticação, utilize sessões em PHP.
- Para criptografar senhas, use a função `password_hash` do PHP.
- Utilize `AJAX` para requisições assíncronas no front-end.
- Utilize bibliotecas como `PHPMailer` para funcionalidades adicionais, como recuperação de senha.
- No MySQL, utilize consultas preparadas para proteger contra injeção de SQL.
- Ratchet baixado com composer, usando webscoket

-------------------------------------------------------------------------------------------------------



Configurando o Sistema de Blog
1. Front-end (HTML, CSS, JavaScript)
Crie a estrutura de diretórios conforme especificado:
/public
  /css
    - styles.css
  /js
    - scripts.js
  - index.html
  - login.html
  - register.html
  - dashboard.html
  - article.html

No arquivo index.html, você pode criar a página principal do blog, exibindo a lista de artigos publicados.
Implemente as telas de registro (register.html) e login (login.html) para os usuários.
Para adicionar, editar e excluir artigos, crie a página dashboard.html com os formulários e botões necessários.
Lembre-se de tornar o design responsivo usando CSS.
2. Back-end (PHP com Apache)
Crie os controladores (authController.php e articleController.php) para lidar com a lógica de autenticação e gerenciamento de artigos.
Defina rotas no arquivo routes.php para as funcionalidades de registro, login e CRUD de artigos.
Use sessões em PHP para gerenciar a autenticação dos usuários.
Utilize a função password_hash para criptografar senhas antes de armazená-las no banco de dados.
3. Banco de Dados (MySQL)
Crie uma tabela chamada users com os campos: id, name, email e password.
Crie outra tabela chamada articles com os campos: id, title, content, publication_date e uma referência ao usuário (por exemplo, user_id).
Proteja contra injeção de SQL usando consultas preparadas.
Dicas
Use AJAX para tornar as interações do usuário mais suaves (por exemplo, carregar artigos sem recarregar a página).
Considere usar a biblioteca PHPMailer para enviar e-mails (por exemplo, para recuperação de senha).
Se você deseja adicionar funcionalidades em tempo real (como notificações), o Ratchet (usando WebSockets) é uma ótima escolha.
Não se esqueça de criar um arquivo README.md para o GitHub com instruções claras sobre como instalar as dependências e configurar o sistema.
