<?php

  //afficher phpinfo
  if (isset($_GET['phpinfo'])) {
      phpinfo();
      exit();
  }
  // Définition de la langue et des textes
  if (isset ($_GET['lang'])) {
      $langue = $_GET['lang'];
  }

  elseif (preg_match("/^fr/", $_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      $langue = 'fr';
  } else {
      $langue = 'en';
  }

  $langues = array(
      'en' => array(
          'langue' => 'English',
          'autre_langue' => 'version française',
          'autre_langue_lien' => 'fr',
          'titre_html' => 'WAMP5 Homepage',
          'titre_conf' => 'Server Configuration',
          'versa' => 'Apache version :',
          'versp' => 'PHP version :',
          'versm' => 'MySQL version :',
          'php_ext' => 'Loaded extensions : ',
          'titre_page' => 'Tools',
          'mysqlerror1' => 'MySQL not launched or bad phpmyadmin config',
          'mysqlerror2' => 'phpmyadmin connection not available',
          'txt_projet' => 'Your projects',
          'txt_no_projet' => 'No project yet.<br />To create a new one, just create a directory in \'www\'.',
          'txt_alias' => 'Your aliases',
          'txt_no_alias' => 'No Alias yet.<br />To create a new one, use the WAMP5 menu.',
          'faq' => 'http://www.gooogle.fr',
      ),
      'fr' => array(
          'langue' => 'Français',
          'autre_langue' => 'english version',
          'autre_langue_lien' => 'en',
          'titre_html' => 'Accueil WAMP5',
          'titre_conf' => 'Configuration Serveur',
          'versa' => 'Version de Apache:',
          'versp' => 'Version de PHP:',
          'versm' => 'Version de MySQL:',
          'php_ext' => 'Extensions charg�es: ',
          'titre_page' => 'Outils',
          'mysqlerror1' => 'MySQL n\'est pas lanc&eacute; ou votre configuration phpmyadmin n\'est pas bonne.',
          'mysqlerror2' => 'connexion de phpmyadmin non disponible',
          'txt_projet' => 'Vos projets',
          'txt_no_projet' => 'Aucun projet.<br /> Pour en ajouter un nouveau, cr&eacute;ez simplement un r&eacute;pertoire dans \'www\'.',
          'txt_alias' => 'Vos alias',
          'txt_no_alias' => 'Aucun alias.<br /> Pour en ajouter un nouveau, utilisez le menu de WAMP5.',
          'faq' => 'http://www.wampserver.com/faq.php'
      ),
      'all' => array(
          'version' => '5.4.1',
          'phpmyadmin' => 'PHPmyadmin 2.11.0',
          'sqlitemanager' => 'SQLitemanager 5.2.0'
      )
  );


  // Version d'apache.
  $apache_version = explode('PHP', apache_get_version());


  // Version de MySQL.
  $pma_conf_file = 'c:/wamp/phpmyadmin/'.'config.inc.php';
  if (file_exists($pma_conf_file)) {
      include ($pma_conf_file);
      if (extension_loaded('mysql'))
      {
          if ($link = @mysql_connect('localhost',$cfg['Servers']['1']['user'] ,$cfg['Servers']['1']['password']))
            $mysql_version =  mysql_get_server_info();
          else
            $mysql_version = $langues[$langue]['mysqlerror1'];
      }
      if (extension_loaded('mysqli'))
      {
          if ($link = @mysqli_connect('localhost',$cfg['Servers']['1']['user'] ,$cfg['Servers']['1']['password']))
            $mysql_version =  mysqli_get_server_info($link);
          else
            $mysql_version = $langues[$langue]['mysqlerror1'];
      }
  } else {
    $mysql_version = $langues[$langue]['mysqlerror2'];
  } 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Localhost">

    <title>SERVER Localhost</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script src="assets/js/chart-master/Chart.js"></script>
  </head>

  <body>
    <section id="container">
      <header class="header black-bg">
        <div class="sidebar-toggle-box">
          <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <a href="index.php" class="logo"><b>Localhost</b></a>
      </header>
      <aside>
        <div id="sidebar" class="nav-collapse">
          <ul class="sidebar-menu" id="nav-accordion">
           <p class="centered">
            <a href="profile.php">
              <img src="assets/img/logo.png" height="50" width="50" class="img-circle" width="554">
            </a>
          </p>
          <h5 class="centered">Localhost</h5>
          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Tableau de bord</span>
            </a>
          </li>
          <li class="mt">
            <a href="#">
              <i class="fa fa-dashboard"></i>
              <span>Port 80 HTTP</span>
            </a>
          </li>
          <li class="mt">
            <a href="#">
              <i class="fa fa-dashboard"></i>
              <span>Port 443 HTTPS</span>
            </a>
          </li>
          <li class="mt">
            <a href="#">
              <i class="fa fa-dashboard"></i>
              <span>Port 22 SSH</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
           <div class="row mtbox">

              <div class="col-md-3 box0">
                 <div class="box1">
                  <span class="li_stack"></span>
                  <h5>PHP <?php echo phpversion(); ?></h5>
                </div>
              </div>

              <div class="col-md-3 box0">
                <div class="box1">
                  <span class="li_data"></span>
                  <h5><a href="phpmyadmin/" target="_bank"><?php echo $langues['all']['phpmyadmin']; ?></a></h5>
                </div>
              </div>

              <div class="col-md-3 box0">
                <div class="box1">
                  <span class="li_stack"></span>
                  <h5><?php echo $langues[$langue]['versa']; ?></h5>
                </div>
              </div>
            </div>

    <div class="row mt">
      <?php
      $list_ignore = array ('.','..','exemples','phpmyadmin','sqlitemanager');
      $handle=opendir(".");

      $msg = $langues[$langue]['txt_no_projet'];
      $container = [];
      while ($file = readdir($handle)) {
        if (is_dir($file) && !in_array($file,$list_ignore)) {
          $msg = '';
          array_push($container, $file);
        }
      }

      asort($container);
      foreach ($container as $fichier) {
        echo '
        <div class="col-md-4 mb">
          <div class="row">
            <div class="col-md-2">
              <img src="assets/img/server.png" width="40" height="40" alt="">
            </div>
            <div class="col-md-10"><kbd>
              '.ucfirst($fichier).'
            </kbd></div>
          </div>
          <div>
            <a href="'.$fichier.'" class="btn btn-block btn-theme04" style="margin-bottom: 10px;"> <i class="fa fa-folder"></i> Voir la page
            </a>
          </div>
        </div>';
      }
      closedir($handle);
      echo $msg;
      ?>
    </div>
  </div>

  <div class="col-lg-3 ds">
    <h3>NOTIFICATIONS</h3>
    <div class="desc">
     <div id="fb-root"></div>
     <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=895983810530157";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
      <div class="fb-page" data-href="https://www.facebook.com/devsprof" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
      </div>
    </div>
                  <div id="calendar" class="mb">
                    <div class="panel green-panel no-margin">
                      <div class="panel-body">
                        <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                          <div class="arrow"></div>
                          <h3 class="popover-title" style="disadding: none;"></h3>
                          <div id="date-popover-content" class="popover-content"></div>
                        </div>
                        <div id="my-calendar"></div>
                      </div>
                    </div>
                  </div><!-- / calendar -->
                </div><!-- /col-lg-3 -->
              </div>
            </section>
          </section>

          <footer class="site-footer">
            <div class="text-center">
              2017 XamppServer
            </div>
          </footer>
        </section>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/jquery-1.8.3.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="assets/js/jquery.sparkline.js"></script>


        <!--common script for all pages-->
        <script src="assets/js/common-scripts.js"></script>

        <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

        <!--script for this page-->
        <script src="assets/js/sparkline-chart.js"></script>    
        <script src="assets/js/zabuto_calendar.js"></script>	

        <script type="application/javascript">
          $(document).ready(function () {
            $("#date-popover").popover({php: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
              $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
              action: function () {
                return myDateFunction(this.id, false);
              },
              action_nav: function () {
                return myNavFunction(this.id);
              },
              ajax: {
                url: "show_data.php?action=1",
                modal: true
              },
              legend: [
              {type: "text", label: "Special event", badge: "00"},
              {type: "block", label: "Regular event", }
              ]
            });
          });
          
          
          function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
          }
        </script>
      </body>
</html>
