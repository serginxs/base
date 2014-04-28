<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    
    private $_id;
    
    
	public function authenticate()
	{
		
                $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
		if($user === null)//check login
                {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
                        return 0;
                }
                
		else if(!CPasswordHelper::verifyPassword($this->password,$user->password))//check password
                {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
                        return 0;
                }
                
		else{
                        $this->_id = $user->id;			
			if($user->isAdmin){
				$this->setState('isAdmin', 1);
			}
			//$this->username = $user->username;			
			//$this->setState('email', $user->email);
			//$this->setState('username', $user->username);
			//$this->setState('phone', $user->phone);
			$this->errorCode=self::ERROR_NONE;
                     }
		return $this->errorCode == self::ERROR_NONE;
	}
        
        /**
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->_id;
	}
}