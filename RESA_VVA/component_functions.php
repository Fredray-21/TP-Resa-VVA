<?php
function connectDB() //connexion DB
{
	$link = new PDO('mysql:host=localhost;dbname=resa_vva', 'resavva', 'resa');
	$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	if (!$link) {

		return  null;
	} else {

		return $link;
	}
}
function disconnectDB($link)
{
	$link = null;
}

// FONCTION POUR HEBERGEMENT //

function getAllTypeheb() //Récupération de tout les type d'hébergement
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT DISTINCT * FROM type_heb";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

function getTypehebWherecode($codeTypeHeb) //Récupération du nom du type en fonction de son code
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT NOMTYPEHEB FROM type_heb WHERE CODETYPEHEB = ? ";
		$sth = $link->prepare($req);
		$sth->execute([$codeTypeHeb]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetch(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

function getLastIDheb() // recupération du dernier id inseré dans Heberegments
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT NOHEB FROM hebergement WHERE NOHEB = (SELECT MAX(NOHEB) FROM hebergement)";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$row = $sth->fetch(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $row;
			} else {
				return null;
			}
		}
	}
}

//ajoute un herbergement
function setHebergement($selecttypeheb, $nomheb, $nombreplaceheb, $surfaceheb, $internet, $anneheb, $secteurheb, $selectorientation, $selectetat, $descriheb,  $tarifsem)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "INSERT INTO hebergement (NOHEB,CODETYPEHEB,NOMHEB,NBPLACEHEB,SURFACEHEB,INTERNET,ANNEEHEB,SECTEURHEB,ORIENTATIONHEB,ETATHEB,DESCRIHEB,PHOTOHEB,TARIFSEMHEB) 
        VALUES (NOHEB,?,?,?,?,?,?,?,?,?,?,?,?)";
		$sth = $link->prepare($req);
		$sth->execute([$selecttypeheb, $nomheb, $nombreplaceheb, $surfaceheb, $internet, $anneheb, $secteurheb, $selectorientation, $selectetat, $descriheb, null, $tarifsem]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$row =  getLastIDheb();
			disconnectDB($link);
			return $row;
		}
	}
}


function getNbAllheb() // renvoie le nombre d'hebergement
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT count(*) as NbHeb FROM hebergement";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetch(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

function SetLinkPHOTO($noheb, $adressPHOTO) // ajoute de lien de la photo dans la BDD
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "UPDATE hebergement SET PHOTOHEB = ? WHERE NOHEB = ?";
		$sth = $link->prepare($req);
		$sth->execute([$adressPHOTO, $noheb]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			disconnectDB($link);
			return true;
		}
	}
}

function getAllhebPagination($min, $max) //recupère les hebegement en fonction de la pagination
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * FROM hebergement ORDER BY NOHEB ASC LIMIT :min,:max";
		$sth = $link->prepare($req);
		$sth->bindValue(':min', $min, PDO::PARAM_INT);
		$sth->bindValue(':max', $max, PDO::PARAM_INT);
		$sth->execute();
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

function getAllheb() // revoie tout les hebergement
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * FROM hebergement ORDER BY NOHEB ASC";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

function getHebWhereID($noheb) //Récupération d'un herbergement en fonction de son Numéro
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * FROM hebergement where NOHEB = ?";
		$sth = $link->prepare($req);
		$sth->execute([$noheb]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetch(PDO::FETCH_ASSOC);
				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

//uptade d'un Hebergement
function UpdateHebergement($selecttypeheb, $nomheb, $nombreplaceheb, $surfaceheb, $selectinternet, $anneheb, $secteurheb, $selectorientation, $selectetat, $descriheb,  $tarifsem, $noheb)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "UPDATE hebergement SET CODETYPEHEB = ?,NOMHEB=?,NBPLACEHEB=?,SURFACEHEB=?,INTERNET=?,ANNEEHEB=?,SECTEURHEB=?,ORIENTATIONHEB=?,ETATHEB=?,DESCRIHEB=?,TARIFSEMHEB=? 
		WHERE NOHEB = ?";
		$sth = $link->prepare($req);
		$sth->execute([$selecttypeheb, $nomheb, $nombreplaceheb, $surfaceheb, $selectinternet, $anneheb, $secteurheb, $selectorientation, $selectetat, $descriheb, $tarifsem, $noheb]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			disconnectDB($link);
			return True;
		}
	}
}


