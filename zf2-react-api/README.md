# Webdev ZF2 Skeleton Project

The skeleton project is a barebones ZF2 application to get you started. A default module `App` is provided with some helpful configurations and an index controller.

## Installation

Use [Composer](http://wiki.webdev.its.iastate.edu/topic/Composer) to create a new skeleton project:

~~~bash
$ cd <locker>/projects
$ composer create-project webdev/zf-skeleton my-project
~~~

Replace `my-project` with your project name.

### Alias

You can alias the create project command in your `~/.bashrc` for convenience:

~~~bash
alias wdzf='composer create-project webdev/zf-skeleton'
~~~

## Post installation

* Place your production and development database credentials in the `config/local.config.php` file.
* Change the name and description in the `composer.json` file to that of your project's.
* Replace the `README.md` file with documentation specific to the project.
* Update the robots.txt file to allow indexing of the site by search engines as appropriate.  The provided robots.txt file is set to disallow all indexing by default.
