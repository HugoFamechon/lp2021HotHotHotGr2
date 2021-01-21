<?php Vue::montrer('standard/layout'); ?>

<main id="mainLogin">
    <section id="loginSection">
        <section id="loginForm">
            <section id="contentForm">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button class="animate action-button blue" type="submit">Login</button>
                <label>
                    <input id="remember" type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </section>
        </section>
    </section>
</main>
