<?php
class employeeController
{
	private $DBConnection = null;
	
	public function __construct()
	{
		 $this->DBConnection= DBConnection::getInstance();
	}
	public function insertEmployee($Name,$Surname,$Email)
	{
		$sql = "BEGIN
				IF NOT EXISTS (SELECT * FROM [Versatel_Schulung].[dbo].[Mitarbeiter]
					WHERE [Mitarbeiter].[Name] = '".$Name."' AND [Mitarbeiter].[Vorname] = '".$Surname."')
				BEGIN
					INSERT INTO [Versatel_Schulung].[dbo].[Mitarbeiter]
					(Name, Vorname, Email)
					VALUES('".$Name."' , '".$Surname."','".$Email."')
				END
			END";
		$this->DBConnection->executeQuery($sql);		
	}
	function dropEmployee($ID)
	{
		$sql =	"DELETE FROM [Versatel_Schulung].[dbo].[Mitarbeiter]
				WHERE [Mitarbeiter].[Personal_Nummer]=$ID";
		$this->DBConnection->executeQuery($sql);		
	}
	function showEmployees()
	{
		$sql=	"SELECT [Mitarbeiter].[Personal_Nummer], [Mitarbeiter].[Vorname]+[Mitarbeiter].[Name] AS Name, [Mitarbeiter].[Team]
						FROM [Versatel_Schulung].[dbo].[Mitarbeiter]
				";
		$result= $this->DBConnection->sqlToAssocArray($sql);
		return $result;
	}
	function showTrainingOfEmployees($ID)
	{
		/*
		$sql=	"SELECT 
					[Mitarbeiter].[Vorname],[Mitarbeiter].[Name],[Schulungsverzeichnis].[Kategorie],[Schulungsverzeichnis].[Inhalt]
				 FROM 
					[Versatel_Schulung].[dbo].[Mitarbeiter]
				 INNER JOIN
					[Versatel_Schulung].[dbo].[Mitarbeiter_nimmt_Teil] ON [Mitarbeiter_nimmt_Teil].[Personal_Nummer] = [Mitarbeiter].[Personal_Nummer]
				 INNER JOIN
					[Versatel_Schulung].[dbo].[Schulung] ON [Schulung].[Schulung_ID] = [Mitarbeiter_nimmt_Teil].[Schulung_ID]
				INNER JOIN
					[Versatel_Schulung].[dbo].[Schulungsverzeichnis] ON [Schulungsverzeichnis].[Schulungsart_ID]= [Mitarbeiter_nimmt_Teil].[Schulung_ID]	
					
				WHERE
					[[Mitarbeiter_nimmt_Teil].[Personal_Nummer] = $ID
						";*/
		$sql=	"SELECT 
					[Mitarbeiter].[Personal_Nummer],[Mitarbeiter].[Vorname],[Mitarbeiter].[Name], [Mitarbeiter].[Team], [Schulung].[Schulung_ID],[Schulung].[Startzeitpunkt] AS von, [Schulung].[Endzeitpunkt] AS bis,[Schulungsverzeichnis].[Kategorie],[Schulungsverzeichnis].[Inhalt]
				 FROM 
					[Versatel_Schulung].[dbo].[Mitarbeiter]
				 INNER JOIN
					[Versatel_Schulung].[dbo].[Mitarbeiter_nimmt_Teil] ON [Mitarbeiter_nimmt_Teil].[Personal_Nummer] = [Mitarbeiter].[Personal_Nummer]
				 INNER JOIN
					[Versatel_Schulung].[dbo].[Schulung] ON [Schulung].[Schulung_ID] = [Mitarbeiter_nimmt_Teil].[Schulung_ID]
				 INNER JOIN 
					[Versatel_Schulung].[dbo].[Schulungsverzeichnis] ON [Schulung].[Art_ID] = [Schulungsverzeichnis].[Schulungsart_ID]
				 WHERE [Mitarbeiter_nimmt_Teil].[Personal_Nummer] = $ID
				";
		$result= $this->DBConnection->sqlToAssocArray($sql);
		return $result;
	}
	function showSkillsOfEmployee($ID)
	{
		$sql="	SELECT 
					[Skill_Verzeichnis].[Unterkategorie]  AS Skills
   				FROM 
					[Versatel_Schulung].[dbo].[Mitarbeiter]
				INNER JOIN
					[Versatel_Schulung].[dbo].[Mitarbeiter_hat_Skill] ON [Mitarbeiter_hat_Skill].[Personal_Nummer] = [Mitarbeiter].[Personal_Nummer]
				INNER JOIN
					[Versatel_Schulung].[dbo].[Skill_Verzeichnis] ON [Skill_Verzeichnis].[Skill_ID] = [Mitarbeiter_hat_Skill].[Skill_ID]
				 
				 WHERE [Mitarbeiter_hat_Skill].[Personal_Nummer] = $ID
			";
		$result= $this->DBConnection->sqlToAssocArray($sql);
		return $result;
	}
	/*
	** this funtion adds an v-check to the datatable V-Check with the personl number and the date
	*/
	function AddVcheckToEmployee($Date,$EmployeeNumber,$Agent,$arrayOfValues)
	{
		$sql="
			INSERT INTO [Versatel_Schulung].[dbo].[V-Checks]
				([Datum],[PersonalNummer], [Bearbeiter], [BegruessungNachVorgabe],[Anschlussidentifikation],[KundeRichtigAuthentifiziert],[FragetechnikRichtigAngewandt],[AnliegenRichtigErfasst],[AnliegenZusammengefasst],[AussagenSachlich],[Dokumentation],[VisavisRichtigGenutzt],[VermeidungVonKonjunktiven],[VermeidenVonWeichmachern],[NamentlicheAnsprache],[PositiveFormulierungen],[VerstaendlicheAussprache],[GespraechspausenAngemessen],[UmgangMitEinwaenden],[Sprechstimmlage],[Lautstaerke],[Geschwindigkeit],[AusredenLassen],[Fuellwoerter],[ZusammenfassungDerVereinbarung],[AbschlussfrageZurZufriedenheit],[VerabschiedungNachVorgabe])
			VALUES('".$Date."' ,'".$EmployeeNumber."','".$Agent."','".$arrayOfValues[0]."','".$arrayOfValues[1]."','".$arrayOfValues[2]."','".$arrayOfValues[3]."','".$arrayOfValues[4]."','".$arrayOfValues[5]."','".$arrayOfValues[6]."','".$arrayOfValues[7]."','".$arrayOfValues[8]."','".$arrayOfValues[9]."','".$arrayOfValues[10]."','".$arrayOfValues[11]."','".$arrayOfValues[12]."','".$arrayOfValues[13]."','".$arrayOfValues[14]."','".$arrayOfValues[15]."','".$arrayOfValues[16]."','".$arrayOfValues[17]."','".$arrayOfValues[18]."','".$arrayOfValues[19]."','".$arrayOfValues[20]."','".$arrayOfValues[21]."','".$arrayOfValues[22]."','".$arrayOfValues[23]."')
		";
		echo $sql;
		$this->DBConnection->executeQuery($sql);
	}
}

?>