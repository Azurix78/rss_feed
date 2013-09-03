function ins(id)
{
	if ( document.getElementById(id).style.display == "none" )
	{
		document.getElementById(id).style.display = "block";
		document.getElementById('tog').value = "Annuler";

	}
	else
	{
		document.getElementById(id).style.display = "none";
		document.getElementById('tog').value = "S'inscrire";
	}
}


function closealert(id)
{
		document.getElementById(id).style.display = "none";
}

function blinkimg(id)
{
	var i = document.getElementById(id);
	if(i.style.visibility=='hidden')
	{
		i.style.visibility='visible';
	}
	else
	{
		i.style.visibility='hidden';
	}
    setTimeout("blinkimg('"+id+"')",1000);
	return true;
}

function deco(x)
{
	var a = document.getElementById(x);
	old = a.innerHTML;
	a.innerHTML="<a href=\"index.php?page=logout\">Se d&eacute;connecter ?</a>";
}

function leavedeco(x)
{
	var e = document.getElementById(x);
	if (!old)
	{
		old = e.innerHTML;
	}
	e.innerHTML=old;
}

function profil_html(id)
{
	if ( id == "message" )
	{

		document.getElementById('gestion').style.display = "none";

		document.getElementById(id).style.display = "block";
	}
	if ( id == "gestion" )
	{

		document.getElementById('message').style.display = "none";
		
		document.getElementById(id).style.display = "block";
	}
}

function verifsupp()
{
	return confirm("Supprimer ?");
}


function switch_li(id)
{
	var i = document.getElementById(id);
	if ( i.style.display == "block" )
	{
		i.style.display = "none";
	}
	else
	{
		i.style.display = "block";
	}
	
}

mycontent = new Array();


function addcheck(content)
{
	for (i=0;i<mycontent.length;i++)
	{
		if ( mycontent[i]==content )
		{
			return;
		}
	}
	if ( content != "Choisissez une ville" && content != "[object HTMLSelectElement]" )
	{
		mycontent.push(content);
		document.getElementById('checkbox').innerHTML += "<input class='checkbox' checked type='checkbox' name='"+content+"'>"+content+"<br>";
	}
	
}

function linkprofil(id)
{
	window.location = "index.php?page=user&id="+id ;
}

function switch_conv(id)
{
	var i = document.getElementById(id);
	if ( i.style.display == "inline-block" || i.style.display == "block" )
	{
		i.style.display = "none";
	}
	else
	{
		i.style.display = "block";
	}
}