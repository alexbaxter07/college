CREATE TABLE `user`(
    `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_name` TEXT NOT NULL,
    `first_name` TEXT NOT NULL,
    `last_name` TEXT NOT NULL,
    `password` TEXT NOT NULL,
    `user_type_id` BIGINT NOT NULL,
    `signup_date` BIGINT NOT NULL
);
CREATE TABLE `user_type`(
    `user_type_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` TEXT NOT NULL,
    `discount` FLOAT(53) NOT NULL
);
CREATE TABLE `hotel_room`(
    `hr_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` BIGINT NOT NULL,
    `occupancy` BIGINT NOT NULL,
    `no_of_rooms` BIGINT NOT NULL,
    `price` FLOAT(53) NOT NULL
);
CREATE TABLE `tickets`(
    `ticket_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` TEXT NOT NULL,
    `price` BIGINT NOT NULL,
    `no_of_tickets` BIGINT NOT NULL
);
CREATE TABLE `ticket_booking`(
    `t_booking_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT NOT NULL,
    `booking_id` BIGINT NOT NULL,
    `made_on` BIGINT NOT NULL,
    `date` BIGINT NOT NULL
);
CREATE TABLE `hotel_booking`(
    `hr_booking_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT NOT NULL,
    `made_on` DATETIME NOT NULL,
    `date` DATETIME NOT NULL,
    `nights` BIGINT NOT NULL,
    `booking_id` BIGINT NOT NULL,
    `hr_id` BIGINT NOT NULL
);
CREATE TABLE `staying_in`(
    `stay_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `hr_booking_id` BIGINT NOT NULL,
    `hr_id` BIGINT NOT NULL,
    `no_of_people` BIGINT NOT NULL
);
CREATE TABLE `visits`(
    `visit_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `t_booking_id` BIGINT NOT NULL,
    `ticket_id` BIGINT NOT NULL,
    `no_of_tickets` BIGINT NOT NULL
);
CREATE TABLE `loyalty_transaction`(
    `lt_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `points` BIGINT NOT NULL,
    `user_id` BIGINT NOT NULL
);
ALTER TABLE
    `loyalty_transaction` ADD CONSTRAINT `loyalty_transaction_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `user`(`user_id`);
ALTER TABLE
    `staying_in` ADD CONSTRAINT `staying_in_hr_id_foreign` FOREIGN KEY(`hr_id`) REFERENCES `hotel_room`(`hr_id`);
ALTER TABLE
    `ticket_booking` ADD CONSTRAINT `ticket_booking_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `user`(`user_id`);
ALTER TABLE
    `visits` ADD CONSTRAINT `visits_ticket_id_foreign` FOREIGN KEY(`ticket_id`) REFERENCES `tickets`(`ticket_id`);
ALTER TABLE
    `visits` ADD CONSTRAINT `visits_t_booking_id_foreign` FOREIGN KEY(`t_booking_id`) REFERENCES `ticket_booking`(`t_booking_id`);
ALTER TABLE
    `hotel_booking` ADD CONSTRAINT `hotel_booking_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `user`(`user_id`);
ALTER TABLE
    `staying_in` ADD CONSTRAINT `staying_in_hr_booking_id_foreign` FOREIGN KEY(`hr_booking_id`) REFERENCES `hotel_booking`(`hr_booking_id`);
ALTER TABLE
    `user` ADD CONSTRAINT `user_user_type_id_foreign` FOREIGN KEY(`user_type_id`) REFERENCES `user_type`(`user_type_id`);