## Configurando o Ambiente de Desenvolvimento com Docker

Para iniciar o projeto localmente, siga estas etapas:

1. Clone o repositório:
   ```bash
   git clone https://github.com/fellipemauriciosilva/challange-innyx.git

2. Navegue até o diretório do projeto:
   ```bash
   cd api-innyx

3. Abra o arquivo .env e configure as variáveis de ambiente do banco de dados:
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=database-name
    DB_USERNAME=database-username
    DB_PASSWORD=database-password

4. Execute os seguintes comandos para construir e iniciar os contêineres Docker:
   ```bash
    docker-compose build
    docker-compose up -d

5. Instale as dependências do Composer e execute as migrações do Laravel:
   ```bash
    docker-compose exec app composer install
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate

6. Acesse o aplicativo em http://localhost:8080 (ou na porta configurada no docker-compose.yml).

   


