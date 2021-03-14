
<main id="mainInscription">
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
        <?php } else {
        ?>
            <li><a id="connexion" href="/user/login">Déja inscrit ?</a></li>
            <li><a id="connexion" href="/documentation">Documentation</a></li>
        <?php }    
        ?>
        </ul>
</nav>
    <section id="InscriptionSection">
        <section id="InscriptionForm">
            <form id="contentForm" action="" onsubmit="return CheckPassWords();" method="post" enctype="multipart/form-data">
            <h1>Inscription</h1>
                <label><b>Name</b></label>
                <input type="text" placeholder="Entrer Nom" name="name" required>

                <label><b>FirstName</b></label>
                <input type="text" placeholder="Entrer Prenom" name="firstname" required>

                <label><b>Email</b></label>
                <input type="email" placeholder="Entrer Email" name="email" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Entrer Mot de Passe" id="pwd1" name="pwd1" required>

                <label><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirmer Mot de Passe" id="pwd2" name="pwd2" required>
                <p id="message" style="color: red; display: none;"></p>
                <button class="animate action-button blue" type="submit">Submit</button>
            </form>
        </section>
    </section>
</main>

<script>
    function CheckPassWords() {
        let pwd1 = document.getElementById('pwd1').value;
        let pwd2 = document.getElementById('pwd2').value;
        let message = document.getElementById('message');
        const regex = /^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/g;
        if (pwd1 !== pwd2) {
            message.innerHTML = "Les mots de passe doivent être identiques";
            message.style.display = "block";
            return false;
        } 
        if (!pwd1.match(regex)) {
            message.innerHTML = "Le mot de passe doit contenir entre 6 et 16 caractères ainsi qu'au minimum 1 lettre majuscule, 1 lettre minuscule et 1 nombre";
            message.style.display = "block";
            return false;
        }
        return true;
    }
</script>