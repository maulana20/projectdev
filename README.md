# ticket-reservation
ticket reservation

install
```
$ docker-compose -f .\docker-compose.dev.yml build
$ docker-compose -f .\docker-compose.dev.yml up -d
```

copy db
```
$ cd db
$ cp .env.example .env
```

seeder
```
$ php artisan db:seed
```

unit test
```
$ php artisan test
```

swagger-ui
```
http://localhost/doc
```