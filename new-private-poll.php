<?php
include("config.php");
?>
 
 <div id="corps" class="corps clear s-layout__content">
<div class="span12">
<div class="cadre cadre-formulaire ltr">
<form id="create_dialog" action="https://forum.hugmice.com/panel-action" class="form-horizontal" method="POST" autocomplete="off">
<fieldset>
<legend>Change Account Data</legend>
<div class="control-group">
<label class="control-label" for="destinataire">Kullanıcı Adı</label>
<div class="controls ">
<input type="text" id="destinataire" name="destinataire" class="input-large" value="">
<div class="contenant-menu-deroulant-utilisateurs-trouves-mp">
<div id="destinataires_trouves" class="menu-deroulant-utilisateurs-trouves-mp" style="display:none;"></div>
</div>
<div id="destinataire_trouve" class="contenant-utilisateur-trouve-mp" style="display: none;"></div>
<button id="bouton_edition_destinataire" class="btn bouton-edition-destinataire-mp" type="button" style="display: none;">Düzenle</button>
</div>
</div>
<div class="control-group">
<label class="control-label " for="data">Data</label>
<div class="controls ">
<select id="data" name="data" onchange="document.getElementById(&#39;reset&#39;).style.display=(this.value == -1) ? &#39;block&#39; : &#39;none&#39;;document.getElementById(&#39;g-change&#39;).style.display=(this.value == -1) ? &#39;none&#39; : &#39;block&#39;;document.getElementById(&#39;g-change-color&#39;).style.display=(this.value == 6 || this.value == 7) ? &#39;block&#39; : &#39;none&#39;;">
<option value="-1">Reset</option>
<option value="0">Cheese</option>
<option value="1">First</option>
<option value="2">Bootcamp</option>
<option value="3">E-Posta</option> </select>
</div>
</div>
<div class="control-group" id="reset">
<label class="control-label " for="reset">Reset</label>
<div class="controls checkbox">
<input type="checkbox" name="reset[cheese]" value="true" checked="">Cheese
</div>
<div class="controls checkbox">
<input type="checkbox" name="reset[first]" value="true" checked="">First
</div>
<div class="controls checkbox">
<input type="checkbox" name="reset[bootcamp]" value="true">Bootcamp
</div>
<div class="controls checkbox">
<input type="checkbox" name="reset[level]" value="true" checked="">Level
</div>
</div>
<div class="control-group" id="g-change" hidden="">
<label class="control-label " for="change">Change</label>
<div class="controls ">
<input type="color" id="g-change-color" class="input-mini" value="#009d9d" onchange="document.getElementById(&#39;change&#39;).value = parseInt(this.value.substr(1), 16);" hidden="">
<input type="text" id="change" name="change" class="input-large" value="" maxlength="40">
</div>
</div>
<div class="control-group">
<label class="control-label " for="reason">Sebep</label>
<div class="controls ">
<input type="text" id="reason" name="reason" class="input-large" value="" maxlength="40">
</div>
</div>
<div class="control-group">
<div class="controls ">
<button type="button" class="btn btn-post" onclick="submitEtDesactive(this);return false;">Onayla</button>
</div>
</div>
<input type="hidden" name="actionType" value="changeAccountData">
</fieldset>
</form>
</div>
</div>
   
   
 <?php
include("footer.php");
?>  