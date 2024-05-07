<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=RESERVATION;charset=utf8',
'root', 'system123',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
die('erreur : ' . $e->getMessage());
}
try{
    $date_choisie =$_POST['date'];
    $disponibilité = $db->prepare("SELECT COUNT(*) AS nombre_reservations FROM DETAILS_RESERVATION WHERE date = :date_choisie");
    $disponibilité->bindParam(':date_choisie', $date_choisie);
    $disponibilité->execute();
    $row = $disponibilité->fetch(PDO::FETCH_ASSOC);

    if ($row['nombre_reservations'] < 50){
        $requete_client=$db->prepare('INSERT INTO DETAILS_CLIENT VALUES(:nom,:email,:telephone)');
        $requete_client->execute(array('nom'=>$_POST['nom'],'email'=>$_POST['email'],'telephone'=>$_POST['telephone']));
        echo"Enregistrement CLIENT ajouté avec succès!";

        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $nombre = $_POST['nombre_personnes'];
        $preferences = $_POST['preferences'];
        $demandes = $_POST['demandes_speciales'];
        $occasion = $_POST['occasion_speciale'];
        $info = $_POST['message'];
        $requete_reservation=$db->prepare('INSERT INTO DETAILS_RESERVATION VALUES(:date, :heure, :nombre, :preferences, :demandes, :occasion, :info)');
        $requete_reservation->execute(array('date' => $date,'heure' => $heure,'nombre' => $nombre,'preferences' => $preferences,'demandes' => $demandes,'occasion' => $occasion,'info' => $info
        ));
        echo"Enregistrement RESERVATION ajouté avec succès!";
    }
    else{
        echo"La date choisie n'est plus disponibles pour de nouvelles réservations !";
    }
}
catch (Exception $e) {
    echo "Une erreur s'est produite: " . $e->getMessage();
}

?>
