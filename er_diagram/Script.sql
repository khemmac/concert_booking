/*
Created		8/7/2013
Modified		15/8/2013
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


alter table bluecard DROP FOREIGN KEY r_person_bluecard_1_M;

alter table booking DROP FOREIGN KEY r_person_booking_1_M;

alter table seat DROP FOREIGN KEY r_zone_seart_1_M;

alter table seat DROP FOREIGN KEY r_booking_seat_1_M;


Drop Procedure IF EXISTS sp_booking
;







drop table IF EXISTS person;
drop table IF EXISTS booking;
drop table IF EXISTS seat;
drop table IF EXISTS zone;
drop table IF EXISTS bluecard;




Create table bluecard (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	person_id Int UNSIGNED NOT NULL,
	code Varchar(20) NOT NULL COMMENT '�����Ţ�ѵ� Blue Card �ͧ���',
	createDate Datetime,
	updateDate Datetime,
 Primary Key (id)) ENGINE = InnoDB;

Create table zone (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	name Varchar(5) NOT NULL,
	price Decimal(8,2) NOT NULL COMMENT '�Ҥҷ���觷���������⫹���',
	description Tinytext,
	createDate Datetime NOT NULL,
	updateDate Datetime NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table seat (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	zone_id Int UNSIGNED NOT NULL,
	booking_id Int UNSIGNED COMMENT '���ʡ�èͧ',
	name Varchar(10) NOT NULL,
	is_booked Tinyint UNSIGNED COMMENT '�չ�觹��١�ͧ����������ѧ',
	is_soldout Tinyint UNSIGNED DEFAULT false COMMENT '����觹������Թ����������ѧ',
	createDate Datetime NOT NULL,
	updateDate Datetime NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table booking (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	person_id Int UNSIGNED NOT NULL,
	code Varchar(20) NOT NULL COMMENT '�����Ţ���ʡ�èͧ',
	pay_date Datetime COMMENT '�ѹ�������Թ',
	pay_money Decimal(10,2) COMMENT '�ʹ�Թ����͹ �Ҩ�е�ͧ�������ʵҧ�����    user �繼���͡��������͹�Թ',
	bank_name Varchar(255) COMMENT '���͸�Ҥ��',
	total_money Decimal(10,2) COMMENT '�ʹ�Թ����ͧ���� ��ͧ�����ʵҧ����� (�� id �ͧ��ѡ����)    �ӹǳ�������',
	bank_ref_id Varchar(20) COMMENT '�����Ţ�׹�ѹ�ҡ��Ҥ��',
	payment_type Tinyint UNSIGNED COMMENT '0=Credit  1=Tranfer',
	status Tinyint UNSIGNED DEFAULT 0 COMMENT '1=�ͧ����  2=�׹�ѹ��èͧ  2=���͹�Թ (��͹��ѵ�)  3=�����Թ����  99=�������     ����� flag �� 99 ��ͧ� update table seat �� set bookingId �� null',
	createDate Datetime,
	updateDate Datetime,
 Primary Key (id)) ENGINE = InnoDB;

Create table person (
	id Int UNSIGNED NOT NULL AUTO_INCREMENT,
	thName Varchar(255) NOT NULL,
	enName Varchar(255),
	username Varchar(20),
	password Varchar(255) COMMENT '�Ҩ��ͧ������� �֧�͡Ẻ����բ�Ҵ��������͹',
	question Varchar(200),
	answer Varchar(255),
	nickName Varchar(100),
	sex Char(1) COMMENT 'M=���  F=˭ԧ',
	code Varchar(13) COMMENT '�Ţ���ʻ�ЪҪ�',
	birthDate Datetime,
	email Varchar(255),
	tel Varchar(20),
	address Varchar(1000),
	job Varchar(255),
	job_area Varchar(255) COMMENT 'ʶҹ���ӧҹ',
	favorite_artist Varchar(255) COMMENT '��ŻԹ���ô',
	createDate Datetime,
	updateDate Datetime,
	UNIQUE (id),
 Primary Key (id)) ENGINE = InnoDB;









Alter table seat add Constraint r_zone_seart_1_M Foreign Key (zone_id) references zone (id) on delete  restrict on update  restrict;
Alter table seat add Constraint r_booking_seat_1_M Foreign Key (booking_id) references booking (id) on delete  restrict on update  restrict;
Alter table bluecard add Constraint r_person_bluecard_1_M Foreign Key (person_id) references person (id) on delete  restrict on update  restrict;
Alter table booking add Constraint r_person_booking_1_M Foreign Key (person_id) references person (id) on delete  restrict on update  restrict;



DELIMITER //
CREATE PROCEDURE sp_booking (IN person_id int, IN zone_id int, seat_ids varchar(100))
BEGIN
    START TRANSACTION;
    -- check booking table
    SET @booking_id = (SELECT b.id FROM booking b WHERE b.person_id=person_id);
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








