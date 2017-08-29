<?php

use yii\db\Migration;

class m170828_175739_init extends Migration
{
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `user` (
          `id` INT NOT NULL,
          `firstname` VARCHAR(45) NULL,
          `lastname` VARCHAR(45) NULL,
          `createDate` DATETIME NULL,
          `modityDate` DATETIME NULL,
          `lastVisitDate` DATETIME NULL,
          `status` INT NULL,
          PRIMARY KEY (`id`))
        ENGINE = InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `city` (
          `id` INT NOT NULL,
          `name` VARCHAR(45) NULL,
          PRIMARY KEY (`id`))
        ENGINE = InnoDB;");

        $this->execute("CREATE TABLE IF NOT EXISTS `address` (
          `id` INT NOT NULL,
          `street` VARCHAR(45) NULL,
          `zip` VARCHAR(45) NULL,
          `createDate` DATETIME NULL,
          `modifyDate` DATETIME NULL,
          `status` INT NULL,
          `userId` INT NOT NULL,
          `cityId` INT NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `fk_address_user_idx` (`userId` ASC),
          INDEX `fk_address_city1_idx` (`cityId` ASC),
          CONSTRAINT `fk_address_user`
            FOREIGN KEY (`userId`)
            REFERENCES `user` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
          CONSTRAINT `fk_address_city1`
            FOREIGN KEY (`cityId`)
            REFERENCES `city` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION)
        ENGINE = InnoDB;");
    }

    public function safeDown()
    {
        echo "m170828_175739_init cannot be reverted.\n";

        return false;
    }
}
