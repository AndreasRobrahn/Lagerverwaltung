<?php
class trainingController
{
	/*
	** the variable for the database connection
	*/
	private $DBConnection = null;
	/*
	** the variable for a specified number to identify a training. at the current state of the application the training has to be created by the user because the apllication dont work with automatic incremented indexes
	*/
	private $trainingID ;
	
	public function __construct()
	{
		 $this->DBConnection= DBConnection::getInstance();
	}
	/*
	** Diese funktion fügt einem einzelnen Mitarbeiter ein Training in der Datenbank hinzu
	**
	*/
	public function addTrainingToEmployee()
	{
		echo 'okay';
	}
	/*
	** Diese funktion erstellt eine Schulung, alle Parameter bis $employees sind hoffentlich selbsterklärend. employees ist ein array mit einer anzahl an mitarbeitern
	**
	*/
	public function createTraining($startingDate,$endingDate, $KindOfTraining, $Teacher, $Duration, $Employees)
	{
		$sql = "BEGIN
				IF NOT EXISTS (SELECT * 
									FROM [Versatel_Schulung].[dbo].[Schulung]
								WHERE [Schulung].[Startzeitpunkt] = '".$startingDate."' AND [Schulung].[Endzeitpunkt] = '".$endingDate."')
					BEGIN
						INSERT INTO [Versatel_Schulung].[dbo].[Schulung]
							(Startzeitpunkt, Endzeitpunkt, Art_ID, Leiter_ID, Dauer)
						VALUES('".$startingDate."' , '".$endingDate."','".$KindOfTraining."','".$Teacher."','".$Duration."')
					END
				END;
				

				";
		$this->DBConnection->executeQuery($sql);
		/*
		** 2. step we ge the id of the new createt training and use it for the [Versatel_Schulung].[dbo].[Mitarbeiter_nimmt_Teil] table
		**
		*/
		$sql2 = "SELECT @@IDENTITY AS ID";
		$GetID= $this->DBConnection->sqlToAssocArray($sql2);
		/*
		** 3 Step is the input of every employee with the kind of training into the table [Versatel_Schulung].[dbo].[Mitarbeiter_nimmt_Teil]
		** 
		*/
		for($i=0;$i <= (count($Employees)-1); $i++)
		{
			$employee = $Employees[$i];
			$sql3 = "INSERT INTO [Versatel_Schulung].[dbo].[Mitarbeiter_nimmt_Teil]
						(Personal_Nummer, Schulung_ID)
					VALUES('".$employee."' , '".$GetID[0]['ID']."')"
				;
			
			$this->DBConnection->executeQuery($sql3);
		}	
		
		
	}
	public function createNewTrainingCategorie($kategorie,$content)
	{
		$query="Insert INTO [Versatel_Schulung].[dbo].[Schulungsverzeichnis]
				(Kategorie, Inhalt)
				VALUES
				('".$kategorie."', '".$content."')";
		$this->DBConnection->executeQuery($query);
	}
	public function showTrainingAndTrainer()
	{
		$sql = "SELECT  [Mitarbeiter].[Vorname]+[Mitarbeiter].[Name] AS Schulungsleiter, [Schulungsverzeichnis].[Kategorie],[Schulungsverzeichnis].[Inhalt], [Schulung].[Startzeitpunkt] AS von, [Schulung].[Endzeitpunkt] AS bis,[Schulung].[Dauer],[Schulung].[Schulung_ID] AS Link 
						FROM [Versatel_Schulung].[dbo].[Schulung]
						INNER JOIN [Versatel_Schulung].[dbo].[Mitarbeiter] ON [Mitarbeiter].[Personal_Nummer] = [Schulung].[Leiter_ID]
						INNER JOIN [Versatel_Schulung].[dbo].[Schulungsverzeichnis] ON [Schulung].[Art_ID] = [Schulungsverzeichnis].[Schulungsart_ID]
						
						";
		$result= $this->DBConnection->sqlToAssocArray($sql);
		return $result;
	}
	public function showTrainingByID($ID)
	{
		$sql = "SELECT  [Schulung].[Schulung_ID],[Mitarbeiter].[Vorname] + [Mitarbeiter].[Name] AS Mitarbeiter
						FROM [Versatel_Schulung].[dbo].[Mitarbeiter]
						INNER JOIN [Versatel_Schulung].[dbo].[Mitarbeiter_nimmt_Teil] ON [Mitarbeiter].[Personal_Nummer] = [Mitarbeiter_nimmt_Teil].[Personal_Nummer]
						INNER JOIN [Versatel_Schulung].[dbo].[Schulung] ON [Schulung].[Schulung_ID] = [Mitarbeiter_nimmt_Teil].[Schulung_ID]
						Where [Schulung].[Schulung_ID]=$ID
					";
		$result= $this->DBConnection->sqlToAssocArray($sql);
		return $result;
	}
	public function showTrainingWithRating()
	{
		$sql=	"SELECT  [Schulung].[Schulung_ID],[Schulung].[Startzeitpunkt],[Schulung].[Endzeitpunkt],AVG(CAST([Schulung_erhaelt_Bewertung].[Bewertung] AS FLOAT)) AS Gesamtnote
				FROM [Versatel_Schulung].[dbo].[Schulung]
				JOIN [Versatel_Schulung].[dbo].[Schulung_erhaelt_Bewertung] ON [Schulung].[Schulung_ID] = [Schulung_erhaelt_Bewertung].[Schulung_ID]
				GROUP BY [Schulung].[Schulung_ID],[Schulung].[Startzeitpunkt],[Schulung].[Endzeitpunkt]
				";
		
		$result= $this->DBConnection->sqlToAssocArray($sql);
		return $result;
	}
	
}
?>