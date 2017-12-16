<?php
namespace Fuel\Migrations;

class Cancion
{

    function up()
    {
        \DBUtil::create_table('cancion', array
            (
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'nombre' => array('type' => 'varchar', 'constraint' => 100),
            'artista' => array('type' => 'varchar', 'constraint' => 100),
            'url' => array('type' => 'varchar', 'constraint' => 100),
            'id_listas' => array('type' => 'int', 'constraint' => 11)
            ), array('id'),false, 'InnoDB', 'utf8_unicode_ci',
        array
        (
        array(
                'constraint' => 'claveAjenaDecancionesAlistas',
                'key' => 'id_listas',
                'reference' => array
                (
                    'table' => 'listas',
                    'column' => 'id',
                ),
                'on_update' => 'CASCADE',
                'on_delete' => 'RESTRICT'
            ),
        )
        ););
    }

    function down()
    {
       \DBUtil::drop_table('cancion');
    }
}