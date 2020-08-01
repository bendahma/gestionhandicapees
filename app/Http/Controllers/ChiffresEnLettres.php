<?php

namespace App\Http\Controllers;

class ChiffreEnLettresArb
{
	private $number;
	private $sex;
	function __construct($number, $sex)
	{
		$this->number=$number;
		$this->sex=$sex;
	}
	
	public function convert_number()
	{
		$number=$this->number;
		$return = "";
		$english_format_number = number_format($number);
		$array_number=explode(',', $english_format_number);
		//convert each number(hundred) to arabic
		for($i=0; $i<count($array_number); $i++){
			$place=count($array_number) - $i;
			$return .= $this->convert($array_number[$i], $place);
			if(isset($array_number[($i + 1)]) && $array_number[($i + 1)]>0)  $return .= ' و';
		}
		return $return;
	}
	private function convert($number, $place){
		// take in charge the sex of NUMBERED
		$sex=$this->sex;
		//the number word in arabic for masculine and feminine
		$words = array(
			'male'=>array(
				'0'=> '' ,'1'=> 'واحد' ,'2'=> 'اثنان' ,'3' => 'ثلاثة','4' => 'أربعة','5' => 'خمسة',
				'6' => 'ستة','7' => 'سبعة','8' => 'ثمانية','9' => 'تسعة','10' => 'عشرة',
				'11' => 'أحد عشر','12' => 'اثنا عشر','13' => 'ثلاثة عشر','14' => 'أربعة عشر','15' => 'خمسة عشر',
				'16' => 'ستة عشر','17' => 'سبعة عشر','18' => 'ثمانية عشر','19' => 'تسعة عشر','20' => 'عشرون',
				'30' => 'ثلاثون','40' => 'أربعون','50' => 'خمسون','60' => 'ستون','70' => 'سبعون',
				'80' => 'ثمانون','90' => 'تسعون', '100'=>'مئة', '200'=>'مئتان', '300'=>'ثلاثمئة', '400'=>'أربعمئة', '500'=>'خمسمئة',
				'600'=>'ستمئة', '700'=>'سبعمئة', '800'=>'ثمانمئة', '900'=>'تسعمئة'
			),
			'female'=>array(
				'0'=> '' ,'1'=> 'واحدة' ,'2'=> 'اثنتان' ,'3' => 'ثلاث','4' => 'أربع','5' => 'خمس',
				'6' => 'ست','7' => 'سبع','8' => 'ثمان','9' => 'تسع','10' => 'عشر',
				'11' => 'إحدى عشرة','12' => 'ثنتا عشرة','13' => 'ثلاث عشرة','14' => 'أربع عشرة','15' => 'خمس عشرة',
				'16' => 'ست عشرة','17' => 'سبع عشرة','18' => 'ثمان عشرة','19' => 'تسع عشرة','20' => 'عشرون',
				'30' => 'ثلاثون','40' => 'أربعون','50' => 'خمسون','60' => 'ستون','70' => 'سبعون',
				'80' => 'ثمانون','90' => 'تسعون', '100'=>'مئة', '200'=>'مئتان', '300'=>'ثلاثمئة', '400'=>'أربعمئة', '500'=>'خمسمئة',
				'600'=>'ستمئة', '700'=>'سبعمئة', '800'=>'ثمانمئة', '900'=>'تسعمئة'
			)
		);
		//take in charge the different way of writing the thousands and millions ...
		$mil = array(
			'2'=>array('1'=>'ألف', '2'=>'ألفان', '3'=>'آلاف'), 
			'3'=>array('1'=>'مليون', '2'=>'مليونان', '3'=>'ملايين'),
			'4'=>array('1'=>'مليار', '2'=>'ملياران', '3'=>'مليارات')
		);
		
		$mf = array('1'=>$sex, '2'=>'male', '3'=>'male', '4'=>'male');
		$number_length = strlen((string)$number);
		if($number == 0) return '';
		else if($number[0]==0){
			if($number[1]==0) $number=(int)substr($number, -1);
			else $number=(int)substr($number, -2);
		}
		 switch($number_length){
			case '1': {
				switch($place){
					case '1':{
						$return = $words[$mf[$place]][$number];
					}
					break;
					case '2':{
						
						if($number==1) $return = 'ألف';
						else if($number==2) $return = 'ألفان';
						else{
							$return = $words[$mf[$place]][$number]. ' آلاف';
						}
					}
					break;
					case '3':{
						if($number==1) $return = 'مليون';
						else if($number==2) $return = 'مليونان';
						else $return = $words[$mf[$place]][$number]. ' ملايين';
					}
					break;
					case '4':{
						if($number==1) $return = 'مليار';
						else if($number==2) $return = 'ملياران';
						else $return = $words[$mf[$place]][$number]. ' مليارات';
					}
					break;
				}
			}
			break;
			case '2': {
				if(isset($words[$mf[$place]][$number])) $return = $words[$mf[$place]][$number];
				else{
					$twoy=$number[0] * 10;
					$ony=$number[1];
					$return = $words[$mf[$place]][$ony].' و'.$words[$mf[$place]][$twoy];
				}
				switch($place){
					case '2':{
						$return .= ' ألف';
					}
					break;
					case '3':{
						$return .= ' مليون';
					}
					break;
					case '4':{
						$return .= ' مليار';
					}
					break;
				}
			}
			break;
			case '3':{
				if(isset($words[$mf[$place]][$number])){ 
					$return = $words[$mf[$place]][$number];
					if($number == 200) $return = 'مئتا';
					switch($place){
							case '2':{
								$return .= ' ألف';
							}
							break;
							case '3':{
								$return .= ' مليون';
							}
							break;
							case '4':{
								$return .= ' مليار';
							}
							break;
						}
						return $return;
				}
				else{
					$threey=$number[0] * 100;
					if(isset($words[$mf[$place]][$threey])){
						$return = $words[$mf[$place]][$threey];
					}
					$twoyony=$number[1] * 10 + $number[2];
					if($twoyony==2){
						switch($place){
							case '1': $twoyony=$words[$mf[$place]]['2']; break;
							case '2': $twoyony='ألفان'; break;
							case '3': $twoyony='مليونان'; break;
							case '4': $twoyony='ملياران'; break;
						}
						if($threey!=0){
							$twoyony='و'.$twoyony;
						}
						$return = $return.' '.$twoyony;
					}
					else if($twoyony==1){
						switch($place){
							case '1': $twoyony=$words[$mf[$place]]['1']; break;
							case '2': $twoyony='ألف'; break;
							case '3': $twoyony='مليون'; break;
							case '4': $twoyony='مليار'; break;
						}
						if($threey!=0){
							$twoyony='و'.$twoyony;
						}
						$return = $return.' '.$twoyony;
					}
					
					else{
						if(isset($words[$mf[$place]][$twoyony])) $twoyony = $words[$mf[$place]][$twoyony];
						else{
							$twoy=$number[1] * 10;
							$ony=$number[2];
							$twoyony = $words[$mf[$place]][$ony].' و'.$words[$mf[$place]][$twoy];
						}
						if($twoyony!='' && $threey!=0) $return= $return.' و'.$twoyony;
						switch($place){
							case '2':{
								$return .= ' ألف';
							}
							break;
							case '3':{
								$return .= ' مليون';
							}
							break;
							case '4':{
								$return .= ' مليار';
							}
							break;
						}
					}	
				}
			}
			break;
		}
		return $return;
	}
}


