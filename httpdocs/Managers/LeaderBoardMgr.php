<?php
require_once($ConstantsArray['dbServerUrl']. "DataStores/LeaderBoardDataStore.php"); 
  class LeaderBoardMgr{
    private static $leaderBoardMgr;
    private static $dataStore;

    public static function getInstance()
    {
        if (!self::$leaderBoardMgr)
        {
            self::$leaderBoardMgr = new LeaderBoardMgr();
            self::$dataStore = new LeaderBoardDataStore(LeaderBoard::$className,LeaderBoard::$tableName);
            return self::$leaderBoardMgr;
        }
        return self::$leaderBoardMgr;
    }

    public function Save($leaderboard){
        $id = self::$dataStore->save($leaderboard);
        return $id;
    }

    public function deleteByLearningPlan($id){
        $colValuePair["learningplanseq"] = $id;
        $id = self::$dataStore->deleteByAttribute($colValuePair);
    }

    public function FindAll($isApplyFilter = false){
        $leaderBoards= self::$dataStore->findAll($isApplyFilter);
        return $leaderBoards;
    }

    //under admin login for grid
    public function getLeaderBoardForGrid(){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $leaderBoards = self::$dataStore->findLeaderBoard($companySeq,true);
        for($i=0;$i<count($leaderBoards);$i++){
            $id = $leaderBoards[$i]['seq'];
            $type =  $leaderBoards[$i]['leaderboardtype'];
            $leaderBoards[$i]['action'] = '<a href="javascript:showLeaderboard(\''. $id .'\',\''. $type .'\')" class="btn btn-xs btn-outline btn-primary moduleDetailsButton">
                                                    View <i class="fa fa-long-arrow-right"></i></a>';
            if($type == "Module"){
                $leaderBoards[$i]['basedOn'] = "Module - ". $leaderBoards[$i]['moduleName'];
            }else{
               $leaderBoards[$i]['basedOn'] = "LearningPlan - ". $leaderBoards[$i]['learningPlanName'];
            }
            $leaderBoards[$i]['leaderboard.lastmodifiedon'] = $leaderBoards[$i]["lastmodifiedon"];

        }
        $gridData["Rows"] = $leaderBoards;
        $count =  self::$dataStore->getTotalCouts($companySeq,true);
        $gridData["TotalRows"] = $count;
        return json_encode($gridData);
    }

    //under admin login for grid popup details
    public function getLeaderBoardData($seq,$type){
        $leaderBoardData = self::$dataStore->getLeaderBoardData($seq,$type);
        return json_encode($leaderBoardData);
    }
  


    //private functions used within this class
    private static function geLeaderBoardDataJson($leaderBoards){
        $fullArr = array();
        foreach($leaderBoards as $leaderBoard){
            $arr = self::getLeaderBoardArry($leaderBoard);
            array_push($fullArr,$arr);
        }
        return $fullArr;
    }

    private static function getLeaderBoardArry($leaderBoardObj){
        $leaderBoard = new LeaderBoard();
        $leaderBoard = $leaderBoardObj;
        $lbArr = array();
        $lbArr["id"] = $leaderBoard->getSeq();
        $lbArr["name"] = $leaderBoard->getName();
        $lbArr["type"] = $leaderBoard->getLeaderBoardType();
        $lbArr["lastmodifiedon"] = $leaderBoard->getLastModifiedOn();
        return $lbArr;
    }

}
?>
