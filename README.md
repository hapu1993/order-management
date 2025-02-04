<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Order Management System

**Project Introduction**
This project has been developed using Laravel 11 with the latest features. It also integrates Laravel Excel for handling file uploads and DOMPDF for generating PDFs.

### **Prerequisites**
	- PHP version: 8.2 - 8.4
	 - Composer installed
	 - Laravel 11

- **Step 01 (Clone the Repository)**
Clone the repository from Git using the following command:

	`git clone <repository_url>`

- **Step 02 (Configure the .env File)**
Insert the **.env** file provided in the email or configure your own database settings in the **.env** file located in the root of the project.

- **Step 03 (Database Setup)**
You can either:
	- Import the SQL file: Import the provided SQL file for database schema and data, or
	- Run Migrations: Run the Laravel migrations to create the necessary tables:
	
	`php artisan migrate`
- **Step 04 (Update Dependencies)**
Update the project dependencies using Composer:

	`composer update`

- **Step 05 (Serve the Application)**
Run the project using the following command:

	`php artisan serve`
	
	The project will be available at ` http://127.0.0.1:8000/ ` by default.

- **Step 06 (Upload Orders)**
To upload Excel or CSV order files, use the following API endpoint:

	`POST http://127.0.0.1:8000/api/order/upload`

	Make sure to use the correct file format as expected by the API (Excel or CSV).
	
 	### 	**Additional Notes**
	Ensure that your PHP version is compatible with Laravel 11 (PHP 8.2 - 8.4).
	
	If you are facing issues with file permissions, make sure your storage and bootstrap/cache directories are writable by the web server.



