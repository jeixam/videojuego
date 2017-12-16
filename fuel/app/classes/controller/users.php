<?php 
use \Firebase\JWT\JWT;
class Controller_Users extends Controller_Rest
{
    public function post_create()
    {
        try {
            if ( ! isset($_POST['name'])) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'parametro incorrecto, se necesita que el parametro se llame name'
                ));

                return $json;
            }

            $input = $_POST;
            $user = new Model_Users();
            $user->nombre = $input['name'];
            $user->password = $input['password'];
            $user->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => 'usuario creado',
                'name' => $input['name']
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

    public function get_users()
    {
    	$users = Model_Users::find('all');

    	return $this->response(Arr::reindex($users));
    }

    public function post_delete()
    {
        $user = Model_Users::find($_POST['id']);
        $userName = $user->nombre;
        $user->delete();

        $json = $this->response(array(
            'code' => 200,
            'message' => 'usuario borrado',
            'name' => $userName
        ));

        return $json;
    }

    public function get_login()
    {
        $input=$_GET;
        $entry = Model_Users::find('all', 
            array('where'=>array(
            array("nombre"=>$input["name"]),
            array("password"=>$input["password"]))
            ));
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
            $nombreArray=$input["name"];
            $passArray=$input["password"];
            $key = "o034d2m90g4tr555qQ554888Qghgh76qhght76UI76";
            $token = array(
                "nombre" => $passArray,
                "pass" => $passArray,
            );
            $jwt = JWT::encode($token, $key);
            //$decoded = JWT::decode($jwt, $key, array('HS256'));

            $json = $this->response(array(
                    'code' => 200,
                    'data'=>$jwt,
                    'message' => 'usuario encontrado'
                ));

                return $json;
        }
    }
    //token

    //public function autentication ()
        //{

            //$decoded = JWT::decode($jwt, $key, array('HS256'));
            
            //if($decoded->nombre==Model_Users::find('all')&&$decoded->pass==Model_Users::find('password'))
                //{
                   
                    //return true
                //}
            //else
            //{
                //return false
            //}
        //}
}