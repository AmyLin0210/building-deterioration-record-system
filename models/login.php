<?php
    require ("config.php");

class ModuleLogin 
{   
    function login($account, $password) {
        $sqlSearch = 'SELECT userId FROM user WHERE account=:account AND password=:password';
        $search    = $GLOBALS['conn']->prepare($sqlSearch);
        $search->execute([':account'=>$account, ':password'=>$password]);
        $result=$search->fetch();
        
        // return the user id or empty array
        return $result;
    }
}

?>