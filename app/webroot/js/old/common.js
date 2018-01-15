function deleteConfirm()
{
var n = $( "#manageData input:checked" ).length;
	if(n==0)
	{
	alert('Please Select a Box');
	return false;
	}

var ret=confirm('Are u sure?');
	if(ret==false)
	{
	return false;
	} else {
	return true;
	}
}

function deleteConfirm2()
{
var n = $( "#no-more-tables input:checked" ).length;
	if(n==0)
	{
	alert('Please Select a Box');
	return false;
	}

var ret=confirm('Are u sure?');
	if(ret==false)
	{
	return false;
	} else {
	return true;
	}
}

function checkselected()
{
	var n = $( "#manageData input:checked" ).length;
	if(n==0)
	{
	alert('Please Select a Box');
	return false;
	}
}


function showGames(game_id)
{
	$('#hotspotViewer').agentstormHotspotViewer('clearHotspots');
	$("#hotspotVirtualTour").remove();
	$("#hotspotMessage").remove();
	$('#accordion2').html('');
	$('#hidden_i').val('0');
	$('#hotspotVirtualTourDefault').show();
	$('#upperpartId').hide();
	$("#displayImagePoint").hide();	
	
	$.ajax({
    type: "POST",
    url: '/story/showMap/'+game_id,
	beforeSend: function(){},
	complete: function(){},
    success: function(msg){
	$("#map_id").html(msg);
    }
    }); 
}

//********Show Map Image********
function showMapImage(map_id)
{
	$('#hotspotViewer').agentstormHotspotViewer('clearHotspots');
	$("#hotspotVirtualTour").remove();
	$('#accordion2').html('');
	$('#hidden_i').val('0');
	$('#hotspotVirtualTourDefault').hide();
	$('#upperpartId').show();	
	$('#loaderImage').show();
	$('#makeSvg').remove();

	$.ajax({
    type: "POST",
    url: '/story/showMapImage/'+map_id,
	beforeSend: function(){},
	complete: function(){},
    success: function(msg){
	var obj=JSON.parse(msg);
    $('#loaderImage').hide();	
	$("#displayImagePoint").show();
	$("#image_width").val(obj.imagewidth);
	$("#image_height").val(obj.imageheight);
	
	//for hotspot

	$('#hotspotViewer').agentstormHotspotViewer('init', {
            'tourUrl': obj.imgName,
            'tourWidth': 900
        });
					
	$('#hotspotViewer').fadeIn(1000);
	$('#hotspotViewer').agentstormHotspotViewer('addHotspot');	
    
    }
	
    });
}	

function hideSvg()
{ 
$("#makeSvg").hide();
setTimeout(checkSvgImg,5000);
}




$(document).ready(function() {

//********Redirect Story********
$("#createStoryPage").click(function() {
$(this).addClass('disabled');
$.ajax({
    type: "POST",
    url: '/story/resetSession',
    success: function(msg){
	$(this).removeClass('disabled');
	window.location='/story/createStory';
	}	
    });
});

//********Save Story********

$("#saveStory").click(function() {

autosaveStory();	
//Validation for story
if($("#title").val()=='')
{
alert('Please Enter Story Title!');
$('#title').focus();
return false;
}

if($("#description").val()=='')
{
alert('Please Enter Story Description!');
$('#description').focus();
return false;
}

if($("#game_id").val()=='')
{
alert('Please Select Game!');
$('#game_id').focus();
return false;
}	

if($("#map_id").val()=='')
{
alert('Please Select Map!');
$('#map_id').focus();
return false;
}


$(this).attr('disabled',true);
$.ajax({
    type: "POST",
    url: '/story/saveStory/',
	data: {title:$("#title").val(),description:$("#description").val(),game_id:$("#game_id").val(),map_id:$("#map_id").val(),id:$("#insert_id").val()},
    success: function(msg){
    var obj = JSON.parse(msg);
    	if(obj.msg=='success')
    	{	
			if($("#insert_id").val()=='')
			{
			//Remove All Old Data
			$('#hotspotViewer').agentstormHotspotViewer('clearHotspots');
			$("#hotspotVirtualTour").remove();
			$("#makeSvg").remove();
			$('#accordion2').html('');
			$('#hidden_i').val('0');
			$('#hotspotVirtualTourDefault').hide();	
			$('#title').val('');
			$('#description').val('');
			$('#game_id').val('');
			$('#map_id').html('<option value="">-Select Map-</option>');
			}
		//Set Popup Data
	    $("#saveStory").attr('disabled',false);
	    $("#share_url").val(obj.share_url)
	    $("#view_story_btn").val(obj.share_url)
	    $("#insert_id").val(obj.insert_id)
		$('#model_popup').modal('show');
		}	
    }
    });
 });


//********View and Save Story********
$("#view_story_btn").click(function() {
$.ajax({
    type: "POST",
    url: '/story/saveStoryShare/',
	data: {id:$("#insert_id").val(),author:$("#author").val(),website:$("#website").val()},
    success: function(msg){
    var obj = JSON.parse(msg);
    	if(obj.msg=='success')
    	{	
    	window.location=$("#share_url").val();
		}	
    }
    });

 });

}); 