//Supprime un hébergement en fonction de son Numéro
function DeleteHebWhereID($noheb)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "DELETE from hebergement WHERE NOHEB = ?";
		$sth = $link->prepare($req);
		$sth->execute([$noheb]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {

			array_map('unlink', glob("upload/$noheb/*"));
			rmdir("upload/$noheb");

			disconnectDB($link);
			return True;
		}
	}
}

//Récupération des hebergement pour une semmaine donné 
function GetHebergementParSemaine($dateDebSem)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "SELECT * FROM resa WHERE DATEDEBSEM = ? ORDER BY NORESA ASC";
		$sth = $link->prepare($req);
		$sth->execute([$dateDebSem]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

			disconnectDB($link);
			return $tab;
		}
	}
}

function GetHebFilter($filter)
{
	$where = "";
	$filter = explode(",", $filter);

	foreach ($filter as $key => $value) {
		$value = explode("=", $value);
		if (!IsNullOrEmptyString($value[1])) {

			if ($value[0] == "heb" && is_numeric($value[1])) {
				$where = $where . "CODETYPEHEB = $value[1] and ";
			} elseif ($value[0] == "wifi" && is_numeric($value[1])) {
				$where = $where . "INTERNET = $value[1] and ";
			} elseif ($value[0] == "or" && ($value[1] == "NORD" or $value[1] == "SUD" or $value[1] == "EST" or $value[1] == "OUEST")) {
				$where = $where . "ORIENTATIONHEB = '$value[1]' and ";
			} elseif ($value[0] == "surfMin" && is_numeric($value[1])) {
				$where = $where . "SURFACEHEB >= $value[1] and ";
			} elseif ($value[0] == "place" && is_numeric($value[1])) {
				$where = $where . "NBPLACEHEB >= $value[1] and ";
			} elseif ($value[0] == "dispo" && $value[1] == "Disponible") {
				$where = $where . "ETATHEB = '$value[1]' and ";
			} else {
				return null;
			}
		}
	}
	$where = substr($where, 0, -4); //supression du "and " final
	//	echo $where;

	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * FROM hebergement WHERE $where ORDER BY NOHEB ASC";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

//retourne les hebergement en fonction de la page
function GetResaFilterPagination($filter, $min, $max)
{
	$where = "";

	if (isset($filter)) {
		$filter = explode(",", $filter);
		foreach ($filter as $key => $value) {
			$value = explode("=", $value);
			if (!IsNullOrEmptyString($value[1])) {

				if ($value[0] == "heb" && is_numeric($value[1])) {
					$where = $where . "NOHEB = $value[1] and ";
				} elseif ($value[0] == "dateDEB" && !IsNullOrEmptyString($value[1])) {
					$timestamp = strtotime($value[1]);
					$value[1] = date("Y-m-d", $timestamp);
					$where = $where . "DATEDEBSEM = '$value[1]' and ";
				} else {
					return null;
				}
			}
		}

		$where = substr($where, 0, -4); //supression du "and " final

		if (empty($where)) {
			return null;
		} else {
			$where = "WHERE " . $where;
		}
	}
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * FROM resa $where ORDER BY NORESA DESC LIMIT :min,:max";
		$sth = $link->prepare($req);
		$sth->bindValue(':min', $min, PDO::PARAM_INT);
		$sth->bindValue(':max', $max, PDO::PARAM_INT);
		$sth->execute();
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

// FIN FONCTION HEBERGEMENT

// FONCTION POUR RESERVATION // 
function getNbAllResa() // retourn le nombre de réservation
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT count(*) as NbResa FROM resa";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetch(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

//Ajoute une réservation
function SetRESERVATION($USER, $dateDEBUT, $noheb, $codeEtatResa, $dateRESA, $dateARRHES, $montantARRHES, $nbOCCUP, $tarifSEM)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "INSERT INTO resa VALUES(NORESA,?,?,?,?,?,?,?,?,?)";
		$sth = $link->prepare($req);
		$sth->execute([$USER, $dateDEBUT, $noheb, $codeEtatResa, $dateRESA, $dateARRHES, $montantARRHES, $nbOCCUP, $tarifSEM]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {

			disconnectDB($link);
			return true;
		}
	}
}

//Récupération des réservation pour un utilisateur 
function GetRESAwhereUSER($USER)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * from resa WHERE USER = ?";
		$sth = $link->prepare($req);
		$sth->execute([$USER]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {

			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

//Récupération des réservation pour un hebergement 
function GetRESAwhereHEB($NOHEB)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * from resa WHERE NOHEB = ?";
		$sth = $link->prepare($req);
		$sth->execute([$NOHEB]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

//valide un payment (augmente le code de la réservation et ajoute la date de payment des ARRHES)
function SetPAYEMENT($dateDebSem, $USER, $NOHEB)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "UPDATE resa SET CODEETATRESA=2, DATEARRHES=? WHERE DATEDEBSEM = ? and USER = ? and NOHEB = ? ";
		$sth = $link->prepare($req);
		$sth->execute([$datenow, $dateDebSem, $USER, $NOHEB]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {

			disconnectDB($link);
			return True;
		}
	}
}

//Récupération du dernier Numéro de réservation 
function LastIDinsertRESA()
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "SELECT MAX(NORESA) NORESA FROM resa ";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$tab = $sth->fetch(PDO::FETCH_ASSOC);

			disconnectDB($link);
			return $tab;
		}
	}
}

