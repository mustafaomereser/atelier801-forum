<?php
include("config.php");
?>
 
 <div id="corps" class="corps clear container" bis_skin_checked="1">
   <div class="row" bis_skin_checked="1">
 <div class="span12" bis_skin_checked="1">
 <div class="cadre cadre-formulaire ltr" bis_skin_checked="1">
 <form id="formulaire" action="<?=$site?>/create-discussion" class="form-horizontal" method="POST" autocomplete="off">
 <fieldset>
 <legend>
Yeni tartışma</legend>
 <div class="control-group" bis_skin_checked="1">
 <label class="control-label ">
Davet et</label>
 <div class="controls " bis_skin_checked="1">
 <div id="contenant_destinataires" bis_skin_checked="1">
 <input type="hidden" id="destinataires_message" name="destinataires">
 <div class="ligne-saisie-destinataire-conversation-privee" bis_skin_checked="1">
 <input type="text" id="destinataire_1" class="input-medium champ-destinataire">
 <div class="contenant-menu-deroulant-utilisateurs-trouves-mp" bis_skin_checked="1">
 <div id="destinataires_trouves_1" class="menu-deroulant-utilisateurs-trouves-mp" style="display:none;" bis_skin_checked="1">
</div>
 </div>
 <div id="destinataire_trouve_1" class="contenant-utilisateur-trouve-mp" style="display:none;" bis_skin_checked="1">
</div>
 <button id="bouton_edition_destinataire_1" class="btn bouton-edition-destinataire-mp" type="button" style="display:none;">
 Düzenle </button>
 </div>
 </div>
 <button id="bouton_ajout_destinataire" class="btn bouton-ajout-destinataire-mp" type="button">
 Ekle </button>
 </div>
 </div>
 <div class="control-group" bis_skin_checked="1">
 <label class="control-label " for="objet">
Konu</label>
 <div class="controls " bis_skin_checked="1">
 <input type="text" id="objet" name="objet" class="input-xxlarge" value="">
 </div>
 </div>
               <div class="control-group" bis_skin_checked="1">
 <label class="control-label " for="message_conversation">
Mesaj</label>
 <div class="controls  ltr" bis_skin_checked="1">
             <div class="" id="outils_message_conversation" bis_skin_checked="1">
 <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[b]&#39;, &#39;[/b]&#39;, 3);" title="Kalın">
<img src="<?=$site?>/img/icones/16/edit-bold.png">
</button>
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[i]&#39;, &#39;[/i]&#39;, 3);" title="İtalik">
<img src="<?=$site?>/img/icones/16/edit-italic.png">
</button>
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[u]&#39;, &#39;[/u]&#39;, 3);" title="Altı çizili">
<img src="<?=$site?>/img/icones/16/edit-underline.png">
</button>
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[s]&#39;, &#39;[/s]&#39;, 3);" title="Üstü çizili">
<img src="<?=$site?>/img/icones/16/edit-strike.png">
</button>
 </div>
 <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#]&#39;, &#39;[/color]&#39;, 8);" title="Renk (hex kodu)">
<img src="<?=$site?>/img/icones/16/edit-color.png">
</button>
 <button class="btn dropdown-toggle btn-reduit" data-toggle="dropdown">
 <span class="caret">
</span>
 </button>
 <ul class="dropdown-menu pull-right label-message">
 <table>
 <tbody>
<tr>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#009D9D]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#009D9D;">
#009D9D</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#2E72CB]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#2E72CB;">
#2E72CB</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#30BA76]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#30BA76;">
#30BA76</span>
</a>
</li>
</td>
 </tr>
 <tr>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#606090]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#606090;">
#606090</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#6C77C1]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#6C77C1;">
#6C77C1</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#92CF91]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#92CF91;">
#92CF91</span>
</a>
</li>
</td>
 </tr>
 <tr>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#98E2EB]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#98E2EB;">
#98E2EB</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#BABD2F]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#BABD2F;">
#BABD2F</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#C2C2DA]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#C2C2DA;">
#C2C2DA</span>
</a>
</li>
</td>
 </tr>
 <tr>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#CB546B]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#CB546B;">
