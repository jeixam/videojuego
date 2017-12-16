<?php 

class Model_Users extends Orm\Model
{
    protected static $_table_name = 'cancion';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'titulo' => array
        (
            'data_type' => 'varchar'   
        ),
        'artista' => array
        (
            'data_type' => 'varchar'
    	)
        'url' => array
        (
            'data_type' => 'varchar'
<<<<<<< HEAD
        ),
        'id_usuarios' => array
        (
            'data_type' => 'int'
        )
        );
    protected static $_many_many = array(
    'cancion' => array(
        'key_from' => 'id',
        'key_through_from' => 'id_listas', // column 1 from the table in between, should match a posts.id
        'table_through' => 'tienen', // both models plural without prefix in alphabetical order
        'key_through_to' => 'id_cancion', // column 2 from the table in between, should match a users.id
        'model_to' => 'Model_listas',
        'key_to' => 'id',
        'cascade_save' => true,
        'cascade_delete' => false,
    )
);
=======
        )
        );
>>>>>>> 9f5cdbe7b7d24a0d74b27e102816c48956357333
}