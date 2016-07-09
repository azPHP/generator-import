#!/bin/bash

docker run --name mysql -p 3306:3306 --rm -e MYSQL_ROOT_PASSWORD=root mysql:latest