#CB546B</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#EB1D51]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#EB1D51;">
#EB1D51</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#ED67EA]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#ED67EA;">
#ED67EA</span>
</a>
</li>
</td>
 </tr>
 <tr>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#EDCC8D]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#EDCC8D;">
#EDCC8D</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#E68D43]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#E68D43;">
#E68D43</span>
</a>
</li>
</td>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#F0A78E]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#F0A78E;">
#F0A78E</span>
</a>
</li>
</td>
 </tr>
 <tr>
 <td class="cellule-dropdown">
<li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[color=#FEB1FC]&#39;, &#39;[/color]&#39;, 15);">
<span style="color:#FEB1FC;">
#FEB1FC</span>
</a>
</li>
</td>
 </tr>
 </tbody>
</table>
 </ul>
 </div>
 <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[size=]&#39;, &#39;[/size]&#39;, 6);" title="Boyut">
<img src="<?=$site?>/img/icones/16/edit-size.png">
</button>
 <button class="btn btn-reduit dropdown-toggle" data-toggle="dropdown">
 <span class="caret">
</span>
 </button>
 <ul class="dropdown-menu">
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[size=10]&#39;, &#39;[/size]&#39;, 9);">
<span style="font-size:10px">
Küçük</span>
</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[size=16]&#39;, &#39;[/size]&#39;, 9);">
<span style="font-size:16px">
Büyük</span>
</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[size=20]&#39;, &#39;[/size]&#39;, 9);">
<span style="font-size:20px">
Devasa</span>
</a>
</li>
 </ul>
 </div>
 <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[font=]&#39;, &#39;[/font]&#39;, 6);" title="Yazı tipi">
<img src="<?=$site?>/img/icones/16/edit-font.png">
</button>
 <button class="btn btn-reduit dropdown-toggle" data-toggle="dropdown">
 <span class="caret">
</span>
 </button>
 <ul class="dropdown-menu">
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[font=Arial]&#39;, &#39;[/font]&#39;, 12);">
<span style="font-family:Arial;">
Arial</span>
</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[font=Comic Sans MS]&#39;, &#39;[/font]&#39;, 20);">
<span style="font-family:Comic Sans MS;">
Comic Sans MS</span>
</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[font=Impact]&#39;, &#39;[/font]&#39;, 13);">
<span style="font-family:Impact;">
Impact</span>
</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[font=Lucida Console]&#39;, &#39;[/font]&#39;, 21);">
<span style="font-family:Lucida Console;">
Lucida Console</span>
</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[font=Tahoma]&#39;, &#39;[/font]&#39;, 13);">
<span style="font-family:Tahoma;">
Tahoma</span>
</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[font=Verdana]&#39;, &#39;[/font]&#39;, 14);">
<span style="font-family:Verdana;">
Verdana</span>
</a>
</li>
 </ul>
 </div>
  <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[p=]&#39;, &#39;[/p]&#39;, 3);" title="Paragraf">
<img src="<?=$site?>/img/icones/16/edit-alignment.png">
</button>
 <button class="btn btn-reduit dropdown-toggle" data-toggle="dropdown">
 <span class="caret">
</span>
 </button>
 <ul class="dropdown-menu">
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[p=left]&#39;, &#39;[/p]&#39;, 8);">
<img src="<?=$site?>/img/icones/16/edit-alignment.png">
 Sol</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[p=right]&#39;, &#39;[/p]&#39;, 9);">
<img src="<?=$site?>/img/icones/16/edit-alignment-right.png">
 Sağ</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[p=center]&#39;, &#39;[/p]&#39;, 10);">
<img src="<?=$site?>/img/icones/16/edit-alignment-center.png">
 Orta</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[p=justify]&#39;, &#39;[/p]&#39;, 11);">
<img src="<?=$site?>/img/icones/16/edit-alignment-justify.png">
 İki yana yasla</a>
</li>
 </ul>
 </div>
 <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[hr]\n&#39;, &#39;&#39;, 5);" title="Yatay çizgi">
<img src="<?=$site?>/img/icones/16/separation.png">
</button>
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[#]&#39;, &#39;[/#]\n[#][/#]&#39;, 2);" title="Sekmeler: etiketler arasında #&#39;dan sonra isim koyun">
<img src="<?=$site?>/img/icones/16/ui-tab.png">
</button>
  <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[table]\n[row][cel]&#39;, &#39;[/cel][cel][/cel][/row]\n[/table]&#39;, 18);" title="Tablo">
<img src="<?=$site?>/img/icones/16/table.png">
</button>
 </div>
  <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[img]&#39;, &#39;[/img]&#39;, 5);" title="Resim: linki kodlar arasına koyun">
<img src="<?=$site?>/img/icones/16/image.png">
</button>
 <button class="btn btn-reduit dropdown-toggle" data-toggle="dropdown">
 <span class="caret">
</span>
 </button>
 <ul class="dropdown-menu">
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[img align=left]&#39;, &#39;[/img]&#39;, 16);">
<img src="<?=$site?>/img/icones/16/edit-image.png">
 Sola hizalı</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[img align=right]&#39;, &#39;[/img]&#39;, 17);">
<img src="<?=$site?>/img/icones/16/edit-image-right.png">
 Sağa hizalı</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[p=center][img]&#39;, &#39;[/img][/p]&#39;, 15);">
<img src="<?=$site?>/img/icones/16/edit-image-center.png">
 Ortalanmış</a>
</li>
 </ul>
 </div>
 <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[video]&#39;, &#39;[/video]&#39;, 7);" title="Video">
<img src="<?=$site?>/img/icones/16/film.png">
</button>
 <button class="btn btn-reduit dropdown-toggle" data-toggle="dropdown">
 <span class="caret">
</span>
 </button>
 <ul class="dropdown-menu">
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[video]https://www.youtube.com/embed/&#39;, &#39;[/video]&#39;, 36);">
YouTube</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[video]https://www.dailymotion.com/embed/video/&#39;, &#39;[/video]&#39;, 46);">
Dailymotion</a>
</li>
 <li>
<a class="element-menu-outils" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[video]https://player.vimeo.com/video/&#39;, &#39;[/video]&#39;, 37);">
Vimeo</a>
</li>
 </ul>
 </div>
 <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[url=]&#39;, &#39;[/url]&#39;, 5);" title="Link">
<img src="<?=$site?>/img/icones/16/ui-label-link.png">
</button>
  <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[list]\n[*][/*]\n[*][/*]\n&#39;, &#39;[/list]&#39;, 10);" title="Liste">
<img src="<?=$site?>/img/icones/16/edit-list.png">
</button>
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[quote=]&#39;, &#39;[/quote]&#39;, 8);" title="Alıntı">
<img src="<?=$site?>/img/icones/16/edit-quotation.png">
</button>
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode(&#39;message_conversation&#39;, &#39;[spoiler]&#39;, &#39;[/spoiler]&#39;, 9);" title="Spoiler">
<img src="<?=$site?>/img/icones/16/lock.png">
</button>
 </div>
  <div class="btn-group groupe-boutons-barre-outils" bis_skin_checked="1">
    <button type="button" class="btn btn-reduit btn-info" onclick="previsualisationMessage(&#39;message_conversation&#39;, &#39;cadre-message&#39;);">
Önizleme</button>
   <button type="button" class="btn btn-reduit btn-inverse" onclick="jQuery(&#39;#previsualisation_message_conversation&#39;).html(&#39;&#39;);">
Gizle</button>
 </div>
   </div>
   <textarea id="message_conversation" name="message" rows="5" class="input-message input-xxlarge ltr" maxlength="60000" onkeydown="traiterAppuiToucheMessage(this, event);">
</textarea>
 <div id="previsualisation_message_conversation" bis_skin_checked="1">
</div>
 </div>
 </div>
         <div class="control-group" bis_skin_checked="1">
 <div class="controls " bis_skin_checked="1">
  <button type="button" class="btn btn-post" onclick="submitEtDesactive(this);return false;">
Onayla</button>
 </div>
 </div>
 <input type="hidden" name="rbvkezdyuz" value="4050DloxeuisLp8ns6VlH6dyN02jv393ggq0qYBuKOh7wwvk">
 </fieldset>
 </form>
 </div>
 </div>
 </div>
  
  
  
  <?php
include("footer.php");
?>