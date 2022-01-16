<?php
    // Muodostetaan tietokantayhteys
    require_once('../database.php'); //linkataan database.php tähän tiedostoon
    $conn = createDbConnection(); //kutsuu funktiota database.php tiedostossa joka luo yhteyden
    $sql = "CALL NamesWithB()"; //kutsutaan proseduuria

    /*  Proseduurin luontilause

    DELIMITER //

    CREATE PROCEDURE NamesWithB()
    BEGIN
        SELECT name_
        FROM names_
        WHERE name_ LIKE "B%"
        LIMIT 10;
    END//
    
    DELIMITER ; */

    // ajetaan kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    // tallennetaan tulos muuttujaan
    $rows = $prepare->fetchAll(); 
    // otsikon tulostus
    $html = "<h1>Names starting with the letter B</h1>";
    // avataan ul-elementti
    $html .= '<ul>';
    // loopataan tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // jokaiselle haetulle riville oma Li-elementti
        $html .= '<li>' . $row['name_'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;

?>