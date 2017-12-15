<?php
namespace Fuel\Migrations;

class Cancion
{

    function up()
    {
        \DBUtil::create_table('cancion', array
            (
            'id_usuario' => array('type' => 'int', 'constraint' => 11),
            'id_listas' => array('type' => 'varchar', 'constraint' => 100),
            ), array('id_usuario','id_listas'),false, 'InnoDB', 'utf8_unicode_ci',
    array(
        array(
            'constraint' => 'claveAjenaDetieneAUsuarios',
            'key' => 'id_usuario',
            'reference' => array(
                'table' => 'usuarios',
                'column' => 'id',
            ),
            'on_update' => 'CASCADE',
            'on_delete' => 'RESTRICT'
        ),
        array(
            'constraint' => 'claveAjenaDetieneAlistas',
            'key' => 'id_listas',
            'reference' => array(
                'table' => 'listas',
                'column' => 'id',
            ),
            'on_update' => 'CASCADE',
            'on_delete' => 'RESTRICT'
        )

    )
);
    }

    function down()
    {
       \DBUtil::drop_table('cancion');
    }
}