class ChiffreEnLettres
{
//NE GERE PAS TOUT (les pluriels...)
#Variables
public $leChiffreSaisi;
public $enLettre='';
public $chiffre=array(1=>"un",2=>"deux",3=>"trois",4=>"quatre",5=>"cinq",6=>"six",7=>"sept",8=>"huit",9=>"neuf",10=>"dix",11=>"onze",12=>"douze",13=>"treize",14=>"quatorze",15=>"quinze",16=>"seize",17=>"dix-sept",18=>"dix-huit",19=>"dix-neuf",20=>"vingt",30=>"trente",40=>"quarante",50=>"cinquante",60=>"soixante",70=>"soixante-dix",80=>"quatre-vingt",90=>"quatre-vingt-dix");


#Fonction de conversion appelée dans la feuille principale
public function Conversion($sasie)
{
$this->enLettre='';
$sasie=trim($sasie);

#suppression des espaces qui pourraient exister dans la saisie
$nombre='';
$laSsasie=explode(' ',$sasie);
foreach ($laSsasie as $partie)
$nombre.=$partie;

#suppression des zéros qui précéderaient la saisie
$nb=strlen($nombre);
for ($i=0;$i<=$nb;)
{
if(substr($nombre,$i,1)==0)
{
$nombre=substr($nombre,$i+1);
$nb=$nb-1;
}
elseif(substr($nombre,$i,1)<>0)
{
$nombre=substr($nombre,$i);
break;
}
}
#echo $nombre;
#$this->SupZero($nombre);
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($nombre);
#echo $nb.'<br/ >';
#$this->leChiffreSaisi=$nombre;
#conversion du chiffre saisi en lettre selon les cas
switch ($nb)
{
case 0:
$this->enLettre='zéro';
case 1:
if ($nombre==0)
{
$this->enLettre='zéro';
break;
}
elseif($nombre<>0)
{
$this->Unite($nombre);
break;
}

case 2:
$unite=substr($nombre,1);
$dizaine=substr($nombre,0,1);
$this->Dizaine(0,$nombre,$unite,$dizaine);
break;

case 3:
$unite=substr($nombre,2);
$dizaine=substr($nombre,1,1);
$centaine=substr($nombre,0,1);
$this->Centaine(0,$nombre,$unite,$dizaine,$centaine);
break;

#cas des milles
case ($nb>3 and $nb<=6):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,0,($nb-3));
$this->Mille($nombre,$unite,$dizaine,$centaine,$mille);
break;

#cas des millions
case ($nb>6 and $nb<=9):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,-6);
$million=substr($nombre,0,$nb-6);
$this->Million($nombre,$unite,$dizaine,$centaine,$mille,$million);
break;

#cas des milliards
/*case ($nb>9 and $nb<=12):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,-6);
$million=substr($nombre,-9);
$milliard=substr($nombre,0,$nb-9);
Milliard($nombre,$unite,$dizaine,$centaine,$mille,$million,$milliard);
break;*/

}
if (!empty($this->enLettre))
	return $this->enLettre;
}

