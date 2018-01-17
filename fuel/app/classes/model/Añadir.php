<?php  
class Model_Añadir extends Orm\Model
{
	protected static $_table_name = 'añadir';
	protected static $_primary_key = array('id_lista', 'id_pieza');
	protected static $_properties = array(
        'id_lista'=> array('data_type' => 'int'), 
        'id_pieza' => array('data_type' => 'int')
    );
	
}