//Récupération du nom l'état d'une réservation
function GetNomEtatResa($NORESA)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "SELECT NOMETATRESA FROM resa INNER JOIN etat_resa ON resa.CODEETATRESA = etat_resa.CODEETATRESA WHERE NORESA = ?";
		$sth = $link->prepare($req);
		$sth->execute([$NORESA]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$tab = $sth->fetch(PDO::FETCH_ASSOC);

			disconnectDB($link);
			return $tab;
		}
	}
}

//Récupération de tout les état de réservation
function GetALLEtatResa()
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "SELECT  * FROM etat_resa ORDER BY CODEETATRESA ASC";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

			disconnectDB($link);
			return $tab;
		}
	}
}

//annule une réservation
function AnnuleRESA($NORESA)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "UPDATE resa SET CODEETATRESA = 5 WHERE NORESA = ? ";
		$sth = $link->prepare($req);
		$sth->execute([$NORESA]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {

			disconnectDB($link);
			return True;
		}
	}
}

//Récupération de toute les réservation
function GetAllResa()
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "SELECT * FROM resa ORDER BY NORESA ASC ";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

			disconnectDB($link);
			return $tab;
		}
	}
}

//Récupération de toute les réservation en fonction de leurs état
function GetResaWhereCODE($codeETAT)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "SELECT * FROM resa WHERE CODEETATRESA = ? ORDER BY NORESA ASC ";
		$sth = $link->prepare($req);
		$sth->execute([$codeETAT]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$tab = $sth->fetchAll(PDO::FETCH_ASSOC);

			disconnectDB($link);
			return $tab;
		}
	}
}

//modifie l'état d'une réservation
function UpdateEtatResa($NORESA, $codeEtat)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "UPDATE resa SET CODEETATRESA = ? WHERE NORESA = ?";
		$sth = $link->prepare($req);
		$sth->execute([$codeEtat, $NORESA]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			disconnectDB($link);
			return True;
		}
	}
}
// FIN FONCTION RESERVATION //

// FONCTION GESTION - UTILE //
//Calcule d'un pourcentage
function cacul_pourcentage($nombre, $total, $pourcentage)
{
	$resultat = ($nombre / $total) * $pourcentage;
	return $resultat;
}

