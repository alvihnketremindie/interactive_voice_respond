<?php

	$fichier = $_SERVER['argv'][1];
	$expe=$_SERVER['argv'][4];

	if (count($_SERVER['argv']) == 6)
	{
		$fichier_dedicace=$_SERVER['argv'][3].'&'.$_SERVER['argv'][3];
		$desti=$_SERVER['argv'][2];
		$idDedi =$_SERVER['argv'][5];
	}
	else
	{
		$fichier_dedicace=$_SERVER['argv'][3];
		$desti=$_SERVER['argv'][4];
	}

       if($handle = fopen($fichier,'a+'))
                {
                        #fwrite($handle, "Channel: DAHDI/g1/".$desti."\n");
			fwrite($handle, "Channel: SIP/".$desti."\n");
                        fwrite($handle, "Context: menu_accueil_dedicace\n");
                        fwrite($handle, "Extension: s\n");
			fwrite($handle, "Priority: 1\n");
                        fwrite($handle, "MaxRetries: 0\n");
                        fwrite($handle, "RetryTime: 12\n");
                        fwrite($handle, "WaitTime: 40\n");
                        fwrite($handle, "CallerID: fete_des_meres <98001>\n");
                        fwrite($handle, "Archive: Yes\n");
                        fwrite($handle, "Set: fichier_dedicace=".$fichier_dedicace."\n");
			fwrite($handle, "set: desti_dedicace=".$desti."\n");
			fwrite($handle, "set: expe_dedicace=".$expe."\n");
			fwrite($handle, "Set: idDedicace=".$idDedi."\n");
                        fclose ($handle);
                }
?>
