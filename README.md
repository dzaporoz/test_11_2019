# Test work

## Installing:
- git clone https://github.com/dzaporoz/test_11_2019.git test
- cd test
- composer install
- sh install.sh

### Application is ready to run.
To run it in client-portal mode execute 'php artisan client-portal:install'

To run it in back-office mode, stop client mode execution and execute 'php artisan back-office:install'

A running application can be found at 'http://127.0.0.1:8000'


### Readiness
The main part of subject is done. I had a difficulty with understanding how can the application work in two modes.
So I implemented this using an environment variable on which depends a routing and user authentification provider class.

I also implemented only a basic test (tests/Feature/BackOfficeAuthTest.php). 
I'm having difficulty with testing controllers using methods other than GЕT (most likely due to my misunderstanding Laravel authorization nuances). Test file is tests/Feature/BackOfficeAuthTest.php
