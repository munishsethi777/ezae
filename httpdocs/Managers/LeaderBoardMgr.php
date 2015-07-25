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
    public function getLeaderBoardForGrid($isApplyFilter){
        $leaderBoards =  $this->FindAll($isApplyFilter);
        $leaderBoardJson = self::geLeaderBoardDataJson($leaderBoards);
        $gridData["Rows"] = $leaderBoardJson;
        $gridData["TotalRows"] = self::$dataStore->executeCountQuery(null,$isApplyFilter);
        return json_encode($gridData);
    }
    public static function geLeaderBoardDataJson($leaderBoards){
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
