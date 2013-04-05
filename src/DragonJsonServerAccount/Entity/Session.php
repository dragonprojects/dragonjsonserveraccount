<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccount
 */

namespace DragonJsonServerAccount\Entity;

/**
 * Entityklasse einer Session
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="sessions")
 */
class Session
{
	/**
	 * @Doctrine\ORM\Mapping\Id 
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 * @Doctrine\ORM\Mapping\GeneratedValue
	 **/
	protected $session_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 **/
	protected $account_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="string")
	 **/
	protected $sessionhash;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="string")
	 **/
	protected $data;
	
	/**
	 * Gibt die ID der Session zurück
	 * @return integer
	 */
	public function getSessionId()
	{
		return $this->session_id;
	}
	
	/**
	 * Setzt die AccountID der Session
	 * @param integer $account_id
	 * @return Session
	 */
	public function setAccountId($account_id)
	{
		$this->account_id = $account_id;
		return $this;
	}
	
	/**
	 * Gibt die AccountID der Session zurück
	 * @return integer
	 */
	public function getAccountId()
	{
		return $this->account_id;
	}
	
	/**
	 * Setzt den Sessionhash der Session
	 * @param string $sessionhash
	 * @return Session
	 */
	public function setSessionhash($sessionhash)
	{
		$this->sessionhash = $sessionhash;
		return $this;
	}
	
	/**
	 * Gibt den Sessionhash der Session zurück
	 * @return string
	 */
	public function getSessionhash()
	{
		return $this->sessionhash;
	}
	
	/**
	 * Setzt die Daten der Session
	 * @param array $data
	 * @return Session
	 */
	public function setData(array $data)
	{
		$this->data = \Zend\Json\Encoder::encode($data);
		return $this;
	}
	
	/**
	 * Gibt die Daten der Session zurück
	 * @return array
	 */
	public function getData()
	{
		return \Zend\Json\Decoder::decode($this->data, \Zend\Json\Json::TYPE_ARRAY);
	}
	
	/**
	 * Gibt die Attribute der Session als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'session_id' => $this->getSessionId(),
			'account_id' => $this->getAccountId(),
			'sessionhash' => $this->getSessionhash(),
			'data' => $this->getData(),
		];
	}
}