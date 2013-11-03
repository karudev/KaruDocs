<?php

namespace Doc\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Letter
 *
 * @ORM\Table(name="letter")
 * @ORM\Entity(repositoryClass="Doc\IndexBundle\Entity\LetterRepository")
 */
class Letter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="letter_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="account_id")
     */
    private $accountId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="date")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_last_updated", type="date")
     */
    private $dateLastUpdated;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=255)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=4000)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Contact")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="contact_id")
     */
    private $receiverId;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

  

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Letter
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateLastUpdated
     *
     * @param \DateTime $dateLastUpdated
     * @return Letter
     */
    public function setDateLastUpdated($dateLastUpdated)
    {
        $this->dateLastUpdated = $dateLastUpdated;
    
        return $this;
    }

    /**
     * Get dateLastUpdated
     *
     * @return \DateTime 
     */
    public function getDateLastUpdated()
    {
        return $this->dateLastUpdated;
    }

    /**
     * Set object
     *
     * @param string $object
     * @return Letter
     */
    public function setObject($object)
    {
        $this->object = $object;
    
        return $this;
    }

    /**
     * Get object
     *
     * @return string 
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Letter
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
     * Set accountId
     *
     * @param \Doc\IndexBundle\Entity\Account $accountId
     * @return Letter
     */
    public function setAccountId(\Doc\IndexBundle\Entity\Account $accountId = null)
    {
        $this->accountId = $accountId;
    
        return $this;
    }

    /**
     * Get accountId
     *
     * @return \Doc\IndexBundle\Entity\Account 
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set receiverId
     *
     * @param \Doc\IndexBundle\Entity\Contact $receiverId
     * @return Letter
     */
    public function setReceiverId(\Doc\IndexBundle\Entity\Contact $receiverId = null)
    {
        $this->receiverId = $receiverId;
    
        return $this;
    }

    /**
     * Get receiverId
     *
     * @return \Doc\IndexBundle\Entity\Contact 
     */
    public function getReceiverId()
    {
        return $this->receiverId;
    }
}