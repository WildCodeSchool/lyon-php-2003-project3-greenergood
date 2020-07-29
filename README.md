# The Greener Good - Gare centrale
### Prerequisites


1. Check that composer is installed : https://getcomposer.org/
2. Check that node & yarn are installed : 
    * https://nodejs.org/en/download/
    * https://classic.yarnpkg.com/fr/docs/install 

## Deployment

* Clone this project
* Run `composer install`
* Run `yarn install`
* Change database infos in .env.local (line 27)
* Change mailer DSN in .env.local (line 31)
* Run `yarn encore prod`


## Built With

* [Symfony](https://github.com/symfony/symfony)
* [GrumPHP](https://github.com/phpro/grumphp)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPStan](https://github.com/phpstan/phpstan)
* [PHPMD](http://phpmd.org)
* [ESLint](https://eslint.org/)
* [Sass-Lint](https://github.com/sasstools/sass-lint)
* [Travis CI](https://github.com/marketplace/travis-ci)