//Récupération des nom et prénom pour un user 
function GetNameWhereUser($USER)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$datenow = date("Y-m-d");
		$req = "SELECT NOMCPTE, PRENOMCPTE FROM compte WHERE USER = ? ";
		$sth = $link->prepare($req);
		$sth->execute([$USER]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$tab = $sth->fetch(PDO::FETCH_ASSOC);

			disconnectDB($link);
			return $tab;
		}
	}
}

//ajouter dans un fichier une log de connexion
function Log_connexion($idUSER, $user)
{
	$fichier2 = fopen("log-connexion.txt", "a");
	$dt = new DateTime("now", new DateTimeZone("Europe/Paris"));

	$date =  $dt->format('d/m/Y');
	$heure =  $dt->format('H');
	$minute =  $dt->format('i');
	$seconde =  $dt->format('s');

	$d = "[" . $date . " à " . $heure . "H" . $minute . "m" . $seconde . "s] ";
	$compte = "[User:" . $idUSER . " / Name:" . $user['NOMCPTE'] . " / Firstname:" . $user['PRENOMCPTE'] . "];";
	$string = $d . utf8_encode($compte);
	if (fwrite($fichier2,  "\n" . $string)) {
		fclose($fichier2);
		return True;
	} else {
		return False;
	};
}

//retourn si la chaine et null ou que des aspace
function IsNullOrEmptyString($str)
{
	return (!isset($str) || trim($str) === '');
}
// FIN FONCTION GESTION - UTILE //

// FONCTION DATE // 
//Récupération de toute les date de la table semaine
function GetALLDates()
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT * from semaine ";
		$sth = $link->query($req);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchALL(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

//Récupération des date deja réservé pour un herbergement
function GetDatesWhereIDHeb($noheb)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT DATEDEBSEM from resa WHERE NOHEB = ? and CODEETATRESA NOT IN (5,6);";
		$sth = $link->prepare($req);
		$sth->execute([$noheb]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {
			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetchALL(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

//Retourne le tableau de toute les date sans les semaine deja réservé
function GetDatesACTIF($noheb)
{
	$tab = GetDatesWhereIDHeb($noheb); // tableau des date deja réservé pour un hebergement donné
	$arrayDATEaSUPR = [];

	if (isset($tab)) {
		foreach ($tab as $key => $value) {
			array_push($arrayDATEaSUPR, $value['DATEDEBSEM']);
		}
	}

	$allDATE = GetALLDates(); // retourne toute les date de la table semaine
	$arrayALLDATE = [];
	if (isset($allDATE)) {
		foreach ($allDATE as $key => $value) {
			array_push($arrayALLDATE, $value['DATEDEBSEM']);
		}
	}

	$dateACTIF = [];
	$result = array_diff($arrayALLDATE, $arrayDATEaSUPR);

	foreach ($result as $cle => $date) { // on retire les date avant la date du jour
		if (date("Y-m-d") > $date) {
			unset($result[$cle]);
		}
	}

	foreach ($result as $key => $value) { // on range le tableau en remettant les clé a 0
		array_push($dateACTIF, $value);
	}
	return $dateACTIF;
}

//Retourne la date de fin pour une date de début donné
function GetDatesENDWhereDATEdeb($dateDEBUT)
{
	$link = connectDB();
	if (!$link) {
		return null;
	} else {
		$req = "SELECT DATEFINSEM from semaine WHERE DATEDEBSEM = ?";
		$sth = $link->prepare($req);
		$sth->execute([$dateDEBUT]);
		if (!$sth) {
			echo $link->errorInfo();
			return null;
		} else {

			$nblignes = $sth->rowCount();
			if ($nblignes > 0) {
				$tab = $sth->fetch(PDO::FETCH_ASSOC);

				disconnectDB($link);
				return $tab;
			} else {
				return null;
			}
		}
	}
}

// FIN FONCTION DATE //





