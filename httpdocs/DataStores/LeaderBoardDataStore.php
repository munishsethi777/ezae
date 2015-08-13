<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/LeaderBoard.php");

 class LeaderBoardDataStore extends BeanDataStore{
    private static $leaderBoardDataStore;
    public static function getInstance()
    {
        if (!self::$leaderBoardDataStore)
        {
            self::$leaderBoardDataStore = new LeaderBoardDataStore(LeaderBoard::$className,LeaderBoard::$tableName);
                return self::$leaderBoardDataStore;
        }
        return self::$leaderBoardDataStore;
    }
    
    public function findLeaderBoard($companySeq,$isApplyFilter = false){
        $sql = "select leaderboard.*,modules.title as moduleName,learningplans.title as learningPlanName from leaderboard"
." left join learningplans on learningplans.seq = leaderboard.learningplanseq"
." left join modules on modules.seq = leaderboard.moduleseq"
." where learningplans.companyseq = $companySeq";
        $leaderBoards = $this->executeQuery($sql,$isApplyFilter);        
        return $leaderBoards;        
    }

    public function getTotalCouts($companySeq,$isApplyFilter = false){
         $coutSql = "select count(*) as total from leaderboard
left join learningplans on learningplans.seq = leaderboard.learningplanseq
left join modules on modules.seq = leaderboard.moduleseq
where learningplans.companyseq = $companySeq";
         $count = $this->executeQuery($coutSql,$isApplyFilter);
         return $count[0]["total"];    
    }
    
    
    //under admin login for grid popup details
    public function getLeaderBoardData($seq,$type){
        if($type == "Module"){
            $sql = "select activities.*,leaderboard.seq as lseq,leaderboard.name as leaderboardName,users.username from activities
    left join leaderboard on  leaderboard.moduleseq = activities.moduleseq
    left join users on users.seq = activities.userseq
    where leaderboard.learningplanseq = activities.learningplanseq
    and leaderboard.seq = $seq order by score DESC LIMIT 10";
        }else{
           $sql = "select users.username,leaderboard.name leaderboardName,avg(progress) progress, avg(score) score from activities
left join leaderboard on  leaderboard.learningplanseq = activities.learningplanseq
left join users on users.seq = activities.userseq
where leaderboard.learningplanseq = activities.learningplanseq
and leaderboard.seq = $seq group by userseq order by userseq DESC LIMIT 10";
           
        }
        $leaderBoardData = $this->executeQuery($sql);
        return $leaderBoardData;
    }
 }
?>
