<?php


$dbi = mysqli_connect('localhost', 'root', 'digital', 'fete_des_meres');
if ($dbi)
{
	$req = "SELECT file_dedicace,numero_expe,numero_desti, id_envoiDedicace FROM envoiDedicace WHERE statut = 'NON_ENVOYE'";
	$sql = mysqli_query($dbi,$req);
	if($sql)
		{

			while($assoc = mysqli_fetch_assoc($sql))
				{
					envoi($assoc['file_dedicace'], $assoc['numero_expe'], $assoc['numero_desti'], $assoc['id_envoiDedicace']);
					$req = "UPDATE envoiDedicace SET statut = 'ENVOYE' WHERE id_envoiDedicace = '".$assoc['id_envoiDedicace']."'";
					mysqli_query($dbi,$req);	

				}
		}
		else
		{
						
			
		}	



}



function envoi($file_dedicace,$numero_expe,$numero_desti, $idDedi)
{
	$fichier = time().$numero_expe;
	if($handle = fopen("/var/spool/asterisk/outgoing/".$fichier.".call",'a+'))
	
	{
		#fwrite($handle, "Channel: DAHDI/g1/".$desti."\n");
                fwrite($handle, "Channel: SIP/".$numero_desti."\n");
                fwrite($handle, "Context: menu_accueil_dedicace\n");
                fwrite($handle, "Extension: s\n");
                fwrite($handle, "Priority: 1\n");
                fwrite($handle, "MaxRetries: 0\n");
                fwrite($handle, "RetryTime: 12\n");
                fwrite($handle, "WaitTime: 40\n");
                fwrite($handle, "CallerID: fete_des_meres <98001>\n");
                fwrite($handle, "Archive: Yes\n");
                fwrite($handle, "Set: fichier_dedicace=".$file_dedicace."\n");
                fwrite($handle, "set: desti_dedicace=".$numero_desti."\n");
                fwrite($handle, "set: expe_dedicace=".$numero_expe."\n");
                fwrite($handle, "Set: idDedicace=".$idDedi."\n");
                fclose ($handle);
	

         }       



}

?>
