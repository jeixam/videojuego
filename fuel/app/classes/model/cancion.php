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
        )
        );
}