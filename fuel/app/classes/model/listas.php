<?php 

class Model_Listas extends Orm\Model
{
    protected static $_table_name = 'listas';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'titulo' => array
        (
            'data_type' => 'varchar'   
        ),
        'id_usuario' => array
        (
            'data_type' => 'int'   
        )
        );
protected static $_belongs_to = array(
    'usuarios' => array(
        'key_from' => 'usuario_id',
        'model_to' => 'Model_users',
        'key_to' => 'id',
        'cascade_save' => true,
        'cascade_delete' => false,
    )
);
    
}