#Gestion des miiliards
/*
function Milliard($nombre,$unite,$dizaine,$centaine,$mille,$million,$milliard)
{

}
*/

#Gestion des millions

function Million($nombre,$unite,$dizaine,$centaine,$mille,$million)
{
#si les mille comportent un seul chiffre
#$cent represente les 3 premiers chiffres du chiffre ex: 321 dans 12502321
#$mille represente les 3 chiffres qui suivent les cents ex: 502 dans 12502321
#reste represente les 6 premiers chiffres du chiffre ex: 502321 dans 12502321

$cent=substr($nombre,-3);
$reste=substr($nombre,-6);

if (strlen($million)==1)
{
$mille=substr($nombre,1,3);
$this->enLettre.=$this->chiffre[$million];
	if ($million == 1){
		$this->enLettre.=' million ';
	}else{
		$this->enLettre.=' millions ';
	}
}
elseif (strlen($million)==2)
{
$mille=substr($nombre,2,3);
$nombre=substr($nombre,0,2);
//echo $nombre;
$this->Dizaine(0,$nombre,$unite,$dizaine);
$this->enLettre.='millions ';
}
elseif (strlen($million)==3)
{
$mille=substr($nombre,3,3);
$nombre=substr($nombre,0,3);
$this->Centaine(0,$nombre,$unite,$dizaine,$centaine);
$this->enLettre.='millions ';
}

#recuperation des cens dans nombre

#suppression des zéros qui précéderaient le $reste
$nb=strlen($reste);
for ($i=0;$i<=$nb;)
{
if(substr($reste,$i,1)==0)
{
$reste=substr($reste,$i+1);
$nb=$nb-1;
}
elseif(substr($reste,$i,1)<>0)
{
$reste=substr($reste,$i);
break;
}
}
$nb=strlen($reste);
#si tous les chiffres apres les milions =000000 on affiche x million
if ($nb==0)
;
else
{
#Gestion des milles
#suppression des zéros qui précéderaient les milles dans $mille
$nb=strlen($mille);
for ($i=0;$i<=$nb;)
{
if(substr($mille,$i,1)==0)
{
$mille=substr($mille,$i+1);
$nb=$nb-1;
}
elseif(substr($mille,$i,1)<>0)
{
$mille=substr($mille,$i);
break;
}
}
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($mille);
#echo '<br />nb='.$nb.'<br />';
if ($nb==0)
;
#AffichageResultat($enLettre);
elseif ($nb==1)
{
if ($mille==1)
$this->enLettre.='mille ';
else
{
$this->Unite($mille);
$this->enLettre.='mille ';
}
}
elseif ($nb==2)
{
$this->Dizaine(1,$mille,$unite,$dizaine);
$this->enLettre.='mille ';
}
elseif ($nb==3)
{
$this->Centaine(1,$mille,$unite,$dizaine,$centaine);
$this->enLettre.='mille ';
}
#Gestion des cents
#suppression des zéros qui précéderaient les cents dans $cent
$nb=strlen($cent);
for ($i=0;$i<=$nb;)
{
if(substr($cent,$i,1)==0)
{
$cent=substr($cent,$i+1);
$nb=$nb-1;
}
elseif(substr($cent,$i,1)<>0)
{
$cent=substr($cent,$i);
break;
}
}
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($cent);
#echo '<br />nb='.$nb.'<br />';
if ($nb==0)
;
#AffichageResultat($enLettre);
elseif ($nb==1)
$this->Unite($cent);
elseif ($nb==2)
$this->Dizaine(0,$cent,$unite,$dizaine);
elseif ($nb==3)
$this->Centaine(0,$cent,$unite,$dizaine,$centaine);
}
}

