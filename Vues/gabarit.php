<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project HotHotHot</title>
        <link rel="stylesheet" href="../Assets/css/bootstrap.css">
        <link rel="stylesheet" href="../Assets/css/notie.min.css">
        <link rel="stylesheet" href="../Assets/css/style.css">
        <link rel="stylesheet" href="../Assets/fonts/stylesheet.css">
    </head>
    <body class="container-fluid">
        <?php Vue::montrer('standard/layout'); ?>
        <section>
            <?php echo $A_vue['body'] ?>
            <?php Vue::montrer('standard/pied'); ?>
        </section>
        <!-- Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="lib/notie.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>