//********Stop Counter********
var t='';
function stopCount()
{
//console.log(t);	
clearTimeout(t);
}

//********Save Story Point********
function saveHotspot(ind)
{
var left=$("#game_story_"+ind).css('left'); //x
var top=$("#game_story_"+ind).css('top');  //y
var uploads_image=$("#uploads_image_"+ind).val();
var link_image=$("#link_image_"+ind).val();
var embed_video=$("#embed_video_"+ind).val();
var tell_story=$("#tell_story_"+ind).val();

var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1; //Check Chrome Browser
if(is_chrome==true)
{
var imagewidth=parseFloat($("#hotspotVirtualTour").width());
var imageheight=parseFloat($("#hotspotVirtualTour").height());
left=parseFloat(left)*imagewidth/100;
top=parseFloat(top)*imageheight/100;
}

		formdata = false;
		if (window.FormData) 
		{
		formdata = new FormData();
		}
		
		formdata.append("story_index", ind);
		formdata.append("left", left);
		formdata.append("top", top);
		formdata.append("link_image", link_image);
		formdata.append("embed_video", embed_video);
		formdata.append("tell_story", tell_story);

$.ajax({
    type: "POST",
    url: '/story/saveStoryPoint',
	processData: false,
	contentType: false,
	data: formdata,
    success: function(msg){
    var obj = JSON.parse(msg);
	
	/*
	if(t=='')
	{
	t=setTimeout(autosaveStory,20000);   	
    }
    */
   } 
    
    });
}

function checkSvgImg()
{
	if($("#makeSvg").css('display')=='none')
	{
	$("#makeSvg").css('display','');	
	}
}


function autosaveStory()
{
var objId,index;
$( ".accordion-body" ).each(function() {
var find=$(".accordion").find(this).attr('class');
	if(find=='accordion-body in' || find=='accordion-body collapse in')
	{
	objId=$(this).attr('id');
	index=objId.split('_');
	//saveHotspot(index[1]);
	}
});
}

//********Save Story Point********
function uploadStoryImage(inputFile)
{
var indexObj=$(inputFile).attr('id');
	indexSplit=indexObj.split('_');
	index=indexSplit[2];

	if($("#link_image_"+index).val()!='' || $("#embed_video_"+index).val()!='')
	{
	alert('You can Upload Image OR Link to image url OR Embed YouTube!');
	return false;
	}	
	
//All for Upload File From Ajax
	formdata = false;
	if (window.FormData) 
	{
  	formdata = new FormData();
	}
	var j = 0, len = inputFile.files.length, file;
		for ( ; j < len; j++ ) 
		{
		file = inputFile.files[j];
			if (!!file.type.match(/image.*/)) 
			{
				if (formdata) 
				{
				formdata.append("images", file);
				}
			}	
		}
		formdata.append("index", index);
		
var action=	'/story/uploadStoryImage';
$.ajax({
    type: "POST",
    url: action,
	processData: false,
	contentType: false,
	data: formdata,
    success: function(msg){
    var obj = JSON.parse(msg);
	$("#uploadImgName_"+index).html(obj.imgUrl);	
    }
    });
}

