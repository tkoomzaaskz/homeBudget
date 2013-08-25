The Wealthy Laughing Duck Project
---------------------------------

This repository is a [duck component](https://github.com/wealthy-laughing-duck).
Visit [Wealthy Laughing Duck Project](http://wealthy-laughing-duck.github.io/) for more information.

Symfony Web Application
=======================

This duck component is a standalone web application built with
[symfony PHP framework (version 1.4)](http://www.symfony-project.org)
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

Applications
------------

There's no `frontend` application. Backend app is the default one, it enables
users to manage their finances after successful login. There's also an API app
that allows external systems to communicate with the system.

Basic API
---------

To access the api, you need to pass appropriate password
([Basic HTTP Authentication](http://httpd.apache.org/docs/2.2/mod/mod_auth_basic.html)).
The default password (stored in this repo) is: `Hm0ByIEe5aGhNdov`. You may
override it, of course - modify [.htpasswd](public_html/.htpasswd) file in this
case.

Probably, you'll have to override the `AuthUserFile` in
[.htaccess](public_html/.htaccess) file, since Apache requires absolute path.

Continuous Intergation
----------------------

( *work in progress* )

[![Build Status](https://travis-ci.org/wealthy-laughing-duck/duck-symfony-webapp.png)](https://travis-ci.org/wealthy-laughing-duck/duck-symfony-webapp)
