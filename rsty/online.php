<?php
//useronline Skript!

    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                Online
            WHERE
                IP = '".$_SERVER['REMOTE_ADDR']."'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if($row['Anzahl']) {
        // Nur Datum Updaten
        $sql = "UPDATE
                    Online
                SET
                    Datum = NOW()
                WHERE
                    IP = '".$_SERVER['REMOTE_ADDR']."'";
        $mysqli->query($sql);
    } else {
	if($_GET["nickname"]!=""){
        // Neuer eintra
        $sql = "INSERT INTO Online
                    (IP, Datum,nick)
                VALUES
                    ('".$_SERVER['REMOTE_ADDR']."', NOW(), '".mysql_real_escape_string($_GET["nickname"])."')";
        $mysqli->query($sql);
     }
	}

    // alte Datensätze löschen
    $sql = "DELETE FROM
                Online
            WHERE
                DATE_SUB(NOW(), INTERVAL 2 MINUTE) > Datum";
    $mysqli->query($sql);

    // Anzahl Ausgeben
    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                Online";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if($ml==""){
	echo '
	<label posn="-62.2 16 5" style="TextTitleError">User Online :  '.$row['Anzahl'].'</label>
	';
	} else {
	$online=$row['Anzahl'];
	}