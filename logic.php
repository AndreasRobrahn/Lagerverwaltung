<?php

defined('BASEPATH') or define('BASEPATH', realpath(dirname(__FILE__)));
	// Require autoloader
	require_once(BASEPATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
	function getConfig()
	{
		return require(BASEPATH . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php");
	}
$steuerung = new employeeController();
$schulung= new trainingController();

print_r ($_POST);
echo '<hr>';
$testarray=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
echo date("d.m.Y");
$steuerung->AddVcheckToEmployee(date("d.m.Y"),$PersonalNumber,$Agent,$testarray);
switch($_POST)
{
	case(empty($_POST)):
		echo 'nottin';
	break;
	case(isset($_POST['Personalnummer1']) && isset($_POST['Leiter'])):
		$arrayOfConditions= array_keys($_POST);
		for($i=0;$i <=(count($_POST)-1); $i++)
		{
			if ((stristr($arrayOfConditions[$i], 'Personal') === false) )
			{
				$Schulungsinformation[]=$_POST[$arrayOfConditions[$i]];
			}	
			else
			{
				$MitarbeiterSchulung[]= $_POST[$arrayOfConditions[$i]];
			}
		}
	$schulung->createTraining($Schulungsinformation[0],$Schulungsinformation[1], $Schulungsinformation[2],$Schulungsinformation[3],$Schulungsinformation[4],$MitarbeiterSchulung);
	break;
	case(isset($_POST['Personalnummer1']) && isset($_POST['Leiter'])):
		$arrayOfConditions= array_keys($_POST);
		for($i=0;$i <=(count($_POST)-1); $i++)
		{
			if ((stristr($arrayOfConditions[$i], 'Personal') === false) )
			{
				$Schulungsinformation[]=$_POST[$arrayOfConditions[$i]];
			}	
			else
			{
				$MitarbeiterSchulung[]= $_POST[$arrayOfConditions[$i]];
			}
		}
	$schulung->createTraining($Schulungsinformation[0],$Schulungsinformation[1], $Schulungsinformation[2],$Schulungsinformation[3],$Schulungsinformation[4],$MitarbeiterSchulung);
	break;
}

//echo $backToStart='<meta http-equiv="refresh" content="0 URL=index.php">';
?>