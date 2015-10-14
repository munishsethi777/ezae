<?php
require_once("BeanDataStore.php5");
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/tag.php");

 class LearningProfileDataStore extends BeanDataStore{
    private static $learningProfileDataStore;
    public static function getInstance()
    {
        if (!self::$learningProfileDataStore)
        {
            self::$learningProfileDataStore = new LearningProfileDataStore(tag::$className,tag::$tableName);
            return self::$learningProfileDataStore;
        }
        return self::$learningProfileDataStore;
    }

    public function getLearningProfilesByUser($userSeq){
        $sql = "select userlearningprofiles.userseq, learningprofiles.* from userlearningprofiles
left join learningprofiles on learningprofiles.seq = userlearningprofiles.tagseq
where userlearningprofiles.userseq = $userSeq";
        $learningProfiles = self::$learningProfileDataStore->executeObjectQuery($sql);
        return $learningProfiles;
    }
 }
?>
