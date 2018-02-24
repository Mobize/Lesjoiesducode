<?php

class Jdc {

	public $id;
	public $name;
	public $content;
	public $creation_date;

	public function __construct($post = array()) {
		foreach($post as $key => $value) {
			if (property_exists($this, $key)) {
				$this->$key = $value;
			}
		}
	}

	private function _displayPost($max_length = 100) {
		if ($max_length > 0 && strlen($this->content) > $max_length) {
			$this->content = substr($this->content, 0, $max_length).'...<br>';
			$this->content .= '<a href="post.php?id='.$this->id.'">Lire la suite</a>';
		}

		$html = '<div class="post">
		    <p>'.date('d-m-Y H:i:s', strtotime($this->creation_date)).' par <a href="#">'.$this->name.'</a></p>
		    <blockquote>
		      <p>'.nl2br($this->content).'</p>
		    </blockquote>
		</div>';

		return $html;
	}

	public static function displayPost($post, $max_length = 100) {
		$jdc = new Jdc($post);
		return $jdc->_displayPost($max_length);
	}

	public static function displayFullPost($post) {
		return self::displayPost($post, 0);
	}

}