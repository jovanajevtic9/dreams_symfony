<?php

namespace DreamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dream
 *
 * @ORM\Table(name="dream")
 * @ORM\Entity(repositoryClass="DreamBundle\Repository\DreamRepository")
 */
class Dream
{



    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="dreams")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Dream", mappedBy="user")
     */
    protected $dreams;

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
     * @ORM\Column(name="text", type="string", length=3000)
     */
    private $text;



    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes;

    /**
     * @var int
     *
     * @ORM\Column(name="unlikes", type="integer")
     */
    private $unlikes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;


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
     * Set text
     *
     * @param string $text
     *
     * @return Dream
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }





    /**
     * Set likes
     *
     * @param integer $likes
     *
     * @return Dream
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set unlikes
     *
     * @param integer $unlikes
     *
     * @return Dream
     */
    public function setUnlikes($unlikes)
    {
        $this->unlikes = $unlikes;

        return $this;
    }

    /**
     * Get unlikes
     *
     * @return int
     */
    public function getUnlikes()
    {
        return $this->unlikes;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Dream
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Dream
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }




}

