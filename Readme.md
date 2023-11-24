
### Passo a passo
Baixar as imagens e criar os container
```sh
docker compose up -d --build

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini

DB_CONNECTION=mysql
DB_HOST=setup-mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=user
DB_PASSWORD=password

```

Limpar o cache
```sh
docker-compose exec setup-php php artisan config:cache
```

Caso necessário: Instalar as dependências do projeto
```sh
docker-compose exec setup-php composer install
```

Acessar o projeto
[http://localhost:8080/lista/Property](http://localhost:8080/lista/Property)
