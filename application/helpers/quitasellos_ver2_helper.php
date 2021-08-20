<?php
function QuitaSelloAzucar($GT,$GTRANS,$GSAT, $CHO,$Azucar, $Proteina,$Fibra,$Optional_Dec,$Sodio)
{
    $SelloEnergia=False;
    $SelloTrans=False;
    $SelloGrasaSat=False;
    $SelloAzu=False;
    $oCHO = $CHO - $Azucar;
    $grasatotal=(9.0 * $GT);
    $carbohidrato=(4.0 * ($Azucar + $oCHO));
    $proteina=(4.0 * $Proteina);
    $fibra=(2.0 * $Fibra);
    $Energia=0.1 * ($grasatotal+$carbohidrato+$proteina+$fibra);
    $CuatroA=(4.0*$Azucar); 
    $i=0;
    $Matriz[$i][0]=$i;
    $Matriz[$i][1]=$Azucar;
    $Matriz[$i][2]=$Energia*10;
    $Matriz[$i][3]=4.0*$Azucar;
    $Matriz[$i][4]=$Energia;
    if ($CuatroA >= ($Energia))
       $Matriz[$i][6]=1;
    else $Matriz[$i][6]=0;
    if ($Matriz[$i][2] >= 275) 
       $Matriz[$i][7]=1;
    else $Matriz[$i][7]=0;
    if ((9.0*$GSAT)>=($Energia))
        $Matriz[$i][8]=1;
    else $Matriz[$i][8] =0;
    if((9.0*$GTRANS) >= ($Energia))
        $Matriz[$i][9]=1;
    else $Matriz[$i][9]=0;
    if(($Sodio >= 300) || (($Sodio/$Energia)>=1))
        $Matriz[$i][10]=1;
    else  $Matriz[$i][10]=0;
    $i++; 
    while( $CuatroA >= (0.10*$Energia)) {
                $Azucar=$Azucar - $Optional_Dec;
                
                $grasatrans=(9.0 * $GT);
                $carbohidrato=(4.0 * ($Azucar + $oCHO));
                $proteina=(4.0 * $Proteina);
                $fibra=(2.0 * $Fibra);
                
                $Energia=$grasatotal+$carbohidrato+$proteina+$fibra;
                $CuatroA=(4.0*$Azucar);
                 
               if($Energia >= 275 )
                {
                           //$CantEnergia = $Energia;
                           $SelloEnergia = True;
                }
               else $SelloEnergia = False;
               if ((9.0*$GTRANS) >= (0.1*$Energia)) 
                {
                            //$CantGrasaTrans = $GTRANS;
                            $SelloGrasaTrans = True;
                }
               else $SelloGrasaTrans=False; 
               if ((9.0*$GSAT) >= (0.1*$Energia)) 
                {
                            //$CantGrasaSat = $GSAT;
                            $SelloGrasaSat = True;
                }
                else $SelloGrasaSat=False;
                if(($Sodio>=300) || (($Sodio/$Energia)>=1))
                  $SelloSodio=True;
                else $SelloSodio=False;
                $Matriz[$i][0]=$i;
                $Matriz[$i][1]=$Azucar;
                $Matriz[$i][2]=$Energia;
                $Matriz[$i][3]=4.0*$Azucar;
                $Matriz[$i][4]=$Energia*0.10;
                if ($CuatroA >= (0.10*$Energia))
                   $Matriz[$i][6]=1;
                else
                   $Matriz[$i][6]=0;
                if ($SelloEnergia == False ) 
                   $Matriz[$i][7]=0; 
                else 
                   $Matriz[$i][7]=1;
                if ($SelloGrasaSat == False)
                   $Matriz[$i][8]=0;
                else
                   $Matriz[$i][8]=1;

                if ($SelloTrans == False)
                   $Matriz[$i][9]=0; 
                else 
                   $Matriz[$i][9]=1;
                if ($SelloSodio ==  False)
                   $Matriz[$i][10]=0;
                else 
                   $Matriz[$i][10]=1;
                $i++;
                   
    }
    
    tableA($Matriz);

    return $Azucar;
}

