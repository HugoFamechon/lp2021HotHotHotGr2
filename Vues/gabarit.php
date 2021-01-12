<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>TP1 FAMECHON</title>
        <link rel="stylesheet" href="./Vues/Styles/Style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php Vue::montrer('standard/entete'); ?>
        <section>
            <?php echo $A_vue['body'] ?>
            <?php Vue::montrer('standard/pied'); ?>
        </section>
    </body>
</html>