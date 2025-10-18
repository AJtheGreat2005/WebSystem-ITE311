$mysqlPath = "C:\xampp\mysql\bin\mysql.exe"
$query = "CREATE DATABASE IF NOT EXISTS lms_roquero;"
& $mysqlPath -u root -e $query
