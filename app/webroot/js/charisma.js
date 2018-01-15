function docReady(){function y(){if(v.length>0)v=v.slice(1);while(v.length<g){var e=v.length>0?v[v.length-1]:50;var t=e+Math.random()*10-5;if(t<0)t=0;if(t>100)t=100;v.push(t)}var n=[];for(var r=0;r<v.length;++r)n.push([r,v[r]]);return n}$('a[href="#"][data-top!=true]').click(function(e){e.preventDefault()});$(".datepicker").datepicker({dateFormat:"yy-mm-dd"});$(".noty").click(function(e){e.preventDefault();var t=$.parseJSON($(this).attr("data-noty-options"));noty(t)});$("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();$('[data-rel="chosen"],[rel="chosen"]').chosen();$("#myTab a").click(function(e){e.preventDefault();$(this).tab("show")});$(".slider").slider({range:true,values:[10,65]});$('[rel="tooltip"],[data-rel="tooltip"]').tooltip({placement:"bottom",delay:{show:400,hide:200}});$('[rel="popover"],[data-rel="popover"]').popover();$(".iphone-toggle").iphoneStyle();$("ul.gallery li").hover(function(){$("img",this).fadeToggle(1e3);$(this).find(".gallery-controls").remove();$(this).append('<div class="well gallery-controls">'+'<p><a href="#" class="gallery-edit btn"><i class="icon-edit"></i></a> <a href="#" class="gallery-delete btn"><i class="icon-remove"></i></a></p>'+"</div>");$(this).find(".gallery-controls").stop().animate({"margin-top":"-1"},400,"easeInQuint")},function(){$("img",this).fadeToggle(1e3);$(this).find(".gallery-controls").stop().animate({"margin-top":"-30"},200,"easeInQuint",function(){$(this).remove()})});$(".thumbnails").on("click",".gallery-delete",function(e){e.preventDefault();$(this).parents(".thumbnail").fadeOut()});$(".thumbnails").on("click",".gallery-edit",function(e){e.preventDefault()});$("#toggle-fullscreen").button().click(function(){var e=$(this),t=document.documentElement;if(!e.hasClass("active")){$("#thumbnails").addClass("modal-fullscreen");if(t.webkitRequestFullScreen){t.webkitRequestFullScreen(window.Element.ALLOW_KEYBOARD_INPUT)}else if(t.mozRequestFullScreen){t.mozRequestFullScreen()}}else{$("#thumbnails").removeClass("modal-fullscreen");(document.webkitCancelFullScreen||document.mozCancelFullScreen||$.noop).apply(document)}});if($(".tour").length&&typeof e=="undefined"){var e=new Tour;e.addStep({element:".span10:first",placement:"top",title:"Custom Tour",content:"You can create tour like this. Click Next."});e.addStep({element:".theme-container",placement:"left",title:"Themes",content:"You change your theme from here."});e.addStep({element:"ul.main-menu a:first",title:"Dashboard",content:"This is your dashboard from here you will find highlights."});e.addStep({element:"#for-is-ajax",title:"Ajax",content:"You can change if pages load with Ajax or not."});e.addStep({element:".top-nav a:first",placement:"bottom",title:"Visit Site",content:"Visit your front end from here."});e.restart()}$(".btn-close").click(function(e){e.preventDefault();$(this).parent().parent().parent().fadeOut()});$(".btn-minimize").click(function(e){e.preventDefault();var t=$(this).parent().parent().next(".box-content");if(t.is(":visible"))$("i",$(this)).removeClass("icon-chevron-up").addClass("icon-chevron-down");else $("i",$(this)).removeClass("icon-chevron-down").addClass("icon-chevron-up");t.slideToggle()});$(".btn-setting").click(function(e){e.preventDefault();$("#myModal").modal("show")});$("#external-events div.external-event").each(function(){var e={title:$.trim($(this).text())};$(this).data("eventObject",e);$(this).draggable({zIndex:999,revert:true,revertDuration:0})});if($("#sincos").length){var t=[],n=[];for(var r=0;r<14;r+=.5){t.push([r,Math.sin(r)/r]);n.push([r,Math.cos(r)])}var i=$.plot($("#sincos"),[{data:t,label:"sin(x)/x"},{data:n,label:"cos(x)"}],{series:{lines:{show:true},points:{show:true}},grid:{hoverable:true,clickable:true,backgroundColor:{colors:["#fff","#eee"]}},yaxis:{min:-1.2,max:1.2},colors:["#539F2E","#3C67A5"]});function s(e,t,n){$('<div id="tooltip">'+n+"</div>").css({position:"absolute",display:"none",top:t+5,left:e+5,border:"1px solid #fdd",padding:"2px","background-color":"#dfeffc",opacity:.8}).appendTo("body").fadeIn(200)}var o=null;$("#sincos").bind("plothover",function(e,t,n){$("#x").text(t.x.toFixed(2));$("#y").text(t.y.toFixed(2));if(n){if(o!=n.dataIndex){o=n.dataIndex;$("#tooltip").remove();var r=n.datapoint[0].toFixed(2),i=n.datapoint[1].toFixed(2);s(n.pageX,n.pageY,n.series.label+" of "+r+" = "+i)}}else{$("#tooltip").remove();o=null}});$("#sincos").bind("plotclick",function(e,t,n){if(n){$("#clickdata").text("You clicked point "+n.dataIndex+" in "+n.series.label+".");i.highlight(n.series,n.datapoint)}})}if($("#flotchart").length){var u=[];for(var r=0;r<Math.PI*2;r+=.25)u.push([r,Math.sin(r)]);var a=[];for(var r=0;r<Math.PI*2;r+=.25)a.push([r,Math.cos(r)]);var f=[];for(var r=0;r<Math.PI*2;r+=.1)f.push([r,Math.tan(r)]);$.plot($("#flotchart"),[{label:"sin(x)",data:u},{label:"cos(x)",data:a},{label:"tan(x)",data:f}],{series:{lines:{show:true},points:{show:true}},xaxis:{ticks:[0,[Math.PI/2,"π/2"],[Math.PI,"π"],[Math.PI*3/2,"3π/2"],[Math.PI*2,"2π"]]},yaxis:{ticks:10,min:-2,max:2},grid:{backgroundColor:{colors:["#fff","#eee"]}}})}if($("#stackchart").length){var u=[];for(var r=0;r<=10;r+=1)u.push([r,parseInt(Math.random()*30)]);var a=[];for(var r=0;r<=10;r+=1)a.push([r,parseInt(Math.random()*30)]);var f=[];for(var r=0;r<=10;r+=1)f.push([r,parseInt(Math.random()*30)]);var l=0,c=true,h=false,p=false;function d(){$.plot($("#stackchart"),[u,a,f],{series:{stack:l,lines:{show:h,fill:true,steps:p},bars:{show:c,barWidth:.6}}})}d();$(".stackControls input").click(function(e){e.preventDefault();l=$(this).val()=="With stacking"?true:null;d()});$(".graphControls input").click(function(e){e.preventDefault();c=$(this).val().indexOf("Bars")!=-1;h=$(this).val().indexOf("Lines")!=-1;p=$(this).val().indexOf("steps")!=-1;d()})}var v=[{label:"Internet Explorer",data:12},{label:"Mobile",data:27},{label:"Safari",data:85},{label:"Opera",data:64},{label:"Firefox",data:90},{label:"Chrome",data:112}];if($("#piechart").length){$.plot($("#piechart"),v,{series:{pie:{show:true}},grid:{hoverable:true,clickable:true},legend:{show:false}});function m(e,t,n){if(!n)return;percent=parseFloat(n.series.percent).toFixed(2);$("#hover").html('<span style="font-weight: bold; color: '+n.series.color+'">'+n.series.label+" ("+percent+"%)</span>")}$("#piechart").bind("plothover",m)}if($("#donutchart").length){$.plot($("#donutchart"),v,{series:{pie:{innerRadius:.5,show:true}},legend:{show:false}})}var v=[],g=300;var b=30;$("#updateInterval").val(b).change(function(){var e=$(this).val();if(e&&!isNaN(+e)){b=+e;if(b<1)b=1;if(b>2e3)b=2e3;$(this).val(""+b)}});if($("#realtimechart").length){var w={series:{shadowSize:1},yaxis:{min:0,max:100},xaxis:{show:false}};var i=$.plot($("#realtimechart"),[y()],w);function E(){i.setData([y()]);i.draw();setTimeout(E,b)}E()}}$(document).ready(function(){function e(e){$("#bs-css").attr("href","css/bootstrap-"+e+".css")}if($.browser.msie){$("#is-ajax").prop("checked",false);$("#for-is-ajax").hide();$("#toggle-fullscreen").hide();$(".login-box").find(".input-large").removeClass("span10")}$("ul.main-menu li a").each(function(){if($($(this))[0].href==String(window.location))$(this).parent().addClass("active")});$("a.ajax-link").click(function(e){if($.browser.msie)e.which=1;if(e.which!=1||!$("#is-ajax").prop("checked")||$(this).parent().hasClass("active"))return;e.preventDefault();if($(".btn-navbar").is(":visible")){$(".btn-navbar").click()}$("#loading").remove();$("#content").fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');var t=$(this);History.pushState(null,null,t.attr("href"));$("ul.main-menu li.active").removeClass("active");t.parent("li").addClass("active")});$("ul.main-menu li:not(.nav-header)").hover(function(){$(this).animate({"margin-left":"+=5"},300)},function(){$(this).animate({"margin-left":"-=5"},300)});docReady()});$.fn.dataTableExt.oApi.fnPagingInfo=function(e){return{iStart:e._iDisplayStart,iEnd:e.fnDisplayEnd(),iLength:e._iDisplayLength,iTotal:e.fnRecordsTotal(),iFilteredTotal:e.fnRecordsDisplay(),iPage:Math.ceil(e._iDisplayStart/e._iDisplayLength),iTotalPages:Math.ceil(e.fnRecordsDisplay()/e._iDisplayLength)}};$.extend($.fn.dataTableExt.oPagination,{bootstrap:{fnInit:function(e,t,n){var r=e.oLanguage.oPaginate;var i=function(t){t.preventDefault();if(e.oApi._fnPageChange(e,t.data.action)){n(e)}};$(t).addClass("pagination").append("<ul>"+'<li class="prev disabled"><a href="#">&larr; '+r.sPrevious+"</a></li>"+'<li class="next disabled"><a href="#">'+r.sNext+" &rarr; </a></li>"+"</ul>");var s=$("a",t);$(s[0]).bind("click.DT",{action:"previous"},i);$(s[1]).bind("click.DT",{action:"next"},i)},fnUpdate:function(e,t){var n=5;var r=e.oInstance.fnPagingInfo();var i=e.aanFeatures.p;var s,o,u,a,f,l=Math.floor(n/2);if(r.iTotalPages<n){a=1;f=r.iTotalPages}else if(r.iPage<=l){a=1;f=n}else if(r.iPage>=r.iTotalPages-l){a=r.iTotalPages-n+1;f=r.iTotalPages}else{a=r.iPage-l+1;f=a+n-1}for(s=0,iLen=i.length;s<iLen;s++){$("li:gt(0)",i[s]).filter(":not(:last)").remove();for(o=a;o<=f;o++){u=o==r.iPage+1?'class="active"':"";$("<li "+u+'><a href="#">'+o+"</a></li>").insertBefore($("li:last",i[s])[0]).bind("click",function(n){n.preventDefault();e._iDisplayStart=(parseInt($("a",this).text(),10)-1)*r.iLength;t(e)})}if(r.iPage===0){$("li:first",i[s]).addClass("disabled")}else{$("li:first",i[s]).removeClass("disabled")}if(r.iPage===r.iTotalPages-1||r.iTotalPages===0){$("li:last",i[s]).addClass("disabled")}else{$("li:last",i[s]).removeClass("disabled")}}}}})
