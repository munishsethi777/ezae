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
        session_start();
		if (!self::$sessionUtil){
			self::$sessionUtil = new SessionUtil();
			return self::$sessionUtil;
		}
		return self::$sessionUtil;
	}

    public function createAdminSession(Admin $admin){
        $arr = new ArrayObject();
        $arr[$ADMIN_SEQ] = $admin->getSeq();
        $arr[$ADMIN_NAME] = $admin->getName();
        $arr[$ADMIN_COMPANY_SEQ] = $admin->getCompanySeq();

        $_SESSION[self::$ADMIN_LOGGED_IN] = $arr;
        $_SESSION[self::$LOGIN_MODE] = 'admin';
     }
    public function createUserSession(User $user){
        $arr = new ArrayObject();
        $arr[$USER_SEQ] = $user->getSeq();
        $arr[$USER_USERNAME] = $user->getUserName();
        $arr[$USER_COMPANY_SEQ] = $user->getCompanySeq();

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
    public function sessionCheck($isUser){
        $bool = self::isSessionAdmin();
        if($isUser){
            $bool = self::isSessionUser();
            if($bool == false){
                header("location: index.php");
            }
        }else{
            if($bool == false){
                header("location: adminLogin.php");
            }
        }

    }


  }
?>