function QuitaSelloGrasaSat($Azucar, $GT, $GTRANS,$GSAT,$CHO, $Proteina,$Fibra,$Optional_Dec,$Sodio)
{
    $SelloEnergia=False;
    $SelloTrans=False;
    $oG = $GT - $GSAT - $GTRANS;
    $pGSAT = ($GSAT * 100.0) / $GT;
    $pGTRANS = ($GTRANS * 100.0) / $GT;
    $poG = ($oG * 100.0) / $GT;

     $Vector[0]=(100*$GSAT)/$GT;
    $Vector[1]=(100*$GTRANS)/$GT;
    $Vector[2]=(100*$oG)/$GT;
    $Vector[3]=$Vector[0]+$Vector[1]+$Vector[2];

    $NueveGSAT = (9 * $GSAT);
    $NueveGrasa = (9 * ($GSAT+$GTRANS+$oG) );
    $Carbohidratos = (4 * $CHO);
    $CuatroProteina = (4 * $Proteina);
    $DosFibra = (2 * $Fibra);
    $Energia = $NueveGrasa + $Carbohidratos + $CuatroProteina + $DosFibra;

    $i=0;
    $Matriz[$i][0]=$i;
    $Matriz[$i][1]=$GSAT;
    $Matriz[$i][2]=$GTRANS;
    $Matriz[$i][3]=$oG;
    $Matriz[$i][4]=$GT;
    $Matriz[$i][5]=$Energia;
    $Matriz[$i][6]=$NueveGSAT;
    $Matriz[$i][7]=$GTRANS*9.0;
    $Matriz[$i][8]=($Energia *0.1);
    $Matriz[$i][9]=9;
    $Matriz[$i][10]=10;
    
    $NueveGSAT = (9 * $GSAT);
    $NueveGrasa = (9 * ($GSAT+$GTRANS+$oG) );
    $Carbohidratos = (4 * $CHO);
    $CuatroProteina = (4 * $Proteina);
    $DosFibra = (2 * $Fibra);
    $Energia = $NueveGrasa + $Carbohidratos + $CuatroProteina + $DosFibra;
    if ((9.0*$GSAT)>=(0.1*$Energia))
        $Matriz[$i][11]=1;
    else $Matriz[$i][11] =0; 
    if((9.0*$GTRANS) >= (0.1*$Energia))
        $Matriz[$i][12]=1;
    else $Matriz[$i][12]=0;
    if ($Energia >= 275)
        $Matriz[$i][13]=1;
    else $Martiz[$i][13]=0;
    if ((4.0*$Azucar) >= (0.1*$Energia))
       $Matriz[$i][14]=1;
    else $Matriz[$i][14]=0;
    if (($Sodio >= 300) || (($Sodio/$Energia)>=1))
        $Matriz[$i][15]=1;
    else  $Matriz[$i][15]=0;
    $i++;

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
        if( ($Energia >= 275)  )
           {
             //$CantEnergia = $Energia;
             $SelloEnergia = True;
           }
        else $SelloEnergia = False;
        if ((9*$GTRANS) >= (0.1*$Energia)) 
           {
             //$CantGrasaTrans = $GTRANS;
             $SelloGrasaTrans = True;
          }
        else $SelloGrasaTrans = False;
        if ( (9*$GSAT) >= (0.1 * $Energia))
            $SelloGrasaSat = True;
        else $SelloGrasaSat = False;      
        if ( (4*$Azucar) >= (0.1 * $Energia))
            $SelloAzucar = True;
        else $SelloAzucar = False;
        if (($Sodio >= 300) || (($Sodio/$Energia)>=1))
            $SelloSodio = True;
        else $SelloSodio = False;

         $Matriz[$i][0]=$i;
         $Matriz[$i][1]=round($GSAT,1);
         $Matriz[$i][2]=round($GTRANSi,1);
         $Matriz[$i][3]=round($oG,1);
         $Matriz[$i][4]=round($GT,1);
         $Matriz[$i][5]=round($Energia,1);
         $Matriz[$i][6]=round($NueveGSAT,1);
         $Matriz[$i][7]=round($GTRANS*9,1);
         $Matriz[$i][8]=round($Energia *0.1,1);
         $Matriz[$i][9]=9;
         $Matriz[$i][10]=10;


        if ($SelloGrasaSat == False)
                   $Matriz[$i][11]=0;
                else
                   $Matriz[$i][11]=1;
        if ($SelloTrans == False)
                   $Matriz[$i][12]=0;
                else
                   $Matriz[$i][12]=1;
         if ($SelloEnergia == False )
              $Matriz[$i][13]=0;
                else
                   $Matriz[$i][13]=1;
        if ($SelloAzucar == False )
              $Matriz[$i][14]=0;
                else
                   $Matriz[$i][14]=1;

                if ($SelloSodio ==  False)
                   $Matriz[$i][15]=0;
                else
                   $Matriz[$i][15]=1;



    $i++;
         
    }
    tableG($Matriz,$Vector);
    return Array($GSAT,$GTRANS);
}


