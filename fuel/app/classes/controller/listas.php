<?php 
use \Firebase\JWT\JWT;
class Controller_Listas extends Controller_Rest
{
    public function post_create()
    {
        try {
            if ( ! isset($_POST['titulo'])) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'parametro incorrecto, se necesita que el parametro se llame titulo'
                ));

                return $json;
            }

            $input = $_POST;
            $user = new Model_Listas();
            $user->nombre = $input['titulo'];
            $user->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => 'lista creada',
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

    public function get_listas()
    {
    	$listas = Model_Listas::find('all');

    	return $this->response(Arr::reindex($listas));
    }

    public function post_delete()
    {
        $titulo = Model_Users::find($_POST['id']);
        $tituloLista = $titulo->titulo;
        $titulo->delete();

        $json = $this->response(array(
            'code' => 200,
            'message' => 'lista borrada',
            'name' => $tituloLista
        ));

        return $json;
    }

   
}