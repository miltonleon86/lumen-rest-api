# MyTheresa Rest Api

* this boilerplate will cover:

```$bash
- Docker and docker compose 
- Lumen Migrations and Seeds examples
- Swagger Docs
- Api and Unit testing examples
- Eloquent databse relations examples
- MVC pattern and good practices
```

* make sure you don't have other apps running on port 80.

* Add mytheresa to your local hosts environment 
```$bash
 127.0.0.1       api.mytheresa.develop
```

* Go to the folder root and run
```$bash
 docker-compose build
 docker-compose up -d
 docker exec -it php composer install
```

* Run Migrations and seeds in order to create the needed data.
```$bash
docker exec -it php php artisan migrate
docker exec -it php php artisan db:seed
```

* Creating the docs
```$bash
Publish all
docker exec -it php php artisan swagger-lume:publish

Generate
docker exec -it php php artisan swagger-lume:generate

Url
http://api.mytheresa.develop/api/documentation

Please change the explore Url to http instead of https for local env.

seeded cart ids: 1, 2
seeded item ids: 1,2,3,4,5,6
```

* Running Api and Unit tests
```$bash
docker exec -it php ./vendor/bin/phpunit
sudo chmod 777 -R storage/
```

* Todo:
```$bash
- Configure Github pipelines
- Swagger Docs should use http on local env
- Complete CRUD and test.
```
