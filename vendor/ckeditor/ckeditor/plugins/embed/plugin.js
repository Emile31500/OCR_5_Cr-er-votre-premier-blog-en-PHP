﻿/*
 Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
<<<<<<< HEAD
(function(){CKEDITOR.plugins.add("embed",{icons:"embed",hidpi:!0,requires:"embedbase",init:function(a){var b=CKEDITOR.plugins.embedBase.createWidgetBaseDefinition(a),e=b.init;a.config.embed_provider||CKEDITOR.error("embed-no-provider-url");CKEDITOR.tools.extend(b,{dialog:"embedBase",button:a.lang.embedbase.button,allowedContent:"div[!data-oembed-url]",requiredContent:"div[data-oembed-url]",providerUrl:new CKEDITOR.template(a.config.embed_provider||""),styleToAllowedContentRules:function(a){return{div:{propertiesOnly:!0,
classes:a.getClassesArray(),attributes:"!data-oembed-url"}}},init:function(){e.call(this);if(!a.config.embed_keepOriginalContent)this.on("ready",function(){this.loadContent(this.data.url,{callback:function(){a.fire("updateSnapshot")}})})},upcast:function(c,b){var d;if("div"==c.name&&c.attributes["data-oembed-url"]){b.url=c.attributes["data-oembed-url"];if(!a.config.embed_keepOriginalContent)for(;d=c.getFirst();)d.remove();return!0}},downcast:function(a){a.attributes["data-oembed-url"]=this.data.url}},
!0);a.widgets.add("embed",b);a.config.embed_keepOriginalContent&&a.filter.addElementCallback(function(a){if("data-oembed-url"in a.attributes)return CKEDITOR.FILTER_SKIP_TREE})}})})();CKEDITOR.config.embed_keepOriginalContent=!1;
=======
(function(){CKEDITOR.plugins.add("embed",{icons:"embed",hidpi:!0,requires:"embedbase",init:function(b){var c=CKEDITOR.plugins.embedBase.createWidgetBaseDefinition(b);b.config.embed_provider||CKEDITOR.error("embed-no-provider-url");CKEDITOR.tools.extend(c,{dialog:"embedBase",button:b.lang.embedbase.button,allowedContent:"div[!data-oembed-url]",requiredContent:"div[data-oembed-url]",providerUrl:new CKEDITOR.template(b.config.embed_provider||""),styleToAllowedContentRules:function(a){return{div:{propertiesOnly:!0,
classes:a.getClassesArray(),attributes:"!data-oembed-url"}}},upcast:function(a,b){if("div"==a.name&&a.attributes["data-oembed-url"])return b.url=a.attributes["data-oembed-url"],!0},downcast:function(a){a.attributes["data-oembed-url"]=this.data.url}},!0);b.widgets.add("embed",c);b.filter.addElementCallback(function(a){if("data-oembed-url"in a.attributes)return CKEDITOR.FILTER_SKIP_TREE})}})})();
>>>>>>> OCR5/master
