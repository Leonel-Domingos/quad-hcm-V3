# Installation

<div class="alert alert-info">
<strong>SCSS and JS sources</strong><br>
Note that this package does not include the <code>scss</code> source files used for the theme. Please purchase the original <a href="https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0?ref=lodev09">Full HTML version</a> to customize your own copy.
</div>

This will guide you through the basic installation of SmartAdmin PHP v4. Some of the guide below may not apply to this copy of SmartAdmin PHP. If you find any issues or want to request a feature, visit us at our [Support Forum](https://support.gotbootstrap.com/t/php).

## Server Requirements

Before you install SmartAdmin, it's important to check that your server meets the requirements. To run SmartAdmin, you will need:

* **Apache** (with mod_rewrite enabled)
* **PHP 7.1+** with the following extensions: `dom`, `gd`, `json`, `mbstring`, `openssl`, `pdo_mysql`, `mcrypt`
* **MySQL 5.6+** or **MariaDB 10.0.5+**
* **SSH (command-line) access** to run Composer

<div class="alert alert-warning">
<strong>Shared Hosting</strong><br>
At this stage, it's not possible to install SmartAdmin by downloading a ZIP file and uploading the files to your web server. This is because SmartAdmin uses a dependency-management system called <a href="https://getcomposer.org" target="_blank">Composer</a> which needs to run on the command line.

This doesn't necessarily mean you need a VPS. Some shared hosts give you SSH access, through which you should be able to install Composer and SmartAdmin just fine. For other hosts without SSH, you can try workarounds such as <a href="https://github.com/andreherberth/pockethold" target="_blank">Pockethold</a>.
</div>

## Installing

SmartAdmin uses [Composer](https://getcomposer.org) to manage its dependencies and extensions. Before installing SmartAdmin, you will need to [install Composer](https://getcomposer.org) on your machine. Afterwards, run this command within the root folder where `composer.json` is located:

```bash
composer install
```

While this command is running, you can configure your web server. You will need to make sure your webroot is set to `/path/to/your/smartadmin/public`, and set up [URL Rewriting](#url-rewriting) as per the instructions below.

When everything is ready, navigate to your site in a web browser and follow the instructions to complete the installation.

### Configuration

<div class="alert alert-danger">
<strong>Sensitive Data</strong><br>
Make sure you store sensitive and private information in a secure location and not accessible publicly. <strong>DO NOT</strong> include the config file in your repository.
</div>

SmartAdmin PHP uses the package [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) to store sensitive and private information like database credentials. The package includes an `.env` file that you can modify as needed.

If you wish not to use `.env`, feel free to comment in `root.php:19-20` and modify the constants as needed.

```php
// load configuration
// $dotenv = Dotenv\Dotenv::create(ROOT_PATH, '.env');
// $dotenv->load();

// set the constant DB_HOST for example.
define('DB_HOST', 'localhost');
```

## URL Rewriting

Required for some features like the built-in REST API server.

### Apache

SmartAdmin includes a `.htaccess` file in the `public` directory – make sure it has been uploaded correctly. If you're using shared hosting, confirm with your provider that `mod_rewrite` is enabled and `.htaccess` files are allowed. If you're managing your own server, you may need to add the following to your site configuration:

```apache
DocumentRoot "/path/to/your/smartadmin/public"

<Directory "/path/to/your/smartadmin/public">
    AllowOverride All
</Directory>
```

## Customizing Paths

By default SmartAdmin's directory structure includes a `public` directory which contains only publicly-accessible files. This is a security best-practice, ensuring that all sensitive source code files are completely inaccessible from the web root.

However, if you wish to host SmartAdmin in a subdirectory (like `yoursite.com/smartadmin`), or if your host doesn't give you control over your webroot (you're stuck with something like `public_html` or `htdocs`), you can set up SmartAdmin without the `public` directory by following the steps below.

1. Move all the files inside the `public` directory (including `.htaccess`) into the directory you want to serve SmartAdmin from
2. Uncomment `.htaccess:125-128` to protect sensitive resources.
3. Edit `const.php` and update the `PUBLIC_PATH` constant:

	```php
	define('PUBLIC_PATH', __DIR__);
	// ...
	```
4. Edit `init.php`, `init.utils.php` and any other files that's requiring `const.php` and use the appropriate path:

	```php
	require_once 'const.php';
	// ...
	```

## Database

SmartAdmin PHP includes Database functionality using the package [lodev09/php-models](https://github.com/lodev09/php-models) to abstract your data. An SQL file is included within this package. It is located in the `db` folder.

Follow the installation below to get started.

### Importing data

Provided that you met the [MySQL server requirements](#server-requirements), follow these steps:

1. Login to `mysql` client and create the database.

	```bash
	CREATE DATABASE smartadmin_db;
	```
2. Import the sql file.

	```bash
	mysql -u root -p smartadmin_db < db/smartadmin_db.sql
	```
3. Configure the database credentials in the `.env` [file](#configuration).

	```conf
	DB_HOST=localhost
	DB_USER=root
	DB_PASSWORD=YOUR_PASSWORD
	DB_NAME=smartadmin_db
	```

## File Structure

This package comes with a flexible file structure that can be easily used for small to large scope projects. This section will explain app's file structure and how to adapt it to your project.

```
- README.md
- CHANGELOG.md
- screenshot.png
- screens.png
- smartadmin-php
	- db
	- lib
		- app
		- common
		- components
		- models
		- func.php
	- public
		- .htaccess
		- (public files)
	- utils
		- (util files)
	- .env
	- composer.json
	- composer.lock
	- config.php
	- debug.php
	- root.php
	- const.php
	- README.md
```

## Credits

This is the SmartAdmin PHP port of the original [SmartAdmin - Responsive WebApp](https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0?ref=lodev09) HTML 5 template. See [Package introduction](intel_introduction.php) for more information.

Authored by [@lodev09](https://twitter.com/lodev09).