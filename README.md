# RAINFALLZ

RainfallZ is an app to predict the amounts of rainfall that happened in Banyuasin Regency (January 2018 - December 2022) based on temperature, air pressure, air humidity, and wind velocity. Soft computing methods that used in this program are Tsukamoto Fuzzy Inference System, and Artificial Bee Colony Optimization Algorithm. This app built as final assignment to complete my study in Informatics Engineering major in Sriwijaya University

## Built With
![Code-Igniter 4](https://img.shields.io/badge/CodeIgniter-%23EF4223.svg?style=for-the-badge&logo=codeIgniter&logoColor=white)

![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)

## Getting Started

Here are steps to install and run this project to your computer locally :

### Prerequisites

1. Codeigniter 4
2. PHP version 7.3 or higher is require
3. git & git bash
4. Composer


### Installation

1. Clone the repo

	```
	git clone https://github.com/R4Z121/rainfallz.git
 	```

2. Create database with name 'rainfallz' in phpmyadmin
3. Import rainfallz.sql in root folder to rainfallz database in phpmyadmin
4. Open app/config/Database.php search for $default configuration, then change with your database configuration
5. Open git bash in folder root then run the following command :
    ```
    php spark serve
    ```
6. Run app in localhost:[port]/webshowcase
