<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Schulungsverwaltung </title>
  <!-- Bootstrap core CSS-->
  <link href="csss/startbootstrap-sb-admin-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="csss/startbootstrap-sb-admin-gh-pages/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="csss/startbootstrap-sb-admin-gh-pages/css/sb-admin.css" rel="stylesheet">
  <!-- Javascript functions-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" 
  type="text/javascript"></script>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/java.js"></script>
</head>
<body id ="page-top" class="fixed-nav sticky-footer bg-dark">
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">XXX</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Components">
          <a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion" aria-expanded="true">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Schulungen</span>
          </a>
          <ul class="sidenav-second-level collapse show" id="collapseComponents" style="">
            <li>
              <a href="index.php?Schulungen_Übersicht">Übersicht der Schulungen</a>
            </li>
            <li>
              <a href="index.php?Test">Bewertungen der Schulungen </a>
            </li>
			<li>
              <a href="index.php?Schulung_anlegen">Schulung anlegen </a>
            </li>
			<li>
              <a href="index.php?Schulungsart_anlegen">Schulungsart anlegen </a>
            </li>
          </ul>
        </li>
		
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Mitarbeiter</span>
          </a>
		  <ul class="sidenav-second-level collapse show" id="collapseComponents" style="">
            <li>
              <a href="index.php?Mitarbeiter_Übersicht">Übersicht Mitarbeiter</a>
            </li>
			<li>
              <a href="index.php?index.php?Mitarbeiter_anlegen">Neuer Mitarbeiter</a>
            </li>
			<li>
              <a href="index.php?Mitarbeiter_Schulungen">Schulung pro Mitarbeiter</a>
            </li>
          </ul>
		 </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="index.php?Test">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Test</span>
          </a>
       </ul>
        </li>
       </ul>
        
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
	<div class="content-wrapper">
		<div class="container-fluid">
			<ol class="breadcrumb">
		<?php
			/*
			** this is the sektion where i save some stuff and functions i want potentially implemented 
			**
			*/
			defined('BASEPATH') or define('BASEPATH', realpath(dirname(__FILE__)));
			// Require autoloader
			require_once(BASEPATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
			function getConfig()
			{
				return require(BASEPATH . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php");
			}
			/*
			** a form for a radio form, which is just too much to write
			*/
			function RadioInlineFormular($arrayOfNames,$NumberOfValues,$form="")
			{
				for($i=0; $i<=(count($arrayOfNames)-1);$i++)
				{
					$form.= $arrayOfNames[$i].'</br>';
					for ($j=0; $j<=(count($NumberOfValues)-1);$j++)
					{
						
						$form.= '
						<label for="radio-inline">
							<input type ="radio" name="'.$arrayOfNames[$i].'" value="'.$NumberOfValues[$j].'"> '.$NumberOfValues[$j].'
						</label>'
						; 
					}	
					$form.='</br>';
				}
				return $form;
			}
			/*
			** with the function below we transform every two dimensional array, aka every return data fro a database 
			**
			*/
			function standartOutputTable($array)
			{
				$output=  '<table id="dataTable" class="table table-bordered dataTable" role="grid" aria-describedby="dataTable_info" style="widht: 80%;" width="80%" cellspacing="0">';
					$output .= '<tr>';
					for($i=0;$i<=(count(array_keys($array[0]))-1);$i++)
					{
						$output .= '<th>'.(array_keys($array[0])[$i]).'</th>';
					}
					$output .= '</tr>';
					for ($i=0; $i<=(count($array)-1);$i++)
					{
						$output .= '<tr>';
						$firstDimension= $array[$i];
						$associativeKeys= array_keys($firstDimension);
						for($j=0; $j <= (count($firstDimension)-1);$j++)
						{
							$output .= '<td>'.$firstDimension[$associativeKeys[$j]].'</td>';
						}
						$output .= '</tr>';
					}
				$output.= '</table>';
				return $output;
			}
			$schulung= new trainingController();
			$steuerung = new employeeController();
			
			// Bereich für die !!!!!!!!!!!!!!!!SCHULUNGÜBERSICHT!!!!!!!!!!!!!!!!!
			switch($_GET)
			{
				case(!isset($_GET)):
				$output= '
						<li class="breadcrum-item"><H2> Übersicht </H2></li>
						</ol>
						';
				echo $output;			
				break;
				case(isset($_GET['Schulungen_Übersicht'])):
					// we need a link to the employees in Training as the last column, so we cannot use the standartoutputtable 
					$result= $schulung->showTrainingAndTrainer();
					print_r($result);
					$output= '
							<li class="breadcrum-item"><H2> Schulungsübersicht </H2></li>
							</ol>
							';
					$output .= '<table id="dataTable" class="table table-bordered dataTable" role="grid" aria-describedby="dataTable_info" style="widht: 100%;" width="100%" cellspacing="0">';
						$output.= '<tr>';
						for($i=0;$i<=(count(array_keys($result[0]))-1);$i++)
						{
							$output.= '<th>'.(array_keys($result[0])[$i]).'</th>';
						}
						$output.= '</tr>';
						for ($i=0; $i<=(count($result)-1);$i++)
						{
							$output.= '<tr>';
							
							$firstDimension= $result[$i];
							$associativeKeys= array_keys($firstDimension);
							for($j=0; $j <= (count($firstDimension)-1);$j++)
							{
								if($j == (count($firstDimension)-1))
								{
									//echo '<td><a class="nav-link" data-toogle="modal" data-target="#exampleModal">'.$firstDimension[$associativeKeys[$j]].'</a></td>';
									$output.= '<td><a href="index.php?SchulungsID='.$firstDimension[$associativeKeys[$j]].'" id="'.$firstDimension[$associativeKeys[$j]].'">Mitarbeiter</a></td>';
								}
								else
								{
									$output.= '<td>'.$firstDimension[$associativeKeys[$j]].'</td>';
								}
								
							}
							$output.= '</tr>';
						}
					$output.= '</table>';
				echo $output;
				break;
				//!!!!! ÜBERSICHT DER MITARBEITER PRO SCHULUNG !!!!!!!!!!
				case(isset($_GET['SchulungsID'])):
					$result= $schulung->showTrainingByID($_GET['SchulungsID']);
					$output= '
							<li class="breadcrum-item"><H2> Mitarbeiter in Schulung </H2></li>
								</ol>
									<div class="card-body">
										<div class="table-responsive">
											<div id="dataTable-wrapper" class="dataTAbles_wrapper container-fluid dt-bootstrap4">	
						';
					
					$output.= standartOutputTable($result);
					echo $output;
				break;
				case(isset($_GET['Mitarbeiter_Übersicht'])):
				/*
				** Mitarbeiterübersicht, zeigt alle Mitarbeiter an
				*/
					$result= $steuerung->showEmployees();
					echo '<table id="dataTable" class="table table-bordered dataTable" role="grid" aria-describedby="dataTable_info" style="widht: 100%;" width="100%" cellspacing="0">';
					echo '<tr>';
					for($i=0;$i<=(count(array_keys($result[0]))-1);$i++)
					{
						echo '<th>'.(array_keys($result[0])[$i]).'</th>';
					}
					echo '</tr>';
					for ($i=0; $i<=(count($result)-1);$i++)
					{
						echo '<tr>';
						$firstDimension= $result[$i];
						$associativeKeys= array_keys($firstDimension);
						for($j=0; $j <= (count($firstDimension)-1);$j++)
						{
							if($j == 1)
							{
								echo '<td><a href="index.php?Mitarbeiter_Schulungen='.$firstDimension[$associativeKeys[$j-1]].'">'.$firstDimension[$associativeKeys[$j]].'</a></td>';
							}
							else
							{
								echo '<td>'.$firstDimension[$associativeKeys[$j]].'</td>';
							}
							
						}
						echo '</tr>';
					}
					echo '</table>';
				break;
				/*
				**!!!!!!!!!!!!!!!! ÜBERSICHT DER EINZELNEN MITARBEITER nach Trainings, Skills und V-Checks / AKTUELL DIE WICHTIGSTE SEITE!!!!!!!!!!!!!!!!!!!!!!!!!
				** output should be the only variable were we attach html to, unfurtenately at this time we have some forms that are in separate variables
				*/
				case(isset($_GET['Mitarbeiter_Schulungen'])):
					if(empty($_GET['Mitarbeiter_Schulungen']))
					{
						echo "nottin";
					}
					else
					{
						$result= $steuerung->showTrainingOfEmployees($_GET['Mitarbeiter_Schulungen']);
						//$output= standartOutputTable($result);
												
						$output= '
							<li class="breadcrum-item"><H2>'.$result[0]['Vorname'].' '.$result[0]['Name'].' </H2> </br>
								<div>
									PersonalNummer: '.$result[0]['Personal_Nummer'].'</br>
									Team: '.$result[0]['Team'].'</br>
								</div>
							
							</li>
							</ol>
							';
						// TrainingsÜbersicht, wir müssen die ersten 5 Elemente aus dem result array löschen da die nur für den obigen abschnitt wichtig sind
						for($i=0;$i <= (count($result)-1);$i++)
						{
							$TransformResultToOutput[]= array_slice($result[$i],4,-1);
						}	
						$buttonAddTraining= '
						<button type="button" id="addTraining" onclick="ShowAndHideFormDiv()">Training hinzufügen</button>
						';
						$output.= '<h2>Trainings</h2>'.$buttonAddTraining.''.standartOutputTable($TransformResultToOutput);	
						$output.= '<hr>';					
						
						// SkillÜbersicht
						$result2= $steuerung->showSkillsOfEmployee($_GET['Mitarbeiter_Schulungen']);
						$output.= '<h2>Skills</h2><button id="addSkill" onsubmit="">Skill hinzufügen</button>'.standartOutputTable($result2);			
						//V-Check Dingsbums
						$stringattached=trim($result[0]['Vorname']);
						$stringattached.= '_'.$result[0]['Name'];
						$output.='<h2>V-Checks</h2>';
												
						//there seems to be 2 non visible files in the order 
						//print_r($result);
						echo $output;
						$divFormAddTrainingToClick='
							<div id="formAddTraining" style="background-color : red; top: 26%; left: 28%; position: absolute; height: 500px; width: 500px; display:none">
								<table>
								<form action ="logic.php" method="POST">
									<input type ="hidden" name="Personalnummer1" value="'.$result[0]['Personal_Nummer'].'"> </br>
									Startzeitpunkt: <input type ="Date" name="Startzeitpunkt"> </br>
									Endzeitpunkt: <input type ="Date" name="Endzeitpunkt"> </br>
									Art des Training: <input type ="text" name="Art"> </br>
									Schulungsleiter: <input type ="text" name="Leiter"> </br>
									Dauer:  <input type ="text" name="Dauer"> </br>
									<input type="submit">
									
								</form>	
								</table>
							</div>
						';
						$divFormAddVCheckToClick= 
							'<div class="container" id="AddVCheck"  style="background-color : red; top: 31%; left: 32%; position: absolute; height: auto; width: auto; display:block">
								<table>
								<form action="logic.php" method="POST">
									<input type ="hidden" name="Personalnummer1" value="'.$result[0]['Personal_Nummer'].'"> 
									Bearbeiter<input type ="text" name="Bearbeiter"> 
							';
						$arrayOfNames =array("BegrüßungNachVorgabe","Anschlussidentifikation","KundeRichtigAuthentifiziert","AnliegenRichtigErfasst","AnliegenZusammengefasst","AussagenSachlich","Dokumentation","VisavisRichtigGenutzt","VermeidungVonKonjunktiven","VermeidenVonWeichmachern","NamentlicheAnsprache","PositiveFormulierungen","VerstaendlicheAussprache","GesprächspausenAngemessen");
						$NumberOfValues =array(1,2,3,5,10);
						$divFormAddVCheckToClick.= RadioInlineFormular($arrayOfNames,$NumberOfValues,$divFormAddVCheckToClick);
						$divFormAddVCheckToClick.='<input type="submit"></form></table></div>';
						
						
						echo $divFormAddTrainingToClick;
						echo $divFormAddVCheckToClick;
						
						
					}
				break;
			}
					
			// Formular um eine neue Schulung anzulegen
			if(isset($_GET['Schulung_anlegen']))
			{
				$formstep = 0;
				$inputform=' 
				<div class="container">
					<div class="card card-columns">
						<div class="card-header">Eine neue Schulung anlegen
						</div>
						<div class="card-body">
							<form action="logic.php"  method="POST">
								<div class="form-group">
									<div class="form-row" id="step'.($formstep+=1) .'">
										<div class="col-md-6">
											<label> Startzeitpunkt </label>
											<input id="" class="form-control" placeholder="" name="Startzeitpunkt" type="date"">
										</div>
										<div id="employee1" class="col-md-6">
											<label> Personalnummer1 </label>
											<input id="Mitarbeiter1" class="form-control" placeholder="bitte Mitarbeiter eingeben" type="text" name="Personalnummer1">
										</div>
									</div>
									<div class="form-row" id="step'.($formstep+=1) .'">
										<div class="col-md-6">
											<label> Endzeitpunkt </label>
											<input id="" class="form-control" placeholder="" name="Endzeitpunkt" type="date"">
										</div>
									</div>
									<div class="form-row" id="step'.($formstep+=1) .'">
										<div class="col-md-6">
											<label> Art </label>
											<input id="" class="form-control" placeholder="" type="text" name="Art">
										</div>
									</div>
									<div class="form-row" id="step'.($formstep+=1) .'">
										<div class="col-md-6">
											<label> Schulungsleiter </label>
											<input class="form-control" placeholder="bitte einen Schulungsleiter eingeben" type="text" name="Schulungsleiter_ID" >
										</div>
										
									</div>
									<div class="form-row" id="step'.($formstep+=1) .'">
										<div class="col-md-6">
											<label> kalkulierte Dauer </label>
											<input id="" class="form-control" placeholder="" type="number" name="Dauer">
										</div>
									</div>
								</div>
							</div>
							<button class="btn btn-primary" type="submit"> OK</button>
							</form>
							<button class="btn btn-default" id="addemployee">Weiterer Mitarbeiter</button>
						</div>
					</div>
				</div>';
				$inputform.= '<hr>';
				
				//sektion für mitarbeiter
				
				echo $inputform;
			}
			if(isset($_GET['Schulungsart_anlegen']))
			{
				$inputform=' 
				<div class="container">
					<div class="card card-columns">
						<div class="card-header">Einen neuen Schulungsprozeß anlegen
						</div>
						<div class="card-body>
							<form>
								<div class="form-group">
									<div class="form-row">
										<div class="col-md-6">
											<label> Kategorie </label>
											<input id="" class="form-control" placeholder="bitte eine Kategorie eingeben" type="text" >
										</div>
									</div>
									<div class="form-row">
										<div id="" class="col-md-6">
											<label> Inhalt </label>
											<input id="" class="form-control" placeholder="bitte einen Inhalt bestimmen" name="Inhalt" type="text"">
										</div>
									</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>';
				echo $inputform;
				
					
			}
			//Testarea
			if(isset($_GET['Test']))
			{
				echo 'testbereich';
				$a ="Prozeßschulung";
				$b ="Prozeß 4";
				//$schulung->createNewTrainingCategorie($a,$b);
				//standartOutputTable($result);
			}
?>
</div>
</body>
</html>
<script>
$(document).ready(function()
{
	var i = 2;
	$('#addemployee').click(function()
	{
		$('#step'+i+'').append('<div id="Mitarbeiter'+i+'" class="col-md-6"><label> Personalnummer'+i+' </label><input id="" class="form-control" placeholder="bitte Mitarbeiter eingeben" type="text" name="Personalnummer'+i+'"><button name="remove" id ="'+i+'"class="btn btn-danger btn_remove">X</button></div>');
		i++;
	});
	$(document).on('click','.btn_remove',function()
	{
		var buttonid= $(this).attr('id');
		$('#Mitarbeiter'+buttonid+'').remove();
		i--;
	});
});
function ShowAndHideFormDiv(){
	var divWeNeed = document.getElementById('formAddTraining');
	
	if (divWeNeed.style.display === "none"){
		divWeNeed.style.display = "block";
		document.getElementById('addTraining').innerHTML = 'verstecken'
	} else {
		divWeNeed.style.display = "none";
		document.getElementById('addTraining').innerHTML = 'Training hinzufügen'
	}
	}
	
	/*
		document.getElementById('formAddTraining').style.display = 'block';
		document.getElementById('addTraining').id ='buttonHide';
		document.getElementById('buttonHide').innerHTML = 'verstecken';*/
	
	//document.getElementById("formAddTraining").style.display="block
</script>