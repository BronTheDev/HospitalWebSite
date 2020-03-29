# HospitalWebSite
Hospital Database website

Sidbury-Crawford & Aubron Moore  
Working the Database 

For our Hospital database, we used the Microsoft SQL Server, as well as SQL Server Management Studio,  to create and host a server, and our primary database, Hospital. We have kept the same authorizations and permissions for the project’s “Nurse”, “Patient”, and “Doctor” user groups. However,  PHP has been incorporated as our server-side programming language, due to its efficiency and strong compatibility with database-compatibility. This allowed us to easily create appealing webpages for users, display information from our Hospital database, and pass-through SQL Querys and script statements to modify and retrieve additional information. Despite this, we were not able to transfer over our previous client directly, since it employed Java. Therefore, much of the methods and classes from our first project had to be re-created using PHP, HTML, and some modification of our SQL Scripts. 

To establish a connection to our database, we downloaded the Microsoft Drivers for PHP for SQL Server and enabled them. This extension allowed us to integrate the PHP application with our SQL Server so that data can be both written and read within the script. To secure our network we created our own SSL certificate using OpenSSL in the Apache server and also added a subdomain to my localhost domain for the WWW certificate. We also used a md5 hash that hashed all user passwords and usernames before logging in and as soon as we registered a user whether that was a patient, doctor or nurse.


