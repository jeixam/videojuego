<?php 
use \Firebase\JWT\JWT;

class Controller_Users extends Controller_Autentificacion
{

    /**
     *  Funcion para crear un usuario
     * @return json con un codigo
     */
    public function post_create()
    {
        try {
            if ( ! isset($_POST['nombre'])) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => ' parametro incorrecto, se necesita que el parametro se llame nombre'
                ));

                return $json;
            }

            $input = $_POST;
            $user = new Model_Users();
            $user->nombre = $input['nombre'];
            $user->password = $input['password'];
            $user->email = $input['email'];
            $user->victorias = $input['victorias'];
            $user->derrotas = $input['derrotas'];
            $user->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => ' usuario creado ',
                'nombre' => $input['nombre']
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
    /**
     *  Funcion para borrar un usuario
     * @return json con un codigo
     */
    public function post_delete()
    {
    	if($this->LoginAuthentification())
        {
        	$user = Model_Users::find($this->userID());
        	$userName = $user->nombre;
        	$user->delete();

        	$json = $this->response(array(
            	'code' => 200,
            	'message' => ' usuario borrado ',
            	'name' => $userName
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
/**
     *  Funcion para entrar con usuario
     * @return token y un codigo
     */
    public function Post_login()
    {
    	$input= $_POST;
        $input['nombre'];
        $entry = Model_Users::find('all', 
            array('where'=>array
            	(
            		array('nombre', $input['nombre']),
            		array('password', $input['password']),
        		),
            ));
        //usuario buscado
        //si esto es nulo
        if($entry==null)
        {
            $json = $this->response(array(
                    'code' => 400,
                    'message' => 'no existe el usuario o la contraseña'
                ));

                return $json;
        }
        else
        {
            foreach ($entry as $key => $user) 
            {
                $userInfo=array(
                    'nombre'=>$user->nombre,
                    'victorias'=>$user->victorias,
                    'derrotas'=>$user->derrotas,
                    'email'=>$user->email
                );
            }
            $nombreArray=$input['nombre'];
            $passArray=$input['password'];
            $key = 'klj34234kl2j34k259923j';
            $token = array(
                "nombre" => $nombreArray,
                "password" => $passArray,
            );
            $jwt = JWT::encode($token, $key);
            $info=array('token'=>$jwt, 
                'nombre'=>$userInfo['nombre'],
                'victoras'=>$userInfo['victorias'],
                'derrotas'=>$userInfo['derrotas'],
                'email'=>$userInfo['email'],
            );
            $json = $this->response(array(
                    'code' => ' 200 ',
                    'data'=>$info,
                    'message' => ' usuario encontrado, logeado'
                ));

                return $json;
        }
    }
/**
     *  Funcion para cambiar la contraseña
     * @return un codigo
     */
public function post_rememberPassword()
    {
    	
            $input = $_POST;

            $entry = Model_Users::find('all', 
            array('where'=>array
                (
                    array('email', $input['email']),
                ),
            ));
        	
            if(isset($entry))
            {
                foreach ($entry as $key => $value)
                {
                    $id = $entry[$key]->id;
                }
                $infoID=$id;
                $datauser = DB::update('usuarios');
                $datauser->where('id', '=', $infoID);
                $datauser->value('password', $input['password']);
                $datauser->execute();

                $response = $this->response(array(
                'code' => 200,
                'message' => ' contraseña cambiada a ',
                'data' => $input['password']
                ));
                return $response;
            }
            else 
            {
                $response = $this->response(array(
                'code' => 400,
                'message' => ' El email no es correcto ',
                'data' => var_dump($this->LoginAuthentification())
            ));
            return $response;
            }
    }
    
}