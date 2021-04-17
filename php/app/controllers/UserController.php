<?php


class UserController extends BaseController
{

    public function __construct()
    {
        //过滤
        $this->beforeFilter('auth',array('except'=>array('Login','DoLogin')));
        //$this->beforeFilter('csrf',array('on'=>'post'));
    }
    /*
     *
     * 用户列表页*/
    public function getIndex(){
        //return View::make('adminindex');
        $users = User::paginate(3);
        return View::make('user.list')->with('users',$users);
    }
    /*
     * 添加用户*/
    public function getAddUser(){
        return View::make('user.add');
    }
    public function postAddUser(){
        //表单验证
        //数据
        $data = Input::all();
        //规则
        $rules = array(
            'username'=>'required|unique:users|min:5|regex:/^[a-zA-Z][a-zA-Z0-9]*/',
            'password'=>'required|min:6|confirmed',
            'email'=>'required|email|unique:users'
        );
        $validator=Validator::make($data,$rules);
        if ($validator->fails()){
            $msg1 = $validator->messages()->first('username');
            $msg2 = $validator->messages()->first('email');
            $msg3 = $validator->messages()->first('password');
            $msg = $msg1."\n".$msg2."\n".$msg3;
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $user = new User();
        $user->username=$data['username'];
        $user->email=$data['email'];
        $user->password=Hash::make($data['password']);
        $user->save();

        $data = array('success'=>true, 'msg'=>'添加成功');
        return json_encode($data);
    }

    /**
     * 编辑用户
     * @param $id
     * @return mixed
     */
    public function getEditUser($id){
        $user = User::find($id);
        return View::make('user.edit')->with('user',$user);
    }

    public function postEditUser(){
        $datas = Input::all();
        $rules = array(
            'password'=>'required|min:6|confirmed',
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg = $validator->messages()->first('password');
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }
        $id = $datas['id'];
        $password = $datas['password'];
        $user = User::find($id);
        $user->password=Hash::make($password);
        $user->save();
        $data = array('success'=>true, 'msg'=>'修改成功');
        return json_encode($data);
    }

    public function Login(){
        return View::make('user.login');
    }
    public function DoLogin(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        if(Auth::attempt(array('username'=>$username,'password'=>$password),true)) {
            $data = array("status" => true);
        }else{
            $data = array("status"=>false);
        }
        return json_encode($data);
    }
    public function Logout(){
        Auth::logout();
        return Redirect::to('/');
    }
}