<?php


$Main->Isi="
<table border=0 cellspacing=2 width=60%>
	<tr>
	<td valign=top>
		<table border=0 cellspacing=0 width=60% class=\"adminform\">
			<tr><th colspan=4>FITUR</th></tr>
			<tr>
				<td valign=top>
				".PanelIcon($Link="pages.php?Pg=member",$Image="sections.png",$Isi="MEMBER").
				PanelIcon($Link="pages.php?Pg=histori_iklan",$Image="sections.png",$Isi="HISTORI IKLAN").
"

				<td>
				<td valign=top>
				".
				PanelIcon($Link="pages.php?Pg=penukaran",$Image="sections.png",$Isi="PENUKARAN").
				PanelIcon($Link="pages.php?Pg=hadiah",$Image="sections.png",$Isi="HADIAH").
				"</td>

				<td valign=top>
				".
				PanelIcon($Link="pages.php?Pg=tukar_point",$Image="sections.png",$Isi="TUKAR POINT").
				"</td>

			</tr>





</table>



		";
// 				".PanelIcon($Link="?Pg=$Pg&SPg=03#ISIAN",$Image="sections.png",$Isi="Import/Restore Data")."

?>
