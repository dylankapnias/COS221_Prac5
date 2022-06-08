<div align="center">
    <h1> COS221 Practical 5 </h1>
</div>

## Group Members
```PHP
$DylanKapnias = new Student("u18108467");
$MariePretorius = new Student("u21565342");
$LesediKekana = new Student("u20486473");
```

## Instructions
* Create a new database. (Using cli: "mysqladmin -u 'your_username' -p create 'name_of_database'). Insert password when asked.
* Import the database dump into the newly created database. (Using cli: "mysql -u 'your_username' -p 'name_of_database' < dump.sql"). Insert password when asked.
* Extract the files within the 'COS221_Prac5.tar.gz' archive into a folder within your Apache path. ('tar -xvf COS221_Prac.tar.gz')
* Move into the steezypar directory. Assuming that composer has been installed, whether locally or globally, you should now run composer's install (Local: 'php composer.phar install'; Global: 'composer install')
* Change the details within the 'assets/php/util/db-conn.php' to match those for the database you created using the dump.
* Navigate to the directory holding the index.php from your browser.