function QuitaSelloSodio($GT,$GSAT,$GTRANS,$CHO, $Sodio,$Proteina, $Fibra,$Optional_Dec)
{
    $i=0;
    $oG = $GT - $GSAT - $GTRANS;
    $NueveGrasa = (9 * ($GSAT+$GTRANS+$oG) );
    $Carbohidratos = (4 * $CHO);
    $CuatroProteina = (4 * $Proteina);
    $DosFibra = (2 * $Fibra);
    //echo "$NueveGrasa  $Carbohidratos  $CuatroProteina  $DosFibra<BR>";
    $Energia = $NueveGrasa + $Carbohidratos + $CuatroProteina + $DosFibra;
    //echo "La energía: $Energia";
    if ($Sodio >= 300 || $Sodio> $Energia) $SelloSodio = True;
    else $SelloSodio = False;
    $Matriz[$i][0]=$i;
    $Matriz[$i][1]=$Sodio;
    if ($SelloSodio == True) $Matriz[$i][2]=1;
    else $Matriz[$i][2]=0;
    $i++; 
    if ($Sodio >= 300) 
     {  
       $Sodio = 299;
       $Matriz[$i][0]=$i;
       $Matriz[$i][1]=$Sodio;
       if ($SelloSodio == True) $Matriz[$i][2]=1;
       else $Matriz[$i][2]=0;
       $i++;
     }
    if ($Sodio > $Energia)
     {
        
       $Sodio=$Energia;
       $Matriz[$i][0]=$i;
       $Matriz[$i][1]=$Sodio;
       if ($SelloSodio == True) $Matriz[$i][2]=1;
       else $Matriz[$i][2]=0;
       $i++;
     } 
     //echo "Energia Inicial: $Energia"; 
     while( $Sodio >= $Energia) {
                $Sodio =$Sodio - $Optional_Dec;
               if ($Sodio >= 300 || $Sodio> $Energia) $SelloSodio = True;
                else $SelloSodio = False;
               $Matriz[$i][0]=$i;
               $Matriz[$i][1]=$Sodio;
               if ($SelloSodio == True) $Matriz[$i][2]=1;
               else $Matriz[$i][2]=0;
               $i++;
 
    } 
   TableS($Matriz);
   return $Sodio;
}

