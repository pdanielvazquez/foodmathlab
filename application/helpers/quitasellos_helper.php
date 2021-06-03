<?php
function QuitaSelloAzucar($GT,$GTRANS,$GSAT, $CHO,$Azucar, $Proteina,$Fibra,$Optional_Dec)
{
    $SelloGrasaTrans = False;
    $SelloEnergia=False;
    $SelloTrans=False;
    $SelloSat=False;
    $SelloGrasaSat = False;
    $oCHO = $CHO - $Azucar;
    $grasatotal=(9.0 * $GT);
    $carbohidrato=(4.0 * ($Azucar + $oCHO));
    $proteina=(4.0 * $Proteina);
    $fibra=(2.0 * $Fibra);
    $Energia=0.1 * ($grasatotal+$carbohidrato+$proteina+$fibra);
    $CuatroA=(4.0*$Azucar); 

    $CantEnergia = 0;
    $CantGrasaTrans = 0;
    $CantGrasaSat = 0;
    $CantGrasaTRans = 0;
    while( $CuatroA >= $Energia) {
                $Azucar=$Azucar - $Optional_Dec;
                
                $grasatrans=(9.0 * $GT);
                $carbohidrato=(4.0 * ($Azucar + $oCHO));
                $proteina=(4.0 * $Proteina);
                $fibra=(2.0 * $Fibra);
                
                $Energia=0.1 * ($grasatotal+$carbohidrato+$proteina+$fibra);
                $CuatroA=(4.0*$Azucar);
                
               if(($Energia*10) <= 275 && $SelloEnergia != True)
                {
                           $CantEnergia = ($Energia*10);
                           $SelloEnergia = True;
                }
               if( ((9.0*$GTRANS) <= (0.1*$Energia)) && $SelloGrasaTrans !=True)
                {
                            $CantGrasaTrans = $GTRANS;
                            $SelloGrasaTrans = True;
                }
               
               if( ((9.0*$GSAT) <= (0.1*$Energia)) && $SelloGrasaTrans !=True)
                {
                            $CantGrasaSat = $GSAT;
                            $SelloGrasaSat = True;
                }


                //echo "<BR>$A  $Energia";
    }
    echo "Energia: $Energia<BR>";
    echo "Cantidad Energia Sello: $CantEnergia<BR>";
    echo "Cantidad Grasa Trans Sello: $CantGrasaTrans<BR>";
    echo "Cantidad Grasa Saturada Sello: $CantGrasaSat<BR>";
    echo "Azucar:  $Azucar<br>";
    
    return Array($Energia,$CantEnergia,$CantGrasaTrans,$CantGrasaSat,$Azucar);
}

