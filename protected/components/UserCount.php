<?php
class UserCount {
	public static function getSymbols($text) {
		$text = preg_replace("/[`~!?@#№$%&*+=_,.:;<>\-\/\\\()\[\]\"\'\^\ ]/", "", $text);
		return mb_strlen($text, 'UTF-8');
	}
	
	public static function getArticles($user_id) {
		return Page::model()->count('user_id=:id', array(':id'=>$user_id)); 
	}

	public static function allText($user_id) {
		$model = Page::model()->findAllByAttributes(array('user_id' => $user_id));
		foreach($model as $key) $text .= $key->text;
		return $text;
	}
	
	public static function publishedText($user_id) {
		$model = Page::model()->findAllByAttributes(array('user_id' => $user_id, 'publish' => '1'));
		foreach($model as $key) $text .= $key->text;
		return $text;
	}
}