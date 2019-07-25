<?php

namespace App\Entity;

use DateTime;

/**
 * @Entity
 */
class Message
{
	/**
	 * @var User
	 * @ManyToOne(targetEntity="User", inversedBy="messages")
	 */
	protected $user;

	/**
	 * @var int
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var DateTime
	 * @Column(type="datetime")
	 *
	 */
	protected $date;

	/**
	 * @var string
	 * @Column(type="text")
	 */
	protected $msg;

	public function __construct($user, $msg)
	{
		$this->date = new DateTime();
		$this->user = $user;
		$this->msg = $msg;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return DateTime
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getMsg()
	{
		return $this->msg;
	}

	/**
	 * @param string $msg
	 */
	public function setMsg($msg)
	{
		$this->msg = $msg;
	}

	/**
	 * @param DateTime $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}

	/**
	 * @param User $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}


}