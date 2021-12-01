
<?php if($action == 'statsAdherents' || $action == 'statsExemplaires') { ?>
    <script src='Contenu\assets\DataTables\media\js\jquery.js'></script>
    <script src="Contenu\assets\DataTables\media\js\jquery.dataTables.min.js"></script>
    <script src="Contenu\assets\script\script_stats.js"></script>
<?php } else if ($action == 'addAdherent' || $action == 'addEmploye') { ?>
    <script src='Contenu\assets\script\creer_adherent.js'></script>
<?php } else if ($action == 'modifyAdherent' || $action = 'modifyEmploye') { ?>
        <script src='Contenu\assets\script\modifier_adherent.js'></script>
<?php } else if ($action == 'searchAdherent' || $action == 'searchEmploye') { ?>
    <script src='Contenu\assets\script\recherche_adherent.js'></script>
<?php } ?>
    </body>
</html>