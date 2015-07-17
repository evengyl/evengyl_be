<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 without-padding" style='border-right:1px solid grey;'>
    <nav class="navbar navbar-default " role="navigation">
        <div class="collapse navbar-collapse intranet_nav" style="margin-top:15px;" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a href="?nav=intranet&nav_intra=eval">EVAL</a></li>
                <li class="divider"></li>
                <li><a href="?nav=intranet&nav_intra=php_infos">PHP - Infos</a></li>
                <li class="divider"></li>
                <li><a href="?nav=intranet&nav_intra=infos_serveur">Info Serveur</a></li>
                <li class="divider"></li>
                <li><a href="?nav=intranet&nav_intra=info_table">Infos tables</a></li>
                <li class="divider"></li>
                <li><a href="?nav=intranet&nav_intra=plugin_matos">Liste Matériels</a></li>
                <li class="divider"></li>
                <li><a href="http://wiki.evengyl.be/index.php/Accueil">Wiki Leaks Evengyl</a></li>
                <li class="divider"></li>
                <li><a href="http://www.netvibes.com/privatepage/1">NetVibe Flux RSS</a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10"><?php



    if(isset($_GET['nav_intra']))
    {

        if($_GET['nav_intra'] == 'manage_bsd')
        {
            require('manage_bsd.php');
        }
        
        else if($_GET['nav_intra'] == 'info_table')
        {    
            echo '<p style="font-size:17px; padding:10px; text-align:center;" class="bg-success">El&eacutements d&eacutetaill&eacutes des tables</p>'; 
            info_table(); //fonction dans le fichier function.php        
        }
        else if($_GET['nav_intra'] == 'plugin_matos')
        {
            require('plugin_matos.php'); // cette appel est un appel de templates , il doit être revus et correctement intégré
        }
        else if($_GET['nav_intra'] == 'eval')
        {
            render_eval();
        }
        else if($_GET['nav_intra'] == 'php_infos')
        {
            info_php();
        }
        else if($_GET['nav_intra'] == 'infos_serveur')
        {?>
            <div class="row" style="margin-top:15px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="thumbnail-general" style="background:#dfe0e0; height:100px;">
                            <p style="font-size:16px;" class="bg-primary">Load average statut server Raspberry Pi type B</p>
                            <div id="load_donnees"><?php cpu_usage(); ?></div>
                        </div>           
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                        <div class="thumbnail" style="background:#dfe0e0; height:420px;">
                            <p style="font-size:16px;" class="bg-primary">Processor in server raspberry pi type b</p>
                            <?php cpu_info(); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <div class="thumbnail" style="background:#dfe0e0; height:200px;">
                            <p style="font-size:16px;" class="bg-primary">Memory in server raspberry pi type b</p>
                            <?php mem_info(); ?>
                        </div>
                    </div>
                </div>   
            </div><?php
        }      
    }?>        
</div>

