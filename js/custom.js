var mouseIsDown = false;

  $("html").mouseup(function() {
	mouseIsDown = false;
  })
   $("html").mousedown(function() {
	mouseIsDown = true;
  });
  
function c_auth() {
    var bilgi = {
        kadi: $('#kadi').val(),
		sifre: $('#sifre').val(),
		redirect: $('#redirect').val()
    }
    $.ajax({
        type: 'post',
        url: '../ajax/giris.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result').html(result);
        }
    });
 
}

			function badge_disable(tis,t=0){
				if(mouseIsDown==true || (t==1 && mouseIsDown==false )){
					$("#"+tis.id).toggleClass("badgedisable");
					var now = $('#'+tis.id).attr("class");
					var yetkiler = $('#yetkiler').val();
					var deg = "";
					
					if(now.search("badgedisable")<=0){
						yetkiler = yetkiler.replace(",,", ",");
						yetkiler = yetkiler.split(",");
						$('#yetkiler').val(yetkiler+","+tis.id).change();
					}else{
						deg = yetkiler.replace(","+tis.id, "");
						deg = deg.replace(",,", ",");
						$('#yetkiler').val(deg).change();

					}
				}
			}

/* $(document).ready(function() {

var s = $("img").attr("src");
if(s.search("logo-atelier801")){
$("img").attr("id","logo");
$("img").attr("onclick","takla(this);");
}

}); 


$(document).ready(function(){

try{
	$('#seconder_menu').attr("style","display: block;");
}catch(ex){
	
}
	
});
*/

var anglegg = 0;

function cevir360(){
	if(anglegg<=0){
	 setInterval(function() {
	  if(anglegg<=359){
	  
		anglegg = anglegg+3;
		$("body").rotate(anglegg);

	  }else{
		 anglegg=anglegg;
	  }
	  
	  }, 40);
	}else if(anglegg>=359){
		anglegg=anglegg-anglegg;
	}
}


var angleg = 0;

function takla(even){
	if(angleg<=0){
		var id = even.id ?? even;

	 setInterval(function() {
	  if(angleg<=359){
	  
		angleg = angleg+3;
		$("#"+id).rotate(angleg);

	  }else{
		 angleg=angleg;
	  }
	  
	  }, 15);
	}else if(angleg>=359){
		angleg=angleg-angleg;
	}
}

 var anglef = 0;

function cevir(){
 if(anglef==0){
	 
 }else{
	 return false;
 }

  $("body #sc").load('../css/scrollg.css');

  setInterval(function() {
	anglef = anglef-3;
	$("body").rotate(anglef);
	takla('b');
  }, 15);
	
}


function topic_tasi(id) {
	
	var bilgi = {
		id:id
	}
	
    $.ajax({
        type: 'post',
        url: '../ajax/topic_tasi.php',
        data: {query: bilgi},
        success: function(result) {
            $('#topic_tasi').html(result);
        }
    });
 
}


function selected(c){
	id = c;
	$('#'+id).attr('selected','');
}


function active(c){
	id = c;
	$('#'+id).addClass('active');
	$('#ae').remove();
}

function imgError(image) {
    $('#'+image.id).attr("style","display:none;");
    return false;
}


function degistirattr(id,attfr,val){
	$('#'+id).attr(attfr,val);
}



function onizle(id,nereye){
		
	var text_turk_parametresi = $('#'+id).val();
	
		if(text_turk_parametresi.length>=1){
		
	var bilgi = {
        text: text_turk_parametresi
    }
	
    $.ajax({
        type: 'post',
        url: '../ajax/preview.php',
        data: {query: bilgi},
        success: function(result) {
            $('#'+nereye).html(result);
        }
    });
	
	}else{
		
            $('#'+nereye).html('');
		
	}
		
}


function fclass(evf,cls,eg){
	var id = evf.id ?? evf;
	if(cls == "add"){
		$('#'+id).addClass(eg);

	}
	if(cls == "remove"){
		$('#'+id).removeClass(eg);
	}
	
	
}

