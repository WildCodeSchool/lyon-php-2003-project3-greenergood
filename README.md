# The Greener Good - Gare centrale

[![Build Status](https://travis-ci.com/WildCodeSchool/lyon-php-2003-project3-greenergood.svg?token=vxA4AusVVxs5jx1s6rqR&branch=master)](https://travis-ci.com/WildCodeSchool/lyon-php-2003-project3-greenergood)

![Wild Code School](https://wildcodeschool.fr/wp-content/uploads/2019/01/logo_pink_176x60.png)

It's symfony website-skeleton project with some additional tools to validate code standards.

* GrumPHP, as pre-commit hook, will run 2 tools when `git commit` is run :

  * PHP_CodeSniffer to check PSR2 
  * PHPStan will check PHP recommendation

  If tests fail, the commit is canceled and a warning message is displayed to developper.

* Travis CI, as Continuous Integration will be run when a branch with active pull request is updated on github. It will run :

  * Tasks to check if vendor, .idea, env.local are not versionned,
  * PHP_CodeSniffer to check PSR2,
  * PHPStan will check PHP recommendation.

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed

### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`

### Working

1. Run `symfony server:start` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets

### Testing

1. Run `./bin/phpcs` to launch PHP code sniffer
2. Run `./bin/phpstan analyse src --level max` to launch PHPStan
3. Run `./bin/phpmd src text phpmd.xml` to launch PHP Mess Detector
4. Run `./bin/eslint assets/js` to launch ESLint JS linter
5. Run `./bin/sass-lint -c sass-linter.yml` to launch Sass-lint SASS/CSS linter

### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

## Deployment

Add additional notes about how to deploy this on a live system


## Built With

* [Symfony](https://github.com/symfony/symfony)
* [GrumPHP](https://github.com/phpro/grumphp)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPStan](https://github.com/phpstan/phpstan)
* [PHPMD](http://phpmd.org)
* [ESLint](https://eslint.org/)
* [Sass-Lint](https://github.com/sasstools/sass-lint)
* [Travis CI](https://github.com/marketplace/travis-ci)

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.
