<?php
include '../includes/config.php';
include '../includes/validateFunction.php';

$iBlokId = $_POST['blok_id'];
$sDatum = $_POST['datum'];
$sStartTijd = $_POST['start_tijd'];
$sEindTijd = $_POST['eind_tijd'];
$iPlekken = $_POST['plekken'];

# Valideer gegevens
if (isset($_POST['submit'])) {
    # Haal waardes binnen en valideer input d.m.v. functie
    $sNaam = validateInput($_POST['naam']);
    $sAdres = validateInput($_POST['adres']);
    $sPlaats = validateInput($_POST['plaats']);
    $iTelefoonnummer = validateInput($_POST['telefoonnummer']);
    $sEmail = validateInput($_POST['email']);

    # Zet lid op true wanneer hij aangevinkt is
    if (isset($_POST['lid'])) {
        $bLid = 1;
        $lidTekst = ' lid en voor u is het <strong>gratis.</strong>';
    } else {
        $bLid = 0;
        $lidTekst = ' helaas geen lid en dient <strong>€5.00</strong> op locatie te betalen.';
    }

    # Check voor errors en laat dan notificatie zien
    if (empty($sNaam) || empty($sAdres) || empty($sPlaats) || empty($iTelefoonnummer) || empty($sEmail)) {
        header('Location: ./index.php?signup=empty');
        exit;
    } else if (!is_numeric($iTelefoonnummer)) {
        header('Location: ./index.php?signup=number');
        exit;
    } else if (!is_string($sNaam) || !is_string($sAdres) || !is_string($sPlaats) || !is_string($sEmail)) {
        header('Location: ./index.php?signup=char');
        exit;
    } else if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
        header('Location: ./index.php?signup=email');
        exit;
    } else {

        $matchedQuery = mysqli_query($mysqli, "SELECT * FROM inschrijvingen WHERE email = '$sEmail'");

        # Inschrijving met die naam bestaat al
        if (mysqli_num_rows($matchedQuery) == 1) {
            $matchedRow = mysqli_fetch_array($matchedQuery);
            # Redirect naar evt. verwijder pagina
            header('Location:./ingeschreven.php?inschrijving_id=' . $matchedRow['inschrijving_id']);
        } else {
            # Geen errors -> opslaan in database en redirect terug
            header('Location: ../index.php?signup=success');
    
            $query = "INSERT INTO inschrijvingen(blok_id, naam, adres, plaats, telefoonnummer, email, lid)";
            $query .= "VALUES('$iBlokId', '$sNaam', '$sAdres', '$sPlaats', '$iTelefoonnummer', '$sEmail', '$bLid')";
        
            $minPlek = $iPlekken - 1;
            $queryBlokken = "UPDATE blokken SET plekken = '$minPlek' WHERE blok_id = '$iBlokId'";
    
            $result = mysqli_query($mysqli, $query);
            $resultBlokken = mysqli_query($mysqli, $queryBlokken);
    
            if ($result) {
                # Verstuur email
                $to = $sEmail;
                $subject = 'Inschrijving schaatsen voor blok ' . $iBlokId;
                $message = '<h1>Uw inschrijving voor schaatsen</h1>';
                $message .= '<p>Beste '. $sNaam .', </p><br/>' . '<p>Hierbij bevestigen wij uw inschrijving van blok ' . $iBlokId . '.</p>';
                $message .= '<p>Uw datum: ' . $sDatum . ' van '. $sStartTijd . ' tot ' . $sEindTijd . '</p>';
                $message .= '<p>U bent' . $lidTekst . '<p>';
                $message .= '<br/> <p>Wij hopen u snel te zien!</p>';
    
                $headers = 'From ftp84999' . "\r\n" . 'Reply-To: ftp84999' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
                mail($to, $subject, $message, $headers);
            }
        }
    }
}

?>