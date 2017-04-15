<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170413072204 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
            -- MySQL Workbench Synchronization
            -- Generated: 2017-04-13 02:21
            -- Model: New Model
            -- Version: 1.0
            -- Project: Name of the project
            -- Author: israel
            
            SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
            SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
            SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL,ALLOW_INVALID_DATES\';
         
            ALTER SCHEMA `ebank`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;
            
            CREATE TABLE IF NOT EXISTS `ebank`.`cardholder` (
              `id_cardholder` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `v_first_name` VARCHAR(100) NOT NULL,
              `v_last_name` VARCHAR(100) NOT NULL,
              `v_email` VARCHAR(100) NOT NULL,
              `d_birthday` DATE NOT NULL,
              `c_locale` CHAR(2),
              `v_address` VARCHAR(200) NOT NULL,
              `c_cp` CHAR(5) NOT NULL,
              PRIMARY KEY (`id_cardholder`))
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8;
            
            CREATE TABLE IF NOT EXISTS `ebank`.`transaction` (
              `id_transaction` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `fk_card` INT(10) UNSIGNED,
              `d_amount` DOUBLE(8,2) NOT NULL,
              `d_datetime` DATETIME NOT NULL,
              `v_description` VARCHAR(100) NOT NULL,
              `fk_cardholder` INT(10) UNSIGNED NULL DEFAULT NULL,
              PRIMARY KEY (`id_transaction`),
              INDEX `fk_transaction_card1_idx` (`fk_card` ASC),
              INDEX `fk_transaction_cardholder1_idx` (`fk_cardholder` ASC),
              CONSTRAINT `fk_transaction_card1`
                FOREIGN KEY (`fk_card`)
                REFERENCES `ebank`.`card` (`id_card`)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
              CONSTRAINT `fk_transaction_cardholder1`
                FOREIGN KEY (`fk_cardholder`)
                REFERENCES `ebank`.`cardholder` (`id_cardholder`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8;
            
            CREATE TABLE IF NOT EXISTS `ebank`.`card` (
              `id_card` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `v_number` VARCHAR(16) NOT NULL,
              `i_year_expiration` INT(2) NOT NULL,
              `i_month_expiration` INT(2) NOT NULL,
              `v_cvv` VARCHAR(4) NOT NULL,
              `d_limit` DOUBLE(8,2),
              `fk_card_type` INT(10) UNSIGNED NOT NULL,
              `d_balance` DOUBLE(8,2),
              `c_nip` CHAR(4) NOT NULL,
              `fk_account` INT(10) UNSIGNED NOT NULL,
              `d_credit` DOUBLE(8,2),
              PRIMARY KEY (`id_card`),
              INDEX `fk_card_card_type1_idx` (`fk_card_type` ASC),
              INDEX `fk_card_account1_idx` (`fk_account` ASC),
              CONSTRAINT `fk_card_card_type1`
                FOREIGN KEY (`fk_card_type`)
                REFERENCES `ebank`.`card_type` (`id_card_type`)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
              CONSTRAINT `fk_card_account1`
                FOREIGN KEY (`fk_account`)
                REFERENCES `ebank`.`account` (`id_account`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8;
            
            CREATE TABLE IF NOT EXISTS `ebank`.`card_type` (
              `id_card_type` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `v_name` VARCHAR(100) NOT NULL,
              `v_description` VARCHAR(200) NOT NULL,
              `c_code` VARCHAR(5) NOT NULL,
              `b_credit` TINYINT(1) NOT NULL,
              PRIMARY KEY (`id_card_type`))
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8;
            
            CREATE TABLE IF NOT EXISTS `ebank`.`account` (
              `id_account` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `c_number` CHAR(10) NOT NULL,
              `c_clave` CHAR(18) NOT NULL,
              `d_balance` DOUBLE(8,2) NOT NULL,
              `fk_cardholder` INT(10) UNSIGNED NOT NULL,
              PRIMARY KEY (`id_account`),
              INDEX `fk_account_cardholder1_idx` (`fk_cardholder` ASC),
              CONSTRAINT `fk_account_cardholder1`
                FOREIGN KEY (`fk_cardholder`)
                REFERENCES `ebank`.`cardholder` (`id_cardholder`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8;
            
            
            SET SQL_MODE=@OLD_SQL_MODE;
            SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
            SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
            
            INSERT INTO `ebank`.`cardholder` (`id_cardholder`, `v_first_name`, `v_last_name`, `v_email`, `d_birthday`, `c_locale`, `v_address`, `c_cp`) VALUES (\'1\', \'Carlos \', \'Slim\', \'charly@email.com\', \'1940-01-20\', \'\', \'Plaza Carso\', \'12345\');
            INSERT INTO `ebank`.`cardholder` (`v_first_name`, `v_last_name`, `v_email`, `d_birthday`, `c_locale`, `v_address`, `c_cp`) VALUES (\'Bill\', \'Gates\', \'billy@michrosoft\', \'1940-12-12\', \'\', \'Silicon Valley\', \'12345\');

            INSERT INTO `ebank`.`account` (`c_number`, `c_clave`, `d_balance`, `fk_cardholder`) VALUES (\'123456789\', \'12312312312345678\', \'10000\', \'1\');
            INSERT INTO `ebank`.`account` (`c_number`, `c_clave`, `d_balance`, `fk_cardholder`) VALUES (\'0987654321\', \'098098098098765432\', \'10000\', \'2\');

            INSERT INTO `ebank`.`card_type` (`id_card_type`, `v_name`, `v_description`, `c_code`, `b_credit`) VALUES (NULL, \'Nomina\', \'Nomina\', \'TD\', \'0\');
            INSERT INTO `ebank`.`card_type` (`v_name`, `v_description`, `c_code`, `b_credit`) VALUES (\'Gold\', \'Gold\', \'TCG\', \'1\');
            INSERT INTO `ebank`.`card_type` (`v_name`, `v_description`, `c_code`, `b_credit`) VALUES (\'Black\', \'Black\', \'TCB\', \'1\');
    
            INSERT INTO `ebank`.`card` (`v_number`, `i_year_expiration`, `i_month_expiration`, `v_cvv`, `d_limit`, `fk_card_type`, `d_balance`, `c_nip`, `fk_account`, `d_credit`) VALUES (\'4111111111111111\', \'29\', \'12\', \'111\', \'10000\', \'2\', NULL, \'1111\', \'1\', \'0\');
            INSERT INTO `ebank`.`card` (`v_number`, `i_year_expiration`, `i_month_expiration`, `v_cvv`, `d_limit`, `fk_card_type`, `d_balance`, `c_nip`, `fk_account`) VALUES (\'0981230981230987\', \'29\', \'11\', \'111\', NULL, \'1\', \'10000\', \'1111\', \'1\');
            INSERT INTO `ebank`.`card` (`v_number`, `i_year_expiration`, `i_month_expiration`, `v_cvv`, `d_limit`, `fk_card_type`, `d_balance`, `c_nip`, `fk_account`, `d_credit`) VALUES (\'9876542567894653\', \'28\', \'10\', \'111\', \'20000\', \'2\', NULL, \'1111\', \'2\', \'0\');
            INSERT INTO `ebank`.`card` (`v_number`, `i_year_expiration`, `i_month_expiration`, `v_cvv`, `d_limit`, `fk_card_type`, `d_balance`, `c_nip`, `fk_account`, `d_credit`) VALUES (\'9876542567894444\', \'28\', \'12\', \'111\', NULL, \'1\', \'20000\', \'1111\', \'2\', NULL);

            INSERT INTO `ebank`.`transaction` (`fk_card`, `d_amount`, `d_datetime`, `v_description`) VALUES (\'1\', \'-10\', \'2016-12-12\', \'Beer\');
            INSERT INTO `ebank`.`transaction` (`fk_card`, `d_amount`, `d_datetime`, `v_description`) VALUES (\'1\', \'-10\', \'2016-12-13\', \'Black Beer\');
            INSERT INTO `ebank`.`transaction` (`fk_card`, `d_amount`, `d_datetime`, `v_description`) VALUES (\'2\', \'-1\', \'2016-12-01\', \'Chicle\');
            INSERT INTO `ebank`.`transaction` (`fk_card`, `d_amount`, `d_datetime`, `v_description`) VALUES (\'3\', \'10\', \'2016-12-12\', \'Deposit\');
            INSERT INTO `ebank`.`transaction` (`fk_card`, `d_amount`, `d_datetime`, `v_description`, `fk_cardholder`) VALUES (\'3\', \'-5\', \'2016-12-10\', \'Metrobus\', NULL);
            INSERT INTO `ebank`.`transaction` (`fk_card`, `d_amount`, `d_datetime`, `v_description`) VALUES (\'3\', \'-10\', \'2016-01-12\', \'Epura\');
            INSERT INTO `ebank`.`transaction` (`fk_card`, `d_amount`, `d_datetime`, `v_description`) VALUES (\'4\', \'1000\', \'2016-01-30\', \'Deposit\');
        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