function sub_section(id){
var site = $('#site').val();

if($('#sous_sections_'+id).css('display') == 'none')
{
$('#bouton-sous-sections_'+id).attr("src", site+"/img/icones/moins16.png");
$('#sous_sections_'+id).css("display", "block");

}else{
	$('#bouton-sous-sections_'+id).attr("src", site+"/img/icones/plus16.png");
$('#sous_sections_'+id).css("display", "none");
	
}
	
}

function plus(e){
	var id = e.id ?? e;

	var site = $('#site').val();

	var src = $('#c_'+id).attr("src");

	if(src.search("moins24-2.png")>=1){

		$('#c_'+id).attr("src",site+"/img/icones/plus24-2.png");

	}else{

		$('#c_'+id).attr("src",site+"/img/icones/moins24-2.png");

	}

}


function reward(){
    var bilgi = {
        ehe: 'İş olsun diye gönderiyom bu veriyi yoksa sikimde değil yani :P'
    }
	
    $.ajax({
        type: 'post',
        url: '../ajax/reward.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result_rulet').html(result);
        }
    });
}



function maxpage(t){
 var maxpage = $('#maxpage').val();
 var link = $('#link').val();
 var reached = $('#page').val();

 var getsor = "&";
 
if(link.search("&")>=1){
	getsor = "&";
}else{
	getsor = "?";
}
 
 link = link.split(getsor+"p=")[0];
 
 $('#'+t).attr("max", maxpage);

	if(maxpage<=0){
		$('#pagination_control').addClass("hidden");
	}else{
		$('#pagination_control').removeClass("hidden");
	}

	if(maxpage<=1 || maxpage<=reached){
		$('#sonraki').addClass("hidden");
	}




 $('#son').attr("href",link+getsor+"p="+maxpage);
 
 //$("#maxpage").remove();
 $('maxpagecount').html(maxpage);


}


function topic(formd) {
 
 var links = $('#link').val();

 var bilgi = {
        msg: $('#message_reponse').val(),
        link:links
	}
    $.ajax({
        type: 'post',
        url: '../ajax/topic.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result_msg').html(result);
              
        }
    });
}

function dialog() {
var links = $('#link').val();

 var bilgi = {
        msg: $('#message_reponse').val(),
		        link:links

		}
    $.ajax({
        type: 'post',
        url: '../ajax/dialog.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result_msg').html(result);
              
        }
    });
}

function typechange(id,type){
	
	$('#'+id).attr('type',type);
}

function dialog_search() {
var val = $('#destinataire').val();

 var bilgi = {
        users: val

		}
    $.ajax({
        type: 'post',
        url: '../ajax/new-dialog-searc.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result_search').html(result);
              
        }
    });

}

function newdialog() {

 var bilgi = {
		konu: $('#objet').val(),
        msg: $('#message_conversation').val(),
		player: $('#destinataire').val()
	}
		
    $.ajax({
        type: 'post',
        url: '../ajax/new-dialog.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result_msg').html(result);
              
        }
    });
}




function fav(ids,modes) {
    var bilgi = {
       id:ids,
	   mode:modes
    }
    $.ajax({
        type: 'post',
        url: '../ajax/fav.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result_fav').html(result);
              
        }
    });
}
 


