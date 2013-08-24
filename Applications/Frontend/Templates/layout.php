<!DOCTYPE html>
<html>
    <head>
        <title>
        <?php if(!isset($title)){ ?>
            Mon super site MVC
        <?php }else{ echo $title; }?>           
        </title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="/css/Envision.css"/>
    </head>
    <body>
        <div id="wrap">
            <div id="header">
                <h1 id="logo-text"><a href="/">Mon super site</a></h1>
                <p id="slogan">Comment ça "il n'y a presque rien??"</p>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <?php if($user->isAuthenticated()){ ?>
                    <li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>">Admin</a></li>
                    <li><a href="/admin/news-insert.html">Ajouter une news</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div id="content_wrap">
                <div id="main">
                    <?php if($user->hasFlash()){ echo '<p style="text-align: center;">' . $user->getFlash() . '</p>';} ?>
                    <?php echo $content; ?>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>