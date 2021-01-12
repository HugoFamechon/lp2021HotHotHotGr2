<h1>Voici les groups qui ont été générer : </h1>
<div id="groups">
    <table>
    <?php
    $i = 1;
    foreach ($A_vue['groups'] as $Group) {
        echo '<tr>';
        echo '<th>'.'Groupe '. $i .'</th>';
        foreach ($Group as $Student){
            echo "<td>" . $Student->prenom . '.' . substr($Student->nom, 0, 1)  . "</td>";
        }
        echo '</tr>';
        $i++;
    }
    ?>
    </table>
</div>