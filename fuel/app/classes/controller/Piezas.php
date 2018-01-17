<?php 
use \Firebase\JWT\JWT;
class Controller_Piezas extends Controller_Autentificacion
{
    public function post_create()
    {
        if($this->LoginAuthentificationAdmin())
        {
            try {
                    if ( ! isset($_POST['titulo'])) 
                    {
                        $json = $this->response(array(
                        'code' => 400,
                        'message' => ' parametro incorrecto, se necesita que el parametro se llame titulo'
                        ));

                        return $json;
                    }

                    $input = $_POST;
                    $piezas = new Model_Piezas();
                    $piezas->nombre = $input['nombre'];
                    $piezas->vida = $input['vida'];
                    $piezas->velocidad = $input['velocidad'];
                    $piezas->cadencia = $input['cadencia'];
                    $piezas->daño = $input['daño'];
                    $piezas->descripcion = $input['descripcion'];
                    $piezas->id_lista = $input['id_lista'];
                    $piezas->save();

                    $json = $this->response(array(
                        'code' => 200,
                        'message' => ' lista creada ',
                        'titulo' => $input['titulo']
                    ));

                    return $json;

                } 
                catch (Exception $e) 
                {
                    $json = $this->response(array(
                    'code' => 500,
                    'message' => $e->getMessage(),
                    ));

                    return $json;
               }
        }
        else
        {
            $response = $this->response(array
                (
                    'code' => 400,
                    'message' => ' El usuario debe loguearse primero ',
                    'data' => ''
                ));
            return $response;
        }       
    }

public function post_delete()
    {
        if($this->LoginAuthentificationAdmin())
        {
            $idPieza=$_POST['idPieza'];
            $pieza = Model_Piezas::find($idpieza);
            //la pieza solo puede ser eliminada por su usuario
                $titulopieza = $pieza->nombre;
                $pieza->delete();

                $json = $this->response(array(
                    'code' => 200,
                    'message' => ' pieza borrada ',
                    'name' => $titulopieza
                    ));
                return $json;
        }
        else
        {
            $response = $this->response(array
                (
                    'code' => 400,
                    'message' => ' El usuario debe loguearse primero ',
                    'data' => ''
                ));
            return $response;
        } 
    }

    public function post_edit()
    {
        //llamar a la funcion
        if($this->LoginAuthentificationAdmin())
        {
        	$input = $_POST;
        	if(array_key_exists('id', $input))
            {
            	$pieza = Model_Piezas::find($input['id']);
            	if(!empty($pieza))
                {
                	$dataPieza = DB::update('piezas');
                	$datauser->where('id', '=', $input['id']);

                	if(array_key_exists('nombre', $input))
            		{
            			$query->value('nombre', $input['nombre']);
            		}
            		if(array_key_exists('daño', $input))
            		{
            			$query->value('daño', $input['daño']);
            		}
            		if(array_key_exists('vida', $input))
            		{
            			$query->value('vida', $input['vida']);
            		}
            		if(array_key_exists('velocidad', $input))
            		{
            			$query->value('velocidad', $input['velocidad']);
            		}
            		if(array_key_exists('cadencia', $input))
            		{
            			$query->value('cadencia', $input['cadencia']);
            		}
            		if(array_key_exists('tipo', $input))
            		{
            			$query->value('tipo', $input['tipo']);
            		}
            		if(array_key_exists('descripcion', $input))
            		{
            			$query->value('descripcion', $input['descripcion']);
            		}
            		$datauser->execute();
            		$response = $this->response(array(
                    'code' => 200,
                    'message' => ' El nombre a cambiado a ',
                    'data' => $input['nombre']
                	));
                	return $response;
                }
                else
                {
                	$response = $this->response(array(
                    'code' => 400,
                    'message' => 'Esa pieza no existe',
                    'data' => ''
                    ));
                    return $response;
                }
            }
            else
            {
            	$response = $this->response(array(
                'code' => 400,
                'message' => 'Indice erroneo',
                'data' => ''
                ));
                return $response;
            }
        }
    	else
    	{
        	$response = $this->response(array(
        	'code' => 400,
        	'message' => ' El usuario debe loguearse primero ',
        	'data' => var_dump($this->LoginAuthentification())
        	));
        	return $response;
    	}
    }

    public function post_añadir()
    {
        if($this->LoginAuthentification())
        {
            $input = $_POST;
        }
        else
        {
            $response = $this->response(array
                (
                    'code' => 400,
                    'message' => ' El usuario debe loguearse primero ',
                    'data' => ''
                ));
            return $response;
        }       
    }
      
}