function QuitaSelloEnergia($GT,$GTRANS,$GSAT, $CHO,$Azucar, $Proteina,$Fibra,$Optional_Dec)
{
        $i=0;
        $SelloEnergia = False;
        $SelloGSat = False;
        $SelloGTrans = False;
        $SelloAzucar = False;
        $SelloSodio = False;
    $oCHO = $CHO - $Azucar;
    $Energia = (9 * $GT)+(4 * ($Azucar+$oCHO) )+( 4 * $Proteina)+( 4 * $Fibra);
        // Porcentajes de Carbohidratos, Grasa Saturada, Grasa Total
        $PCHO=($Azucar/$CHO)*100;
        $PGS =($GSAT/ $GT)*100;
        $PGTRANS =($GTRANS/ $GT)*100;
        $Vector[0]=round($PCHO,2);
        $Vector[1]=round($PGS,2);
        $Vector[2]=round($PGTRANS,2);
        $Matriz[$i][0]=$i;
        $Matriz[$i][1]=$GT;
        $Matriz[$i][2]=$Azucar;
        $Matriz[$i][3]=$CHO;
        $Matriz[$i][4]=$GSAT;
        $Matriz[$i][5]=$GTRANS;
        $Matriz[$i][6]=$Energia;
        if($Energia >= 275) $SelloEnergia = True;
        else $SelloEnergia = False;
        
        if((9*$GSAT)>=(0.1*$Energia)) $SelloGSat = True;
        else $SelloGSat = False;
        
        if((9*$GTRANS) >= (0.1*$Energia)) $SelloGTrans = True;
        else $SelloGTrans = False;
        
        if((4*$Azucar) >= (0.1*$Energia) ) $SelloAzucar = True;
        else $SelloAzucar = False;

        if(($Sodio >= 300) || ($Sodio/$Energia)>=1) $SelloSodio= True;
        else $SelloSodio = False;

        if ($SelloEnergia == True) $Matriz[$i][7]=1;
        else $Matriz[$i][7]=0;
       
        if ($SelloGSat == True) $Matriz[$i][8]=1;
        else $Matriz[$i][8]=0;
  
        if ($SelloGTrans == True) $Matriz[$i][9]=1;
        else $Matriz[$i][9]=0;
        
        if ($SelloAzucar == True) $Matriz[$i][10]=1;
        else $Matriz[$i][10]=0; 

       if ($SelloSodio == True) $Matriz[$i][11]=1;
                 else $Matriz[$i][11]=0;


        $i++;
    while ( $Energia >= 275)
    {
         $GT = $GT - $Optional_Dec;
         $Azucar=$Azucar - $Optional_Dec;
                 $Carbohidratos =round((($Azucar/$PCHO)*100),1);
         //$oCHO = $CHO - $Azucar;
                 //$GSAT = $GSAT/$PGS;
                 $GSAT = round((($GT*$PGS)/100),1);
                 $GrasaTrans = $GTRANS/$PGTRANS;
             $Energia = (9*$GT)+(4*($Azucar+$oCHO))+(4*$Proteina)+(2*$Fibra);
                 //echo "<BR> $Energia";
                 $Matriz[$i][0]=$i;
                 $Matriz[$i][1]=$GT;
                 $Matriz[$i][2]=$Azucar;
                 $Matriz[$i][3]=$Carbohidratos;
                 $Matriz[$i][4]=$GSAT;
                 $Matriz[$i][5]=$GTRANS;
                 $Matriz[$i][6]=$Energia;
                 if($Energia >= 275) $SelloEnergia = True;
                 else $SelloEnergia = False;

                 if((9*$GSAT)>=(0.1*$Energia)) $SelloGSat = True;
                 else $SelloGSat = False;

                 if((9*$GTRANS) >= (0.1*$Energia)) $SelloGTrans = True;
                 else $SelloGTrans = False;

                 if((4*$Azucar) >= (0.1*$Energia) ) $SelloAzucar = True;
                 else $SelloAzucar = False;

                 if(($Sodio >= 300) || ($Sodio/$Energia)>=1) $SelloSodio= True;
                 else $SelloSodio = False;

                 if ($SelloEnergia == True) $Matriz[$i][7]=1;
                 else $Matriz[$i][7]=0;

                 if ($SelloGSat == True) $Matriz[$i][8]=1;
                  else $Matriz[$i][8]=0;

                 if ($SelloGTrans == True) $Matriz[$i][9]=1;
                 else $Matriz[$i][9]=0;

                 if ($SelloAzucar == True) $Matriz[$i][10]=1;
                 else $Matriz[$i][10]=0;

                 if ($SelloSodio == True) $Matriz[$i][11]=1;
                 else $Matriz[$i][11]=0;
                 $i++;

                 //echo "Energia = $Energia<BR>";
    }
        tableE($Matriz,$Vector);
    return $Energia;
}