//********Focus Hotspot********
function focusHotspot(ids)
{
//Compress All Tab
$(".accordion-body").addClass('collapse');
$(".accordion-body").removeClass('in');
$(".accordion-body").css('height','0px');

//Expend Focus Tab
$("#collapse_"+ids).addClass('in');
$("#collapse_"+ids).css('height','auto');
$(window).scrollTop($('#focus_hotspot_'+ids).offset().top);
//$("html, body").animate({ scrollTop: 0 }, 800);
}

//Focus Div
function focusonDiv(id)
{
$(".contentdiv").css('display','none');
$(".hotspotObjectName").css('color','#FFFFFF');
$("#game_story_name_"+id).css('color','#F3F781');

$(".toc").each(function() {
$(this).removeClass('selected');
	if(parseInt($(this).attr('rel'))==id)
	{
	$(this).addClass('selected');	
	}
});
		

//Calculate High Z Index
var zIndexLow;
var zIndexHigh=0;
$(".contentdiv").each(function() {
zIndexLow=parseInt($(this).css("zIndex"));
if(zIndexLow>zIndexHigh)
{
zIndexHigh=zIndexLow;
}
});
zIndexHigh=parseInt(zIndexHigh)+1;

$('#focusHotspotDiv_'+id).css({'zIndex':zIndexHigh,'display':'block'});
var height = $(window).height();
	if(parseInt($(window).scrollTop())>135)
	{
	$(window).scrollTop($('#focusHotspotDiv_'+id).offset().top);
	$("html, body").animate({ scrollTop: 100 }, 800);
	}
}

//Load Story
function loadStory(paging,div)
{
	$.ajax({
    type: "POST",
    url: $("#site_url").val()+paging,
    data: {type:div},
    success: function(msg){
	//$("#"+div+'Story').hide().html(msg).fadeIn('slow');
	$("#"+div+'Story').html(msg);
	}
   });
}

//Load Story Paging
function loadStoryPaging(paging,div)
{
	$.ajax({
    type: "POST",
    url: $("#site_url").val()+paging,
    data: {type:div},
    success: function(msg){
	$("#"+div+'Pagination').html(msg);
	}
   });
}

//Check Validation
function loginValidate()
{

	if($("#email").val()=='' || $("#email").val()=='Email')
	{
	alert('Please enter email!');
	return false;	
	}
	
	if($("#password").val()=='' || $("#password").val()=='Password')
	{
	alert('Please enter password!');
	return false;	
	}

}

//Show Image Popup

function showImagePopup(img)
{
$("#modal_popup_img").attr('src','');
$("#modal_popup_img").attr('src',img);
$('#image_model_popup').modal('show');
}

