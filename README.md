# Todoify
Instalação e Configuração da Aplicação Todoify
A aplicação Todoify é uma aplicação web desenvolvida com Vue.js no frontend e PHP no backend. Ela possui funcionalidades exclusivas para usuários comuns e administradores, além de utilizar pacotes NPM e Composer.
Pré-requisitos
Antes de começar, certifique-se de ter os seguintes softwares instalados em sua máquina:

    Node.js (versão 14 ou superior)
    PHP (versão 7.4 ou superior)
    Composer (gerenciador de pacotes PHP)

## Instalação

    Clonar o repositório:
    git clone https://github.com/seu-usuario/todoify.git

## Instalar as dependências do frontend (Vue.js):

cd todoify/frontend
npm install

## Instalar as dependências do backend (PHP):

cd ../backend
composer install

## Configurar o banco de dados:

    Crie um banco de dados MySQL com o nome todoify.

## Executar as migrações do banco de dados:

cd backend
php artisan migrate

# Importante:
## Ao executar as migrations, um usuário admin será criado, ele pode ser acessado utilizando o email admin@gmail.com e a senha 1234.

## Executar os scripts de seed:

php artisan db:seed TaskSeeder

php artisan db:seed

## Iniciar o servidor de desenvolvimento:

    Frontend (Vue.js):

    cd frontend
    npm run dev

## Backend (PHP):

cd backend
php artisan serve

Agora a aplicação Todoify está pronta para ser usada! Acesse http://localhost:5173(ou a porta em que for utilizada pelo vue) no seu navegador para ver a aplicação em execução.
## Funcionalidades
A aplicação Todoify possui as seguintes funcionalidades:
Usuários Comuns

    concluir ou definir em outros estados as tarefas.
    Visualizar um painel com as tarefas pendentes e concluídas.

## Usuários Administradores
Além das funcionalidades dos usuários comuns, os administradores também podem:

    Gerenciar (editar, ativar/desativar) usuários.

## Estrutura do Projeto
O projeto Todoify está organizado da seguinte forma:

    A pasta frontend contém todo o código-fonte da aplicação Vue.js.
    A pasta backend contém todo o código-fonte da aplicação PHP.
