<main id="mainLogin">
    <h1>Connexion</h1>
    <section id="loginSection">
   
        <section id="loginForm">
            <form id="contentForm" action="" method="post">
                <label><b>Email</b></label>
                <input type="text" placeholder="Enter Email" id="email" name="email" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="pwd" name="pwd" required>

                <button id="login" class="animate action-button blue" type="submit">Login</button>
                <label>
                    <input id="remember" type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <label id="ou"><b>Ou</b></label>

                <label><b>Pas encore inscrit ?</b></label>
                <a href="/user/inscription" id="inscription" class="animate action-button blue">Je m'inscris</a>
            </form>
        </section>
    </section>
</main>
