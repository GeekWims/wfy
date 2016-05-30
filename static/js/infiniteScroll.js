function RGInfiniteScroll(el,options){var self=this;var eventID=".rgInfiniteScroll";var bottomY=0;this.$self=$(el);this.sets=$.extend({},this.defaults,options);this.sets.ajaxOptions=$.extend({},this.defaults.ajaxOptions,options.ajaxOptions);this.sets.loadOptions=$.extend({},this.defaults.loadOptions,options.loadOptions);this.current=this.sets.startNumber;var scrollEvent=function(){self.$self.on("scroll"+eventID,function(){bottomY=$(document).height()-$(window).height()-self.sets.bottomSpace;if($(window).scrollTop()>bottomY){self.current++;if(self.sets.url){if(self.sets.loadingAction){self.sets.loadingAction(true)}switch(self.sets.method){case"load":self.load(self.current);break;case"ajax":self.ajax(self.current);break}}}})};var changeUrl=function(url,n){return url.replace("{page}",n)};this.load=function(n){var options=null;var selector=null;if(this.sets.loadOptions){options=this.sets.loadOptions;selector=options.selector?" "+options.selector:""}else{return false}self.stop();this.current+=!n?1:0;n=n?n:this.current+1;$("<div>").load(changeUrl(this.sets.url,n)+selector,function(data,status){var more=status=="success";if(self.sets.loadingAction){self.sets.loadingAction(false)}var $add=$(this).children();options.target.append($add);if(options.complete){var result=options.complete($add);more=result?true:false}if(more){self.run()}})};this.ajax=function(n){if(!this.sets.ajaxOptions)return false;self.stop();this.current+=!n?1:0;n=n?n:this.current;$.ajax({url:changeUrl(this.sets.url,n),cache:false,data:this.sets.ajaxOptions.data,dataType:this.sets.ajaxOptions.dataType}).done(function(data,status){if(self.sets.loadingAction){self.sets.loadingAction(false)}if(self.sets.ajaxOptions.complete){var more=self.sets.ajaxOptions.complete(data,status);if(more){self.run()}}})};this.run=function(sw){this.stop();scrollEvent();return sw?this:null};this.stop=function(){this.$self.off("scroll"+eventID)};this.setPageNumber=function(n){this.current=n?n:this.sets.startNumber};this.run()}RGInfiniteScroll.prototype.defaults={bottomSpace:50,url:null,startNumber:2,method:"load",ajaxOptions:{data:"",dataType:"",complete:function(data,status){console.log(data)}},loadOptions:{target:null,selector:"",complete:function(data){console.log(data);return true}},loadingAction:function(sw){}};(function($){return $.fn.rgInfiniteScroll=function(options){return new RGInfiniteScroll($(this),options).run(true)}})(jQuery);