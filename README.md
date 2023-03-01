## About project

This is a test project for working with json using api and docker

## Installation guide
### Tested on Ubuntu 22.04 and Linux Mint 19
#### If you get any write access errors, try to use <code> sudo chown -R $(whoami) . </code>
1. Install [Docker](https://docs.docker.com/engine/install/) and [Docker compose](https://docs.docker.com/compose/install/)
2. Download project from [this](https://github.com/Bomjarka/demo-app-docker) repository
3. Open project folder in terminal
   1. exec <code>sudo cp .env.example .env</code>
   2. exec <code>docker-compose up and wait until its finished</code>
   3. exec <code>sudo chmod -R 777 storage</code>
   4. enter to app container using following command <code>docker exec -ti demo_app_docker_app bash</code>
      1. in app container exec <code>php artisan key:generate
      2. php artisan migrate
      3. php artisan db:seed</code>
   5. Now you can open web side located at: http://localhost:8085/

## How to use
1. Open http://localhost:8085/json to see main page of application
   1. Here you can see web forms for adding JSON with parameters (user, json field, token)
   2. Also you can see table with all created json (if they exist), you can view them (through READ link) or delete (DELETE link)
2. As application has users after db::seed command you can just create tokens for them
   1. open app container <code>docker exec -ti demo_app_docker_app bash</code>
   2. use command php artisan generate-token login password, (you can see login in table project_users, default password from factory is "test")
   3. this command will create access token for user with lifetime set in tokens.php config file
3. Now you can use api routes for work with JSON
   1. http://localhost:8085/api/addJson is route for creating new json by token (access token in Header and json in body)
   2. http://localhost:8085/api/updateJson is route for updatein json by user (get token in header, code in body)
4. http://localhost:8085/json/{id} is route for viewing json as tree, here you can hide children of any level

## Used tools
1. [Docker](https://docs.docker.com)
2. [Docker compose](https://docs.docker.com/compose/)
3. [Laravel 10](https://laravel.com/)
4. [Postman](https://www.postman.com/)
