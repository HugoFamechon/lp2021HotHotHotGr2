<main id="docControleur">
    <h1>Controleur</h1>
    <p>Le controleur traite les interactions de l'utilisateur, et modifie les données du modèle et de la vue</p>

    <p>Les tableaux contiennent différentes pièces de l'URL.</p>
    <h2>/test/hello/reste</h2>
    <p>$_A_urlDecortique['controleur'] est égale à "ControleurTest"</p>
    <p>$_A_urlDecortique['action'] est égale à "helloAction"</p>
    <img src="" alt="image controleur">

    <p>On élimine d'abord l'éventuel slash en fin d'URL afin d'éviter que notre explode renvoye une dernière entrée vide
        Ensute on éclate l'URL qui va prender place dans un tableau</p>

    <p>Si le paramètre est vide, on va sur le controleur par défaut "ControleurHome"
        Tous les contrôleurs sont préfixés par "Controleur"</p>

    <p>Si l'action est video, on éxecute celle par défaut.
        Toutes les actions sont suffixés par "Action".</p>


</main>