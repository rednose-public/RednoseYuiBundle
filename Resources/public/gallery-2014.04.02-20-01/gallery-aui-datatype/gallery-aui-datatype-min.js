YUI.add("gallery-aui-datatype",function(C){var B=C.Lang,F="false",E="true",D=C.namespace("DataType.Boolean"),G=C.namespace("DataType.String");D.parse=function(A){A=C.Lang.trim(A);return(A==F)?false:!!A;};G.evaluate=function(I){var A=C.Lang.trim(I);if(A==E||A==F){return D.parse(I);}if(A&&B.isString(A)){var H=+A;if(!isNaN(H)){return H;}}return I;};},"gallery-2010.08.18-17-12",{skinnable:false,requires:["gallery-aui-base"]});