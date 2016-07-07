<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        
        $table = $this->table('users');
        $table  -> addColumn ('dni', 'string', ['limit'=>9])
                -> addColumn ('nombre', 'string', ['limit'=>100]) 
                -> addColumn ('apellidos', 'string', ['limit'=>200])
                -> addColumn ('email', 'string', ['limit'=>100])
                -> addColumn ('telefono', 'string', ['limit'=>100])
                -> addColumn ('user', 'string', ['limit'=>100]) 
                -> addColumn ('password', 'string')
                -> addColumn ('role', 'enum', ['values'=>'admin, edis, ceas'])
                -> addColumn ('created', 'datetime')
                -> addColumn ('modified', 'datetime')
                ->create();

       
        $refTable = $this->table ('users');
        $refTable   -> addColumn('equipo_id', 'integer', ['signed' => 'disable'])
                    -> addForeignKey('equipo_id', 'equipos', 'id', ['delete' => 'CASCADE', 'update'=> 'NO_ACTION'])
                    -> update();
    }
}
