<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Company.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/CompanyDataStore.php");

class SessionUtil{
    private static $LOGIN_MODE = "loginMode";
    private static $ADMIN_SEQ = "adminSeq";
    private static $ADMIN_NAME = "adminName";
    private static $ADMIN_LOGGED_IN = "adminLoggedIn";
    private static $ADMIN_COMPANY_SEQ = "adminCompanySeq";
    private static $ADMIN_COMPANY_NAME = "adminCompanyName";

    private static $USER_SEQ = "userSeq";
    private static $USER_USERNAME = "userUserName";
    private static $USER_LOGGED_IN = "userLoggedIn";
    private static $USER_COMPANY_SEQ = "userCompanyseq";
    private static $USER_COMPANY_NAME = "userCompanyName";

    private static $ROLE = "role";

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
        $CDS = CompanyDataStore::getInstance();
        $company = $CDS->FindBySeq($admin->getCompanySeq());

        $arr = new ArrayObject();
        $arr[0] = $admin->getSeq();
        $arr[1] = $admin->getName();
        $arr[2] = $admin->getCompanySeq();
        $arr[3] = $company->getName();


        $_SESSION[self::$ADMIN_LOGGED_IN] = $arr;
        $_SESSION[self::$LOGIN_MODE] = 'admin';
        $_SESSION[self::$ROLE] = RoleType::ADMIN;
        if($admin->getIsManager()){
            $_SESSION[self::$ROLE] = RoleType::MANAGER;
        }
    }
    public function createUserSession(User $user){
        $CDS = CompanyDataStore::getInstance();
        $company = $CDS->FindBySeq($user->getCompanySeq());

        $arr = new ArrayObject();
        $arr[0] = $user->getSeq();
        $arr[1] = $user->getUserName();
        $arr[2] = $user->getCompanySeq();
        $arr[3] = $user->getAdminSeq();
        $arr[4] = $company->getName();
        $_SESSION[self::$USER_LOGGED_IN] = $arr;
        $_SESSION[self::$LOGIN_MODE] = 'user';
        $_SESSION[self::$ROLE] = RoleType::USER;
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
    public function getUserLoggedInCompanyName(){
      if($_SESSION[self::$LOGIN_MODE] == "user" &&
            $_SESSION[self::$USER_LOGGED_IN] != null){
                $arr = $_SESSION[self::$USER_LOGGED_IN];
                return $arr[4];
        }
        return null;
    }
    public function getUserLoggedInAdminSeq(){
      if($_SESSION[self::$LOGIN_MODE] == "user" &&
            $_SESSION[self::$USER_LOGGED_IN] != null){
                $arr = $_SESSION[self::$USER_LOGGED_IN];
                return $arr[3];
        }
        return null;
    }

    public function getAdminLoggedInCompanySeq(){
        if((count($_SESSION) > 0)){
          if($_SESSION[self::$LOGIN_MODE] == "admin" &&
                $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                    $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                    return $arr[2];
            }
        }
    }
    public function getAdminLoggedInCompanyName(){
      if($_SESSION[self::$LOGIN_MODE] == "admin" &&
            $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                return $arr[3];
        }
        return null;
    }
    public function getAdminLoggedInSeq(){
        if((count($_SESSION) > 0)){
            if($_SESSION[self::$LOGIN_MODE] == "admin" &&
                $_SESSION[self::$ADMIN_LOGGED_IN] != null){
                    $arr = $_SESSION[self::$ADMIN_LOGGED_IN];
                    return $arr[0];
            }
        }
    }

    public function getLoggedInRole(){
        return $_SESSION[self::$ROLE];
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