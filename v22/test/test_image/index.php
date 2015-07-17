<?php
$taille_fichier_max = '2097152';
$largeur_max = '500';
function affiche_pre($txt)
{
    ?><pre><? print_r($txt); ?></pre><?
}

?>

    <form method="post" action="?action=confirm" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $taille_fichier_max; ?>" />
    <label for="icone">Slide PNG de max. 2 Mo ,  500px de largeur max !</label><br />
    <div class="form-group" style="margin-right:30px;">
        <div class="input-group">
            <div style="width: 50%;" class="input-group-addon">Ajouter l'image</div>
            <input style='width:450px;' type="file" class="form-control" name="nom" />
        </div>

    <button type="submit" class="btn btn-default">Submit</button>
    </form><?php



affiche_pre($_FILES);
$image_sizes = getimagesize($_FILES['nom']['tmp_name']);
affiche_pre($image_sizes);

die();
// appel True quand le formulaire est envoyer same page
if(isset($_GET['submit_ok']))
{
    if($_GET['submit_ok'] == 'ok')
    {

        if($_POST['title'] == '' OR $_POST['visible'] == '' OR $_POST['promo_or_not'] == '')
        {
            $afficher_form = true;
        }
        else
        {

            // Partie Image controle et encodage dans le fichier
            if ($_FILES['nom']['error'] > 0)
                $erreur = "Erreur lors du transfert";
            if ($_FILES['nom']['size'] > $taille_fichier_max)
                $erreur = "Erreur lors du transfert";
            else
                $erreur = "Fichier bien uploader";


            $image_sizes = getimagesize($_FILES['nom']['tmp_name']);

            if ($image_sizes[0] > $largeur_max)
                $erreur = "Image trop Grande";
            else
            {

                $res_sql = $all_query->select_simple($var='*' , $from= 'ma_news_det', $where='', $order='ORDER BY uid DESC', $type_return='object', $limite='1');
                $way_trace = $path_file.'/vues/news_promo/images/'.$res_sql[0]->uid.'.png';


                $move_result_code = move_uploaded_file($_FILES['nom']['tmp_name'], $way_trace);
                paragraphe_style($erreur);

                // partie traitement du post pour encodage dans la base de données

                unset($_POST['MAX_FILE_SIZE']);

                $_POST['ma_code'] = "http://matedex.be/en/search/?search_txt=".$_POST['ma_code'];
                $req_sql_news = new stdClass();
                $req_sql_news->table = 'ma_news_det';
                $req_sql_news->ctx = $_POST;
                $req_sql_news->ctx['link_image'] = $way_trace;
                $req_sql_news->where = 'uid = '.$res_sql[0]->uid;

                $all_query->update($req_sql_news);
                $erreur = "L'insertion c'est bien déroulée !";
                paragraphe_style($erreur);

            }
            paragraphe_style($ereur);
        }


    }
}


