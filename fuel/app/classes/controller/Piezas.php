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

      
}