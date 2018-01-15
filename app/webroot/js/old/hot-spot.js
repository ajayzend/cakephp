//
// StormRETS Hotspots for jQuery
//
// Version 1.0
//
// Paul Trippett
// StormRETS
// 1st November 2010

(function( $ ){
    
    var hotspots = [];
    
    var settings = {
        'tourUrl': '',
        'tourWidth': 900
    };
    
    var methods = {
	
        init : function( options ) {
		
            this.each(function() {        
                if ( options ) { 
                    $.extend( settings, options );
                }
            });
            this.addClass('hotspotContainer');
            this.append('<img style="position: relative; left: 0px;" src="'+options['tourUrl']+'" id="hotspotVirtualTour" />');
            this.append('<div id="hotspotMessage" class="hotspotMessage"></div>');

            /*
            $('.hotspotObject', this).each(function(i, value) {
                h = {
                    'x': value.offsetLeft,
                    'y': value.offsetTop,
                    't': '1',
		          	'v': $(value).attr('id-value'),
                    'b': settings['tourWidth']
                };
                index=hotspots.push(h)-1;
                $(value).offset({
                    'left': $(value).offset().left ,
                    'top': $(value).offset().top
                });
                $(value).bind('click', function() {
					delid= $(this).attr('id');
					
					$('[name|="target"]', $('#dialog-confirm')).val(h['t'])
					$('[name|="target1"]', $('#show')).val(h['v'])
                
		
                });
            });
            */
            
        },
        addHotspot : function( ) {
            //$('#hotspotMessage').empty().append('Click the Image to place the hotspot.');
            //$('#hotspotVirtualTour').addClass('hotspotActive');            
            $('#hotspotVirtualTour').dblclick(function(e) {
                
                // Reset the message
                //
                $('#hotspotMessage').empty();
                // Reset the Object
                //
                //$(this).unbind('click')
                //$(this).removeClass('hotspotActive');
                
                // Get the Mouse Position
                //
                var x = e.pageX - $(this).offset().left;
                var y = e.pageY - $(this).offset().top;
				
				// Create the Hotspot Object and push onto array
				var h = {
                    'x': x,
                    'y': y,
                    't': e.pageX,
		            'v': $(this).offset().left,
                    'b': settings['tourWidth']
                };
                index = hotspots.push(h)-1;
                
                // Build the Hotspot
              var imagewidth=parseFloat($("#hotspotVirtualTour").width());
			  var imageheight=parseFloat($("#hotspotVirtualTour").height());
              var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1; //Check Chrome Browser
              if(is_chrome==true)
              {
			  var svgWidth=imagewidth+'px';
			  var svgHeight=imageheight+'px';
			  } else {
			  var svgWidth='100%';
			  var svgHeight='100%';  
			  }
              
              
              if($('#hotspotViewer svg').length==false)
              {
              $('#hotspotViewer').append('<svg id="makeSvg" style="width:100%;height:100%;position:absolute;left: 0px;z-index:1;" onClick="hideSvg();"></svg>');
			  }		
				
				var val=$("#hidden_i").val();
				if(parseInt(val)>8)
				{
				var marginLeft='5px';	
				} else {
				var marginLeft='10px';	
				}
				
				var i=parseInt(val)+1;
				$("#hidden_i").val(i);
				var top=parseFloat(y)-12;
					top=(top/imageheight)*100;
				var left=parseFloat(x)-12;
					left=(left/imagewidth)*100;
				
				
				
                hotspot = $('<img src="/img/hotspot.png" id="game_story_'+i+'" class="hotspotObject" style="position:absolute; top:'+(top)+'%; left:'+(left)+'%;z-index:2" title="Story Point '+i+'" onClick="focusHotspot('+i+');"/>');
                var hotspotname = $('<span id="game_story_name_'+i+'" class="hotspotObjectName" style="position:absolute; top:'+(top)+'%; left:'+(left)+'%;z-index:3;margin-left:'+marginLeft+';margin-top: 5px;color: #FFFFFF;font-size: 15px;font-weight:bold;cursor:pointer;" onClick="focusHotspot('+i+');">'+i+'</span>');
				
				//************Append Data in Right Side************
				$("#accordion2").show();
				$(".accordion-body").addClass('collapse');
				$(".accordion-body").removeClass('in');
				$(".accordion-body").css('height','0px');
				var spot ='<form class="story_point_form" id="story_point_form' +i+ '" enctype="multipart/formdata">';
				spot+='<input class="create_story" type="hidden" id="create_story_id_'+i+'" value=""/>';
				spot+='<div class="accordion-group" id="focus_hotspot_'+i+'">';
				spot+='<div class="accordion-heading accord"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_'+i+'" onClick="autosaveStory();">Story Point '+i+'<i class="icon-remove-sign pull-right" style="margin-left:10px;" onClick="deleteHotspot(\''+i+'\');"></i><i class="icon-caret-down pull-right"></i></a></div>';
				spot+='<div id="collapse_'+i+'" class="accordion-body collapse in">';
				spot+='<div class="accordion-inner"><form class="bs-docs-example form-horizontal">';
				
				spot+='<div class="control-group">';
				spot+='<label class="control-label upload_image"><strong>Upload Image: (Optional.)</strong></label>';
				spot+='<div class="controls"><input type="file" placeholder="" name="uploads_image" class="span11 uploads_image" id="uploads_image_'+i+'" onChange="uploadStoryImage(this);"></div>';
				spot+='<div class="uploadImgName" id="uploadImgName_'+i+'"></div>';
				spot+='</div>';
				
				spot+='<div class="control-group">';
				spot+='<label class="control-label"><strong>Link to image url: (Optional.)</strong></label>';
				spot+='<div class="controls"><input type="text" id="link_image_'+i+'" placeholder="url:" class="span11 link_image" name="link_image" onkeyup="validateLinkImage(this.id);"></div>';
				spot+='</div>';
				
				spot+='<div class="control-group">';
				spot+='<label lass="control-label"><strong>Embed YouTube or Vimeo Video:(Optional.)</strong></label>';
				spot+='<div class="controls"><input type="text" placeholder="url:" id="embed_video_'+i+'" class="span11 embed_video" name="embed_video" onkeyup="validateEmbedVideo(this.id);"></div>';
				spot+='</div>';
				
				spot+='<div class="control-group">';
				spot+='<label class="control-label"><strong>Tell story</strong></label>';
				spot+='<div class="controls"><textarea class="tell_story" rows="3" id="tell_story_'+i+'" name="tell_story"></textarea></div>';
				spot+='</div>';

				spot+='</div></div></div></form>';
				
				$("#accordion2").append(spot);
	
				/*
				setTimeout(function()
                {
                $(window).scrollTop($('#focus_hotspot_'+i).offset().top);
                $("html, body").animate({ scrollTop: 0 }, 800);
                }, 1000);
				*/
				
				//Create Svg Line
				var points=parseInt($("#hidden_i").val());
				if(points>1)
				{
				 
				var pointsPrev=points-1;	
				var leftPrev=parseFloat($("#game_story_"+pointsPrev).css('left'));
				var topPrev=parseFloat($("#game_story_"+pointsPrev).css('top'));
				
				if(is_chrome==true)
				{
				leftPrev=leftPrev*imagewidth/100;
				topPrev=topPrev*imageheight/100;
				}
				leftPrev = 100*(leftPrev+12)/imagewidth;
				topPrev = 100*(topPrev+12)/imageheight;
				
				var topNew=parseFloat(y);
					topNew=(topNew/imageheight)*100;
				var leftNew=parseFloat(x);
					leftNew=(leftNew/imagewidth)*100;
				
				var newLine = document.createElementNS('http://www.w3.org/2000/svg','line');
				newLine.setAttribute('x1',leftPrev+'%');
				newLine.setAttribute('y1',topPrev+'%');
				newLine.setAttribute('x2',leftNew+'%');
				newLine.setAttribute('y2',topNew+'%');
				newLine.setAttribute('id','game_story_svg_'+i);
				newLine.setAttribute('class','hotspotObjectSvg');
				newLine.style.stroke='rgb(255,0,0)';
				newLine.setAttribute('stroke-width','4');
				newLine.setAttribute('stroke-dasharray','13,3');
				$("#makeSvg").append(newLine);
				}
				
				//After Click on Hot Spot
				hotspot.bind('click', function() {
				delid= $(this).attr('id');
                $('[name|="target"]', $('#dialog-confirm')).val(h['d'])
		
                });
                
                // Draw the new Hotspot
                //
                $('.hotspotContainer').append(hotspot);
                $('.hotspotContainer').append(hotspotname);
                $('#makeSvg').css('display','');
                
                saveHotspot(i);
                
            });
            return this;
        },
        clearHotspots:function() {
            hotspots = [];
            $('.hotspotObject').remove();
            $('.hotspotObjectName').remove();
            return this;
        },
        serialize: function() {
		
		
			var hotspots = []; var j=0;
			var property_id=$("#property_id").val();
			var group_id=$("#group_id").val();
			var virtualtour_id=$("#virtualtour_id").val();
            $('.hotspotObject', this).each(function(i, value) {
                h = {
                    'x': value.offsetLeft,
                    'y': value.offsetTop,
                    't': $(value).attr('data-value'),
					'v': $(value).attr('id-value'),
                    'b': settings['tourWidth']
                };
                index=hotspots.push(h)-1;
                $(value).offset({
                    'left': $(value).offset().left,
                    'top': $(value).offset().top
                });
				j++;
			});
            return {'hotspots': hotspots, 'postback': true, 'property_id': property_id, 'group_id': group_id, 'virtualtour_id': virtualtour_id}
        }
    };
    
    $.fn.agentstormHotspotViewer = function(method) {
        
        // Method calling logic
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist' );
        }
        
    };
    
})( jQuery );
