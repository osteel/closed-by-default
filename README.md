# Closed-by-Default Principle

Companion repository for presentations on the Closed-by-Default Principle.

## What is it?

The Closed-by-Default Principle is a mindset for writing code that assumes everything should start out as constrained as possible, and only be opened up when there’s a concrete, proven need.

For instance, instead of leaving methods `public`, classes inheritable, or properties mutable _just in case_, you declare them `final`, `private`, `readonly`, or strongly typed by default. This reduces the _cognitive surface_ of your code: fewer paths to explore, fewer assumptions to keep in mind, and fewer opportunities for misuse.

When change is required, you deliberately open a piece of code by loosening a restriction, signalling to future developers that it was an intentional choice. Over time, this practice produces code bases that are safer, clearer, and easier to evolve – because openness is the exception, not the rule.

In summary, the Closed-by-Default Principle removes dead ends from your mental maze of code, revealing a straighter path to understanding.

## Slides

You will find the slide decks used for various events in [this folder](./slides).

## How to

If you wish to explore and experiment with this repository locally, clone it and install its Composer dependencies:

```shell
git clone git@github.com:osteel/closed-by-default.git && cd closed-by-default && composer install
```

To run all the static analysis tools at once:

```shell
composer static
```

Find the detail of the tools and rules below.

## Static analysis

Static analysis tools should be used to enforce the rules promoted by the Closed-by-Default Principle.

This brings consistency and predictability to the code, and alignment to the team.

### Enforce visibility declaration

* Tool: either [Pint](https://github.com/laravel/pint) or [PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) directly
* Rule: [modifier_keywords](https://cs.symfony.com/doc/rules/class_notation/modifier_keywords.html)
* Configuration:
  * Pint: [pint.json](./pint.json) (included in the [`laravel` preset](https://laravel.com/docs/pint#presets))
  * PHP CS Fixer: [.php-cs-fixer.dist.php](./.php-cs-fixer.dist.php) (included in the [@PER-CS ruleset](https://cs.symfony.com/doc/ruleSets/PER-CS.html))
* Usage:

```shell
# Pint
./vendor/bin/pint

# PHP CS Fixer
./vendor/bin/php-cs-fixer fix -v
```

### Privatise variables and methods

* Tool: either [Pint](https://github.com/laravel/pint) or [PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) directly
* Rule: [protected_to_private](https://cs.symfony.com/doc/rules/class_notation/protected_to_private.html)
* Configuration:
  * Pint: [pint.json](./pint.json)
  * PHP CS Fixer: [.phpcs-fixer.dist.php](./.phpcs-fixer.dist.php)
* Usage:

```shell
# Pint
./vendor/bin/pint

# PHP CS Fixer
./vendor/bin/php-cs-fixer fix -v
```

### Finalise classes

* Tool: [Swiss Knife](https://github.com/rectorphp/swiss-knife)
* Usage:

```shell
./vendor/bin/swiss-knife finalize-classes src
```

### Force strict types declaration

* Tool: [Rector](https://github.com/rectorphp/rector)
* Rule: [SafeDeclareStrictTypesRector](https://getrector.com/rule-detail/safe-declare-strict-types-rector)
* Configuration: [rector.php](./rector.php)
* Usage:

```shell
./vendor/bin/rector
```

### Fix missing type hints

* Tool: [Rector](https://github.com/rectorphp/rector)
* Ruleset: [Type Declarations](https://getrector.com/find-rule?rectorSet=core-type-declarations&activeRectorSetGroup=core)
* Configuration: [rector.php](./rector.php)
* Usage:

```shell
./vendor/bin/rector
```

### Report missing type hints

* Tool: [PHPStan](https://github.com/phpstan/phpstan)
* Level: [6](https://phpstan.org/user-guide/rule-levels)
* Configuration: [phpstan.dist.neon](./phpstan.dist.neon)
* Usage:

```shell
./vendor/bin/phpstan analyse
```

### Declare properties read-only

* Tool: [Rector](https://github.com/rectorphp/rector)
* Rule: [ReadOnlyPropertyRector](https://getrector.com/rule-detail/read-only-property-rector) (included in the [PHP 8.1 ruleset](https://getrector.com/find-rule?rectorSet=php-php-81&activeRectorSetGroup=php))
* Configuration: [rector.php](./rector.php)
* Usage:

```shell
./vendor/bin/rector
```

### Declare classes read-only

* Tool: [Rector](https://github.com/rectorphp/rector)
* Rule: [ReadOnlyClassRector](https://getrector.com/rule-detail/read-only-class-rector) (included in the [PHP 8.2 ruleset](https://getrector.com/find-rule?rectorSet=php-php-82&activeRectorSetGroup=php))
* Configuration: [rector.php](./rector.php)
* Usage:

```shell
./vendor/bin/rector
```

### Report missing constant types

* Tool: [PHPStan](https://github.com/phpstan/phpstan)
* Rule: [Require Minimal Type Coverage](https://github.com/TomasVotruba/type-coverage) ([extension](https://github.com/phpstan/extension-installer))
* Configuration: [phpstan.dist.neon](./phpstan.dist.neon)
* Usage:

```shell
./vendor/bin/phpstan analyse
```

## Continuous integration

An example of CI workflow running the tools listed above can be found [here](./.github/workflows/ci.yml).

See example runs [here](https://github.com/osteel/closed-by-default/actions).