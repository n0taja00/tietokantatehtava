<?php 

require_once('utilities.php');
// Hakukriteerit
$html = "<h2>Tietokantatehtävä Jaako Taskila</h2>";
$html .= '<form action="GET">';
// Year-pudotusvalikko
$html .= createYearDropDown();
// Genre-pudotusvalikko
$html .= createGenreDropDown();
// loopataan läpi tiedostot data-hakemistosta
$path = 'data';
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ('.' === $file) continue;
        if ('..' === $file) continue;

        $html .= '<div><input type="submit" value="' . basename($file, ".php") . '" formaction="' . $path . "/" . $file . '"></div>';
    }
    closedir($handle);
}
$html .= '</form>';
// luo painikkeen, joka lähettää lomakkeen käsiteltävänä olevalle tiedostolle
echo $html;
?>