#Gestion des milles

function Mille($nombre,$unite,$dizaine,$centaine,$mille)
{
#si les mille comportent un seul chiffre
#$cent represente les 3 premiers chiffres du chiffre ex: 321 dans 12321
if (strlen($mille)==1)
{
$cent=substr($nombre,1);
#si ce chiffre=1
if ($mille==1)
$this->enLettre.='';
#si ce chiffre<>1
elseif($mille<>1)
$this->enLettre.=$this->chiffre[$mille];
}
elseif (strlen($mille)>1)
{
if (strlen($mille)==2)
{
$cent=substr($nombre,2);
$nombre=substr($nombre,0,2);
#echo $nombre;
$this->Dizaine(1,$nombre,$unite,$dizaine);
}
if (strlen($mille)==3)
{
$cent=substr($nombre,3);
$nombre=substr($nombre,0,3);
#echo $nombre;
$this->Centaine(1,$nombre,$unite,$dizaine,$centaine);
}
}

$this->enLettre.='mille ';
#recuperation des cens dans nombre
#suppression des zéros qui précéderaient la saisie
$nb=strlen($cent);
for ($i=0;$i<=$nb;)
{
if(substr($cent,$i,1)==0)
{
$cent=substr($cent,$i+1);
$nb=$nb-1;
}
elseif(substr($cent,$i,1)<>0)
{
$cent=substr($cent,$i);
break;
}
}
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($cent);
#echo '<br />nb='.$nb.'<br />';
if ($nb==0)
;//AffichageResultat($enLettre);
elseif ($nb==1)
$this->Unite($cent);
elseif ($nb==2)
$this->Dizaine(0,$cent,$unite,$dizaine);
elseif ($nb==3)
$this->Centaine(0,$cent,$unite,$dizaine,$centaine);

}

