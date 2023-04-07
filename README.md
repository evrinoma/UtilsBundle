## Description

## Notice

показать проблемы кода

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --verbose --diff --dry-run
```

применить исправления

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php
```
## Тесты
```bash
COMPOSER_NO_DEV=0 composer install
/usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap tests/bootstrap.php --configuration phpunit.xml.dist tests --teamcity

```
## Thanks

## Done

## License
    PROPRIETARY
