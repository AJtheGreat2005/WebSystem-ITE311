$mysqlPath = "C:\xampp\mysql\bin\mysql.exe"
$query = "USE lms_roquero; SET FOREIGN_KEY_CHECKS=0; DROP TABLE IF EXISTS users; SET FOREIGN_KEY_CHECKS=1;"
& $mysqlPath -u root -e $query
