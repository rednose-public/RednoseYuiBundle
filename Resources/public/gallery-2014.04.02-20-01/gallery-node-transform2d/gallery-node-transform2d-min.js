YUI.add("gallery-node-transform2d",function(a){(function(e){var d=e.CSSMatrix2d,b=e.Node,c=e.merge;e.mix(b.prototype,{getMatrix:function(){return new d().setMatrixValue(this.getStyle("transform"));},inverseTransform:function(i,f){var h=this;try{return h.transform(h.getMatrix().inverse(),i,f);}catch(g){if(f){f();}return h;}},multiplyMatrix:function(f,h,g){return this.transform(this.getMatrix().multiply(f),h,g);},rotate:function(h,g,f){return this.transform(this.getMatrix().rotate(h),g,f);},rotateRad:function(h,g,f){return this.transform(this.getMatrix().rotateRad(h),g,f);},scale:function(g,h,f){return this.transform(this.getMatrix().scale(g),h,f);},scaleXY:function(f,i,h,g){return this.transform(this.getMatrix().scale(f,i),h,g);},skewX:function(h,g,f){return this.transform(this.getMatrix().skewX(h),g,f);},skewXRad:function(h,g,f){return this.transform(this.getMatrix().skewXRad(h),g,f);},skewY:function(h,g,f){return this.transform(this.getMatrix().skewY(h),g,f);},skewYRad:function(h,g,f){return this.transform(this.getMatrix().skewYRad(h),g,f);},transform:function(f,i,g){var h=this;f=f.toString();if(i&&h.transition){return h.transition(c(i,{transform:f}),g);}h.setStyle("transform",f);if(g){g();}return h;},translate:function(f,i,h,g){return this.transform(this.getMatrix().translate(f,i),h,g);}});}(a));},"gallery-2012.05.02-20-10",{requires:["gallery-cssmatrix2d","node-style"],skinnable:false,optional:["transition"]});