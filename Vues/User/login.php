<main id="mainLogin">
    <h1>Connexion</h1>
    <section id="loginSection">
   
        <section id="loginForm">
            <form id="contentForm" action="" method="post">
                <label for="uname"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button id="login" class="animate action-button blue" type="submit">Login</button>
                <label>
                    <input id="remember" type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <label id="ou"><b>Ou</b></label>

                <label><b>Pas encore inscrit ?</b></label>
                <a href="/inscription" id="inscription" class="animate action-button blue" type="submit">Je m'inscris</a>
            </form>
        </section>
    </section>
</main>
