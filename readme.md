<p align="center"><img src="https://hemis.edu.af/img/hemis-logo.png"></p>

# About HEMIS

**HEMIS** is the Management Information System for the Ministry of Higher Education.

# Developers Guideline

This project is going to be the main source of information for MoHE and other universities, so **Maintainablity** and **Flexibility** should be considered before writing even a single line of code. 

For any further development, contribution or fixing bugs, please consider the following guidelines to keep the project source code as clean as possible.

## 1. Coding Style Guide

Every single line of code MUST follow the PSR-2 “coding style guide”: [PSR-2](https://www.php-fig.org/psr/psr-2).

* Code MUST use 4 spaces for indenting, not tabs.

* There MUST NOT be a hard limit on line length; the soft limit MUST be 120
characters; lines SHOULD be 80 characters or less.

* There MUST be one blank line after the namespace declaration, and there
MUST be one blank line after the block of use declarations.

* Opening braces for classes MUST go on the next line, and closing braces MUST
go on the next line after the body.

* Opening braces for methods MUST go on the next line, and closing braces MUST
go on the next line after the body.

* Visibility MUST be declared on all properties and methods; abstract and
final MUST be declared before the visibility; static MUST be declared
after the visibility.

* Control structure keywords MUST have one space after them; method and
function calls MUST NOT.

* Opening braces for control structures MUST go on the same line, and closing
braces MUST go on the next line after the body.

* Opening parentheses for control structures MUST NOT have a space after them,
and closing parentheses for control structures MUST NOT have a space before.

Please find more details and examples about the above rules [here](https://www.php-fig.org/psr/psr-2).

### Naming Conventions

Class names MUST be declared in *StudlyCaps*

Class constants MUST be declared in all upper case with underscore separators: *const RELEASE_DATE*

Method names MUST be declared in *camelCase()*

Variable Names MUST be in *$camelCase*

### `git commit` Message Guidelines

Types of commit messages:

 * **build**: Changes that affect the build system or external dependencies (example scopes: gulp, packages, npm)
 * **ci**: Changes to CI configuration files and scripts (example scopes: artisan commands)
 * **docs**: Documentation-only changes
 * **feat**: A new feature
 * **fix**: A bug fix
 * **perf**: A code change that improves performance
 * **refactor**: A code change that neither fixes a bug nor adds a feature
 * **style**: Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)
 * **test**: Adding missing tests or correcting existing tests

 What this guide effectively says is that, if your commit cannot be described sticking to this guideline, then there’s something wrong with the changes you have made i.e. you should not be committing the code without refining it, or the changes should be separated into multiple commits.

 # Getting Started

In order to set up a HEMIS development environment on your local computer, please follow the below steps:

1. Download and install XAMPP and composer on your computer.
2. Clone the project from GitHub.
3. Navigate to the project root directory and run `composer update` to install all required packages and dependencies.
4. Import the HEMIS DATABASE into your local/development MySQL server.
  - Note: I will share the SQL schema of the database.
  - Importing the database from the command-line rather than from phpMyAdmin will take less time.
5. Set the values in the .env file of the project to match your local settings.