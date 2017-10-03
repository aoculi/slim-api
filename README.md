# Slim Api

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
    ->addEndpoint(Api\Home\Routes\Home::class)
    ->addEndpoint(Api\EndpointName\Routes\Endpoint::class); 
```


## To do
aoculi/slim-api-users (endpoint users + tokens + session + roles?)
aoculi/slim-api-migration (use phinx)
aoculi/slim-api-email (use swiftmailer/swiftmailer?)
aoculi/slim-api-validation (use respect/validation)
aoculi/slim-api-comments (endpoint comments)
aoculi/slim-api-likes (endpoint likes)
