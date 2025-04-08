<?php
// functie: update klant
// auteur: Thierry

require_once('functions.php');

// Test of er op de wijzig-knop is gedrukt 
if (isset($_POST['btn_wzg'])) {
    // Test of update gelukt is
    if (updateRecord($_POST) == true) {
        echo "<script>alert('Klant is gewijzigd')</script>";
    } else {
        echo '<script>alert("Klant is NIET gewijzigd")</script>';
    }
}

// Test of id is meegegeven in de URL
if (isset($_GET['idklant'])) {  
    // Haal alle info van de betreffende id $_GET['idklant']
    $idklant = $_GET['idklant'];
    $row = getRecord($idklant);

    // Check if a record was found
    if ($row) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig klant</title>
</head>
<body>
  <h2>Wijzig klant</h2>
  <form method="post">
    <input type="hidden" id="idklant" name="idklant" required value="<?php echo $row['idklant']; ?>"><br>
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="adres">Adres:</label>
    <input type="text" id="adres" name="adres" required value="<?php echo $row['adres']; ?>"><br>

    <label for="postcode">Postcode:</label>
    <input type="number" id="postcode" name="postcode" required value="<?php echo $row['postcode']; ?>"><br>

    <label for="plaats">Plaats:</label>
    <input type="text" id="plaats" name="plaats" required value="<?php echo $row['plaats']; ?>"><br>

    <label for="telefoon">Telefoon:</label>
    <input type="number" id="telefoon" name="telefoon" required value="<?php echo $row['telefoon']; ?>"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required value="<?php echo $row['email']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>

<?php
    } else {
        echo "Geen record gevonden voor de opgegeven ID.<br>";
    }
} else {
    echo "Geen ID opgegeven.<br>";
}
?>