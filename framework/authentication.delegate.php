<?php
namespace F3il;

defined('__F3IL__') or die('Acces interdit');

/**
 *
 * @author william
 */
interface AuthenticationDelegate {
        
    /**
     * @return string
     */
    public function auth_getLoginColumn();
    
    /**
     * @return string
     */
    public function auth_getPasswordColumn();
    
    /**
     * @retrun string
     */
    public function auth_getSaltColumn();
    
    /**
     * @retrun string
     */
    public function auth_getIdColumn();
    
    /**
     * @param string $login
     * @return array
     */
    public function auth_getUserByLogin($login);
    
    /**
     * $param int $id
     * @return array
     */
    public function auth_getUserById($id);                
}
