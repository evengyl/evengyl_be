<div  class="head_sub_title">
  <div><span style='color:#417F85;'>Le Site de Gets_code</span> n'est encore qu'en version pré alpha , si vous avez des suggestions <span style='color:#417F85;'>contacter moi</span></div>
  <hr style='width:60%; border-color:#c6c7c6; margin-top:5px; margin-bottom:5px;'>
</div>

<div class="row">
  <div class="col-lg-offset-2 col-lg-8" style="margin-top:5px; padding-right:0px;">
    <img style='position:absolute; left:-150px; top:-25px;' src='<?php echo $version; ?>/vue/images/logo.png'>
    <nav class="navbar navbar-default without-margin" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="?">Home</a></li>
                  <?php
                  
                  if(isset($_SESSION))
                  {
                    if(isset($_SESSION['level_user']))
                    {
                      if($_SESSION['level_user'] == 3)
                      {

                          if($_SESSION['login'] == 'evengyl')
                            {?>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Matedex Adwords<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="?nav=rapport_adwords">Rapports d'annonces</a></li>
                                  <li class="divider"></li>
                                  <li><a href="?nav=ajout_adwords">Ajouter un rapport</a></li>
                                </ul>
                              </li>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Matedex Liste Campagnes<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="?nav=rapport_adwords">Rapports de Campagnes</a></li>
                                </ul>
                              </li>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Finance<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="?nav=ajout_depense">Dépenses</a></li>
                                  <li class="divider"></li>
                                  <li><a href="?nav=finances">Totale des soldes</a></li>
                                  <li class="divider"></li>
                                  <li><a href="#">Dépots argents</a></li>
                                  <li class="divider"></li>
                                </ul>
                              </li>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lire Ticket<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="?nav=aff_php">PHP</a></li>
                                  <li class="divider"></li>
                                  <li><a href="?nav=aff_js">JS</a></li>
                                  <li class="divider"></li>
                                  <li><a href="?nav=aff_python">PYTHON</a></li>
                                  <li class="divider"></li>
                                </ul>
                              </li>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ajout Ticket<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="?nav=ajouter_php">Ajout PHP</a></li>
                                  <li class="divider"></li>
                                  <li><a href="?nav=ajouter_js">Ajout JS</a></li>
                                  <li class="divider"></li>
                                  <li><a href="?nav=ajouter_python">Ajout PYTHON</a></li>
                                  <li class="divider"></li>
                                </ul>
                              </li>                              
                              <li><a href="?nav=intranet">Intranet</a></li>
                              <li><a href="?nav=manage_bsd">Manager BSD</a></li><?php
                            }
                      }
                      if($_SESSION['level_user'] == 2)
                      {
                      ?>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Matedex Adwords<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="?nav=rapport_adwords">Rapports d'annonces</a></li>
                            </ul>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lire Ticket<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="?nav=aff_php">PHP</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=aff_js">JS</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=aff_python">PYTHON</a></li>
                              <li class="divider"></li>
                            </ul>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ajout Ticket<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="?nav=ajouter_php">Ajout PHP</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=ajouter_js">Ajout JS</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=ajouter_python">Ajout PYTHON</a></li>
                              <li class="divider"></li>
                            </ul>
                          </li>
                          <?php
                      }
                      if($_SESSION['level_user'] == 1)
                      {
                      ?>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lire Ticket<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="?nav=aff_php">PHP</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=aff_js">JS</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=aff_python">PYTHON</a></li>
                              <li class="divider"></li>
                            </ul>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ajout Ticket<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="?nav=ajouter_php">Ajout PHP</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=ajouter_js">Ajout JS</a></li>
                              <li class="divider"></li>
                              <li><a href="?nav=ajouter_python">Ajout PYTHON</a></li>
                              <li class="divider"></li>
                            </ul>
                          </li>
                          
                          <?php
                      }
                    }
                  }
                  if(isset($_SESSION['login']))
                  {
                    ?><li><a href="?nav=disconnect">Deconnexion</a></li><?php
                  }
                  else
                  {
                    ?><li><a href="?nav=connect">Connexion</a></li><?php
                  }
                  ?> 

              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
          <div class="bar-bellow-nav"></div>
      </nav>
      </div>
</div>
