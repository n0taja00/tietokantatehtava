<?php
    // Muodostetaan tietokantayhteys
    require_once('../database.php'); //linkataan database.php tähän tiedostoon
    $start_year = $_GET['start_year']; // laitetaan start_year parametri muuttujaan
    $conn = createDbConnection(); //kutsuu funktiota database.php tiedostossa joka luo yhteyden
    // SQL-lause joka halutaan ajaa tietokantaan
    $sql = "SELECT primary_title
    FROM titles 
    WHERE start_year LIKE '%" . $start_year . "%' AND title_type ='movie'
    LIMIT 10;";
    // ajetaan kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    // tallennetaan tulos muuttujaan
    $rows = $prepare->fetchAll();
    // otsikon tulostus
    $html = '<h1>Movies from ' . $start_year . '</h1>';
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