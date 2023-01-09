#!/bin/bash

git pull

cd app

sh production-stop.sh;
sh launch-production.sh;

cd ..


