if (typeof __coverage__ === 'undefined') { __coverage__ = {}; }
if (!__coverage__['build/gallery-rocket-child-view-container/gallery-rocket-child-view-container.js']) {
   __coverage__['build/gallery-rocket-child-view-container/gallery-rocket-child-view-container.js'] = {"path":"build/gallery-rocket-child-view-container/gallery-rocket-child-view-container.js","s":{"1":0,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0,"13":0,"14":0,"15":0,"16":0,"17":0,"18":0,"19":0,"20":0,"21":0,"22":0,"23":0,"24":0,"25":0,"26":0,"27":0,"28":0,"29":0},"b":{"1":[0,0],"2":[0,0],"3":[0,0]},"f":{"1":0,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0},"fnMap":{"1":{"name":"(anonymous_1)","line":1,"loc":{"start":{"line":1,"column":47},"end":{"line":1,"column":66}}},"2":{"name":"(anonymous_2)","line":5,"loc":{"start":{"line":5,"column":25},"end":{"line":5,"column":41}}},"3":{"name":"(anonymous_3)","line":13,"loc":{"start":{"line":13,"column":7},"end":{"line":13,"column":22}}},"4":{"name":"(anonymous_4)","line":24,"loc":{"start":{"line":24,"column":15},"end":{"line":24,"column":31}}},"5":{"name":"(anonymous_5)","line":28,"loc":{"start":{"line":28,"column":23},"end":{"line":28,"column":47}}},"6":{"name":"(anonymous_6)","line":33,"loc":{"start":{"line":33,"column":18},"end":{"line":33,"column":37}}},"7":{"name":"(anonymous_7)","line":37,"loc":{"start":{"line":37,"column":15},"end":{"line":37,"column":31}}},"8":{"name":"(anonymous_8)","line":41,"loc":{"start":{"line":41,"column":10},"end":{"line":41,"column":25}}},"9":{"name":"(anonymous_9)","line":53,"loc":{"start":{"line":53,"column":17},"end":{"line":53,"column":28}}},"10":{"name":"(anonymous_10)","line":57,"loc":{"start":{"line":57,"column":8},"end":{"line":57,"column":19}}},"11":{"name":"(anonymous_11)","line":64,"loc":{"start":{"line":64,"column":8},"end":{"line":64,"column":30}}}},"statementMap":{"1":{"start":{"line":1,"column":0},"end":{"line":76,"column":59}},"2":{"start":{"line":5,"column":0},"end":{"line":10,"column":2}},"3":{"start":{"line":6,"column":2},"end":{"line":6,"column":19}},"4":{"start":{"line":7,"column":2},"end":{"line":7,"column":26}},"5":{"start":{"line":8,"column":2},"end":{"line":8,"column":23}},"6":{"start":{"line":9,"column":2},"end":{"line":9,"column":32}},"7":{"start":{"line":12,"column":0},"end":{"line":71,"column":2}},"8":{"start":{"line":14,"column":4},"end":{"line":14,"column":44}},"9":{"start":{"line":16,"column":4},"end":{"line":16,"column":37}},"10":{"start":{"line":18,"column":4},"end":{"line":20,"column":5}},"11":{"start":{"line":19,"column":6},"end":{"line":19,"column":75}},"12":{"start":{"line":21,"column":4},"end":{"line":21,"column":25}},"13":{"start":{"line":25,"column":4},"end":{"line":25,"column":59}},"14":{"start":{"line":29,"column":4},"end":{"line":29,"column":57}},"15":{"start":{"line":30,"column":4},"end":{"line":30,"column":45}},"16":{"start":{"line":34,"column":4},"end":{"line":34,"column":33}},"17":{"start":{"line":38,"column":4},"end":{"line":38,"column":47}},"18":{"start":{"line":42,"column":4},"end":{"line":42,"column":44}},"19":{"start":{"line":44,"column":4},"end":{"line":46,"column":5}},"20":{"start":{"line":45,"column":6},"end":{"line":45,"column":67}},"21":{"start":{"line":48,"column":4},"end":{"line":48,"column":37}},"22":{"start":{"line":49,"column":4},"end":{"line":49,"column":25}},"23":{"start":{"line":54,"column":4},"end":{"line":54,"column":45}},"24":{"start":{"line":58,"column":4},"end":{"line":58,"column":23}},"25":{"start":{"line":65,"column":4},"end":{"line":65,"column":17}},"26":{"start":{"line":66,"column":4},"end":{"line":69,"column":5}},"27":{"start":{"line":67,"column":6},"end":{"line":67,"column":39}},"28":{"start":{"line":68,"column":6},"end":{"line":68,"column":50}},"29":{"start":{"line":73,"column":0},"end":{"line":73,"column":43}}},"branchMap":{"1":{"line":18,"type":"if","locations":[{"start":{"line":18,"column":4},"end":{"line":18,"column":4}},{"start":{"line":18,"column":4},"end":{"line":18,"column":4}}]},"2":{"line":44,"type":"if","locations":[{"start":{"line":44,"column":4},"end":{"line":44,"column":4}},{"start":{"line":44,"column":4},"end":{"line":44,"column":4}}]},"3":{"line":68,"type":"binary-expr","locations":[{"start":{"line":68,"column":14},"end":{"line":68,"column":21}},{"start":{"line":68,"column":25},"end":{"line":68,"column":29}}]}},"code":["(function () { YUI.add('gallery-rocket-child-view-container', function (Y, NAME) {","","'use strict';","","var ChildViewContainer = function(views) {","  this._views = {};","  this._indexByModel = {};","  this._updateLength();","  Y.each(views, this.add, this);","};","","ChildViewContainer.prototype = {","  add: function(view) {","    var viewClientId = view.get('clientId');","    // store the view","    this._views[viewClientId] = view;","    // index it by model","    if (view.get('model')) {","      this._indexByModel[view.get('model').get('clientId')] = viewClientId;","    }","    this._updateLength();","  },","","  findByModel: function(model) {","    return this.findByModelClientId(model.get('clientId'));","  },","","  findByModelClientId: function(modelClientId) {","    var viewClientId = this._indexByModel[modelClientId];","    return this.findByClientId(viewClientId);","  },","","  findByClientId: function(clientId) {","    return this._views[clientId];","  },","","  findByIndex: function(index) {","    return Y.Object.values(this._views)[index];","  },","","  remove: function(view) {","    var viewClientId = view.get('clientId');","    // delete model index","    if (view.get('model')) {","      delete this._indexByModel[view.get('model').get('clientId')];","    }","    // remove the view from the container","    delete this._views[viewClientId];","    this._updateLength();","  },","","  // Update the `.length` attribute on this container","  _updateLength: function() {","    this.length = Y.Object.size(this._views);","  },","","  size: function() {","    return this.length;","  },","","  // * @param {Function} fn Function to execute on each enumerable property.","  // *   @param {View} fn.view current view.","  // *   @param {Object} fn.views Views being enumerated.","  each: function(fn, thisObj) {","    var clientId;","    for (clientId in this._views) {","      var view = this._views[clientId];","      fn.call(thisObj || view, view, this._views);","    }","  }","};","","Y.RChildViewContainer = ChildViewContainer;","","","}, 'gallery-2013.09.18-18-49', {\"requires\": [\"yui-base\"]});","","}());"]};
}
var __cov_xLdh_s7SbcRR5KQhfOSF6g = __coverage__['build/gallery-rocket-child-view-container/gallery-rocket-child-view-container.js'];
__cov_xLdh_s7SbcRR5KQhfOSF6g.s['1']++;YUI.add('gallery-rocket-child-view-container',function(Y,NAME){'use strict';__cov_xLdh_s7SbcRR5KQhfOSF6g.f['1']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['2']++;var ChildViewContainer=function(views){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['2']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['3']++;this._views={};__cov_xLdh_s7SbcRR5KQhfOSF6g.s['4']++;this._indexByModel={};__cov_xLdh_s7SbcRR5KQhfOSF6g.s['5']++;this._updateLength();__cov_xLdh_s7SbcRR5KQhfOSF6g.s['6']++;Y.each(views,this.add,this);};__cov_xLdh_s7SbcRR5KQhfOSF6g.s['7']++;ChildViewContainer.prototype={add:function(view){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['3']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['8']++;var viewClientId=view.get('clientId');__cov_xLdh_s7SbcRR5KQhfOSF6g.s['9']++;this._views[viewClientId]=view;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['10']++;if(view.get('model')){__cov_xLdh_s7SbcRR5KQhfOSF6g.b['1'][0]++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['11']++;this._indexByModel[view.get('model').get('clientId')]=viewClientId;}else{__cov_xLdh_s7SbcRR5KQhfOSF6g.b['1'][1]++;}__cov_xLdh_s7SbcRR5KQhfOSF6g.s['12']++;this._updateLength();},findByModel:function(model){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['4']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['13']++;return this.findByModelClientId(model.get('clientId'));},findByModelClientId:function(modelClientId){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['5']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['14']++;var viewClientId=this._indexByModel[modelClientId];__cov_xLdh_s7SbcRR5KQhfOSF6g.s['15']++;return this.findByClientId(viewClientId);},findByClientId:function(clientId){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['6']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['16']++;return this._views[clientId];},findByIndex:function(index){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['7']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['17']++;return Y.Object.values(this._views)[index];},remove:function(view){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['8']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['18']++;var viewClientId=view.get('clientId');__cov_xLdh_s7SbcRR5KQhfOSF6g.s['19']++;if(view.get('model')){__cov_xLdh_s7SbcRR5KQhfOSF6g.b['2'][0]++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['20']++;delete this._indexByModel[view.get('model').get('clientId')];}else{__cov_xLdh_s7SbcRR5KQhfOSF6g.b['2'][1]++;}__cov_xLdh_s7SbcRR5KQhfOSF6g.s['21']++;delete this._views[viewClientId];__cov_xLdh_s7SbcRR5KQhfOSF6g.s['22']++;this._updateLength();},_updateLength:function(){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['9']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['23']++;this.length=Y.Object.size(this._views);},size:function(){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['10']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['24']++;return this.length;},each:function(fn,thisObj){__cov_xLdh_s7SbcRR5KQhfOSF6g.f['11']++;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['25']++;var clientId;__cov_xLdh_s7SbcRR5KQhfOSF6g.s['26']++;for(clientId in this._views){__cov_xLdh_s7SbcRR5KQhfOSF6g.s['27']++;var view=this._views[clientId];__cov_xLdh_s7SbcRR5KQhfOSF6g.s['28']++;fn.call((__cov_xLdh_s7SbcRR5KQhfOSF6g.b['3'][0]++,thisObj)||(__cov_xLdh_s7SbcRR5KQhfOSF6g.b['3'][1]++,view),view,this._views);}}};__cov_xLdh_s7SbcRR5KQhfOSF6g.s['29']++;Y.RChildViewContainer=ChildViewContainer;},'gallery-2013.09.18-18-49',{'requires':['yui-base']});
