

CREATE TABLE `projecttrackerdb`.`tbl_userregistration` (
  `col_userid` INT NOT NULL AUTO_INCREMENT,
  `col_username` VARCHAR(45) NULL,
  `col_firstname` VARCHAR(45) NULL,
  `col_lastname` VARCHAR(45) NULL,
  `col_emailaddress` VARCHAR(45) NULL,
  `col_password` VARCHAR(45) NULL,
  `col_active` VARCHAR(45) NULL,
  PRIMARY KEY (`col_userid`));
