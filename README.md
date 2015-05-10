# eedomus_RaspTTS
Lecture TTS Google sur Raspberry via PHP/mpg321

Script pour Raspberry qui :
- enregistre un fichier mp3 issu de la traduction google (tts), s'il n'a pas déjà été créé
- lit ce fichier mp3 avec mpg321

Pré-requis pour le serveur apache du raspberry :
- donner les droits de lecture audio du user www-data
- donner les droits en écriture sur /var/www à www-data

rasptts.php?lang=fr&tts=Bonjour
rasptts.php?lang=en&tts=Hello

