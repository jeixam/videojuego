<?php  
class Model_Listas extends Orm\Model
{
	protected static $_table_name = 'listas';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
        'id'=> array('data_type' => 'int'), 
        'nombre' => array('data_type' => 'varchar'),
        'id_usuario' => array('data_type' => 'int'),
        'editable' => array('data_type' => 'int')
    );
	protected static $_belongs_to = array(
	    'usuarios' => array(
	        'key_from' => 'id_usuario',
	        'model_to' => 'Model_users',
	        'key_to' => 'id',
	        'cascade_save' => false,
	        'cascade_delete' => false,
	    )
	);
    protected static $_many_many = array(
	    'piezas' => array(
	        'key_from' => 'id',
	        'key_through_from' => 'id_pieza',
	        'table_through' => 'añadir',
	        'key_through_to' => 'id_lista',
	        'model_to' => 'Model_piezas',
	        'key_to' => 'id',
	        'cascade_save' => false,
	        'cascade_delete' => false,
	    )
	);
}