<?php 
  // Funktio joka luo genre-pudotusvalikon
  function createGenreDropDown() {
    // Muodostetaan tietokantayhteys
    require_once('database.php'); //linkataan database.php tähän tiedostoon
    $conn = createDbConnection(); //kutsuu funktiota database.php tiedostossa joka luo yhteyden
    // SQL-lause joka halutaan ajaa tietokantaan
    $sql = 'SELECT DISTINCT genre FROM title_genres;';
    // ajetaan kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    // tallennetaan tulos muuttujaan
    $rows = $prepare->fetchAll();
    $html = '<select name="genre">';
    // loopataan tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // jokaiselle haetulle riville oma Li-elementti
        $html .= '<option>' . $row['genre'] . '</option>';
    }
    $html .= '</select>';
    return $html;
}

// Funktio joka luo year-pudotusvalikon
function createYearDropDown() {
    // Muodostetaan tietokantayhteys
    require_once('database.php'); //linkataan database.php tähän tiedostoon
    $conn = createDbConnection(); //kutsuu funktiota database.php tiedostossa joka luo yhteyden
    // SQL-lause joka halutaan ajaa tietokantaan
    $sql = "SELECT DISTINCT start_year FROM titles ORDER BY start_year DESC LIMIT 40;";
    // ajetaan kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    // tallennetaan tulos muuttujaan
    $rows = $prepare->fetchAll();
    $html = '<select name="start_year">';
    // loopataan tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // jokaiselle haetulle riville oma Li-elementti
        $html .= '<option>' . $row['start_year'] . '</option>';
    }
    $html .= '</select>';
    return $html;
}

?>