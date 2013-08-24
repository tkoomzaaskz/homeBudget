The Wealthy Laughing Duck Project
=================================

Visit [project website](http://wealthy-laughing-duck.github.io/) for more information.

Symfony Web Application
-----------------------

This component is a standalone web application built with
[symfony PHP framework (version 1.4)](http://symfony.com/legacy)
and [Open Flash Chart](http://teethgrinder.co.uk/open-flash-chart/).
It requires a webserver (e.g. apache) with PHP5 and a SQL database.

Installation
------------

First, run the install shell script:

    $ ./install.sh

to fetch symfony sources from github. This script will load the dependency
as a git submodule and will set an appropriate branch. Afterwards, project
permissions are set (writable on `cache` and `log` directories) using
symfony command line.

Then, you shall create a database and fill it with data, you'll find helpful
scripts in the [project/data/sql](data/sql directory). After this you shall
set database permissions in config/databases.yml.

Shared hosting configuration
----------------------------

This project is configured for shared hostings. Check out more information
about this configuration on [symfony world blog](http://symfony-world.blogspot.com/2010/01/configuring-symfony-application-on.html).

Continuous intergation
----------------------

( *work in progress* )

[![Build Status](https://travis-ci.org/wealthy-laughing-duck/duck-symfony-webapp.png)](https://travis-ci.org/wealthy-laughing-duck/duck-symfony-webapp)
