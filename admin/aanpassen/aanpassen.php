<?php
    include '../../includes/config.php';
    include '../../includes/session.php';
    include '../../includes/validateFunction.php';

     # Lees formuliervelden uit en valideer gegevens
    if(isset($_POST['submit'])) {
        $iBlokId = $_POST['blok_id'];
        $sDatum = validateInput($_POST['datum']);
        $sStartTijd = validateInput($_POST['start_tijd']);
        $sEindTijd = validateInput($_POST['eind_tijd']);
        $iPlekken = validateInput($_POST['plekken']);
    }

    # Check voor zichtbaar checkbox
    if (isset($_POST['zichtbaar'])) {
        $bZichtbaar = 1;
    } else {
        $bZichtbaar = 0;
    }

    # Check voor errors en laat dan notificatie zien
    if (empty($sDatum) || empty($sStartTijd) || empty($sEindTijd) || empty($iPlekken)) {
        header('Location: ./index.php?blok_id=' . $iBlokId . '&blok=empty');
        exit;
    } else if (!is_numeric($iPlekken)) {
        header('Location: ./index.php?blok_id=' . $iBlokId . '&blok=number');
        exit;
    } else if (!is_string($sDatum) || !is_string($sStartTijd) || !is_string($sEindTijd)) {
        header('Location: ./index.php?blok_id=' . $iBlokId .'&blok=char');
        exit;
    } else {
        $query = "UPDATE blokken SET datum = '$sDatum', start_tijd = '$sStartTijd', eind_tijd = '$sEindTijd', plekken = '$iPlekken', zichtbaar = '$bZichtbaar' WHERE blok_id = '$iBlokId'";
    
        $result = mysqli_query($mysqli, $query);
    
        if ($result) {
            header('Location:../overzicht.php?blok=aangepast&blok_id=' . $iBlokId . '');
        } else {
            header('Location:../overzicht.php?blok=aangepastFout');
        }
    }
?>