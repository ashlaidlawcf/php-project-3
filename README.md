# Hair Salon Client Record Keeper
#### By Ash Laidlaw

## Description/Goals

The goal of this project is to build a web app which makes use of a SQL database via MAMP, which can be manipulated via PHP. The project is a fake hair salon client database, where each stylist can have a set of clients under his/her name.

## Technologies Used
* PHP
* MAMP
* mySQL
* Silex
* Twig
* HTML
* CSS

## Setup/Installation Requirements

To run this web app, please follow the instructions below.

1. Clone the repository to your computer at (https://github.com/Yhbv24/php-project-3).
2. Use Composer to install the Twig, Silex, and PHPUnit dependencies. You can read more here: (https://getcomposer.org/).
   * For Silex instructions: (http://silex.sensiolabs.org/).
   * For Twig instructions: (http://twig.sensiolabs.org/).
   * For PHPUnit instructions: (https://phpunit.de/).
3. Once all dependencies are installed, you must start the PHP server by navigating into the "web" folder in the project foler, and typing "php -S localhost:8000" in the Terminal.
4. To have access to the database, you will have to install MAMP. You can read more here: (https://www.mamp.info/en/).
5. Once MAMP is installed and the database is started, you will have to type "localhost:8888/phpmyadmin", which will take you to the database configurations.
6. At the top of the page, click "Import", and select the database from the project folder.
7. Once the database is ready to go, type "localhost:8000" in your browser of choice, which will allow you to use the web app.

## Specifications

1. Create files and folders necessary for the web app.
2. Install required dependencies.
3. Create databases for stylists and clients.
4. Create Stylist and Client objects, with required constructors for each.
   * Stylist constructor: id, first name, last name, telephone number
   * Client constructor: id, first name, last name, telephone number, stylist id
5. Create methods to add, change, and delete both stylists and clients.
6. Allow owner to sort clients into their stylists.

|     Spec     |     Input     |     Output     |
| ------------ | ------------- | -------------- |
| 1. All getters and setters work properly | Instantiate new objects for stylist | Object is instantiated properly |
| 2. Method to save stylist | Stylist: "ID, Jon, Smith, 123-456-7890" | Stylist: "ID, Jon, Smith, 123-456-7890 |
| 3. Method to return all stylists | GetAll method | Output should return all stylists as objects |
| 4. Method to find particular stylist | ID: 4 | Stylist with ID of 4 |
| 5. Method to change stylist's information | Number: "123-456-7890" | New Number: "234-567-8901" |
| 6. Method to delete a stylist | Delete single stylist method | Removes a single stylist from database |

## Known Bugs
* No known bugs

## License
* MIT

## Copyright
* © Ash Laidlaw 2017