function deleteHotspot(ind)
{
	var con=confirm('Are you sure want to delete hotspot');
	if(con==false)
	{
	return false;	
	}
	
	if($("#create_story_id_"+ind).val()=='')
	{
	var action='/story/deleteHotspot';
	} else {
	var action='/story/removeHotspot';	
	}
	
	var create_story_id=$("#create_story_id"+ind).val();
	$.ajax({
    type: "POST",
    url: action,
    data: {story_index:ind,story_id:$("#create_story_id_"+ind).val()},
    success: function(msg){
	var obj=JSON.parse(msg);
	if(obj.msg=='success')
	{
	$("#story_point_form"+ind).remove();	
	$("#game_story_"+ind).remove();
	$("#game_story_name_"+ind).remove();
	
	$(".hotspotObjectSvg").remove();
	var imagewidth=parseFloat($("#hotspotVirtualTour").width());
	var imageheight=parseFloat($("#hotspotVirtualTour").height());
	
		//Set Story Point
		var h=1;
		$(".story_point_form").each(function() { $(this).attr('id','story_point_form'+h); h++; });
		var h=1;
		$(".create_story").each(function() { $(this).attr('id','create_story_id'+h); h++; });
		var h=1;	
		$(".uploadImgName").each(function() { $(this).attr('id','uploadImgName_'+h); h++; });
		var h=1;
		$(".uploads_image").each(function() { $(this).attr('id',h); h++; });
		var h=1;
		$(".accordion-toggle").each(function() { 
		$(this).html('Story Point '+h+'<i class="icon-remove-sign pull-right" style="margin-left:10px;" onClick="deleteHotspot(\''+h+'\');"></i><i class="icon-caret-down pull-right"></i></a>'); 
		$(this).attr('href','#collapse_'+h); 
		h++; 
		});
		var h=1;
		$(".accordion-body").each(function() { $(this).attr('id','collapse_'+h); h++; });
		var h=1;
		$(".link_image").each(function() { $(this).attr('id','link_image_'+h); h++; });
		var h=1;
		$(".embed_video").each(function() { $(this).attr('id','embed_video_'+h); h++; });
		var h=1;
		$(".tell_story").each(function() { $(this).attr('id','tell_story_'+h); h++; });
	
		
		//Set Hotspot
		var l=1;
		$(".hotspotObject").each(function() {
		$(this).attr('title','Story Point '+l);
		$(this).attr('id','game_story_'+l);
		l++;
		});
		
		//Set Hotspot Name
		var n=1;
		$(".hotspotObjectName").each(function() {
		$(this).html(n);
		$(this).attr('id','game_story_name_'+n);
		n++;
		});	
		

		var points=parseInt($("#hidden_i").val());
		if(points>1)
		{
			for(var i=1;i<=points;i++)
			{	
			
				if(i<(points-1))
				{
				var topOld=parseFloat($("#game_story_"+i).css('top'));
				var leftOld=parseFloat($("#game_story_"+i).css('left'));
				var topNew=parseFloat($("#game_story_"+(i+1)).css('top'));
				var leftNew=parseFloat($("#game_story_"+(i+1)).css('left'));
				
				var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1; //Check Chrome Browser
				if(is_chrome==true)
				{
				topOld=topOld*imageheight/100;	
				leftOld=leftOld*imagewidth/100;
				topNew=topNew*imageheight/100;		
				leftNew=leftNew*imagewidth/100;
				} 
				
				topOld=((topOld+12)/imageheight)*100;
				leftOld=((leftOld+12)/imagewidth)*100;
				topNew=((topNew+12)/imageheight)*100;
				leftNew=((leftNew+12)/imagewidth)*100;
				
				
				var newLine = document.createElementNS('http://www.w3.org/2000/svg','line');
					newLine.setAttribute('x1',leftOld+'%');
					newLine.setAttribute('y1',topOld+'%');
					newLine.setAttribute('x2',leftNew+'%');
					newLine.setAttribute('y2',topNew+'%');
					newLine.setAttribute('id','game_story_svg_'+i);
					newLine.setAttribute('class','hotspotObjectSvg');
					newLine.style.stroke='rgb(255,0,0)';
					newLine.setAttribute('stroke-width','4');
					newLine.setAttribute('stroke-dasharray','13,3');
					$("#makeSvg").append(newLine);
				}		
			}			
		}
		$("#hidden_i").val(l-1);
		
	}
	}
   });
}


function validateLinkImage(id)
{
var indexSplit=id.split('_');
var i=indexSplit[2];
	if($("#embed_video_"+i).val()!='' || $("#uploadImgName_"+i).html()!='')
	{
	$("#link_image_"+i).val('');
	alert('You can Upload Image OR Link to image url OR Embed YouTube!');
	}

}

function validateEmbedVideo(id)
{
var indexSplit=id.split('_');
var i=indexSplit[2];
	if($("#link_image_"+i).val()!='' || $("#uploadImgName_"+i).html()!='')
	{
	$("#embed_video_"+i).val('');
	alert('You can Upload Image OR Link to image url OR Embed YouTube!');
	}

}