function tableA($Matriz) 
{
//echo $Matriz;
$s.='<table id="example2" class="table table-bordered table-striped">';
$s.='<tr class="bg-secondary">';
$s.='<td colspan="6"></td>';
$s.='<td colspan="5"><center> SELLOS</center> </td>';
$s.='</tr>';


$s.='<tr>';
$s.='<td colspan="6"></td>';
$s.='<td>'. '4A >= 10% E' .'</td>';
$s.='<td>'. 'Energía >= 275' .'</td>';
$s.='<td>'. '9GS >= 10%E' .'</td>';
$s.='<td>'. '9TRANS >= 10% E' .'</td>';
$s.='<td>'. 'Sodio >= 300 mg' .'</td>';
$s.='</tr>';

$s.='<tr class="bg-secondary">'; 
$s.='<td>Iteración</td>';
$s.='<td>Azúcares</td>';
$s.='<td>Energía</td>';
$s.='<td>'. '4 Azúcar'.'</td>';
$s.='<td>'. '10% Energía' .'</td>';
$s.='<td>'.'4A >= 10%Energía'.'</td>';
$s.='<td>'. 'SELLO AZÚCAR' .'</td>';
$s.='<td>'. 'SELLO ENERGÍA' .'</td>';
$s.='<td>'. 'SELLO GRASA SAT' .'</td>';
$s.='<td>'. 'SELLO GRASA TRANS' .'</td>';
$s.='<td>'. 'SELLO SODIO' .'</td>';
$s.='</tr>';

$t=sizeof($Matriz);
for($i=0;$i<$t;$i++)
{
     
  $s.='<tr>'; 
  for($x=0;$x<=(count($Matriz[$i]));$x++)
  {
    if($x<5)
     { 
        $s .= '<td>'.$Matriz[$i][$x].'</td>';
     }
    if($x==5) 
     {
      
        if ( $Matriz[$i][3] >= $Matriz[$i][4])
           $s.='<td style="color:#ff0000">'.$Matriz[$i][3].'>='.$Matriz[$i][4].'</td>';
        else
           $s.='<td>'.$Matriz[$i][3].'<'.$Matriz[$i][4].'</td>';
      //  $s .= '<td>'.$Matriz[$i][$x].'</td>'; 
     }
     if($x>5)
      {
        if ( $Matriz[$i][$x] == 0)
            $s .= '<td bgcolor="green">'.$Matriz[$i][$x].'</td>';
        else
            $s .= '<td>'.$Matriz[$i][$x].'</td>';
      }
    }
  $s.='</tr>';
  
}
$s.='</table>';
echo $s;
}

function tableG($Matriz,$Vector) 
{
$s.='<table id="TableG" class="table table-bordered table-striped">';
$s.='<tr class="bg-secondary">';
$s.='<td colspan="11"></td>';
$s.='<td colspan="5"><center> SELLOS</center> </td>';
$s.='</tr>';


$s.='<tr>';
//$s.='<td colspan="11"></td>';

$s.='<td></td>';
$s.='<td>'.round($Vector[0],2).'%</td>';
$s.='<td>'.round($Vector[1],2).'%</td>';
$s.='<td>'.round($Vector[2],2).'%</td>';
$s.='<td>'.round($Vector[3],2).'%</td>';
$s.='<td colspan="6"></td>';
$s.='<td>'. '9GS >= 10%E' .'</td>';
$s.='<td>'. '9TRANS >= 10% E' .'</td>';
$s.='<td>'. 'Energía >= 275' .'</td>';
$s.='<td>'. '4A >= 10% E' .'</td>';
$s.='<td>'. 'Sodio >= 300 mg' .'</td>';
$s.='</tr>';



$s.='<tr class="bg-secondary">'; 
$s.='<td>Iteración</td>';
$s.='<td>'. 'GRASAS SAT' .'</td>';
$s.='<td>'. 'GRASAS TRANS' .'</td>';
$s.='<td>'. 'OTRAS GRASAS' .'</td>';
$s.='<td>'. 'GRASAS TOTALES' .'</td>';
$s.='<td>'. 'Energía'. '</td>';
$s.='<td>'. '9GS' . '</td>';
$s.='<td>'. '9GT' . '</td>';
$s.='<td>'. '10% Energìa' .'</td>';
$s.='<td>'. '9GS >= 10% Energìa' .'</td>';
$s.='<td>'. '9GT >= 10% Energìa' .'</td>';
$s.='<td>'. 'SELLO GRASA SAT' .'</td>';
$s.='<td>'. 'SELLO GRASA TRANS' .'</td>';
$s.='<td>'. 'SELLO ENERGIA' .'</td>';
$s.='<td>'. 'SELLO AZÚCAR' .'</td>';
$s.='<td>'. 'SELLO SODIO' .'</td>';
$s.='</tr>';

$t=sizeof($Matriz);
//$tam = sizeof($Matriz[0]);
//echo "El tamaño es $tam";
for($i=0;$i<$t;$i++)
{
     
  $s.='<tr>'; 
  for($x=0;$x<(count($Matriz[$i]));$x++)
  {
    if($x<9 && $x<10)
     { 
        $s .= '<td>'.$Matriz[$i][$x].'</td>';
     }
    if($x==9) 
     {
      
        if ( $Matriz[$i][6] >= $Matriz[$i][8])
           $s.='<td style="color:#ff0000">'.$Matriz[$i][6].'>='.$Matriz[$i][8].'</td>';
        else
           $s.='<td>'.$Matriz[$i][6].'<'.$Matriz[$i][8].'</td>';
      //  $s .= '<td>'.$Matriz[$i][$x].'</td>'; 
     }
      if($x==10)
     {

        if ( $Matriz[$i][7] >= $Matriz[$i][8])
           $s.='<td style="color:#ff0000">'.$Matriz[$i][7].'>='.$Matriz[$i][8].'</td>';
        else
           $s.='<td>'.$Matriz[$i][7].'<'.$Matriz[$i][8].'</td>';
      //  $s .= '<td>'.$Matriz[$i][$x].'</td>'; 
     }

     if($x>10)
      {
        if ( $Matriz[$i][$x] == 0)
            $s .= '<td bgcolor="green">'.$Matriz[$i][$x].'</td>';
        else
            $s .= '<td>'.$Matriz[$i][$x].'</td>';
      }
    }
  $s.='</tr>';
  
}
$s.='</table>';
echo $s;
}

