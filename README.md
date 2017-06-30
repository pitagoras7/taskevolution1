#Task Evolution 

## Demo

https://asciinema.org/a/29589

## Install Instructions


## Build Instructions

### Linux

```bash

# Install Apache2 
sudo apt-get install apache2

# Install mysql Version > 5
sudo apt-get install mysql-server mysql-client

# Clone this repo  https://github.com/pitagoras7/taskevolution.git in /var/www/
git clone && cd  taskevolution

# Configure with the parameters of the database Mysql
clases/conexion.php

# Restore Database in Mysql 
clases/taskevolution.sql


# Restart Apache 
/etc/init.d/apache2 restart

## Register a user with parameters:
email =  Email
psw01 =  password 
psw02 =  Password confirmation

http://localhost/taskevolution/user/RestController.php?page_key=create&psw01=12345&psw02=12345&email=develope@gmail.com


## Enter the url 

http://localhost/taskevolution/

Welcome to Task Evolution! =)

For more help projas@evolution.com
```


## LICENSE

This software is licensed under the MIT License.

Copyright evolution, 2017.

Permission is hereby granted, free of charge, to any person obtaining a
copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to permit
persons to whom the Software is furnished to do so, subject to the
following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
USE OR OTHER DEALINGS IN THE SOFTWARE.
