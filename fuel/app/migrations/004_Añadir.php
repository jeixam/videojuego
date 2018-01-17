<?php
namespace Fuel\Migrations;

class Añadir
{
    function up()
    {
        \DBUtil::create_table('añadir', array
            (
            'id_lista' => array('type' => 'int', 'constraint' => 11),
            'id_pieza' => array('type' => 'int', 'constraint' => 11),
            ), array('id_lista' , 'id_pieza'), true, 'InnoDB', 'utf8_general_ci',
            array(
                array(
                    'constraint' => 'deAñadirAListas',
                    'key' => 'id_lista',
                    'reference' => array(
                        'table' => 'listas',
                        'column' => 'id',
                    ),
                    'on_update' => 'CASCADE',
                    'on_delete' => 'CASCADE'
                ),
                array(
                    'constraint' => 'deAñadirAPiezas',
                    'key' => 'id_pieza',
                    'reference' => array(
                        'table' => 'piezas',
                        'column' => 'id',
                    ),
                    'on_update' => 'CASCADE',
                    'on_delete' => 'CASCADE'
                )
            )
        );
    }

    function down()
    {
       \DBUtil::drop_table('añadir');
    }
}