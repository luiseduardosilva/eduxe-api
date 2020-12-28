<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Eduxe - API



#### Baixar projeto

```
git clone https://github.com/luiseduardosilva/eduxe-api
```

#### Docker-compose

```
docker-compose up -d
```


#### Installar dependencias

```
docker exec -it eduxe-php composer install
```

#### Chave Laravel
```
docker exec -it eduxe-php php artisan key:generate
```

#### Copiar `.env`

```
cp .env.example .env
```


#### Configurar Banco de dados
```
DB_CONNECTION=pgsql
DB_HOST=eduxe-postgres
DB_PORT=5432
DB_DATABASE=eduxe
DB_USERNAME=eduxe
DB_PASSWORD=eduxe
```

#### Rodar migrations
```
docker exec -it eduxe-php php artisan migrate
```
