<?php

$nb_fichier = 0;

echo '<ul>';

if($dossier = opendir('./sys_version/'))
{
	while($fichier = readdir($dossier))
	{
		if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
		{
				$nb_fichier++;
				echo '<li><a href="./mondossier/' . $fichier . '">' . $fichier . '</a></li>';
		}
	}
	echo '</ul><br />';
	echo 'Il y a <strong>' . $nb_fichier .'</strong> fichier(s) dans le dossier'; 
	closedir($dossier);
}
else
{
	 echo 'Le dossier n\' a pas pu être ouvert correctement';
}	
    

?>

<p><h2><a href='http://php.net/manual/fr/ref.filesystem.php'>Lien vers la liste des fonctions sur les fichiers</a></h2></p>