function editprofile() {
    var bilgi = {
        id: $('#pr').val(),
		
		lang:$('#lang_val').val(),
		online: $('#onl').is(':checked'),


        ack:$('#presentation').val(),
		birthday: $('#anniversaire').val(),
		konum: $('#localisation').val(),
		gender: $('#genre').val(),

		
		staciklama: $('#b_presentation').is(':checked'),
		stkonum: $('#b_localisation').is(':checked'),
		stbirthday: $('#b_anniversaire').is(':checked'),
		stgender: $('#b_genre').is(':checked')

    }
    $.ajax({
        type: 'post',
        url: '../ajax/profile.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result').html(result);
              
        }
    });
}
 
 
 
  
 function topicedit(etiket) {
    var et = etiket.id ?? etiket;
	var bilgi = {
	id : et,
	msg : $("#edit_message_"+et).val()
    }
    $.ajax({
        type: 'post',
        url: '../ajax/topicedit.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result_'+etiket.id).html(result);
              
        }
    });
}


 
function likes(etiket,sira) {
    var bilgi = {
	veri : etiket.id,
	link : $("#link").val(),
	sira : sira
    }
    $.ajax({
        type: 'post',
        url: '../ajax/likes.php',
        data: {query: bilgi},
        success: function(result) {
			$("#"+etiket.id).addClass("bouton-like-enfonce").removeClass("bouton-like-actif").removeAttr("onclick"); 
            $('#'+etiket.id).html(result);
              
        }
    });
}


function deger(id) {
	  return $('#'+id).val();
}

function degistir(id,val) {

	  $('#'+id).val(val).change();
}



function degistirload(id,val) {
	  $('#'+id).html("Yükleniyo dur...");

	  $('#'+id).load(val);
}


function degistirhtml(id,val) {

	  $('#'+id).html(val);
}

function confirmDel(msg="Bu içeriği silmek istediğinizden emin misiniz?\nBu işlem geri alınamaz!") {
 var agree=confirm(msg);
 if (agree) {
  return true ; }
 else {
  return false ;}
}


function formsubmit(id){
document.getElementById(id).submit();
}

function tribeupdate() {
    var bilgi = {

        id: $('#tr').val(),
		lang:$('#lang_val').val(),
        msg:$('#Message').val(),
		aciklama:$('#description').val(),
		alim:$('#recrutement').val(),
		reisg:$('#chefs_publics').is(':checked'),
		msgg:$('#msg_publics').is(':checked'),
		msgaciklama:$('#desc_publics').is(':checked')


		}
    $.ajax({
        type: 'post',
        url: '../ajax/kabilegnc.php',
        data: {query: bilgi},
        success: function(result) {
            $('#result').html(result);
              
        }
    });
}



function accountupdate(id,mode=0) {
    var bilgi = {
        id: id,
        mode:mode,
		codesifre:$("#codesifre").val(),
		codeemail:$("#codeemail").val(),
		codeisim:$("#codeisim").val(),
		mdp:$("#mdp").val(),
		mdp2:$("#mdp2").val(),
		newmail:$("#mail2").val(),
		newname:$("#newname").val(),
		deco:$("#deco").is(':checked')

    }
		
    $.ajax({
        type: 'post',
        url: '../ajax/account.php',
        data: {query: bilgi},
        success: function(result) {
			if(mode<=3){
				$('#'+id).html(result);
			}else{
				alert("SNİ GDİ KÇK HCKR");
			}
        }
    });
}

function report(ie,reasdev) {
	var links = $('#link').val();
	var reasd = reasdev ?? '';
	
	
    var bilgi = {
        id: ie ?? $('#ie').val(),
		reas: $('#raison'+reasd).val(),
		link : links
    }
    $.ajax({
        type: 'post',
        url: '../ajax/report.php',
        data: {query: bilgi},
        success: function(result) {
            $('#report_result'+reasd).html(result);
              
        }
    });
}


$(document).ready(function (e) {
	$("#cadre_changer_logo_"+$('#prp').val()).on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "../ajax/avatartribe.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#result").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});


$(document).ready(function (e) {
	$("#cadre_changer_avatar_"+$('#prp').val()).on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "../ajax/avatar.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#result").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});

function yonlendir(time=3000, _link) {
        setTimeout("window.location = '"+_link+"';", time);

}

function confirm_refresh(time=3000) {
        setTimeout("location.reload(true);", time);

}

function title(title){
	           document.title = title;
}