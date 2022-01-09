<?php

function getRating($rating) {
	//Вычисляем троку реитинга, для вывода в шаблон.
	$rating = round($rating, 2) * 10;
	$sRating = 0;
	//Если рейтинг целое число
	if ($rating == round($rating / 10) * 10) {
		$sRating = $rating;
	} else {
		$sRating = round($rating / 5, 0) * 5;
		if ($sRating < 10) {
			$sRating = "05";
		}
	}
	return $sRating;
}
?>