YUI.add("gallery-scrollintoview",function(e,t){"use strict";function r(t){var i=t.scrollIntoViewData;for(;;){var s=i.a.offsetParent===null,o=e.one(i.a),u=e.Node.getDOMNode(o)===e.config.doc.body,a=u?e.DOM.winWidth():i.a.clientWidth,f=u?e.DOM.winHeight():i.a.clientHeight;if(i.a.scrollWidth-o.horizMarginBorderPadding()>a||i.a.scrollHeight-o.vertMarginBorderPadding()>f)break;if(s)return t.fire("scrollIntoViewFinished"),t.scrollIntoViewData=null,!1;i.r.move(i.a.offsetLeft-i.a.scrollLeft,i.a.offsetTop-i.a.scrollTop),i.a=i.a.offsetParent||i.a.parentNode}var l=s?e.config.doc.documentElement.scrollLeft||e.config.doc.body.scrollLeft:i.a.scrollLeft,c=s?e.config.doc.documentElement.scrollTop||e.config.doc.body.scrollTop:i.a.scrollTop,h={top:c,bottom:c+(s?e.DOM.winHeight():i.a.clientHeight),left:l,right:l+(s?e.DOM.winWidth():i.a.clientWidth)};s&&i.margin&&(h.top+=i.margin.top||0,h.bottom-=i.margin.bottom||0,h.left+=i.margin.left||0,h.right-=i.margin.right||0);var p=0;o.getStyle("overflowY")!="hidden"&&(i.r.top<h.top?p=i.r.top-h.top:i.r.bottom>h.bottom&&(p=Math.min(i.r.bottom-h.bottom,i.r.top-h.top)));var d=0;o.getStyle("overflowX")!="hidden"&&(i.r.left<h.left?d=i.r.left-h.left:i.r.right>h.right&&(d=Math.min(i.r.right-h.right,i.r.left-h.left)));if(s){if(d||p)if(i.anim){var v=e.one("body");n&&(v=v.get("parentNode")),i.anim.setAttrs({node:v,to:{scrollLeft:v.get("scrollLeft")+d,scrollTop:v.get("scrollTop")+p}}),i.anim.once("end",function(){t.fire("scrollIntoViewFinished")}),i.anim.run()}else window.scrollBy(d,p),t.fire("scrollIntoViewFinished");else i.anim&&e.later(0,null,function(){t.fire("scrollIntoViewFinished")});return t.scrollIntoViewData=null,!1}return d||p?i.anim?(i.anim.setAttrs({node:e.one(i.a),to:{scrollLeft:i.a.scrollLeft+d,scrollTop:i.a.scrollTop+p}}),i.anim.once("end",function(){i.r.move(i.a.offsetLeft-i.a.scrollLeft,i.a.offsetTop-i.a.scrollTop),i.a=i.a.offsetParent,r(t)}),i.anim.run()):(i.a.scrollLeft+=d,i.a.scrollTop+=p,i.r.move(i.a.offsetLeft-i.a.scrollLeft,i.a.offsetTop-i.a.scrollTop),i.a=i.a.offsetParent):i.anim?e.later(0,null,function(){i.r.move(i.a.offsetLeft-i.a.scrollLeft,i.a.offsetTop-i.a.scrollTop),i.a=i.a.offsetParent,r(t)}):(i.r.move(i.a.offsetLeft-i.a.scrollLeft,i.a.offsetTop-i.a.scrollTop),i.a=i.a.offsetParent),!0}var n=YUI.Env.UA.gecko>0||YUI.Env.UA.opera>0;e.Node.prototype.scrollIntoView=function(t){if(this.scrollIntoViewData)return this;var n=e.Node.getDOMNode(this.get("offsetParent"));if(!n)return this;var i={top:this.get("offsetTop"),bottom:this.get("offsetTop")+this.get("offsetHeight"),left:this.get("offsetLeft"),right:this.get("offsetLeft")+this.get("offsetWidth")};i.move=function(e,t){this.top+=t,this.bottom+=t,this.left+=e,this.right+=e},this.scrollIntoViewData={a:n,r:i},t=t||{},this.scrollIntoViewData.margin=t.margin;if(t.anim){var s={};e.Lang.isObject(t.anim)&&e.mix(s,t.anim),this.scrollIntoViewData.anim=new e.Anim(s),r(this)}else while(r(this));return this}},"gallery-2013.06.13-01-19",{requires:["gallery-dimensions","dom-screen"]});