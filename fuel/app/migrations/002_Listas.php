<?php
namespace Fuel\Migrations;

class Listas
{

    function up()
    {
        \DBUtil::create_table('listas', array
            (
<<<<<<< HEAD
            	'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            	'titulo' => array('type' => 'varchar', 'constraint' => 100),
            	'id_usuario' => array('type' => 'int', 'constraint' => 11),
            ), array('id'),false, 'InnoDB', 'utf8_unicode_ci',
    	array
    	(
        array(
            	'constraint' => 'claveAjenaDeListasAUsuarios',
            	'key' => 'id_usuario',
            	'reference' => array
            	(
                	'table' => 'usuarios',
                	'column' => 'id',
            	),
            	'on_update' => 'CASCADE',
            	'on_delete' => 'RESTRICT'
        	),
    	)
		);
	}
=======
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'titulo' => array('type' => 'varchar', 'constraint' => 100),
            'id_usuario' => array('type' => 'int', 'constraint' => 11),
            ), array('id'),false, 'InnoDB', 'utf8_unicode_ci',
    array(
        array(
            'constraint' => 'claveAjenaDeListasAUsuarios',
            'key' => 'id_usuario',
            'reference' => array(
                'table' => 'usuarios',
                'column' => 'id',
            ),
            'on_update' => 'CASCADE',
            'on_delete' => 'RESTRICT'
        ));
    }
>>>>>>> 9f5cdbe7b7d24a0d74b27e102816c48956357333

    function down()
    {
       \DBUtil::drop_table('listas');
    }
}