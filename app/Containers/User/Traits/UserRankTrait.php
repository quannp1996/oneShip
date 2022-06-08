<?php 
namespace App\Containers\User\Traits;

trait UserRankTrait {
    public static $storeRoles = [];

    public function isRoot(){
        return $this->id == 1;
    }

    public function isMySelf($uid = 0){
        if($uid <= 0){
            $uid = \Auth::id();
        }
        return $this->id == $uid;
    }

    public function biggerThanYou($uid = 0, $you = null){
        if($uid <= 0){
            $uid = \Auth::id();
        }
        if(!$this->isRoot()) {
            if(empty($you)) {
                $you = self::find($uid);
            }
            if (!empty($you)) {
                $myRank = $this->getStoreRank();
                $yourRank = $this->getStoreRank($you);

                return $myRank > $yourRank;
            }
        }
        return true;
    }

    public function getStoreRank($user = null){
        if(empty($user)){
            $user = $this;
        }
        if(isset(self::$storeRoles[$user->id])){
            $rank = self::$storeRoles[$user->id];
        }else{
            $rank = $user->getRoleLevel();
            self::$storeRoles[$user->id] = $rank;
        }
        return $rank;
    }
}