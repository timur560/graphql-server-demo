<?php

use yii\db\Migration;

class m170828_190719_insert_demo_data extends Migration
{
    public function safeUp()
    {
        $this->execute("
            INSERT INTO `city` (`id`, `name`) VALUES ('1', 'New York');
            INSERT INTO `city` (`id`, `name`) VALUES ('2', 'Washington');
            INSERT INTO `city` (`id`, `name`) VALUES ('3', 'Chicago');
        ");

        $this->execute("
            INSERT INTO `user` VALUES ('1', 'John', 'Doe', '2017-09-01 16:14:21', '2017-09-04 08:04:32', '2017-09-04 07:34:56', '1');
            INSERT INTO `user` VALUES ('2', 'Vasia', 'Pupkin', '2017-09-02 15:14:34', '2017-09-05 08:04:32', '2017-09-05 07:34:56', '1');
            INSERT INTO `user` VALUES ('3', 'Stan', 'Smith', '2017-09-02 06:12:21', '2017-09-04 08:15:32', '2017-09-04 10:58:21', '1');
        ");

        $this->execute("
            INSERT INTO `address` VALUES ('1', 'Grand St.', '55901', '2017-10-25 08:04:45', '2017-10-25 08:04:45', '1', '1', '2');
            INSERT INTO `address`VALUES ('2', 'Montgomery St.', '34512', '2017-10-25 08:04:45', '2017-10-25 08:04:45', '1', '2', '3');
            INSERT INTO `address` VALUES ('3', 'Claremont Ave.', '56324', '2017-10-25 08:04:45', '2017-10-25 08:04:45', '1', '1', '3');
        ");
    }

    public function safeDown()
    {
        echo "m170828_190719_insert_demo_data cannot be reverted.\n";

        return false;
    }

}
