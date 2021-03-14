<main id="mainLogin">
<nav>
    <a id="logo" href="/">HoHohot</a>
        <?php
        if(session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            //session has not started
        ?> 
        <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
        <ul class="menu">
            <li><a id="connexion" href="/user/logout">Deconnexion</a></li>
            <li><a id="connexion" href="/documentation">Documentation</a></li>
        <?php }    
        ?>
        </ul>
</nav>
    <section id="loginSection">
   
        <section id="loginForm">
            <form id="contentForm" action="" method="post">
                <h1>Connexion</h1>
                <label><b>Email</b></label>
                <input type="text" placeholder="Enter Email" id="email" name="email" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="pwd" name="pwd" required>

                <button id="login" class="animate action-button blue" type="submit">Login</button>
               
                <label id="ou"><b>Ou</b></label>

                <label id="notinscrit"><b>Pas encore inscrit ?</b></label>
                <a href="/user/inscription" id="inscription" class="animate action-button blue">Je m'inscris</a>
            </form>
        </section>
    </section>
</main>
