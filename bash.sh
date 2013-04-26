#! /bin/bash
 
export db_user='MYSQL_USER'
export db_pass='MYSQL_PASSWD'
 
mysql -u $db_user -p$db_pass -h localhost < schedule.sql
 
php ical.php