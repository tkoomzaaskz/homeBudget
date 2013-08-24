#!/bin/bash

git submodule init
git submodule update

cd symfony
git checkout 1.4

cd ../project
./symfony project:permissions

cp config/databases.tpl config/databases.yml
