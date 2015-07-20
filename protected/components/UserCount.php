<?php
class UserCount {
	public static function getSymbols($id) {
		return Page::model()->countBySql("SELECT length(text) FROM page WHERE id=:id", array(':id'=>$id));		
	}
	
	public static function getAllSymbols($user_id) {
		return Page::model()->countBySql("SELECT SUM(length(text)) FROM page WHERE user_id=:user_id", array(':user_id'=>$user_id));
	}
	
	public static function getArticles($user_id) {
		return Page::model()->countBySql("SELECT count(*) FROM page WHERE user_id=:user_id", array(':user_id'=>$user_id)); 
	}	
	
	public static function getReward($id) {
		return Page::model()->countBySql("SELECT length(text) FROM page WHERE id=:id AND publish=1", array(':id'=>$id))*0.1;
	}
	
	public static function getBalance($user_id) {
		return Page::model()->countBySql("SELECT SUM(length(text)) FROM page WHERE user_id=:user_id AND publish=1", array(':user_id'=>$user_id))*0.1;
	}
}