<?php
  class LeaderBoardMgr{
    private static $leaderBoardMgr;
    private static $dataStore;

    public static function getInstance()
    {
        if (!self::$leaderBoardMgr)
        {
            self::$leaderBoardMgr = new LeaderBoardMgr();
            self::$dataStore = new BeanDataStore(LeaderBoard::$className,LeaderBoard::$tableName);
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
    public function getLeaderBoardForGrid($isApplyFilter){
        $sessionUtil = SessionUtil::getInstance();
        $companySeq = $sessionUtil->getAdminLoggedInCompanySeq();
        $sql = "select leaderboard.*,modules.title as moduleName,learningplans.title as learningPlanName from leaderboard
left join learningplans on learningplans.seq = leaderboard.learningplanseq
left join modules on modules.seq = leaderboard.moduleseq
where learningplans.companyseq = $companySeq";
        $leaderBoards = self::$dataStore->executeQuery($sql);
        //$leaderBoards =  $this->FindAll($isApplyFilter);
        //$leaderBoardJson = self::geLeaderBoardDataJson($leaderBoards);
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

        }
        $gridData["Rows"] = $leaderBoards;
        $gridData["TotalRows"] = self::$dataStore->executeCountQuery(null,$isApplyFilter);
        return json_encode($gridData);
    }

    //under admin login for grid popup details
    public function getLeaderBoardData($seq,$type){
        if($type == "Module"){
            $sql = "select activities.*,leaderboard.seq as lseq,leaderboard.name as leaderboardName,users.username from activities
    left join leaderboard on  leaderboard.moduleseq = activities.moduleseq
    left join users on users.seq = activities.userseq
    where leaderboard.learningplanseq = activities.learningplanseq
    and leaderboard.seq = $seq order by score DESC LIMIT 10";
            $leaderBoardData = self::$dataStore->executeQuery($sql);
            return json_encode($leaderBoardData);
        }else{
           $sql = "select users.username,leaderboard.name leaderboardName,avg(progress) progress, avg(score) score from activities
left join leaderboard on  leaderboard.learningplanseq = activities.learningplanseq
left join users on users.seq = activities.userseq
where leaderboard.learningplanseq = activities.learningplanseq
and leaderboard.seq = $seq group by userseq order by userseq DESC LIMIT 10";
            $leaderBoardData = self::$dataStore->executeQuery($sql);
            return json_encode($leaderBoardData);
        }
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
