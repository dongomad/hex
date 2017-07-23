<script>
    function pobierz () {
  	var i = document.getElementById('ile').value; 
	 document.getElementById('buttonakcjanazwa').value= i;
    }
</script>

<?php
mysql_query("SET NAMES 'utf8'");


	echo '<div id="oknoakcjabagaz" class="pokaoknom">
	<div class="pokaoknohexm" >


	<div id="usunramka" style="position:absolute; right:28px; top:1px;"  >
	<input type="button" id="usunx" onclick="pokazoknoakcjabagaz();">
	</div> 

	<div class="pokaoknotrescm">
	<div class="pokaoknonaglowekm" id="bagaznaglowek"></div>

	<input maxlength="5"  name="ile" id="ile" placeholder=" - ilość -" type="text" style="position:absolute; top:50px; left:45px; height: 18px; width:50px; font-size:12px; line-height:14px; background-color:black; border:1px solid silver; color:white; border-radius: 4px; " />


<div id="kolkoakcjazmien" style="position:absolute; top:80px; left:60px; display:block;">
<input type="button" value="" id="buttonakcjanazwa"  style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;">
</div>

	</div>



	</div>

</div>';


?>