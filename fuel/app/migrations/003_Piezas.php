<?php
namespace Fuel\Migrations;

class Piezas
{
    function up()
    {
        \DBUtil::create_table('piezas', array
            (
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'nombre' => array('type' => 'varchar', 'constraint' => 100),
            'vida' => array('type' => 'int', 'constraint' => 11),
            'velocidad' => array('type' => 'int', 'constraint' => 11),
            'cadencia' => array('type' => 'int', 'constraint' => 11),
            'daño' => array('type' => 'int', 'constraint' => 11)
            ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('piezas');
    }
}