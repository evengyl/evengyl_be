<!DOCTYPE html>
<html>
<body>

<?php
function affiche_pre($txt)
{
  ?><pre><? print_r($txt); ?></pre><?
}
//Zone de test

$obj = new stdClass();



$obj->month['1'] = array(10,20,50,30,80,40,60);
$obj->month['2'] = array(10,80,30,60,100,20,10);
$obj->month['3'] = array(100,50,20,40,90,30,50);


foreach($obj as $row => $test)
{

	foreach($test as $values)
	{
		foreach($values as $tesst)
		{
		
			?>	
				<svg width="10" height="<?php echo $tesst; ?>">
  					<rect width="10" height="<?php echo $tesst; ?>" style="fill:rgb(0,0,255);" />
				</svg><?php
		}
echo '</br></br>';
	}
	
}
//Fin de zone de test
?>
</body>
</html>
