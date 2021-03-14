<!-- <ul class="navDoc">
  <li><a href="/documentation/framework/ChargementAuto">Chargement Auto</a></li>
  <li><a href="/documentation/framework/Constantes">Constantes</a></li>
  <li><a href="/documentation/framework/Controleur">Controleur</a></li>
  <li><a href="/documentation/framework/Vue">Vue</a></li>
</ul> -->
<nav>
    <a id="logo" href="/">HoHohot</a>
        <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
        <ul class="menu">
        <?php
        if(session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            //session has not started
        ?> 
            <li><a id="connexion" href="/user/logout">Deconnexion</a></li>
            <li><a id="connexion" href="/documentation">Documentation</a></li>
            <li><a id="connexion" href="/sensor">Sensor</a></li>
        <?php } else {
        ?>
            <li><a id="connexion" href="/user/login">Connexion</a></li>
            <li><a id="connexion" href="/documentation">Documentation</a></li>
        <?php }    
        ?>
        </ul>
</nav>
<div id="docHeader">
    <h1 id="titleDoc">Documentation</h1>
</div>
<div class="tabs-doc">
    <div class="tab-header">
        <div class="active">
            <i class="fa fa-code"></i> Chargement Auto
        </div>
        <div>
            <i class="fa fa-pencil-square"></i> Constantes
        </div>
        <div>
            <i class="fa fa-bar-chart"></i> Controleur
        </div>
        <div>
            <i class="fa fa-envelope"></i> Vue
        </div>
    </div>
    <div class="tab-indicator"></div>
    <div class="tab-content">

        <div class="active">
            <h2>ChargementAuto.php</h2>
            <p>On se trouve dans la classe ChargementAuto</p>
            <img src="../../../Assets/img/charger.PNG">
            <p>Vérifie si le fichier est accessible et existe en lecture. Si la vérification retourne true alors, on
                inclut le contenu du fichier</p>
        </div>
        <div>
            <h2>Constantes.php</h2>
            <p>On se trouve dans la classe Constantes</p>
            <img class="w-50" src="../../../Assets/img/constantes_Chemins.PNG">
            <p>On crée des constantes de nos différents chemins</p>
            <img src="../../../Assets/img/contante_racine.png">
            <p>Permet de nous placer à la racine de notre application</p>
            <img src="../../../Assets/img/contante_noyau.png">
            <p>Permet de nous placer dans le dossier Noyau de notre application</p>
            <img src="../../../Assets/img/contante_vue.png">
            <p>Permet de nous placer dans le dossier Vues de notre application</p>
            <img src="../../../Assets/img/contante_Modele.png">
            <p>Permet de nous placer dans le dossier Modele de notre application</p>
            <img src="../../../Assets/img/contante_controleur.png">
            <p>Permet de nous placer dans le dossier Controleur de notre application</p>
            <img src="../../../Assets/img/contante_exception.png">
            <p>Permet de nous placer dans le dossier Exeptions de notre application</p>
        </div>

        <div>
            <h2>Controleur</h2>
            <p>Le controleur traite les interactions de l'utilisateur, et modifie les données du modèle et de la vue</p>

            <p>Les tableaux contiennent différentes pièces de l'URL.</p>
            <h2>/test/hello/reste</h2>
            <p>$_A_urlDecortique['controleur'] est égale à "ControleurTest"</p>
            <p>$_A_urlDecortique['action'] est égale à "helloAction"</p>
            <img src="" alt="image controleur">

            <p>On élimine d'abord l'éventuel slash en fin d'URL afin d'éviter que notre explode renvoye une dernière
                entrée vide
                Ensute on éclate l'URL qui va prender place dans un tableau</p>

            <p>Si le paramètre est vide, on va sur le controleur par défaut "ControleurHome"
                Tous les contrôleurs sont préfixés par "Controleur"</p>

            <p>Si l'action est video, on éxecute celle par défaut.
                Toutes les actions sont suffixés par "Action".</p>
        </div>
        <div>
            <h2>Vue</h2>
            <p>Tout d'abord, on initialise le tampon</p>

            <p>Permet de retourner le contenu du tampon</p>

            <p>Localise la vue .php à afficher<br>On initialise un sous-tampon</p>
        </div>

    </div>
</div>


<!-- JQuery -->
<?php Vue::montrer('standard/script'); ?>
<?php Vue::montrer('Documentation/script'); ?>

