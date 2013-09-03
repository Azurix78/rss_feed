<?php
function create_conv($bdd, $titre, $id_sender, $id_receiver, $content, $id_conv)
{
	$req = mysqli_query($bdd, "INSERT INTO message(titre, id_sender, id_receiver, content, id_conv, date) VALUES (\"$titre\", $id_sender, $id_receiver, \"$content\", $id_conv, NOW() )" );
}

function getIDCONV($bdd)
{
	$req = mysqli_query($bdd, "SELECT MAX(id_conv) FROM message" );
	if ( $req != false )
	{
		if ( $res = mysqli_fetch_assoc($req) )
		{
			if ( $res['MAX(id_conv)'] == "NULL" )
			{
				return 0;
			}
			else
			{
				return $res['MAX(id_conv)'];
			}
		}
	}
	return 0;
}
?>