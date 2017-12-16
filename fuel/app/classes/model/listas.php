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
<<<<<<< HEAD

protected static $_many_many = array(
    'cancion' => array(
        'key_from' => 'id',
        'key_through_from' => 'id_cancion', // column 1 from the table in between, should match a posts.id
        'table_through' => 'tienen', // both models plural without prefix in alphabetical order
        'key_through_to' => 'id_listas', // column 2 from the table in between, should match a users.id
        'model_to' => 'Model_cancion',
        'key_to' => 'id',
        'cascade_save' => true,
        'cascade_delete' => false,
    )
);
protected static $_belongs_to = array(
    'usuarios' => array(
        'key_from' => 'id_usuario',
=======
protected static $_belongs_to = array(
    'usuarios' => array(
        'key_from' => 'usuario_id',
>>>>>>> 9f5cdbe7b7d24a0d74b27e102816c48956357333
        'model_to' => 'Model_users',
        'key_to' => 'id',
        'cascade_save' => true,
        'cascade_delete' => false,
    )
);
    
}