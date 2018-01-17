<?php  
class Model_Users extends Orm\Model
{
	protected static $_table_name = 'users';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
        'id'=> array('data_type' => 'int'), 
        'nombre' => array('data_type' => 'varchar'),
        'email' => array('data_type' => 'varchar'),
        'password' => array('data_type' => 'varchar',
    	'derrotas' => array('data_type' => 'varchar',
    	'victorias' => array('data_type' => 'varchar')
    );
	protected static $_has_many = array(
	    'list' => array(
	        'key_from' => 'id',
	        'model_to' => 'Model_listas',
	        'key_to' => 'id_usuario',
	        'cascade_save' => false,
	        'cascade_delete' => false,
	    )
	);
}