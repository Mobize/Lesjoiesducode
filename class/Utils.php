<?php

class Utils {

	/*
		Nettoie une chaine en supprimant des balises html
		Ex: $text = '<a><strong>Bla bla</strong</a>';
			$text = strip_selected_tags($text, array('strong'));
			echo $text; // Affiche <a>Bla bla</a>
	*/
	public static function strip_selected_tags($text, $tags = array()) {
	    foreach ($tags as $tag) {
		    $text = preg_replace('/<\/?' . $tag . '(.|\s)*?>/', '', $text);
		}
		return $text;
	}

}