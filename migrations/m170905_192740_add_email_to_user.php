<?php

use yii\db\Migration;

class m170905_192740_add_email_to_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'email', $this->string());
    }

    public function safeDown()
    {
        echo "m170905_192740_add_email_to_user cannot be reverted.\n";

        return false;
    }
}