#Gestion des centaines

function Centaine($inmillier,$nombre,$unite,$dizaine,$centaine)
{

$unite=substr($nombre,2);
$dizaine=substr($nombre,1,1);
$centaine=substr($nombre,0,1);
#comme 700
if ($unite==0 and $dizaine==0)
{
if ($centaine==1)
$this->enLettre.='cent';
elseif ($centaine<>1)
		{
				if ($inmillier == 0)
					$this->enLettre.=($this->chiffre[$centaine].' cents').' ';
				if ($inmillier == 1)
					$this->enLettre.=($this->chiffre[$centaine].' cent').' ';
		}
}
#comme 705
elseif ($unite<>0 and $dizaine==0)
{
if ($centaine==1)
$this->enLettre.=('cent '.$this->chiffre[$unite]).' ';
elseif ($centaine<>1)
$this->enLettre.=($this->chiffre[$centaine].' cent '.$this->chiffre[$unite]).' ';
}
//comme 750
elseif ($unite==0 and $dizaine<>0)
{
#recupération des dizaines
$nombre=substr($nombre,1);
//echo '<br />nombre='.$nombre.'<br />';
if ($centaine==1)
{
$this->enLettre.='cent ';
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
}
elseif ($centaine<>1)
{
$this->enLettre.=$this->chiffre[$centaine].' cent ';
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';

}

}
#comme 695
elseif ($unite<>0 and $dizaine<>0)
{
$nombre=substr($nombre,1);

if ($centaine==1)
{
$this->enLettre.='cent ';
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
}

elseif ($centaine<>1)
{
$this->enLettre.=($this->chiffre[$centaine].' cent ');
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
}
}

}


#Gestion des dizaines

function Dizaine($inmillier,$nombre,$unite,$dizaine)
{
$unite=substr($nombre,1);
$dizaine=substr($nombre,0,1);

#comme 70
if ($unite==0)
{
$val=$dizaine.'0';
$this->enLettre.=$this->chiffre[$val];
		if ($inmillier == 0 && $val == 80){
			$this->enLettre.='s ';
		}
		$this->enLettre.=' ';
}
#comme 71
elseif ($unite<>0)
#dizaine different de 9
if ($dizaine<>9 and $dizaine<>7)
{
if ($dizaine==1)
{
$val=$dizaine.$unite;
$this->enLettre.=$this->chiffre[$val].' ';
}
else
{
$val=$dizaine.'0';
if ($unite == 1 && $dizaine <> 8){
$this->enLettre.=($this->chiffre[$val].' et '.$this->chiffre[$unite]).' ';
}else{
$this->enLettre.=($this->chiffre[$val].'-'.$this->chiffre[$unite]).' ';
}
}
}
#dizaine =9
elseif ($dizaine==9)
$this->enLettre.=($this->chiffre[80].'-'.$this->chiffre['1'.$unite]).' ';
elseif ($dizaine==7)
{
if ($unite == 1){
	$this->enLettre.=($this->chiffre[60].' et '.$this->chiffre['1'.$unite]).' ';
}else{
	$this->enLettre.=($this->chiffre[60].'-'.$this->chiffre['1'.$unite]).' ';
}
}
}
#Gestion des unités

function Unite($unite)
{
$this->enLettre.=($this->chiffre[$unite]).' ';
}

}






?>

