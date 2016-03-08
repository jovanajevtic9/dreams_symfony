<?php

namespace DreamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="DreamBundle\Repository\UserRepository")
 */
class User
{
    protected $dreams = array();


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="likeDreams", type="string", length=2550)
     */
    private $likeDreams;

    /**
     * @var string
     *
     * @ORM\Column(name="dislikeDreams", type="string", length=2550)
     */
    private $dislikeDreams;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="regDate", type="datetime")
     */
    private $regDate;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set likeDreams
     *
     * @param string $likeDreams
     *
     * @return User
     */
    public function setLikeDreams($likeDreams)
    {
        $this->likeDreams = $likeDreams;

        return $this;
    }

    /**
     * Get likeDreams
     *
     * @return string
     */
    public function getLikeDreams()
    {
        return $this->likeDreams;
    }
    /**
     * Set dislikeDreams
     *
     * @param string $dislikeDreams
     *
     * @return User
     */
    public function setDislikeDreams($dislikeDreams)
    {
        $this->dislikeDreams = $dislikeDreams;

        return $this;
    }

    /**
     * Get dislikeDreams
     *
     * @return string
     */
    public function getDislikeDreams()
    {
        return $this->dislikeDreams;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Set regDate
     *
     * @param \DateTime $regDate
     *
     * @return User
     */
    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;

        return $this;
    }

    /**
     * Get regDate
     *
     * @return \DateTime
     */
    public function getRegDate()
    {
        return $this->regDate;
    }

    /**
     * Set dreams
     *
     * @param string $dreams
     *
     * @return User
     */
    public function setDreams($dreams)
    {
        $this->dreams = $dreams;

        return $this;
    }

    /**
     * Get dreams
     *
     * @return string
     */
    public function getDreams()
    {
        return $this->dreams;
    }
}

