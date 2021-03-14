<main id="mainInscription">
    <h1>Inscription</h1>
    <section id="InscriptionSection">
        <section id="InscriptionForm">
            <form id="contentForm" action="" onsubmit="return CheckPassWords();" method="post" enctype="multipart/form-data">
                <label><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" required>

                <label><b>FirstName</b></label>
                <input type="text" placeholder="Enter FirstName" name="firstname" required>

                <label><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="pwd1" name="pwd1" required>

                <label><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" id="pwd2" name="pwd2" required>
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