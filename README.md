# Slim Api

[![Build Status](https://travis-ci.org/aoculi/slim-api.svg?branch=master)](https://travis-ci.org/aoculi/slim-api) [![License](https://poser.pugx.org/aoculi/slim-api/license)](https://packagist.org/packages/aoculi/slim-api)

This is a starter Api code for Slim 3.0+. 
This Api was designed to be a unique starter code when starting a fresh new Api.
This project was also built to be easily extensible when we need common endpoint (cf: future endpoint plugins). 

## Installing

Get last version with [Composer](http://getcomposer.org "Composer").

```bash
composer require aoculi/slim-api
```
## Create a new Endpoint
You can add new routes for your api on public/index.php
```bash
$app = (new App($config))
    ->addEndpoint(Api\Token\Routes\Token::class)
    ->addEndpoint(Api\Home\Routes\Home::class)
    ->addEndpoint(Api\MyNewEndPointName\Routes\MyEndPoint::class); 
```

## Authentication
POST /v1/token with good credentials as Basic Auth
```bash
curl --request POST \
  --url http://192.168.33.33/v1/token \
  --user admin:test
```  

HTTP/1.1 201 Created
Content-Type: application/json
{
    "token": "XXXXXXXXXX",
    "expires": 1491030210
}

Now you can access all other routes with the token
```bash
curl --request GET \
  --url http://192.168.33.33/ \
  --header 'authorization: Bearer {TOKEN}' \
```


## To do
* aoculi/slim-api-users (endpoint users + tokens and session management + roles?)
* aoculi/slim-api-migration (use phinx)
* aoculi/slim-api-email (use swiftmailer/swiftmailer?)
* aoculi/slim-api-validation (use respect/validation)
* aoculi/slim-api-comments (endpoint comments)
* aoculi/slim-api-likes (endpoint likes)
