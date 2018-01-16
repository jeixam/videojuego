<?php
namespace Fuel\Migrations;

class Usuarios
{
    function up()
    {
        \DBUtil::create_table('usuarios', array
            (
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'nombre' => array('type' => 'varchar', 'constraint' => 100),
            'password' => array('type' => 'varchar', 'constraint' => 100),
            'email' => array('type' => 'varchar', 'constraint' => 100),
            'derrotas' => array('type' => 'int', 'constraint' => 11),
            'victorias' => array('type' => 'int', 'constraint' => 11)
            ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('usuarios');
    }
}