function QuitaSelloGrasaSat($GT, $GTRANS,$GSAT,$CHO, $Proteina,$Fibra,$Optional_Dec)
{
    $SelloEnergia=False;
    $SelloTrans=False;
    $oG = $GT - $GSAT - $GTRANS;
    $pGSAT = ($GSAT * 100.0) / $GT;
    $pGTRANS = ($GTRANS * 100.0) / $GT;
    $poG = ($oG * 100.0) / $GT;
    /*echo "Otras Grasas:  $oG<BR>";
    echo "Otras p Grasas Saturadas:  $pGSAT<BR>";
    echo "Otras p Grasas Trans: $pGTRANS<BR>";
    echo "Otras p otras Grasas: $poG<BR>";*/


    $NueveGSAT = (9 * $GSAT);
    $NueveGrasa = (9 * ($GSAT+$GTRANS+$oG) );
    $Carbohidratos = (4 * $CHO);
    $CuatroProteina = (4 * $Proteina);
    $DosFibra = (2 * $Fibra);
    $Energia = $NueveGrasa + $Carbohidratos + $CuatroProteina + $DosFibra;
    while( $NueveGSAT >= (0.1*$Energia) ) {
        
        $GSAT = $GSAT - $Optional_Dec;
        
        $GT = ($GSAT * 100.0) / $pGSAT;
        $GTRANS = ($GT * $pGTRANS) / 100.0;
        $oG = ($GT * $poG) / 100.0;
  
   
        $oG = $GT - $GSAT - $GTRANS;
        $pGSAT = ($GSAT * 100.0) / $GT;
        $pGTRANS = ($GTRANS * 100.0) / $GT;
        $poG = ($oG * 100.0) / $GT;

        $NueveGSAT = (9 * $GSAT);
        $NueveGrasa = (9 * ($GSAT+$GTRANS+$oG) );
        $Carbohidratos = (4 * $CHO);
        $CuatroProteina = (4 * $Proteina);
        $DosFibra = (2 * $Fibra);
        $Energia = $NueveGrasa + $Carbohidratos + $CuatroProteina + $DosFibra;
        //echo "$Energia   <BR>";
        if( ($Energia <= 275) && ($SelloEnergia != True) )
           {
             $CantEnergia = $Energia;
             $SelloEnergia = True;
           }
        if( ((9.0*$GTRANS) <= (0.1*$Energia)) && $SelloGrasaTrans !=True)
           {
             $CantGrasaTrans = $GTRANS;
             $SelloGrasaTrans = True;
          }
    }
    echo "Energia: $Energia<BR>";
    echo "Cantidad Energia Sello: $CantEnergia<BR>";
    echo "Cantidad Grasa Trans Sello: $CantGrasaTrans<BR>";
    echo "Grasas Totales $GT<BR>";
    echo "Grasa Saturada:  $GSAT";

    return Array($Energia,$CantEnergia,$CantGrasaTRans,$GSAT,$GT);
}


function QuitaSelloSodio($GT,$GSAT,$GTRANS,$CHO, $Sodio,$Proteina, $Fibra,$Optional_Dec)
{
    $oG = $GT - $GSAT - $GTRANS;
    $NueveGrasa = (9 * ($GSAT+$GTRANS+$oG) );
    $Carbohidratos = (4 * $CHO);
    $CuatroProteina = (4 * $Proteina);
    $DosFibra = (2 * $Fibra);
    //echo "$NueveGrasa  $Carbohidratos  $CuatroProteina  $DosFibra<BR>";
    $Energia = $NueveGrasa + $Carbohidratos + $CuatroProteina + $DosFibra;
    if ($Sodio >= 300) $Sodio = 299;
    if ($Sodio > $Energia) $Sodio=$Energia;
     //echo "Energia Inicial: $Energia"; 
    while( $Sodio >= $Energia) {
                $Sodio =$Sodio - $Optional_Dec;
    }
   return $Sodio;
}

function QuitaSelloEnergia($GT,$GTRANS,$GSAT, $CHO,$Azucar, $Proteina,$Fibra,$Optional_Dec)
{
	$oCHO = $CHO - $Azucar;
	$Energia = (9 * $GT)+(4 * ($Azucar+$oCHO) )+( 4 * $Proteina)+( 4 * $Fibra);
        // Porcentajes de Carbohidratos, Grasa Saturada, Grasa Total
        $PCHO=($Azucar/$CHO)*100;
        $PGS =($GSAT/ $GT)*100;
        $PGTRANS =($GTRANS/ $GT)*100;
        /*echo "$PCHO<BR>";
        echo "$PGS<BR>";
        echo "$PGTRANS<BR>";
        echo "$Energia<BR>";*/
	while ( $Energia >= 275)
	{
		 $GT = $GT - $Optional_Dec;
		 $Azucar=$Azucar - $Optional_Dec;
		 $oCHO = $CHO - $Azucar;
                 $Carbohidratos = $CHO/$PCHO;
                 $GrasaSat = $GSAT/$PGS;
                 $GrasaTrans = $GTRANS/$PGTRANS;
	         $Energia = (9*$GT)+(4*($Azucar+$oCHO))+(4*$Proteina)+(4*$Fibra);
                 //echo "Energia = $Energia<BR>";
	}
	return Array($GT,$Azucar,$Energia);
}