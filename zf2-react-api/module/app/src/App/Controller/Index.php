<?php

namespace App\Controller;

use Webdev\Controller\AbstractRestfulController;
use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use App\Entity;

class Index extends AbstractRestfulController
{

	public function createAction() //creates a user, returns true/false based on if the submission is valid
	{
		$data = json_decode(file_get_contents('php://input'), true);

		$username = $data['username'];
		$password = $data['password'];
		$color = $data['color'];
		$ret = []; //this serves as the JSON object to return, represented as an associative array

		//query to check if the username is taken, its ok not everything needs to be encapsulated
		$qb = $this->entity('User')->createQueryBuilder('u');
		$qb
			->select('u.username')
			->where('u.username = :username')
			->setParameter('username', $username);

		/** @var Entity\User $user */
		$user = $qb->getQuery()->getOneOrNullResult();

		if ($user)
		{
			$ret['success'] = false; //return {success: false}
            $ret['err'] = 'user already exists!';
			return $this->createResponse($ret);
		}

		$user = new Entity\User($username, $password, $color); //build the new user
		$this->entity()->persist($user);
		$this->entity()->flush();

		$ret['success'] = true; //return {success: true}
		return $this->createResponse($ret);
	}

	public function loginAction() //logs in the user, returns true/false based on if the submission is valid
	{
		$data = json_decode(file_get_contents('php://input'), true);

		$username = $data['username'];
		$password = $data['password'];
		$ret = [];

		if($this->validateUser($username, $password))
		{
			$ret['success'] = true;
			return $this->createResponse($ret);
		}

		$ret['success'] = false;
		$ret['err'] = 'username/password is incorrect';
		return $this->createResponse($ret);

	}

	public function viewAction() //returns a JSON of the last 50 messages sent
	{
		$data = json_decode(file_get_contents('php://input'), true);

		$username = $data['username'];
		$password = $data['password'];
		$ret = [];

		if(!$this->validateUser($username, $password))
		{
			$ret['success'] = false;
			$ret['err'] = 'username/password is incorrect... are you a hacker?';
			return $this->createResponse($ret);
		}

		$ret['success'] = true;
		$ret['messages'] = [];

		$msgArr = $this->entity('Message')->findAll(); //I'm not sure if this is the best way of going about getting the first 50 messages
		for($i = 0; ($i < 50) && ($i < sizeof($msgArr)); $i++)
		{
			$msg = [];
			$msg['username'] = $msgArr[$i]->getUser()->getUsername();
			$msg['color'] = $msgArr[$i]->getUser()->getColor();
			$msg['date'] = $msgArr[$i]->getDate();
			$msg['message'] = $msgArr[$i]->getMsg();
			array_push($ret['messages'], $msg);
		}

		return $this->createResponse($ret);
	}

	public function sendAction() //returns no JSON because real users sending this request are already logged in, username/password only exist for people trying to be hackers so we don't need a success message
	{
		$data = json_decode(file_get_contents('php://input'), true);


		$username = $data['username'];
		$password = $data['password'];
		$msg = $data['message'];
		$ret = [];
		if(!$this->validateUser($username, $password))
		{
			$ret['success'] = false; //TODO figure out if this is good
			$ret['err'] = 'username/password is incorrect... are you a hacker?';
			return $this->createResponse($ret);
		}

		$this->entity()->persist(new Entity\Message($this->entity('User')->find($this->validateUser($username, $password)), $msg));
		$this->entity()->flush();

		$ret['success'] = true;

		return $this->createResponse($ret);
	}

	/**
	 * this basically checks if the username exists and the password matches it
	 *
	 * @param $username
	 * @param $password
	 *
	 * @return bool
	 */
	protected function validateUser($username, $password) //TODO make sure this works
	{
		$qb = $this->entity('User')->createQueryBuilder('u');
		$qb
			->select('u.id')
			->where('u.username = :username AND u.password = :password')
			->setParameter('username', $username)
			->setParameter('password', $password);

		return($qb->getQuery()->getOneOrNullResult());
	}

	/**
	 * Helper method to buld that JSON POST response
	 *
	 * @param array $data The data to return in the response.
	 * @return Formatted 200 JSON response object.
	 */
	protected function createResponse($data) //$data is an assoc. array we want to set as our response in JSON
    {

        $resp = $this->getResponse();


		//Add a bunch of vital headers
        $resp->getHeaders()->addHeaders([
            'Access-Control-Allow-Origin:*', //this tells us what domains the response can be accessed in, * means any
            'Content-Type: application/json', //specify the body content of the response
            'Access-Control-Allow-Methods: GET,POST', //specify what methods are allowed to access this data
            'Access-Control-Allow-Credentials: true',
            'Access-Control-Allow-Headers: Content-Type, Connection', //specifies what headers are allowed from the client
            'Access-Control-Max-Age: 30000', //Defines the timeout for the response to be loaded in ms
            'Connection: close'
        ]);


		// Set the status code to 200, OK. Means the http request was successful
		$resp->setStatusCode(Response::STATUS_CODE_200);

		// Sets the body to a JSON of our data
        $resp->setContent(json_encode($data));

		return $resp;
	}
}
