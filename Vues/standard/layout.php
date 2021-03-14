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
        <?php } else {
        ?>
            <li><a id="connexion" href="/user/login">Connexion</a></li>
        <?php }    
        ?>
        </ul>
</nav>
