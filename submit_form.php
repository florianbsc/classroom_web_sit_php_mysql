<input type="text" name="nom" value="Mateo21" />

<?php

// Après soumission du formulaire
echo $_GET['nom']; // "Mateo21"

// OU

echo $_POST['nom']; // "Mateo21"