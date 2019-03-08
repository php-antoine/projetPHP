<?php

$dbname='mabase.db';
if(!class_exists('SQLite3'))
    die("SQLite 3 NOT supported.");
$flags = SQLITE3_OPEN_READWRITE;

$base=new SQLite3($dbname, $flags);

$mytable ="abonnés";

$query = "CREATE TABLE 
IF NOT EXISTS 
$mytable(
            
            ID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            nomdecompte INTEGER,
            mdp varchar(100),
            email varchar(100)
            )";

$result = $base->exec($query);

function verifmdp ($mdp ) {
    $num = false;
    $maj = false;
    $min = false;
    if ( strlen($mdp) < 8 ) {
        return false;
    }
    for ( $i = 0 ; $i < strlen($mdp) ; $i++) {
        if (ctype_upper($mdp[$i])) {
            $maj = true;

        }
        if (ctype_lower($mdp[$i])) {
            $min = true;

        }
        if ( is_numeric($mdp[$i])) {
            $num = true;
        }

    }
    return $maj && $min && $num;


}



if ( isset($_POST['creer'])) {
    $creation = true;
    if (verifmdp($_POST['mdp']) == false) {
        echo "<script>alert(\" erreur pour le format du mot de passe \")</script>";
        $creation = false;
    }
    if ($_POST['mdp'] != $_POST['confirmmdp']) {
        echo "<script>alert(\"le mot de passe et sa confirmation doivent etre identiques \")</script>";
        $creation = false;

    }
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
        $creation = false;
        echo 'Cet email a un format non adapté.';
    }

    $query = "SELECT nomdecompte,email  FROM $mytable";
    $res = $base->query($query);
    while($row = $res->fetchArray()) {
        if ( $row['nomdecompte'] == $_POST['ndc'] || $row['email'] == $_POST['email']) {
            $creation = false;
            echo " nom de compte ou email deja utilisé";
        }
    }
    if ( $creation == true ) {
        $ndc = $_POST['ndc'];
        $mdp = $_POST['mdp'];
        $email = $_POST['email'];
        $query = "INSERT INTO $mytable(ID,nomdecompte,mdp,email) VALUES (NULL,'$ndc','$mdp','$email')";
        $result = $base->exec($query);
        echo "compte créé";

    }


    }
?>


<html
<head>
    <script type="text/javascript" src="creationcompte.js"></script>
</head>
<body>

<form method="post" action="creationcompte.php" name="creation">
    <label for="ndc"> Nom de compte</label>
    <input type="text" name="ndc" /></br>
    <label for="mdp">Mot de passe </label>
    <input type="password" name="mdp" onmouseover="afficher()"  id="mdp" /></br>
    <label for="confirmmdp">Confirmation  </label>
    <input type="password" name="confirmmdp"></br>
    <label for="email" > Adresse email</label>
    <input type="text" name="email"/></br>
    <input type="submit" name="creer" value="creer le compte"/>


</form>
</body>

</html>