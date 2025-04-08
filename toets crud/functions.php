<?php
// auteur: Thierry
// functie: algemene functies tbv hergebruik

include_once "config.php";

function connectDb() {
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function crudMain() {
    // Menu-item insert
    $txt = "
    <h1>Crud klanten reizen</h1>
    <nav>
        <a href='insert.php'>Nieuwe klant toevoegen </a>
    </nav><br>";
    echo $txt;

    // Haal alle klanten record uit de tabel 
    $result = getData(CRUD_TABLE);

    // Print table
    printCrudTabel($result);
}

// Selecteer de data uit de opgegeven table
function getData($table) {
    // Connect database
    $conn = connectDb();

    // Select data uit de opgegeven table methode prepare
    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

// Selecteer de rij van de opgegeven id uit de table
function getRecord($id) {
    // Connect database
    $conn = connectDb();

    // Select data uit de opgegeven table methode prepare
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE idklant = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id' => $id]);
    $result = $query->fetch();

    return $result;
}

// Function 'printCrudTabel' print een HTML-table met data uit $result 
// en een wijzig- en verwijder-knop.
function printCrudTabel($result) {
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table>";

    // Print header table
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach ($headers as $header) {
        $table .= "<th>" . $header . "</th>";   
    }
    // Voeg actie kopregel toe
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</tr>";

    // Print elke rij
    foreach ($result as $row) {
        $table .= "<tr>";
        // Print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }

        // Wijzig knopje
        $table .= "<td>
            <form method='post' action='update.php?idklant=$row[idklant]' >       
                <button>Wzg</button>	 
            </form></td>";

        // Delete knopje
        $table .= "<td>
            <form method='post' action='delete.php?idklant=$row[idklant]' >       
                <button>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table .= "</table>";

    echo $table;
}

function updateRecord($row) {
    // Maak database connectie
    $conn = connectDb();

    // Maak een query 
    $sql = "UPDATE " . CRUD_TABLE . "
    SET 
        naam = :naam, 
        adres = :adres,
        postcode = :postcode,
        plaats = :plaats,
        telefoon = :telefoon,
        email = :email
    WHERE idklant = :idklant"; // Added the primary key condition

    // Prepare query
    $stmt = $conn->prepare($sql);
    
    // Uitvoeren
    $stmt->execute([
        ':idklant' => $row['idklant'],
        ':naam' => $row['naam'],
        ':adres' => $row['adres'],
        ':postcode' => $row['postcode'],
        ':plaats' => $row['plaats'],
        ':telefoon' => $row['telefoon'],
        ':email' => $row['email']
    ]);

    // Test of database actie is gelukt
    return $stmt->rowCount() == 1;
}

function insertRecord($post) {
    // Maak database connectie
    $conn = connectDb();

    // Maak een query 
    $sql = "
        INSERT INTO " . CRUD_TABLE . " (idklant, naam, adres, postcode, plaats, telefoon, email)
        VALUES (:idklant, :naam, :adres, :postcode, :plaats, :telefoon, :email)
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    
    // Uitvoeren
    $stmt->execute([
        ':idklant' => $post['idklant'],
        ':naam' => $post['naam'],
        ':adres' => $post['adres'],
        ':postcode' => $post['postcode'],
        ':plaats' => $post['plaats'],
        ':telefoon' => $post['telefoon'],
        ':email' => $post['email']
    ]);

    // Test of database actie is gelukt
    return $stmt->rowCount() == 1;  
}

function deleteRecord($id) {
    // Connect database
    $conn = connectDb();
    
    // Maak een query 
    $sql = "
    DELETE FROM " . CRUD_TABLE . " 
    WHERE idklant = :id"; // Assuming 'idklant' is the primary key

    // Prepare query
    $stmt = $conn->prepare($sql);

    // Uitvoeren
    $stmt->execute([
        ':id' => $id // Use the passed $id parameter
    ]);

    // Test of database actie is gelukt
    return $stmt->rowCount() == 1;
}
?>