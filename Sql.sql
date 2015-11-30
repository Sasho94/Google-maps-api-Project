DROP DATABASE IF EXISTS `museum`;
 create DATABASE museum;
 use museum;
 create table `museum`.`tab`
 (
 `name` VARCHAR(150) UNIQUE ,
 `address` VARCHAR(150), 
 `latitude` DOUBLE ,
 `longditude` DOUBLE ,
  
 `ID` int not null auto_increment,
 primary key (`ID`)
 )DEFAULT CHARSET=cp1251;
 
 GRANT ALL
ON museum.*
TO 'sasho'@'localhost'
IDENTIFIED BY 'secret';
ALTER DATABASE museum CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE tab CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT ignore INTO tab (name, address, latitude,longditude)
 VALUES ("Сасо", "suha reka", 1 , 2);
 