function tableE($Matriz,$Vector) 
{
$s.='<table id="TableA" class="table table-bordered table-striped">';
$s.='<tr class="bg-secondary">';
$s.='<td colspan="6"></td>';
$s.='<td colspan="6"><center> SELLOS</center> </td>';
$s.='</tr>';


$s.='<tr>';
$s.='<td colspan="3"></td>';
$s.='<td>'. $Vector[0] .'%</td>';
$s.='<td>'. $Vector[1] .'%</td>';
$s.='<td>'. $Vector[2] .'%</td>';
$s.='<td></td>';
$s.='<td>'. 'Energìa >= 275' .'</td>';
$s.='<td colspan="4"></td>';
$s.='</tr>';

$s.='<tr class="bg-secondary">'; 
$s.='<td>Iteración</td>';
$s.='<td>'. 'Grasa' .'</td>';
$s.='<td>'.  'Azúcar' .'</td>';
$s.='<td>'. 'Carbohidratos' .'</td>';
$s.='<td>'. 'Grasa Sat' .'</td>';
$s.='<td>'.'Grasa Trans'.'</td>';
$s.='<td>'. 'Energía' .'</td>';
$s.='<td>'. 'SELLO ENERGÍA' .'</td>';
$s.='<td>'. 'SELLO GRASA SAT' .'</td>';
$s.='<td>'. 'SELLO GRASA TRANS' .'</td>';
$s.='<td>'. 'SELLO AZÚCAR' .'</td>';
$s.='<td>'. 'SELLO SODIO' .'</td>';
$s.='</tr>';


$t=sizeof($Matriz[0]);
//echo "El tamaño es: $t";
for($i=0;$i<$t;$i++)
{
     
  $s.='<tr>'; 
  for($x=0;$x<(count($Matriz[$i]));$x++)
  {
      if($x!=0) 
      {
        if ( $Matriz[$i][$x] == 0)
            $s .= '<td bgcolor="green">'.$Matriz[$i][$x].'</td>';
        else
            $s .= '<td>'.$Matriz[$i][$x].'</td>';
      }
      else
        $s .= '<td>'.$Matriz[$i][$x].'</td>';
 }
  $s.='</tr>';
} 
$s.='</table>';
echo $s;
}

function tableS($Matriz)
{
  $t=sizeof($Matriz);
  //echo "El tamaño es $t";
  $s.='<table id="TableA" class="table table-bordered table-striped">';
  $s.='<tr class="bg-secondary">';
  $s.='<td>Iteración</td>';
  $s.='<td>'. 'SODIO' .'</td>';
  $s.='<td>'.  'SELLO' .'</td>';
  $s.='</tr>';

  for($i=0;$i<$t;$i++)
   {
     
    $s.='<tr>'; 
    for($x=0;$x<(count($Matriz[$i]));$x++)
     {
      if($x!=0)
      {
        if ( $Matriz[$i][$x] == 0)
            $s .= '<td bgcolor="green">'.$Matriz[$i][$x].'</td>';
        else
            $s .= '<td>'.$Matriz[$i][$x].'</td>';
      }
      else 
        $s .= '<td>'.$Matriz[$i][$x].'</td>';
     }
    $s.='</tr>';
   }

$s.='</table>';
echo $s;
}
