<?php
    // functie: formulier en database insert klant
    // auteur: thierry

    echo "<h1>Insert klanten</h1>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertRecord($_POST) == true){
            echo "<script>alert('klant is toegevoegd')</script>";
        } else {
            echo '<script>alert("klanrt is verwijderd is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="idklant">idklant:</label>
        <input type="text" id="idklant" name="idklant" required><br>

        <label for="naam">naam:</label>
        <input type="text" id="naam" name="naam" required><br>

        <label for="adres">adres:</label>
        <input type="text" id="adres" name="adres" required><br>

        <label for="postcode">postcode:</label>
        <input type="number" id="postcode" name="postcode" required><br>

        <label for="plaats">plaats:</label>
        <input type="text" id="plaats" name="plaats" required><br>

        <label for="telefoon">telefoon:</label>
        <input type="number" id="telefoon" name="telefoon" required><br>

        <label for="email">email:</label>
        <input type="text" id="email" name="email" required><br>

        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='index.php'>Home</a>
    </body>
</html>
