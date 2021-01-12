<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project HotHotHot</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="../Assets/css/notie.min.css">
        <link rel="stylesheet" href="../Assets/css/style.css">
        <link rel="stylesheet" href="../Assets/fonts/stylesheet.css">
    </head>
    <body class="container-fluid">
        <?php Vue::montrer('standard/layout'); ?>
        <section>
            <?php echo $A_vue['body'] ?>
        </section>
        <?php Vue::montrer('standard/pied'); ?>
        <!-- Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="../Assets/lib/notie.min.js"></script>
        <script src="../Assets/js/script.js"></script>
    </body>
</html>