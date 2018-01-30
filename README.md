# Popular PHP Repositories on GitHub

This will list top 1000 starred (Popular) PHP repositories from github. Pagination is included at the bottom of the list for easy navigation.


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them

##### Server Requirements:
    * NGINX or Apache web server
    * PHP 7.0.0 or newer
    * MySQL
    * Node.js and npm
    * Composer
    * Or Use a homestead Vagrant for laravel https://laravel.com/docs/5.5/homestead

##### Technologies Used:
    * PHP
    * MySQL
    * Composer
    * npm    
    * Laravel 5.5
    * Bootsrap 4 (leveraged via CDN)
    * jQuery (leveraged via CDN)


### Installation

Laravel utilizes Composer to manage its dependencies. So, before using Laravel, make sure you have Composer installed on your machine.

1. Clone the popular-repositories Github repo to your target machine.

     ```git clone https://github.com/nafassait/popular-repositories.git popular-repositories```
    
2. In terminal, navigate to the directory, `popular-repositories/`, the repository base directory.

     ```cd popular-repositories/ ```
    
3. Install the Composer dependencies listed in the `composer.json` file.

	 ```composer install```
    
4. Copy the PHP dotenv file `.env.example` and name it `.env`.

	 ```cp -a .env.example .env```
    
5. Generate a Github personal access token with a scope that allows access to public repositories.
 
    <https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/>
    
    <https://github.com/settings/tokens>

6. Update the `GITHUB_TOKEN` variable in the `.env` file with the generated Github personal access token.

	 ```GITHUB_TOKEN=cp433c59d1149d45fda181c511430cf36fa12ad9```

7. Update the `GITHUB_USERAGENT` variable in the `.env` file with your Github username.

	```GITHUB_USERAGENT=github_username```

8. Create a MySQL database for the popular-repositories app and a corresponding user to access the created database.

	```CREATE DATABASE homestead;```
    
9. Update the `.env` file with the new database and user credentials.

    ```
    DB_HOST=127.0.0.1
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    ```

10. Run php artisan key:generate. This will create an app key

	 ```php artisan key:generate ```
	
11. Database migration. Run php artisan migrate which will create a github_repos table under the Database configured

	 ```php artisan migrate ```	

12. If PHP local server, run using below else set the webroot to point to the **popular-repositories/public** directory

    ```php artisan serve ```


## Project Architecture:

* Pages
    * Home Page
    * Repo Detail View
    * Fetch action for background ajax
* Controller: GithubController
    * Index Action: Renders home page with repository details fetched from model
    * Repo Action: Show a detail view page for selected repo by ID from model.
    * Fetch Action: Fetch latest data from Github
        * Fetch Data from Github search API using Github library class
        * Insert/Update entries to DB for the app interface
        * Can be triggered from app frontend or via a scheduled task
        * Fetch data recursively    
* Leverage GitHub Search API for data.
* Uses GithubRepo Model and Laravel Eloquent ORM for Database operations. 
* Use Migrate feature for DB tables creation.
* Model Class: GithubRepo
* API Library Class: Github

#### Schema
![Schema](/screenshots/Schema.jpg)


### Known Limitations

* Github API has rate limits
* Github Search is providing only up to 1000 items after that it will give error.


### Troubleshooting

##### UI broken
* Check the CSS and JS are loading from external CDN via network tools.
* Check for any errors in console.

##### Fetch fails
* Check API details are correct in .env
* Check API is available from the webserver
* Check error log laravel.log for details

##### Listing not showing any data / something went wrong message
* Enable debug from .env file.
* Validate the Data in DB and tables are configured correctly.
* Validate directories within the  storage and the bootstrap/cache directories is writable by your web server.
    ```APP_DEBUG=true```

## Screenshots

##### Home Page
![Home](/screenshots/Home.jpg)

##### Fetch Action
![Fetch Action](/screenshots/Fetch-Action.jpg)

##### Fetch Complete
![Fetch Complete](/screenshots/Fetch-Complete.jpg)

##### Repo Details
![Repo Details](/screenshots/Repo-Details.jpg)


## Author

**Nafas Sait** (https://github.com/nafassait)