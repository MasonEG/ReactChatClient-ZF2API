<?php
namespace App\Entity;

use doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 */
class User
{
	/**
	 * @var ArrayCollection|Message[]
	 * @OneToMany(targetEntity="Message", mappedBy="user")
	 */
	protected $messages;

	/**
	 * @var int
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $username;

	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $password;

	/**
	 * this is going to be some HTML/CSS compatible color string
	 * @var string
	 * @Column(type="string")
	 */
	protected $color;

	public function __construct($username, $password, $color)
	{
		$this->username = $username;
		$this->password = $password;
		$this->color = $color;
	}

	/**
	 * @return string
	 */
	public function getColor()
	{
		return $this->color;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param string $color
	 */
	public function setColor($color)
	{
		$this->color = $color;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}
}