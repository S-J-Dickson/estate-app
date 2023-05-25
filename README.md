### Getting Started

The repo is using Laravel Sail and has been developed on Unbuntu but as Laravel Sail uses docker technology the repo should work on all operating systems. 


1. Install Docker
2. Clone Repo
3. Cd in repo
4. Execute script

``docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs``
    
    
### Operations

1. ```./vendor/bin/sail up```
2. ``` ./vendor/bin/sail composer install```
3. ``` ./vendor/bin/sail composer migrate```

    
### Troubleshooting
 
 Stop all containers, other containers may be sharing same port not allowing the application to run
 
 1. ``docker stop $(docker ps -aq)``
 
**Error : service "laravel.test" is not running container #1**

1. Run ```docker ps -a```
2. Get container id of ``sail-8.2/app``
3. run ```docker start <CONTAINER_ID HERE>```

### Overview

![console output](https://github.com/S-J-Dickson/estate-app/assets/44926352/57d25b46-ade0-463c-9ef0-1799ab35ec69)

### Tests

 ![test output](https://github.com/S-J-Dickson/estate-app/assets/44926352/35b6e25b-dae9-47a0-809a-71575ba337e1)


### Designs

![image](https://github.com/S-J-Dickson/estate-app/assets/44926352/397f2418-3306-4c81-a5ca-587bdd265c05)

The database design would allow flexibility in adding additional titles, as using an enum datatype is better when using fixed states that will not change.

![image](https://github.com/S-J-Dickson/estate-app/assets/44926352/8e0dbb60-a512-4eed-bffe-dbe93654d5ac)

Time didn't allow for the creation of the controller, but using the service design, I can use the service with the controller easily. Currently, the service is being used with the command, and the service is easily unit tested, and the command has an integration test.

### Improvements

The code base doesn't handle edge cases not in the CSV format. Furthermore, the tests created only pass the successful cases, meaning there are no tests when things go wrong, for example, incorrect file formats, invalid characters, etc. More edge cases should be considered and added to the data provider.

To further secure the code base, the Laravel Validator class could be used to validate that the person's properties are valid inputs. An HTML purifier could be used to strip dangerous scripts to prevent could cause cross-site scripting or SQL injection. 

A frontend interface could be created to import the CSV. Finally, the person and title models have been made, but no data is stored in the database, but this could be easily achieved in the PersonService class.

If this project was to become longer-term, issues could be created. A branch would be created for the feature, and a pull request would be made once completed.

A simple GitHub workflow could be created to execute all the tests per pull request.
