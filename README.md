<a name="readme-top"></a>
# Permuttio
Simple web app where you can check stock and gold prices.

## Table of contents
* [About the project](#About-the-project)
* [Built with](#Built-with)
* [Prerequisites](#Prerequisites)
* [Installation](#Installation)


## About The Project

**Permuttio** is a project of website where you can check prices of gold from last 10 days, observe values of different currencies or check price of currency from choosing specific date.
Registering account is required to use website, you can then change password or delete account.<br>
Website can be viewed in Polish or English.<br> 
On registration avatar is created based on first and last name using <a href = "https://ui-avatars.com/">UI Avatars</a>.
All data about gold and currencies prices is from <a href="http://api.nbp.pl/">NBP API</a>. 

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built with
* Laravel 9.19
* PHP 8.0.2
* MySql 8.0
* <a href="http://api.nbp.pl/">NBP API</a>.
* <a href = "https://ui-avatars.com/">UI Avatars</a>.
* <a href = "https://www.chartjs.org/">Chart.js</a>.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Prerequisites
* <a href = "https://www.php.net/manual/en/install.php">PHP</a>
* <a href = "https://getcomposer.org/">Composer</a>
* PHP libraries:
  * bcmath, curl, json, mbstring, mysql, tokenizer, xml, zip
  * You can add them using this code
    ```
    sudo apt install php-bcmath php-curl php-json php-mbstring php-mysql php-tokenizer php-xml php-zip
    ```
<br>
* Optionally for database client <a href = "https://docs.docker.com/get-docker/">Docker</a> and <a href="https://docs.docker.com/compose/">Docker Compose</a>

### Installation

1. "cp .env.example .env".
2. You can set values for database connection in file .env or use "sudo docker-compose up -d" when using docker composer.
3. "composer update"
4. "php artisan key:generate".
5. "php artisan migrate".
6. "php artisan db:seed".
7. "php artisan storage:link".
8. "php artisan serve".

<p align="right">(<a href="#readme-top">back to top</a>)</p>



