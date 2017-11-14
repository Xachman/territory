<?php
use Migrations\AbstractMigration;

class UpdateFromColumn extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('email_logs');
        $table->renameColumn('from', 'email_from');
        $table->update();
    }
}
