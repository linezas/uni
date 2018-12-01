/*
YUI 3.17.2 (build 9c3c78e)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("plugin",function(e,t){function n(t){!this.hasImpl||!this.hasImpl(e.Plugin.Base)?n.superclass.constructor.apply(this,arguments):n.prototype.initializer.apply(this,arguments)}n.ATTRS={host:{writeOnce:!0}},n.NAME="plugin",n.NS="plugin",e.extend(n,e.Base,{_handles:null,initializer:function(e){this._handles=[]},destructor:function(){if(this._handles)for(var e=0,t=this._handles.length;e<t;e++)this._handles[e].detach()},doBefore:function(e,t,n){var r=this.get("host"),i;return e in r?i=this.beforeHostMethod(e,t,n):r.on&&(i=this.onHostEvent(e,t,n)),i},doAfter:function(e,t,n){var r=this.get("host"),i;return e in r?i=this.afterHostMethod(e,t,n):r.after&&(i=this.afterHostEvent(e,t,n)),i},onHostEvent:function(e,t,n){var r=this.get("host").on(e,t,n||this);return this._handles.push(r),r},onceHostEvent:function(e,t,n){var r=this.get("host").once(e,t,n||this);return this._handles.push(r),r},afterHostEvent:function(e,t,n){var r=this.get("host").after(e,t,n||this);return this._handles.push(r),r},onceAfterHostEvent:function(e,t,n){var r=this.get("host").onceAfter(e,t,n||this);return this._handles.push(r),r},beforeHostMethod:function(t,n,r){var i=e.Do.before(n,this.get("host"),t,r||this);return this._handles.push(i),i},afterHostMethod:function(t,n,r){var i=e.Do.after(n,this.get("host"),t,r||this);return this._handles.push(i),i},toString:function(){return this.constructor.NAME+"["+this.constructor.NS+"]"}}),e.namespace("Plugin").Base=n},"3.17.2",{requires:["base-base"]});
YUI.add("moodle-core-lockscroll",function(e,t){e.namespace("M.core").LockScroll=e.Base.create("lockScroll",e.Plugin.Base,[],{_enabled:!1,destructor:function(){this.disableScrollLock()},enableScrollLock:function(t){if(this.isActive())return;var n=this.get("host").get("boundingBox").get("region").height,r=e.config.win.innerHeight||e.config.doc.documentElement.clientHeight||0;if(!t&&n>r-10)return;this._enabled=!0;var i=e.one(e.config.doc.body),s=i.getComputedStyle("width");i.addClass("lockscroll");var o=parseInt(i.getAttribute("data-activeScrollLocks"),10)||0,u=o+1;return i.setAttribute("data-activeScrollLocks",u),o===0&&i.setStyle("maxWidth",s),this},disableScrollLock:function(){if(this.isActive()){this._enabled=!1;var t=e.one(e.config.doc.body),n=parseInt(t.getAttribute("data-activeScrollLocks"),10)||1,r=n-1;n===1&&(t.removeClass("lockscroll"),t.setStyle("maxWidth",null)),t.setAttribute("data-activeScrollLocks",n-1)}return this},isActive:function(){return this._enabled}},{NS:"lockScroll",ATTRS:{}})},"@VERSION@",{requires:["plugin","base-build"]});
YUI.add("moodle-core-notification-alert",function(e,t){var n,r,i,s,o,u,a;n="moodle-dialogue",r="notificationBase",i="yesLabel",s="noLabel",o="title",u="question",a={BASE:"moodle-dialogue-base",WRAP:"moodle-dialogue-wrap",HEADER:"moodle-dialogue-hd",BODY:"moodle-dialogue-bd",CONTENT:"moodle-dialogue-content",FOOTER:"moodle-dialogue-ft",HIDDEN:"hidden",LIGHTBOX:"moodle-dialogue-lightbox"},M.core=M.core||{};var f="Moodle alert",l;l=function(e){e.closeButton=!1,l.superclass.constructor.apply(this,[e])},e.extend(l,M.core.notification.info,{_closeEvents:null,initializer:function(){this._closeEvents=[],this.publish("complete");var t=e.Node.create('<input type="button" id="id_yuialertconfirm-'+this.get("COUNT")+'"'+'value="'+this.get(i)+'" />'),n=e.Node.create('<div class="confirmation-dialogue"></div>').append(e.Node.create('<div class="confirmation-message">'+this.get("message")+"</div>")).append(e.Node.create('<div class="confirmation-buttons"></div>').append(t));this.get(r).addClass("moodle-dialogue-confirm"),this.setStdModContent(e.WidgetStdMod.BODY,n,e.WidgetStdMod.REPLACE),this.setStdModContent(e.WidgetStdMod.HEADER,'<h1 id="moodle-dialogue-'+this.get("COUNT")+'-header-text">'+this.get(o)+"</h1>",e.WidgetStdMod.REPLACE),this._closeEvents.push(e.on("key",this.submit,window,"down:13",this),t.on("click",this.submit,this));var s=this.get("boundingBox").one(".closebutton");s&&this._closeEvents.push(s.on("click",this.submit,this))},submit:function(){(new e.EventHandle(this._closeEvents)).detach(),this.fire("complete"),this.hide(),this.destroy()}},{NAME:f,CSS_PREFIX:n,ATTRS:{title:{validator:e.Lang.isString,value:"Alert"},message:{validator:e.Lang.isString,value:"Confirm"},yesLabel:{validator:e.Lang.isString,setter:function(e){return e||(e="Ok"),e},value:"Ok"}}}),M.core.alert=l},"@VERSION@",{requires:["moodle-core-notification-dialogue"]});
YUI.add("moodle-core-notification-exception",function(e,t){var n,r,i,s,o,u,a;n="moodle-dialogue",r="notificationBase",i="yesLabel",s="noLabel",o="title",u="question",a={BASE:"moodle-dialogue-base",WRAP:"moodle-dialogue-wrap",HEADER:"moodle-dialogue-hd",BODY:"moodle-dialogue-bd",CONTENT:"moodle-dialogue-content",FOOTER:"moodle-dialogue-ft",HIDDEN:"hidden",LIGHTBOX:"moodle-dialogue-lightbox"},M.core=M.core||{};var f="Moodle exception",l;l=function(t){var n=e.mix({},t);n.width=n.width||M.cfg.developerdebug?Math.floor(e.one(document.body).get("winWidth")/3)+"px":null,n.closeButton=!0;var r=["message","name","fileName","lineNumber","stack"];e.Array.each(r,function(e){n[e]=t[e]}),l.superclass.constructor.apply(this,[n])},e.extend(l,M.core.notification.info,{_hideTimeout:null,_keypress:null,initializer:function(t){var n,i=this,s=this.get("hideTimeoutDelay");this.get(r).addClass("moodle-dialogue-exception"),this.setStdModContent(e.WidgetStdMod.HEADER,'<h1 id="moodle-dialogue-'+t.COUNT+'-header-text">'+e.Escape.html(t.name)+"</h1>",e.WidgetStdMod.REPLACE),n=e.Node.create('<div class="moodle-exception"></div>').append(e.Node.create('<div class="moodle-exception-message">'+e.Escape.html(this.get("message"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-filename"><label>File:</label> '+e.Escape.html(this.get("fileName"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-linenumber"><label>Line:</label> '+e.Escape.html(this.get("lineNumber"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-stacktrace"><label>Stack trace:</label> <pre>'+this.get("stack")+"</pre></div>")),M.cfg.developerdebug&&n.all(".moodle-exception-param").removeClass("hidden"),this.setStdModContent(e.WidgetStdMod.BODY,n,e.WidgetStdMod.REPLACE),s&&(this._hideTimeout=setTimeout(function(){i.hide()},s)),this.after("visibleChange",this.visibilityChanged,this),this._keypress=e.on("key",this.hide,window,"down:13,27",this),this.centerDialogue()},visibilityChanged:function(e){if(e.attrName==="visible"&&e.prevVal&&!e.newVal){this._keypress&&this._keypress.detach();var t=this;setTimeout(function(){t.destroy()},1e3)}}},{NAME:f,CSS_PREFIX:n,ATTRS:{message:{value:""},name:{value:""},fileName:{value:""},lineNumber:{value:""},stack:{setter:function(t){var n=e.Escape.html(t).split("\n"),r=new RegExp("^(.+)@("+M.cfg.wwwroot+")?(.{0,75}).*:(\\d+)$"),i;for(i in n)n[i]=n[i].replace(r,"<div class='stacktrace-line'>ln: $4</div><div class='stacktrace-file'>$3</div><div class='stacktrace-call'>$1</div>");return n.join("")},value:""},hideTimeoutDelay:{validator:e.Lang.isNumber,value:null}}}),M.core.exception=l},"@VERSION@",{requires:["moodle-core-notification-dialogue"]});
YUI.add("moodle-core-notification-ajaxexception",function(e,t){var n,r,i,s,o,u,a;n="moodle-dialogue",r="notificationBase",i="yesLabel",s="noLabel",o="title",u="question",a={BASE:"moodle-dialogue-base",WRAP:"moodle-dialogue-wrap",HEADER:"moodle-dialogue-hd",BODY:"moodle-dialogue-bd",CONTENT:"moodle-dialogue-content",FOOTER:"moodle-dialogue-ft",HIDDEN:"hidden",LIGHTBOX:"moodle-dialogue-lightbox"},M.core=M.core||{};var f="Moodle AJAX exception",l;l=function(e){e.name=e.name||"Error",e.closeButton=!0,l.superclass.constructor.apply(this,[e])},e.extend(l,M.core.notification.info,{_keypress:null,initializer:function(t){var n,i=this,s=this.get("hideTimeoutDelay");this.get(r).addClass("moodle-dialogue-exception"),this.setStdModContent(e.WidgetStdMod.HEADER,'<h1 id="moodle-dialogue-'+this.get("COUNT")+'-header-text">'+e.Escape.html(t.name)+"</h1>",e.WidgetStdMod.REPLACE),n=e.Node.create('<div class="moodle-ajaxexception"></div>').append(e.Node.create('<div class="moodle-exception-message">'+e.Escape.html(this.get("error"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-debuginfo"><label>URL:</label> '+this.get("reproductionlink")+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-debuginfo"><label>Debug info:</label> '+e.Escape.html(this.get("debuginfo"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-stacktrace"><label>Stack trace:</label> <pre>'+e.Escape.html(this.get("stacktrace"))+"</pre></div>")),M.cfg.developerdebug&&n.all(".moodle-exception-param").removeClass("hidden"),this.setStdModContent(e.WidgetStdMod.BODY,n,e.WidgetStdMod.REPLACE),s&&(this._hideTimeout=setTimeout(function(){i.hide()},s)),this.after("visibleChange",this.visibilityChanged,this),this._keypress=e.on("key",this.hide,window,"down:13, 27",this),this.centerDialogue()},visibilityChanged:function(e){if(e.attrName==="visible"&&e.prevVal&&!e.newVal){var t=this;this._keypress.detach(),setTimeout(function(){t.destroy()},1e3)}}},{NAME:f,CSS_PREFIX:n,ATTRS:{error:{validator:e.Lang.isString,value:M.util.get_string("unknownerror","moodle")},debuginfo:{value:null},stacktrace:{value:null},reproductionlink:{setter:function(t){return t!==null&&(t=e.Escape.html(t),t='<a href="'+t+'">'+t.replace(M.cfg.wwwroot,"")+"</a>"),t},value:null},hideTimeoutDelay:{validator:e.Lang.isNumber,value:null}}}),M.core.ajaxException=l},"@VERSION@",{requires:["moodle-core-notification-dialogue"]});
YUI.add("moodle-filter_glossary-autolinker",function(e,t){var n="Glossary filter autolinker",r="width",i="height",s="menubar",o="location",u="scrollbars",a="resizable",f="toolbar",l="status",c="directories",h="fullscreen",p="dependent",d;d=function(){d.superclass.constructor.apply(this,arguments)},e.extend(d,e.Base,{overlay:null,alertpanels:{},initializer:function(){var t=this;require(["core/event"],function(n){e.delegate("click",function(r){r.preventDefault();var i="",s=e.Node.create('<div id="glossaryfilteroverlayprogress"><img src="'+M.cfg.loadingicon+'" class="spinner" />'+"</div>"),o=new e.Overlay({headerContent:i,bodyContent:s}),u,a;t.overlay=o,o.render(e.one(document.body)),u=this.getAttribute("href").replace("showentry.php","showentry_ajax.php"),a={method:"get",context:t,on:{success:function(e,t){this.display_callback(t.responseText,n)},failure:function(e,t){var n=t.statusText;M.cfg.developerdebug&&(t.statusText+=" ("+u+")"),new M.core.exception({message:n})}}},e.io(u,a)},e.one(document.body),"a.glossary.autolink.concept")})},display_callback:function(t,n){var r,i,s,o,u,a;try{r=e.JSON.parse(t);if(r.success){this.overlay.hide();for(i in r.entries)u=r.entries[i].definition+r.entries[i].attachments,s=new M.core.alert({title:r.entries[i].concept,draggable:!0,message:u,modal:!1,yesLabel:M.util.get_string("ok","moodle")}),n.notifyFilterContentUpdated(s.get("boundingBox").getDOMNode()),e.Node.one("#id_yuialertconfirm-"+s.get("COUNT")).focus(),o="#moodle-dialogue-"+s.get("COUNT"),s.on("complete",this._deletealertpanel,this,o),e.Object.isEmpty(this.alertpanels)||(a=this._getLatestWindowPosition(),e.Node.one(o).setXY([a[0]+10,a[1]+10])),this.alertpanels[o]=e.Node.one(o).getXY();return!0}r.error&&new M.core.ajaxException(r)}catch(f){new M.core.exception(f)}return!1},_getLatestWindowPosition:function(){var t=[0,0];return e.Object.each(this.alertpanels,function(e){e[0]>t[0]&&(t=e)}),t},_deletealertpanel:function(e,t){delete this.alertpanels[t]}},{NAME:n,ATTRS:{url:{validator:e.Lang.isString,value:M.cfg.wwwroot+"/mod/glossary/showentry.php"},name:{validator:e.Lang.isString,value:"glossaryconcept"},options:{getter:function(){return{width:this.get(r),height:this.get(i),menubar:this.get(s),location:this.get(o),scrollbars:this.get(u),resizable:this.get(a),toolbar:this.get(f),status:this.get(l),directories:this.get(c),fullscreen:this.get(h),dependent:this.get(p)}},readOnly:!0},width:{value:600},height:{value:450},menubar:{value:!1},location:{value:!1},scrollbars:{value:!0},resizable:{value:!0},toolbar:{value:!0},status:{value:!0},directories:{value:!1},fullscreen:{value:!1},dependent:{value:!0}}}),M.filter_glossary=M.filter_glossary||{},M.filter_glossary.init_filter_autolinking=function(e){return new d(e)}},"@VERSION@",{requires:["base","node","io-base","json-parse","event-delegate","overlay","moodle-core-event","moodle-core-notification-alert","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]});
