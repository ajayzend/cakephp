(function(e){"";"use strict";var t={autoPlay:true,speed:5e3,text:{play:"",stop:"",previous:"Previous",next:"Next",loading:"Loading"},transition:[1],showCaption:true,IESafe:false,showTooltips:false,carousel:false,swipe:true,carouselVertical:false,animationFinished:null,buildFinished:null,bindsFinished:null,startOn:0,thumbOpacity:.4,hoverPause:false,animationSpeed:600,fadeThumbsIn:false,carouselOptions:{},thumbChangeEvent:"click.pikachoose",stopOnClick:false,hideThumbnails:false};e.fn.PikaChoose=function(t){return this.each(function(){e(this).data("pikachoose",new n(this,t))})};e.PikaChoose=function(n,r){this.options=e.extend({},t,r||{});this.list=null;this.image=null;this.anchor=null;this.caption=null;this.imgNav=null;this.imgPlay=null;this.imgPrev=null;this.imgNext=null;this.textNext=null;this.textPrev=null;this.previous=null;this.next=null;this.aniWrap=null;this.aniDiv=null;this.aniImg=null;this.thumbs=null;this.transition=null;this.active=null;this.tooltip=null;this.animating=false;this.stillOut=null;this.counter=null;this.timeOut=null;this.pikaStage=null;if(typeof this.options.data!="undefined"){n=e("<ul></ul>").addClass("jcarousel-skin-pika").appendTo(n);e.each(this.options.data,function(){var t=null;if(typeof this.link!="undefined"){t=e("<li><a href='"+this.link+"'><img></a></li>").appendTo(n);if(typeof this.title!="undefined"){t.find("a").attr("title",this.title)}}else{t=e("<li><img></li>").appendTo(n)}if(typeof this.caption!="undefined"){t.append("<span>"+this.caption+"</span>")}if(typeof this.thumbnail!="undefined"){t.find("img").attr("ref",this.image);t.find("img").attr("src",this.thumbnail)}else{t.find("img").attr("src",this.image)}})}if(n instanceof jQuery||n.nodeName.toUpperCase()=="UL"||n.nodeName.toUpperCase()=="OL"){this.list=e(n);this.build();this.bindEvents()}else{return}var i=0;var s=0;for(var o=0;o<25;o++){var u='<div col="'+i+'" row="'+s+'"></div>';this.aniDiv.append(u);i++;if(i==5){s++;i=0}}};var n=e.PikaChoose;n.fn=n.prototype={version:"96"};e.fn.pikachoose=e.fn.PikaChoose;n.fn.extend=n.extend=e.extend;n.fn.extend({build:function(){this.step=0;if(this.options.pikaStage){this.wrap=this.options.pikaStage;this.wrap.addClass("pika-stage")}else{this.wrap=e("<div class='pika-stage'></div>").insertBefore(this.list)}this.image=e("<img>").appendTo(this.wrap);this.imgNav=e("<div class='pika-imgnav'></div>").insertAfter(this.image);this.imgPlay=e("<a></a>").appendTo(this.imgNav);this.counter=e("<span class='pika-counter'></span>").appendTo(this.imgNav);if(this.options.autoPlay){this.imgPlay.addClass("pause")}else{this.imgPlay.addClass("play")}this.imgPrev=e("<a class='previous'></a>").insertAfter(this.imgPlay);this.imgNext=e("<a class='next'></a>").insertAfter(this.imgPrev);this.caption=e("<div class='caption'></div>").insertAfter(this.imgNav).hide();this.tooltip=e("<div class='pika-tooltip'></div>").insertAfter(this.list).hide();this.aniWrap=e("<div class='pika-aniwrap'></div>").insertAfter(this.caption);this.aniImg=e("<img>").appendTo(this.aniWrap).hide();this.aniDiv=e("<div class='pika-ani'></div>").appendTo(this.aniWrap);this.textNav=e("<div class='pika-textnav'></div>").insertAfter(this.aniWrap);this.textPrev=e("<a class='previous'>"+this.options.text.previous+"</a>").appendTo(this.textNav);this.textNext=e("<a class='next'>"+this.options.text.next+"</a>").appendTo(this.textNav);this.list.addClass("pika-thumbs");this.thumbs=this.list.find("img");this.loader=e("<div class='pika-loader'></div>").appendTo(this.wrap).hide().html(this.options.text.loading);this.active=this.thumbs.eq(this.options.startOn);this.finishAnimating({index:this.options.startOn,source:this.active.attr("ref")||this.active.attr("src"),caption:this.active.parents("li:first").find("span:first").html(),clickThrough:this.active.parent().attr("href")||"",clickThroughTarget:this.active.parent().attr("target")||"",clickThroughTitle:this.active.parent().attr("title")||""});this.aniDiv.css({position:"relative"});var t=this;this.updateThumbs();if(this.options.fadeThumbsIn){this.list.fadeIn()}if(this.options.hideThumbnails){this.list.hide()}if(this.options.carousel&&e.fn.jcarousel){var n={vertical:this.options.carouselVertical,initCallback:function(e){jQuery(e.list).find("img").click(function(n,r){if(typeof r!=="undefined"&&r.how=="auto"){if(t.options.autoPlay===false){return false}}var i=parseInt(jQuery(this).parents(".jcarousel-item").attr("jcarouselindex"),10);var s=jQuery(this).parents("ul").find("li:last").attr("jcarouselindex")==i-1?true:false;if(!s){i=i-2<=0?0:i-2}i++;e.scroll(i)})}};var r=e.extend({},n,this.options.carouselOptions||{});this.list.jcarousel(r)}if(this.options.swipe&&e.fn.touchwipe){this.wrap.touchwipe({wipeLeft:function(){t.Next()},wipeRight:function(){t.Prev()}})}if(typeof this.options.buildFinished=="function"){this.options.buildFinished(this)}},createThumb:function(t){var n=t;var r=this;this.thumbs=this.list.find("img");if(typeof e.data(t[0],"source")!=="undefined"){return}t.parents("li:first").wrapInner("<div class='clip' />");n.hide();e.data(t[0],"clickThrough",n.parent("a").attr("href")||"");e.data(t[0],"clickThroughTarget",n.parent("a").attr("target")||"");e.data(t[0],"clickThroughTitle",n.parent("a").attr("title")||"");if(n.parent("a").length>0){n.unwrap()}e.data(t[0],"caption",n.next("span").html()||"");n.next("span").remove();e.data(t[0],"source",n.attr("ref")||n.attr("src"));e.data(t[0],"imageTitle",n.attr("title")||"");e.data(t[0],"imageAlt",n.attr("alt")||"");e.data(t[0],"index",this.thumbs.index(t));e.data(t[0],"order",n.closest("ul").find("li").index(n.parents("li")));var i=e.data(t[0]);e("<img />").on("load",{data:i},function(){if(typeof r.options.buildThumbStart=="function"){r.options.buildThumbStart(r)}var t=e(this);var s=this.width;var o=this.height;if(s===0){s=t.attr("width")}if(o===0){o=t.attr("height")}var u=parseInt(n.parents(".clip").css("height").slice(0,-2),10);var a=parseInt(n.parents(".clip").css("width").slice(0,-2),10);if(a===0){a=n.parents("li:first").outerWidth()}if(u===0){u=n.parents("li:first").outerHeight()}var f=a/s;var l=u/o;var c;if(f<l){n.css({height:"100%"});n.fadeTo(.001,0);n.css({left:-(n.outerWidth()-a)/2});n.hide()}else{n.css({width:"100%"})}n.hover(function(t){clearTimeout(r.stillOut);e(this).stop(true,true).fadeTo(250,1);if(!r.options.showTooltips){return}r.tooltip.show().stop(true,true).html(i.caption).animate({top:e(this).parent().position().top,left:e(this).parent().position().left,opacity:1},"fast")},function(t){if(!e(this).hasClass("active")){e(this).stop(true,true).fadeTo(250,r.options.thumbOpacity);r.stillOut=setTimeout(r.hideTooltip,700)}});if(i.order==r.options.startOn){n.fadeTo(250,1);n.addClass("active");n.parents("li").eq(0).addClass("active")}else{n.fadeTo(250,r.options.thumbOpacity)}if(typeof r.options.buildThumbFinish=="function"){r.options.buildThumbFinish(r)}}).attr("src",n.attr("src"))},bindEvents:function(){this.thumbs.on(this.options.thumbChangeEvent,{self:this},this.imgClick);this.imgNext.on("click.pikachoose",{self:this},this.nextClick);this.textNext.on("click.pikachoose",{self:this},this.nextClick);this.imgPrev.on("click.pikachoose",{self:this},this.prevClick);this.textPrev.on("click.pikachoose",{self:this},this.prevClick);this.imgPlay.unbind("click.pikachoose").on("click.pikachoose",{self:this},this.playClick);this.wrap.unbind("mouseenter.pikachoose").on("mouseenter.pikachoose",{self:this},function(e){e.data.self.imgNav.stop(true,true).fadeTo("slow",1);if(e.data.self.options.hoverPause===true){clearTimeout(e.data.self.timeOut)}});this.wrap.unbind("mouseleave.pikachoose").on("mouseleave.pikachoose",{self:this},function(e){e.data.self.imgNav.stop(true,true).fadeTo("slow",0);if(e.data.self.options.autoPlay&&e.data.self.options.hoverPause){e.data.self.timeOut=setTimeout(function(e){return function(){e.nextClick()}}(e.data.self),e.data.self.options.speed)}});this.tooltip.unbind("mouseenter.pikachoose").on("mouseenter.pikachoose",{self:this},function(e){clearTimeout(e.data.self.stillOut)});this.tooltip.unbind("mouseleave.pikachoose").on("mouseleave.pikachoose",{self:this},function(e){e.data.self.stillOut=setTimeout(e.data.self.hideTooltip,700)});if(typeof this.options.bindsFinished=="function"){this.options.bindsFinished(this)}},hideTooltip:function(t){e(".pika-tooltip").animate({opacity:.01})},imgClick:function(t,n){var r=t.data.self;var i=e.data(this);if(r.animating){return}if(typeof n=="undefined"||n.how!="auto"){if(r.options.autoPlay&&r.options.stopOnClick){r.imgPlay.trigger("click")}else{clearTimeout(r.timeOut)}}else{if(!r.options.autoPlay){return false}}if(e(this).attr("src")!==e.data(this).source){r.loader.fadeIn("fast")}r.caption.fadeOut("slow");r.animating=true;r.active.fadeTo(300,r.options.thumbOpacity).removeClass("active");r.active.parents(".active").eq(0).removeClass("active");r.active=e(this);r.active.addClass("active").fadeTo(200,1);r.active.parents("li").eq(0).addClass("active");e("<img />").on("load",{self:r,data:i},function(){r.loader.fadeOut("fast");r.aniDiv.css({height:r.image.height(),width:r.image.width()}).show();r.aniDiv.children("div").css({width:"20%",height:"20%","float":"left"});var t=0;if(r.options.transition[0]==-1){t=Math.floor(Math.random()*7)+1}else{t=r.options.transition[r.step];r.step++;if(r.step>=r.options.transition.length){r.step=0}}if(r.options.IESafe&&e.browser.msie){t=1}r.doAnimation(t,i)}).attr("src",e.data(this).source)},doAnimation:function(t,n){this.aniWrap.css({position:"absolute",top:this.wrap.css("padding-top"),left:this.wrap.css("padding-left"),width:this.wrap.width()});var r=this;r.image.stop(true,false);r.caption.stop().fadeOut();var i=r.aniDiv.children("div").eq(0).width();var s=r.aniDiv.children("div").eq(0).height();var o=new Image;e(o).attr("src",n.source);if(o.height!=r.image.height()||o.width!=r.image.width()){if(t!==0&&t!==1&&t!==7){}}r.aniDiv.css({height:r.image.height(),width:r.image.width()});r.aniDiv.children().each(function(){var t=e(this);var r=Math.floor(t.parent().width()/5)*t.attr("col");var i=Math.floor(t.parent().height()/5)*t.attr("row");t.css({background:"url("+n.source+") -"+r+"px -"+i+"px","background-size":t.parent().width()+"px "+t.parent().height()+"px",width:"0px",height:"0px",position:"absolute",top:i+"px",left:r+"px","float":"none"})});r.aniDiv.hide();r.aniImg.hide();switch(t){case 0:r.image.stop(true,true).fadeOut(r.options.animationSpeed,function(){r.image.attr("src",n.source).fadeIn(r.options.animationSpeed,function(){r.finishAnimating(n)})});break;case 1:r.aniDiv.hide();r.aniImg.height(r.image.height()).hide().attr("src",n.source);r.wrap.css({height:r.image.height()});e.when(r.image.fadeOut(r.options.animationSpeed),r.aniImg.eq(0).fadeIn(r.options.animationSpeed)).done(function(){r.finishAnimating(n)});break;case 2:r.aniDiv.show().children().hide().each(function(t){var o=t*30;e(this).css({opacity:.1}).show().delay(o).animate({opacity:1,width:i,height:s},200,"linear",function(){if(r.aniDiv.find("div").index(this)==24){r.finishAnimating(n)}})});break;case 3:r.aniDiv.show().children("div:lt(5)").hide().each(function(t){var s=e(this).attr("col")*100;e(this).css({opacity:.1,width:i}).show().delay(s).animate({opacity:1,height:r.image.height()},r.options.animationSpeed,"linear",function(){if(r.aniDiv.find(" div").index(this)==4){r.finishAnimating(n)}})});break;case 4:r.aniDiv.show().children().hide().each(function(t){if(t>4){return}var o=e(this).attr("col")*30;var u=r.gapper(e(this),s,i);var a=r.options.animationSpeed*.7;e(this).css({opacity:.1,height:"100%"}).show().delay(o).animate({opacity:1,width:u.width},a,"linear",function(){if(r.aniDiv.find(" div").index(this)==4){r.finishAnimating(n)}})});break;case 5:r.aniDiv.show().children().show().each(function(t){var o=t*Math.floor(Math.random()*5)*7;var u=r.gapper(e(this),s,i);if(e(".animation div").index(this)==24){o=700}e(this).css({height:u.height,width:u.width,opacity:.01}).delay(o).animate({opacity:1},r.options.animationSpeed,function(){if(r.aniDiv.find(" div").index(this)==24){r.finishAnimating(n)}})});break;case 6:r.aniDiv.height(r.image.height()).hide().css({background:"url("+n.source+") top left no-repeat"});r.aniDiv.children("div").hide();r.aniDiv.css({width:0}).show().animate({width:r.image.width()},r.options.animationSpeed,function(){r.finishAnimating(n);r.aniDiv.css({background:"transparent"})});break;case 7:r.wrap.css({overflow:"hidden"});r.aniImg.height(r.image.height()).hide().attr("src",n.source);r.aniDiv.hide();r.image.css({position:"relative"}).animate({left:"-"+r.wrap.outerWidth()+"px"});r.aniImg.show();r.aniWrap.css({left:r.wrap.outerWidth()}).show().animate({left:"0px"},r.options.animationSpeed,function(){r.finishAnimating(n)});break}},finishAnimating:function(t){this.animating=false;this.image.attr("src",t.source);this.image.attr("alt",t.imageAlt);this.image.attr("title",t.imageTitle);this.image.css({left:"0"});this.image.show();var n=this;e("<img />").on("load",function(){n.aniImg.fadeOut("fast");n.aniDiv.fadeOut("fast")}).attr("src",t.source);var r=t.index+1;var i=this.thumbs.length;this.counter.html(r+"/"+i);if(t.clickThrough!==""){if(this.anchor===null){this.anchor=this.image.wrap("<a>").parent()}this.anchor.attr("href",t.clickThrough);this.anchor.attr("title",t.clickThroughTitle);this.anchor.attr("target",t.clickThroughTarget)}else{if(this.image.parent("a").length>0){this.image.unwrap()}this.anchor=null}if(this.options.showCaption&&t.caption!==""&&t.caption!==null){this.caption.html(t.caption).fadeTo("slow",1)}if(this.options.autoPlay&&i>1){this.timeOut=setTimeout(function(e){return function(){e.nextClick()}}(this),this.options.speed,this.timeOut)}if(typeof this.options.animationFinished=="function"){this.options.animationFinished(this)}},gapper:function(e,t,n){var r;if(e.attr("row")==4){r=this.aniDiv.height()-t*5+t;t=r}if(e.attr("col")==4){r=this.aniDiv.width()-n*5+n;n=r}return{height:t,width:n}},nextClick:function(e){var t="natural";var n=null;try{n=e.data.self;if(typeof e.data.self.options.next=="function"){e.data.self.options.next(this)}}catch(r){n=this;t="auto"}var i=n.active.parents("li:first").next().find("img");if(i.length===0){i=n.list.find("img").eq(0)}i.trigger("click",{how:t});return i},prevClick:function(e){if(typeof e.data.self.options.previous=="function"){e.data.self.options.previous(this)}var t=e.data.self;var n=t.active.parents("li:first").prev().find("img");if(n.length===0){n=t.list.find("img:last")}n.trigger("click");return n},playClick:function(e){var t=e.data.self;t.options.autoPlay=!t.options.autoPlay;t.imgPlay.toggleClass("play").toggleClass("pause");if(t.options.autoPlay){t.nextClick()}else{clearTimeout(t.timeOut)}return t.options.autoPlay?"playing":"paused"},Next:function(){var e={data:{self:this}};return this.nextClick(e)},Prev:function(){var e={data:{self:this}};return this.prevClick(e)},GoTo:function(e){var t={data:{self:this}};var n=this.list.find("img").eq(e);if(n.length>0){n.trigger("click");return n}else{throw"Image not found. Images are 0 indexed."}},Play:function(){if(this.options.autoPlay){return"playing"}var e={data:{self:this}};return this.playClick(e)},Pause:function(){if(!this.options.autoPlay){return"paused"}var e={data:{self:this}};return this.playClick(e)},updateThumbs:function(){var t=this;this.thumbs=this.list.find("img");this.thumbs.each(function(){t.createThumb(e(this),t)})}})})(jQuery)
