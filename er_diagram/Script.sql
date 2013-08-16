

alter table bluecard DROP FOREIGN KEY r_person_bluecard_1_M;

alter table booking DROP FOREIGN KEY r_person_booking_1_M;

alter table seat DROP FOREIGN KEY r_zone_seart_1_M;

alter table seat DROP FOREIGN KEY r_booking_seat_1_M;


Drop Procedure IF EXISTS sp_booking
;

Drop Procedure IF EXISTS sp_booking_confirm
;







drop table IF EXISTS person;
drop table IF EXISTS booking;
drop table IF EXISTS seat;
drop table IF EXISTS zone;
drop table IF EXISTS bluecard;




Create table bluecard (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	person_id Int UNSIGNED NOT NULL,
	code Varchar(20) NOT NULL COMMENT 'หมายเลขบัตร Blue Card ของปตท',
	createDate Datetime,
	updateDate Datetime,
 Primary Key (id)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

Create table zone (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	name Varchar(5) NOT NULL,
	price Decimal(8,2) NOT NULL COMMENT 'ราคาที่นั่งทั้งหมดภายในโซนนี้',
	description Tinytext,
	createDate Datetime NOT NULL,
	updateDate Datetime NOT NULL,
 Primary Key (id)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

Create table seat (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	zone_id Int UNSIGNED NOT NULL,
	booking_id Int UNSIGNED COMMENT 'รหัสการจอง',
	name Varchar(10) NOT NULL,
	is_booked Tinyint UNSIGNED COMMENT 'ทีนั่งนี้ถูกจองไปแล้วหรือยัง',
	is_soldout Tinyint UNSIGNED DEFAULT false COMMENT 'ที่นั่งนี้จ่ายเงินแล้วเหรือยัง',
	createDate Datetime NOT NULL,
	updateDate Datetime NOT NULL,
 Primary Key (id)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

Create table booking (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	person_id Int UNSIGNED NOT NULL,
	round Tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT 'รอบการจองตั๋ว',
	code Varchar(20) NOT NULL COMMENT 'หมายเลขรหัสการจอง',
	pay_date Datetime COMMENT 'วันที่ชำระเงิน',
	pay_money Decimal(10,2) COMMENT 'ยอดเงินที่โอน อาจจะต้องมีเศษเป็นสตางค์ด้วย    user เป็นผู้กรอกเมื่อแจ้งโอนเงิน',
	bank_name Varchar(255) COMMENT 'ชื่อธนาคาร',
	total_money Decimal(10,2) COMMENT 'ยอดเงินที่ต้องชำระ ต้องมีเศษสตางค์ด้วย (ใช้ id สองหลักท้าย)    คำนวณโดยโปรแกรม',
	bank_ref_id Varchar(20) COMMENT 'หมายเลขยืนยันจากธนาคาร',
	payment_type Tinyint UNSIGNED COMMENT '0=Credit  1=Tranfer',
	status Tinyint UNSIGNED DEFAULT 0 COMMENT '1=จองอยู่  2=ยืนยันการจอง  2=แจ้งโอนเงิน (รออนุมัติ)  3=จ่ายเงินแล้ว  99=เลยเวลา     เมื่อ flag เป็น 99 ต้องไป update table seat โดย set bookingId เป็น null',
	createDate Datetime,
	updateDate Datetime,
 Primary Key (id)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

Create table person (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	thName Varchar(255) NOT NULL,
	enName Varchar(255),
	username Varchar(20),
	password Varchar(255) COMMENT 'อาจต้องเข้ารหัส จึงออกแบบให้มีขนาดเยอะไว้ก่อน',
	question Varchar(200),
	answer Varchar(255),
	nickName Varchar(100),
	sex Char(1) COMMENT 'M=ชาย  F=หญิง',
	code Varchar(13) COMMENT 'เลขรหัสประชาชน',
	birthDate Datetime,
	email Varchar(255),
	tel Varchar(20),
	address Varchar(1000),
	job Varchar(255),
	job_area Varchar(255) COMMENT 'สถานที่ทำงาน',
	favorite_artist Varchar(255) COMMENT 'ศิลปินคนโปรด',
	createDate Datetime,
	updateDate Datetime,
	UNIQUE (id),
 Primary Key (id)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;









Alter table seat add Constraint r_zone_seart_1_M Foreign Key (zone_id) references zone (id) on delete  restrict on update  restrict;
Alter table seat add Constraint r_booking_seat_1_M Foreign Key (booking_id) references booking (id) on delete  restrict on update  restrict;
Alter table bluecard add Constraint r_person_bluecard_1_M Foreign Key (person_id) references person (id) on delete  restrict on update  restrict;
Alter table booking add Constraint r_person_booking_1_M Foreign Key (person_id) references person (id) on delete  restrict on update  restrict;



DELIMITER //
CREATE PROCEDURE sp_booking (IN person_id int, IN zone_id int, seat_ids varchar(100))
BEGIN
    START TRANSACTION;
    -- check booking table
    SET @booking_id = (SELECT b.id FROM booking b WHERE b.person_id=person_id AND b.status=1);
    SET @bound = ',';
--    SET @result="";
    IF(@booking_id>0) THEN
        SET @str_sql = CONCAT("UPDATE seat SET `booking_id`=NULL, is_booked=0, updateDate=NOW()
                                WHERE id NOT IN (",seat_ids,") AND zone_id=",zone_id,"
                                AND booking_id=",@booking_id,";");
        PREPARE stmt FROM @str_sql;
        EXECUTE stmt;
--        SELECT @result;
    ELSE
        INSERT INTO booking (`person_id`,`total_money`,`status`,`createDate`)
            VALUES (person_id, 0, 1, NOW());
        SET @booking_id =  (SELECT LAST_INSERT_ID());
    END IF;
    SET @occurance = (SELECT LENGTH(seat_ids) - LENGTH(REPLACE(seat_ids, @bound, ''))+1);
    SET @i=1;
    WHILE @i <= @occurance DO
        SET @splitted_value =
        (SELECT REPLACE(SUBSTRING(SUBSTRING_INDEX(seat_ids, @bound, @i),
        LENGTH(SUBSTRING_INDEX(seat_ids, @bound, @i - 1)) + 1), @bound, ''));
        
        UPDATE seat SET `booking_id`=@booking_id, is_booked=1, updateDate=NOW()
            WHERE seat.id=@splitted_value AND is_booked=0 AND seat.zone_id=zone_id;
--        SET @result = CONCAT(@result, "UPDATE WHERE id=",@splitted_value, " \n");
        SET @i = @i + 1;
    END WHILE;
    UPDATE booking SET total_money=(SELECT SUM(z.price) FROM seat s 
                                    LEFT JOIN zone z ON s.zone_id=z.id WHERE s.booking_id=@booking_id);
    SELECT s.id FROM seat s WHERE s.booking_id=@booking_id;
    COMMIT;
END//

delimiter //

CREATE PROCEDURE sp_booking_confirm (IN person_id int, IN booking_round int)
BEGIN

	START TRANSACTION;

	SET @booking_id = (SELECT b.id FROM booking b WHERE b.person_id=person_id AND b.status=1);

	IF(@booking_id IS NULL) THEN
		SELECT 0;
	ELSE
		SET @code=(SELECT CONCAT(booking_round, DATE_FORMAT(CURDATE(),'%m%d')
						, CAST((SELECT COUNT(b.id) FROM booking b WHERE b.person_id=person_id) AS UNSIGNED)
						, LPAD(CAST((SELECT COUNT(s.id) FROM seat s WHERE s.booking_id=9) AS UNSIGNED), 2, '0')
						, LPAD(person_id, 6, '0')));
		UPDATE booking SET code=@code ,status=2 ,updateDate=NOW()
			WHERE id=@booking_id;
		SELECT @booking_id;
	END IF;

	COMMIT;
END//









