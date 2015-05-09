<?php
// Initialisation des arguments
$langue="fr";
$tts = "Test Micro, 1 2, 1 2, OK";
if (isset($_GET['lang'])) {
		$langue = $_GET['lang'];
}
if (isset($_GET['tts'])) {
		$tts = $_GET['tts'];
}
// Cr�ation d�un nom de fichier mp3 unique cod� correspondant � la phrase
$dossier = "audio/".$langue;
$phrase = urlencode($tts);
$fichier = md5($tts);
if (!file_exists($dossier))
	mkdir($dossier, 0755, true);
$fichier = $dossier."/TTS-".$fichier.".mp3";
//  Si ce fichier mp3 n�existe pas d�j� alors il est cr��
//  via l�outil de traduction de la phrase donn�e par google.
//  Google limitant les traductions � 100 caract�res, une phrase trop
//  longue est d�coup�e en plusieurs phrases traduites successivement.
if (!file_exists($fichier)){
	$i = 0;
	while (strlen($phrase) > 100)
	{
		$string_cut = substr($phrase, 0, 100);
		$last_space = strrpos($string_cut, "+");
		$strings[$i] = substr($phrase, 0, $last_space);
		$phrase = substr($phrase, $last_space, strlen($phrase));
		$i++;
	}
	$strings[$i] = $phrase;
	$phrase = $strings;
	$mp3 = "";
	for ($i = 0; $i < count($phrase); $i++)
		$mp3[$i] = file_get_contents('http://translate.google.com/translate_tts?q='.$phrase[$i].'&tl='.$langue);
	file_put_contents($fichier, $mp3);
}
// Lecture du fichier, existant ou nouvellement cr�e, par le lecteur audio mpg321
$execution = 'mpg321 '.$fichier;
exec($execution);
?>