
function refresh()
{
  setTimeout( function() {
    $('#load_donnees').fadeOut('fast').load('/vue/templates/intranet.php').fadeIn('fast');
    refresh();
  }, 2000);
}


$(document).ready( function(){
$('#load_donnees').load('/vue/templates/intranet.php');
refresh();
});
 
