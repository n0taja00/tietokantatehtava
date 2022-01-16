<?php
    // Muodostetaan tietokantayhteys
    require_once('../database.php'); //linkataan database.php tähän tiedostoon
    $genre = $_GET['genre']; //laitetaan genre parametri muuttujaan
    $conn = createDbConnection(); //kutsuu funktiota database.php tiedostossa joka luo yhteyden
    // SQL-lause joka halutaan ajaa tietokantaan
    $sql = "SELECT primary_title
    FROM titles INNER JOIN title_genres
    ON titles.title_id = title_genres.title_id
    WHERE genre LIKE '%" . $genre . "%'
    LIMIT 10;";
    // ajetaan kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    // tallennetaan tulos muuttujaan
    $rows = $prepare->fetchAll();
    // otsikon tulostus
    $html = '<h1>' . $genre . '</h1>';
    // avataan ul-elementti
    $html .= '<ul>';
    // loopataan tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // jokaiselle haetulle riville oma Li-elementti
        $html .= '<li>' . $row['primary_title'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;

?>