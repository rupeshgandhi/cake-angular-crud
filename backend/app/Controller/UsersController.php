<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */


	public function show()
	{
		$this->autoRender=false;
		$this->layout=false;

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
		header("Content-Type: application/json; charset=UTF-8");

		/*	$postdata = file_get_contents("php://input");
		$data=json_decode($postdata);

			if(!empty($data))
			{
				$response =array('status'=>200,'message'=>'Data fethched Successfully','result'=>$res);exit;
			}

		*/

		if($this->request->is('get'))
		{
		$res=$this->User->find('all',array('order' => array('id' => 'desc')));
		if(!empty($res))
		{
		 $response =array('status'=>200,'message'=>'Data fethched Successfully','result'=>$res);
		}else{
		 $response =array('status'=>200,'message'=>'Data fethched Successfully','result'=>$res);
		}

		}
		echo json_encode($response);
	}


	 public function create()
	 {
			$this->autoRender=false;
			$this->layout=false;

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
		header("Content-Type: application/json; charset=UTF-8");

		$postdata = file_get_contents("php://input");
		$data=json_decode($postdata);

			if(!empty($data))
			{


				$username=$data->username;
				$pass=$data->password;
				$address=$data->address;
				$age=$data->age;
				$firstname=$data->firstName;
				$lastname=$data->lastName;
				$mobile=$data->mobile;
				$email=$data->email;



				$error=array();
				if(empty($firstname))
				{
					$error['firstName']="enter the first name";
				}
				if(empty($lastname))
				{
					$error['lastname']="enter the last name";
				}
				if(empty($email))
				{
					$error['email']="enter the email";
				}
				if(empty($address))
				{
					$error['address']="enter the address";
				}
				if(empty($mobile))
				{
					$error['mobile']="enter the mobile";
				}
				if(empty($age))
				{
					$error['age']="enter the age";
				}
				if(empty($username))
				{
					$error['username']="enter the username";
				}
				if(empty($pass))
				{
					$error['password']="enter the password";
				}

				if(empty($error))
				{

				$checkuserexist=$this->checkuserexist($username);


					$data=array(
					'firstName' => $firstname,
					'lastName' => $lastname,
					'email' => $email,
					'address' => $address,
					'mobile' => $mobile,
					'age' => $age,
					'username' => $username,
					'password' => md5($pass),
					);

				if(!$checkuserexist)
				{

					if($this->User->save($data))
					{
						$response =array('status'=>200,'message'=>'User data save successfully');
					}else{
						$response =array('status'=>401,'message'=>'user data not saved');
					}
				}else{
					$response =array('status'=>401,'message'=>'Username already exist');
				}
			}else{
				$response =array('status'=>401,'message'=>$error);
			}
		}
			echo json_encode($response);
	 }


	 public function checkuserexist($un)
	 {
		 $this->autoRender=false;
		$this->layout=false;
		 $result=false;
		 if(!empty($un))
		 {
			$res=$this->User->find('all',array('conditions' =>array('username'=>$un)));

			if(!empty($res))
			{
				$result =true;
			}else{
				$result =false;
			}
		 }
		 return $result;
	 }


	 public function ajax_delete()
	 {
		 $this->autoRender=false;
 		$this->layout=false;

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
		header("Content-Type: application/json; charset=UTF-8");

		 if($this->request->is('delete'))
		{

			$id=$this->request->params['pass'][0];

		if(!empty($id))
			{

				$checkid=$this->checkid($id);
				if($checkid)
				{
					if($this->User->delete($id,true))
					{
						$response =array('status'=>200,'message'=>'Id deleted successfully');
					}else{
						$response =array('status'=>401,'message'=>'Id not deleted');
					}
				}else{
				$response =array('status'=>401,'message'=>'Id doesnt exist');
				}
			}else{
				$response =array('status'=>401,'message'=>'Id shoud not be blank');
			}


		}
		echo json_encode($response);
	 }


	 public function checkid($id)
	 {
		 $this->autoRender=false;
		$this->layout=false;
		 $result=false;
		 if(!empty($id))
		 {
			$res=$this->User->find('all',array('conditions' =>array('id'=>$id)));

			if(!empty($res))
			{
				$result =true;
			}else{
				$result =false;
			}
		 }
		 return $result;
	 }


	 public function edit($id)
	 {
		$this->autoRender=false;
		$this->layout=false;

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
		header("Content-Type: application/json; charset=UTF-8");


		if($this->request->is('get'))
		{
			$id=$this->request->params['pass'][0];
			if(!empty($id))
			{
				$res =$this->User->find('first',array('conditions'=>array('id'=>$id)));
				if(!empty($res))
				{
					$finalresult=array(
						'id'=>$res['User']['id'],
						'username'=>$res['User']['username'],
						'firstName'=>$res['User']['firstName'],
						'lastName'=>$res['User']['lastName'],
						'email'=>$res['User']['email'],
						'age'=>$res['User']['age'],
						'address'=>$res['User']['address'],
						'mobile'=>$res['User']['mobile'],
					);

						$response =array('status'=>200,'message'=>'data edited successfully','result'=>$finalresult);

				}else{
					$response =array('status'=>401,'message'=>'data not found');
				}
			}else{
				$response =array('status'=>401,'message'=>'Id shoud not be blank');
			}


		}

		echo json_encode($response);

	 }


	  public function update()
	 {
		$this->autoRender=false;
		$this->layout=false;

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
		header("Content-Type: application/json; charset=UTF-8");

		$postdata = file_get_contents("php://input");
		$data=json_decode($postdata);

			if(!empty($data))
			{


				$username=$data->username;
				$address=$data->address;
				$age=$data->age;
				$firstname=$data->firstName;
				$lastname=$data->lastName;
				$mobile=$data->mobile;
				$email=$data->email;
				$id=$data->id;

				$error=array();

				if(empty($id))
				{
					$error['id']="enter the id";
				}
				if(empty($firstname))
				{
					$error['firstName']="enter the first name";
				}
				if(empty($lastname))
				{
					$error['lastname']="enter the last name";
				}
				if(empty($email))
				{
					$error['email']="enter the email";
				}
				if(empty($address))
				{
					$error['address']="enter the address";
				}
				if(empty($mobile))
				{
					$error['mobile']="enter the mobile";
				}
				if(empty($age))
				{
					$error['age']="enter the age";
				}
				if(empty($username))
				{
					$error['username']="enter the username";
				}


				if(empty($error))
				{

				$data=array(
					'firstName' => $firstname,
					'lastName' => $lastname,
					'email' => $email,
					'address' => $address,
					'mobile' => $mobile,
					'age' => $age,
					'id' => $id,
					);

				$this->User->id = $id;
				if($this->User->save($data))
				{

					$response =array('status'=>200,'message'=>'updated successfully');

				}else{

					$response =array('status'=>401,'message'=>'record not updated');
				}

				}else{
				$response =array('status'=>401,'message'=>$error);
				}
		}
			echo json_encode($response);

	 }

	 public function login(){
		$this->layout = false;
		$this->autoRender = false;

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
		header("Content-Type: application/json; charset=UTF-8");

		$postdata = file_get_contents("php://input");
		$data=json_decode($postdata);

		$username=$data->username;
		$password=$data->password;

		if(!empty($data)){
				$username=$username;
				$pass=$password;
				$error=array();
				if(empty($username))
				{
					$error['username']="Please enter the username";
				}
				if(empty($pass))
				{
					$error['Password']="Please enter the Password";
				}


				if(empty($error))
				{
					$usern =$username;
					$pass = $pass;

					$checkuser=$this->checklogin($usern,$pass);
					///$response = array('status'=>'200','message'=>'Logged in successfully','result'=>$checkuser);


					if(!empty($checkuser))
					{
						$token = sha1(mt_rand(1, 90000) . 'SALT');

						$datas=array(
						'token' => $token,
						'username' => $checkuser['User']['username'],
						);


						$response = array('status'=>200,'message'=>'Logged in successfully','result'=>$datas);
					}
					else{

						$response = array('status'=>401,'message'=>'Logged failed');
					}
				}
				else{
					$response = array('status'=>401,'message'=>$error);
					}
			}

		echo $senddata=json_encode($response);



	}



	 public function checklogin($uname,$pass){
			$this->autoRender = false;
			$this->layout = false;
			$result=array();
			if(!empty($uname) && !empty($pass)){
				$newpass= md5($pass);
				$result = $this->User->find('first', array('conditions' => array('username' => $uname,'password' => $newpass)));
				if(!empty($result)){
					return $result;
				} else {
					return $result;
				}
			} else {
				return $result;
			}
		}

		public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
