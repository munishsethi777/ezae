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
        $leaderBoards =  $this->FindAll($isApplyFilter);
        $leaderBoardJson = self::geLeaderBoardDataJson($leaderBoards);
        for($i=0;$i<count($leaderBoardJson);$i++){
            $id = $leaderBoardJson[$i]['id'];
            $leaderBoardJson[$i]['action'] = '<a href="javascript:showLeaderboard(\''. $id .'\')" class="btn btn-xs btn-outline btn-primary moduleDetailsButton">
                                                    View <i class="fa fa-long-arrow-right"></i>
                                                </a>';
        }
        $gridData["Rows"] = $leaderBoardJson;
        $gridData["TotalRows"] = self::$dataStore->executeCountQuery(null,$isApplyFilter);
        return json_encode($gridData);
    }

    //under admin login for grid popup details
    public function getLeaderBoardData($seq){
        $sql = "select activities.*,leaderboard.seq as lseq,leaderboard.name as leaderboardName,users.username from activities
left join leaderboard on  leaderboard.moduleseq = activities.moduleseq
left join users on users.seq = activities.userseq
where leaderboard.learningplanseq = activities.learningplanseq
and leaderboard.seq = $seq order by score DESC LIMIT 10";
        $leaderBoardData = self::$dataStore->executeQuery($sql);
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
