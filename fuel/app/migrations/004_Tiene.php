<?php
namespace Fuel\Migrations;

class Tiene
{

    function up()
    {
        \DBUtil::create_table('tiene', array
            (
            'id_cancion' => array('type' => 'int', 'constraint' => 11),
            'id_listas' => array('type' => 'int', 'constraint' => 11),
            ), array('id_cancion','id_listas'),false, 'InnoDB', 'utf8_unicode_ci',
    array(
        array(
            'constraint' => 'claveAjenaDetieneAcancion',
            'key' => 'id_cancion',
            'reference' => array(
                'table' => 'cancion',
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
       \DBUtil::drop_table('tiene');
    }
}