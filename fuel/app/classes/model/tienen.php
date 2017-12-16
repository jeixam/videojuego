<?php 

class Model_Tienen extends Orm\Model
{
<<<<<<< HEAD
    protected static $_table_name = 'tiene';
=======
    protected static $_table_name = 'tienen';
>>>>>>> 9f5cdbe7b7d24a0d74b27e102816c48956357333
    protected static $_primary_key = array('id_listas','id_cancion');
    protected static $_properties = array(
        
        'id_listas' => array
        (
            'data_type' => 'int'   
        ),
        'id_cancion' => array
        (
            'data_type' => 'int'   
        )
        );

    
}