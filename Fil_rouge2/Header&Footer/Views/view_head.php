<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Contenu/assets/css/style-mobile.css" />
        <link rel="stylesheet" href="Contenu/assets/css/style-desktop.css">
        <?php if($action == 'statsAdherents' || $action == 'statsExemplaires') { ?>
        <link rel="stylesheet" href="Contenu\assets\DataTables\media\css\jquery.dataTables.min.css">
        <?php } ?>
        <title>BDthèque des Marmusots par les plus stylées de toute la promo</title>
    </head>
    <body>
        