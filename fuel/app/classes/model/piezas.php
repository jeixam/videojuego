<?php  
class Model_piezas extends Orm\Model
{
	protected static $_table_name = 'piezas';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
        'id'=> array('data_type' => 'int'), 
        'nombre' => array('data_type' => 'varchar'),
        'vida' => array('data_type' => 'varchar'),
        'velocidad' => array('data_type' => 'varchar'),
        'cadencia' => array('data_type' => 'varchar'),
        'descripcion' => array('data_type' => 'varchar'),
        'tipo' => array('data_type' => 'varchar'),
        'daño' => array('data_type' => 'varchar')
    );
	
    protected static $_many_many = array(
	    'listas' => array(
	        'key_from' => 'id',
	        'key_through_from' => 'id_lista',
	        'table_through' => 'añadir',
	        'key_through_to' => 'id_pieza',
	        'model_to' => 'Model_listas',
	        'key_to' => 'id',
	        'cascade_save' => false,
	        'cascade_delete' => false,
	    )
	);
}