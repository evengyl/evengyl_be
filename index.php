<?php
      session_start();
##########################################
# Createur : Evengyl
# Date de creation : 29-09-2014
# Version : 1.10
# Date de modif : 19-10-2014
# Comment lucie page remboursement and Depenses 
##########################################
?>
<!DOCTYPE html>

<html lang="fr">
  <?php  
  
  $version = 'v22';

  require_once($version.'/controleur/load_class.php');  
  $_db_connect->set_version($version);
  include($version.'/vue/templates/head.php');
  ?>
  <body>

<div class="row" style="background:#d7d8d7; border-bottom:1px solid #c6c7c6;">    
<?php    
    // strat nav
		require_once($version.'/vue/templates/nav.php');
    //end nav
    //start sldier
    //require_once($version.'/vue/templates/slider.php');
    // end slider
?>
    <!-- sub-title-->
    <div class="col-lg-12">
      <h2 style="text-align:center;" class="subtitle  without-margin margin-five">Get's the real approuved source code</h2>       
    </div>
    <!-- end subtitle -->
</div>
    <!-- // start all content -->
      <!-- // Start Ariane -->
    <div class="row col-lg-12" style=" background:white;height:40px; padding-left:100px; padding-right:150px; border-bottom:solid black 1px; border-top:solid black 1px;">
      <p style='line-height:29px; font-family:"bebas"; font-size:20px;'><a href="/">Home</a> > <?php echo(isset($_GET['nav']))?$_GET['nav']:''; ?></p>
    </div>
      <!-- End Of ariane -->



		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    		<?php require_once($version.'/vue/templates/content.php');?>
			</div>
		</div>
    <!-- // end all content  -->
    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin:10px 10px 0 0;">
<?php
    // start all content
    require_once($version.'/vue/templates/footer.php');
    // end all content 
?>
    </div>
 </body>
</html>

