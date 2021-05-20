<?php
 include '../../includes/config.php';
 include '../../includes/session.php';
 include '../../includes/validateFunction.php';

 # Lees formuliervelden uit en valideer gegevens
 if(isset($_POST['submit'])) {
     $sDatum = validateInput($_POST['datum']);
     $sStartTijd = validateInput($_POST['start_tijd']);
     $sEindTijd = validateInput($_POST['eind_tijd']);
     $iPlekken = validateInput($_POST['plekken']);

     # Check voor zichtbaar checkbox
    if (isset($_POST['zichtbaar'])) {
        $bZichtbaar = 1;
    } else {
        $bZichtbaar = 0;
    }

    # Check voor errors en laat dan notificatie zien
    if (empty($sDatum) || empty($sStartTijd) || empty($sEindTijd) || empty($iPlekken)) {
        header('Location: ./index.php?blok=empty');
        exit;
    } else if (!is_numeric($iPlekken)) {
        header('Location: ./index.php?blok=number');
        exit;
    } else if (!is_string($sDatum) || !is_string($sStartTijd) || !is_string($sEindTijd)) {
        header('Location: ./index.php?blok=char');
        exit;
    } else {
        $query = "INSERT INTO blokken (datum, start_tijd, eind_tijd, plekken, zichtbaar)";
        $query .= "VALUES ('$sDatum', '$sStartTijd', '$sEindTijd', '$iPlekken', '$bZichtbaar')";
    
        $result = mysqli_query($mysqli, $query);
    
        if ($result) {
            header('Location:../overzicht.php?blok=success');
        } else {
           header('Location:../overzicht.php?blok=failed');
        }
    }
 }
 
?>