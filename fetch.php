<html>
<head>
<link rel="stylesheet" href="stylesheet.css">
<title>
Fetcher
</title>
<?php
if (isset($_POST['id']))
{
	$sqlfetch = "SELECT Geraet,Artikel_NR,EAN, Bemerkung, Menge FROM `gerät/lager` WHERE `gerät/lager`.`Geraet` LIKE '".$_POST['id']."%'";
	$return=$Machine->fetchTheGoddamQuery($sqlfetch,$mysqliObject);
	$arrayToAbuse=array_keys($return[0]);
	echo '<div class="row">';
	for ($i=0;$i<= (count($arrayToAbuse)-1);$i++)
				{
					echo '<div class="cell">'.$arrayToAbuse[$i].'</div>';
				}
	echo '</div>';
	$Machine->showItAll($return,"divastable");
	
}
if (isset($_POST['Training']))
{
	echo 7;
}


?>
</body>
<script>
$('.popupimage').click (function ()
{
	event.preventDefault();
	var liefernummer = this.innerHTML;
	$('.modal').modal('show');
	$.post('fetch.php', {LieferNummer : liefernummer} , function(data)
	{
		$('#anzeige-lieferbestandteile').html(data);
	});
	//document.getElementById('anzeige-lieferbestandteile').innerHTML = liefernummer;
	//alert( src + liefernummer);$document.getElementById('anzeige-lieferbestandteile').innerHTML= "liefernummer";
});
</script>
</html>