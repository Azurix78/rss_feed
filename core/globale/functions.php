<?php
/* Fonctions diverses */

session_start();

function getAge($birthDate)
{

    $birthDate = explode("-", $birthDate);

    
      if (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") )
      {      
        $age = (date("Y")-$birthDate[0])-1;
      }
      else
      {
        $age = (date("Y")-$birthDate[0]);
      }
    return $age;
}

function imgSEX($sex)
{
  if ( $sex == "m" )
  {
    return "<img src='img/male.png' alt='male'>";
  }
  elseif ( $sex == "w" )
  {
    return "<img src='img/female.png' alt='female'>";
  }
}

function xmlentities($string)
{ 
   return str_replace ( array ( '&', '"', "'", '<', '>', '�' ), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;', '&apos;' ), $string ); 
} 

function xmldecode($string)
{
  return str_replace ( array ( '&amp;' , '&quot;', '&apos;'), array ( '&', '"', "'" ), $string ); 
}
?>