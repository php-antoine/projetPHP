<?php

function verifmdp ($mdp ) {
    $lettre = false;
    $maj = false;
    $min = false;
    $taille = false;
    if ( strlen($mdp) < 8 ) {
        return false;
    }
    for ( $i = 0 ; $i < strlen($mdp) ; $i++) {
        if ()
    }


}

if ( isset($_POST['creer'])) {

    if ( $_POST['mdp'] != $_POST['confirmmdp']) {
        echo "<script>alert(\"le mot de passe et sa confirmation doivent etre identiques \")</script>";

    }


}


?>


<form method="post" action="creationcompte.php" name="creation">
    <label for="ndc"> Nom de compte</label>
    <input type="text" name="ndc" /></br>
    <label for="mdp">Mot de passe </label>
    <input type="password" name="mdp" /></br>
    <label for="confirmmdp">Confirmation  </label>
    <input type="password" name="confirmmdp"></br>
    <label for="email" > Adresse email</label>
    <input type="text" name="email"/></br>
    <input type="submit" name="creer" value="creer le compte"/>


</form>
</body>

</html>