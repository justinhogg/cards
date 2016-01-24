# cards
A simple command line interface to play games of cards

### Installation

git clone this repository.

Download composer: curl -s https://getcomposer.org/installer | php

Install dependencies, run this command from the root directory:

```php composer.phar install```

### Commands

*games*

__play:cards__ - Play a new card game.

To run this command from the root directory: 

```php games.php play:cards```

### Options


### Unit Tests

To run this command from the root directory:

``` ./vendor/bin/phpunit ```
``` ./vendor/bin/phpunit --testsuite [Cards|Games|Players]```


### PSR2

To run this code sniff command from the root directory:

``` ./vendor/bin/phpcs --standard=PSR2 src/Cilex```

To run this code sniff fixer command from the root directory:

``` ./vendor/bin/phpcbf --standard=PSR2 src/Cilex```