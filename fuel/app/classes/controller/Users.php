<?php 
use \Firebase\JWT\JWT;

class Controller_Users extends Controller_Autentificacion
{
//Modo de codificar el token
    protected $key = 'klj34234kl2j34k259923j';
    protected $algorithm = array('HS256');

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
            $user->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => 'usuario creado',
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
            $nombreArray=$input['nombre'];
            $passArray=$input['password'];
            $key = 'klj34234kl2j34k259923j';
            $token = array(
                "nombre" => $nombreArray,
                "password" => $passArray,
            );
            $jwt = JWT::encode($token, $key);
            $json = $this->response(array(
                    'code' => ' 200 ',
                    'data'=>$jwt,
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
    	//llamar a la funcion
        if($this->LoginAuthentification())
        {
            $input = $_POST;
        	$infoID=$this->userID();
            if($input['email']==$this->userEmail())
            {
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

    /**
     *  Funcion para verificar el token
     * @return boolean
     */
    protected function LoginAuthentification()
    {
        
        $tokenHeader = apache_request_headers();

        //isset  Determina si una variable esta definida y no es NULL

        if(isset($tokenHeader['token']))
        {
             
          $token = $tokenHeader['token'];
          $datosUsers = JWT::decode($token, $this->key, $this->algorithm); 
          //var_dump($datosUsers);
          if(isset($datosUsers->nombre) and isset($datosUsers->password))
          { 
              $user = Model_users::find('all', array
                          (
                              'where' => array
                              (
                                array('nombre'=>$datosUsers->nombre),
                                array('password'=>$datosUsers->password)
                              )
                          ));
                if(!empty($user))
                {
                    foreach ($user as $key => $value)
                    {
                          $id = $user[$key]->id;
                          $username = $user[$key]->nombre;
                          $password = $user[$key]->password;
                    }
                }
                else
                {
                  return false;
                }
          }
          else
          {
            return false;
          }

          if($username == $datosUsers->nombre and $password == $datosUsers->password)
          {
            return true;
          }
          else
          {
            return false;
          }
      }
      else
      {
          return false;
      } 
        
    }
/**
     *  Funcion para obtener el id del usuario logueado por el token
     * @return int
     */
    protected function userID ()
    {
      $tokenHeader = apache_request_headers();
      $token = $tokenHeader['token'];
      $datosUsers = JWT::decode($token, $this->key, $this->algorithm);
      //var_dump($datosUsers);
      $user = Model_users::find('all', array
      (
        'where' => array
        (
          array('nombre'=>$datosUsers->nombre),
          array('password'=>$datosUsers->password)
        )
        ));
        if(!empty($user))
        {
          $id=0;
          foreach ($user as $key => $value)
            {
              $id = $user[$key]->id;
              $username = $user[$key]->nombre;
              $password = $user[$key]->password;
            }
          return $id;         
        }                  
    }
/**
     *  Funcion para obtener el email del usuario logueado por el token
     * @return string
     */
    protected function userEmail ()
    {
      $tokenHeader = apache_request_headers();
      $token = $tokenHeader['token'];
      $datosUsers = JWT::decode($token, $this->key, $this->algorithm);
      $user = Model_users::find('all', array
      (
        'where' => array
        (
          array('email'=>$datosUsers->email),
        )
        ));
        if(!empty($user))
        {
          $email="";
          foreach ($user as $key => $value)
            {
              $email = $user[$key]->email;
            }
          return $email;         
        }                  
    }

}