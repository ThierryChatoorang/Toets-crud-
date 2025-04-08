<?php
// auteur: thierry
// functie: verwijder een klant op basis van de id
include 'functions.php';

// Haal klant uit de database
if (isset($_GET['idklant'])) {
    $idklant = $_GET['idklant'];
    
    // Test of de delete actie gelukt is
    if (deleteRecord($idklant)) {
        echo '<script>alert("Klant met ID: ' . htmlspecialchars($idklant) . ' is verwijderd.")</script>';
        echo "<script>location.replace('index.php');</script>";
    } else {
        echo '<script>alert("Klant is NIET verwijderd.")</script>';
    }
}
?>

