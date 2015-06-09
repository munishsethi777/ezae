<?php

class SessionUtil{
    private static $LOGIN_MODE = "loginMode";
    private static $ADMIN_SEQ = "adminSeq";
    private static $ADMIN_NAME = "adminName";
    private static $ADMIN_LOGGED_IN = "adminLoggedIn";
    private static $ADMIN_COMPANY_SEQ = "adminCompanySeq";

    private static $USER_SEQ = "userSeq";
    private static $USER_USERNAME = "userUserName";
    private static $USER_LOGGED_IN = "userLoggedIn";
    private static $USER_COMPANY_SEQ = "userCompanyseq";

	private static $sessionUtil;
	public static function getInstance(){       
		if(!self::$sessionUtil){
            session_start();
			self::$sessionUtil = new SessionUtil();
			return self::$sessionUtil;
		}
		return self::$sessionUtil;
	}

    public function createAdminSession(Admin $admin){
        $arr = new ArrayObject();
        $arr[0] = $admin->getSeq();
        $arr[1] = $admin->getName();
        $arr[2] = $admin->getCompanySeq();

        $_SESSION[self::$ADMIN_LOGGED_IN] = $arr;
        $_SESSION[self::$LOGIN_MODE] = 'admin';
     }
    public function createUserSession(User $user){
        $arr = new ArrayObject();
        $arr[0] = $user->getSeq();
        $arr[1] = $user->getUserName();
        $arr[2] = $user->getCompanySeq();

        $_SESSION[self::$USER_LOGGED_IN] = $arr;
        $_SESSION[self::$LOGIN_MODE] = 'user';
    }

    public function isSessionAdmin(){
        if($_SESSION[self::$LOGIN_MODE] == "admin" &&
            $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                return true;
        }
    }
    public function isSessionUser(){
        if($_SESSION[self::$LOGIN_MODE] == "user" &&
            $_SESSION[self::$USER_LOGGED_IN] != null){
                return true;
        }
    }
    public function getAdminLoggedInName(){
      if($_SESSION[self::$LOGIN_MODE] == "admin" &&
            $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                return $arr[1];
        }
    }

    public function getUserLoggedInName(){
      if($_SESSION[self::$LOGIN_MODE] == "user" &&
            $_SESSION[self::$USER_LOGGED_IN] != null){
                $arr = $_SESSION[self::$USER_LOGGED_IN];
                return $arr[1];
        }
        return null;
    }

    public function getUserLoggedInSeq(){
      if($_SESSION[self::$LOGIN_MODE] == "user" &&
            $_SESSION[self::$USER_LOGGED_IN] != null){
                $arr = $_SESSION[self::$USER_LOGGED_IN];
                return $arr[0];
        }
        return null;
    }

    public function getUserLoggedInCompanySeq(){
      if($_SESSION[self::$LOGIN_MODE] == "user" &&
            $_SESSION[self::$USER_LOGGED_IN] != null){
                $arr = $_SESSION[self::$USER_LOGGED_IN];
                return $arr[2];
        }
        return null;
    }

    public function getAdminLoggedInCompanySeq(){
      if($_SESSION[self::$LOGIN_MODE] == "admin" &&
            $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                return $arr[2];
        }
    }
    
    public function getAdminLoggedInSeq(){
      if($_SESSION[self::$LOGIN_MODE] == "admin" &&
            $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                return $arr[0];
        }
    }

    public function destroySession(){
        $boolAdmin = self::isSessionAdmin();
        $boolUser = self::isSessionUser();
        $_SESSION = array();
        session_destroy();
        if($boolAdmin == true){

            header("Location:adminLogin.php");
        }

        if($boolUser == true){
            header("Location:index.php");

        }

    }
    public function sessionCheck($loginType){
        $bool = self::isSessionAdmin();
        if($loginType == LoginType::USER){
            $bool = self::isSessionUser();
            if($bool == false){
                header("location: UserLogin.php");
            }
        }else{
            if($bool == false){
                header("location: adminLogin.php");
            }
        }

    }


  }
?>