<?php

  class Module{
      public static $tableName = "modules";
      private $seq, $title, $description, $createdon, $isenabled, $ispaid, $price, $lastmodifiedon, $maxscore, $passpercent,
      $companyseq, $timeallowed, $tagline, $imagepath, $synopsis, $author, $moduletype, $tags, $prerequisties, $prework, $videourl,$typedetails, $maxquestions, $isfaceauthentication, $iscertificationenabled;


      public function setSeq($seq_){
        $this->seq = $seq_;
      }
      public function getSeq(){
        return $this->seq;
      }

      public function setTitle($title_){
          $this->title = $title_;
      }
      public function getTitle(){
          return $this->title;
      }

      public function setDescription($description_){
        $this->description = $description_;
      }
      public function getDescription(){
        return $this->description;
      }

      public function setCreatedOn($dateOfCreation_){
        $this->createdon = $dateOfCreation_;
      }
      public function getCreatedOn(){
        return $this->createdon;
      }

      public function setIsEnabled($enabled_){
        $this->isenabled = $enabled_;
      }
      public function getIsEnabled(){
        return $this->isenabled;
      }

      public function setIsPaid($paid_){
        $this->ispaid = $paid_;
      }
      public function getIsPaid(){
        return $this->ispaid;
      }

      public function setPrice($price_){
        $this->price = $price_;
      }
      public function getPrice(){
        return $this->price;
      }

      public function setLastModifiedOn($lastModifiedOn_){
        $this->lastmodifiedon = $lastModifiedOn_;
      }
      public function getLastModifiedOn(){
        return $this->lastmodifiedon;
      }

      public function setMaxScore($maxScore_){
        $this->maxscore = $maxScore_;
      }
      public function getMaxScore(){
        return $this->maxscore;
      }

      public function setPassPercent($passPercent_){
        $this->passpercent = $passPercent_;
      }
      public function getPassPercent(){
        return $this->passpercent;
      }

      public function setCompanySeq($companySeq_){
            $this->companyseq = $companySeq_;
      }
      public function getCompanySeq(){
            return $this->companyseq;
      }

      public function setTimeAllowed($timeallowed_){
            $this->timeallowed = $timeallowed_;
      }
      public function getTimeAllowed(){
            return $this->timeallowed;
      }

      public function setTagLine($tagLine){
            $this->tagline = $tagLine;
      }
      public function getTagLine(){
            return $this->tagline;
      }

      public function setImagePath($val){
            $this->imagepath = $val;
      }
      public function getImagePath(){
            return $this->imagepath;
      }

      public function setSynopsis($val){
            $this->synopsis = $val;
      }
      public function getSynopsis(){
            return $this->synopsis;
      }

      public function setAuthor($val){
            $this->author = $val;
      }
      public function getAuthor(){
            return $this->author;
      }

      public function setModuleType($val){
            $this->moduletype = $val;
      }
      public function getModuleType(){
            return $this->moduletype;
      }

      public function setTags($val){
            $this->tags = $val;
      }
      public function getTags(){
            return $this->tags;
      }

      public function setPrerequisties($val){
            $this->prerequisties = $val;
      }
      public function getPrerequisties(){
            return $this->prerequisties;
      }

      public function setPrework($val){
            $this->prework = $val;
      }
      public function getPrework(){
            return $this->prework;
      }

      public function setVideoUrl($val){
            $this->videourl = $val;
      }
      public function getVideoUrl(){
            return $this->videourl;
      }

      public function setTypeDetails($typeDetail_){
            $this->typedetails = $typeDetail_;
      }
      public function getTypeDetails(){
            return $this->typedetails;
      }

      public function setMaxQuestions($value){
            $this->maxquestions = $value;
      }
      public function getMaxQuestions(){
            return $this->maxquestions;
      }

      public function setIsFaceAuthentication($value){
            $this->isfaceauthentication = $value;
      }
      public function getIsFaceAuthentication(){
            return $this->isfaceauthentication;
      }

      public function setIsCertificationEnabled($value){
            $this->iscertificationenabled = $value;
      }
      public function getIsCertificationEnabled(){
            return $this->iscertificationenabled;
      }

  }

?>
