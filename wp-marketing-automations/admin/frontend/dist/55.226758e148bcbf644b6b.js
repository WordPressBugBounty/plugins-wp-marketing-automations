(window.webpackJsonp=window.webpackJsonp||[]).push([[55],{1061:function(t,e,r){"use strict";var n=r(9),o=r.n(n),a=r(3),i=r(1105),c=r(1079),u=(r(1106),r(96)),l=r(1);function s(t){return(s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function f(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function p(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?f(Object(r),!0).forEach((function(e){h(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):f(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function h(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function d(){d=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",a=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function u(t,e,r,n){var o=e&&e.prototype instanceof p?e:p,a=Object.create(o.prototype),i=new _(n||[]);return a._invoke=function(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return L()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=j(i,r);if(c){if(c===f)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var u=l(t,e,r);if("normal"===u.type){if(n=r.done?"completed":"suspendedYield",u.arg===f)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(n="completed",r.method="throw",r.arg=u.arg)}}}(t,r,i),a}function l(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var f={};function p(){}function h(){}function y(){}var m={};c(m,o,(function(){return this}));var b=Object.getPrototypeOf,v=b&&b(b(P([])));v&&v!==e&&r.call(v,o)&&(m=v);var g=y.prototype=p.prototype=Object.create(m);function w(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function O(t,e){var n;this._invoke=function(o,a){function i(){return new e((function(n,i){!function n(o,a,i,c){var u=l(t[o],t,a);if("throw"!==u.type){var f=u.arg,p=f.value;return p&&"object"==s(p)&&r.call(p,"__await")?e.resolve(p.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(p).then((function(t){f.value=t,i(f)}),(function(t){return n("throw",t,i,c)}))}c(u.arg)}(o,a,n,i)}))}return n=n?n.then(i,i):i()}}function j(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,j(t,e),"throw"===e.method))return f;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return f}var n=l(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,f;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,f):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,f)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function x(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function _(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function P(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,a=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:L}}function L(){return{value:void 0,done:!0}}return h.prototype=y,c(g,"constructor",y),c(y,"constructor",h),h.displayName=c(y,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===h||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,y):(t.__proto__=y,c(t,i,"GeneratorFunction")),t.prototype=Object.create(g),t},t.awrap=function(t){return{__await:t}},w(O.prototype),c(O.prototype,a,(function(){return this})),t.AsyncIterator=O,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new O(u(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},w(g),c(g,i,"Generator"),c(g,o,(function(){return this})),c(g,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=P,_.prototype={constructor:_,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(x),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),u=r.call(a,"finallyLoc");if(c&&u){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,f):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),f},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),x(r),f}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;x(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:P(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),f}},t}function y(t,e,r,n,o,a,i){try{var c=t[a](i),u=c.value}catch(t){return void r(t)}c.done?e(u):Promise.resolve(u).then(n,o)}function m(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var a=t.apply(e,r);function i(t){y(a,n,o,i,c,"next",t)}function c(t){y(a,n,o,i,c,"throw",t)}i(void 0)}))}}e.a=function(){var t=arguments.length>0&&void 0!==arguments[0]&&arguments[0],e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],r=Object(u.useQuery)(["get-bwf-fields"],m(d().mark((function t(){var e;return d().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,o()({method:"GET",path:Object(a.y)("/v3/fields")});case 3:if(!(e=t.sent)||!e.result){t.next=6;break}return t.abrupt("return",e.result);case 6:t.next=10;break;case 8:t.prev=8,t.t0=t.catch(0);case 10:return t.abrupt("return",[]);case 11:case"end":return t.stop()}}),t,null,[[0,8]])}))),{staleTime:18e5}),n=r.isLoading,s=r.data,f=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],r={};if(t)for(var n in t)if(!e||!t[n].hasOwnProperty("search")||2!==parseInt(t[n].search)){var o=t[n],a=Object(i.b)(o.type),c=o&&o.hasOwnProperty("meta")&&o.meta.hasOwnProperty("options")?o.meta.options:[],u=o.name;r["bwf_cf".concat(o.ID)]=Object(i.a)(u,Object(l.__)("Custom Field","wp-marketing-automations"),"contact_custom_fields",12,a,c)}return r},h=n?[]:p(p({},c.a),f(s));return t?{loading:n,filters:h}:!!n||h}},1106:function(t,e,r){},1379:function(t,e,r){"use strict";r.r(e);var n=r(0),o=r(2),a=r(1),i=r(9),c=r.n(i),u=r(5),l=r(13),s=r(12),f=r(3),p=r(1046),h=r(1052),d=r(19),y=r(194),m=r(65),b=r(8),v=r(74),g=r(44),w=r(1061);function O(t){return(O="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function j(){j=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",a=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function u(t,e,r,n){var o=e&&e.prototype instanceof f?e:f,a=Object.create(o.prototype),i=new _(n||[]);return a._invoke=function(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return L()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=w(i,r);if(c){if(c===s)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var u=l(t,e,r);if("normal"===u.type){if(n=r.done?"completed":"suspendedYield",u.arg===s)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(n="completed",r.method="throw",r.arg=u.arg)}}}(t,r,i),a}function l(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var s={};function f(){}function p(){}function h(){}var d={};c(d,o,(function(){return this}));var y=Object.getPrototypeOf,m=y&&y(y(P([])));m&&m!==e&&r.call(m,o)&&(d=m);var b=h.prototype=f.prototype=Object.create(d);function v(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function g(t,e){var n;this._invoke=function(o,a){function i(){return new e((function(n,i){!function n(o,a,i,c){var u=l(t[o],t,a);if("throw"!==u.type){var s=u.arg,f=s.value;return f&&"object"==O(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(f).then((function(t){s.value=t,i(s)}),(function(t){return n("throw",t,i,c)}))}c(u.arg)}(o,a,n,i)}))}return n=n?n.then(i,i):i()}}function w(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,w(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=l(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,s;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function x(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function _(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function P(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,a=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:L}}function L(){return{value:void 0,done:!0}}return p.prototype=h,c(b,"constructor",h),c(h,"constructor",p),p.displayName=c(h,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===p||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,h):(t.__proto__=h,c(t,i,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},v(g.prototype),c(g.prototype,a,(function(){return this})),t.AsyncIterator=g,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new g(u(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},v(b),c(b,i,"Generator"),c(b,o,(function(){return this})),c(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=P,_.prototype={constructor:_,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(x),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),u=r.call(a,"finallyLoc");if(c&&u){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,s):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),x(r),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;x(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:P(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},t}function E(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function x(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?E(Object(r),!0).forEach((function(e){_(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):E(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function _(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function P(t,e,r,n,o,a,i){try{var c=t[a](i),u=c.value}catch(t){return void r(t)}c.done?e(u):Promise.resolve(u).then(n,o)}function L(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var r=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==r)return;var n,o,a=[],i=!0,c=!1;try{for(r=r.call(t);!(i=(n=r.next()).done)&&(a.push(n.value),!e||a.length!==e);i=!0);}catch(t){c=!0,o=t}finally{try{i||null==r.return||r.return()}finally{if(c)throw o}}return a}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return S(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return S(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function S(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}e.default=function(t){var e=location&&location.search?Object(d.parse)(location.search.substring(1)):{},r=Object(h.a)(),i=Object(w.a)(!0,!0),O=i.loading,E=i.filters,_=L(Object(n.useState)(!0),2),S=_[0],k=_[1],N=L(Object(n.useState)({}),2),T=N[0],I=N[1],C=L(Object(n.useState)(!0),2),G=C[0],F=C[1],B=L(Object(n.useState)({message:"",type:1}),2),U=B[0],A=B[1],D=Object(v.a)().setL2Title;Object(n.useEffect)((function(){D("title"in T?T.title:"")}),[T]);var J=L(Object(n.useState)(!1),2),M=J[0],Y=J[1],q=r.setCampaignValues,H=r.setExclude,Q=function(){var t=!0;!Object(o.isEmpty)(T.title)&&[1,2,3].includes(parseInt(T.type))&&(t=!1),t||2!==parseInt(T.type)||(t=!0),t||3!==parseInt(T.type)||Object(f.cc)()||(t=!0),F(t)},R=p.a.getCampaignId(),V=p.a.getCampaignData(),W=p.a.getExcludes(),$=!!(!(!V||!V.parent)&&V.parent);Object(n.useEffect)((function(){V&&R>0&&parseInt(t.campaignId)===parseInt(R)&&(I({title:V.title,description:V.description,type:V.type,isPromotional:!V.data||!V.data.hasOwnProperty("is_promotional")||V.data.is_promotional,includeUnverified:!(!V.data||!V.data.hasOwnProperty("includeUnverified"))&&V.data.includeUnverified,includeSoftBounce:!(!V.data||!V.data.hasOwnProperty("includeSoftBounce"))&&V.data.includeSoftBounce,abType:V.data&&V.data.hasOwnProperty("ab_type")?V.data.ab_type:"standard"}),k(!1)),0===parseInt(t.campaignId)&&(I({title:"",description:"",type:0,isPromotional:!1,abType:!1}),k(!1))}),[R]),Object(n.useEffect)((function(){Q()}),[T]);var z=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};if(Object(o.isEmpty)(t))return{};var r=Object(s.b)(t,E);return Object(s.j)(r,e,{filters:E})},K=function(){var r,n=(r=j().mark((function r(){var n,a;return j().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:if(G){r.next=19;break}if(t.setPending(!0),i=void 0,i={title:V.title,description:V.description,type:V.type,isPromotional:V.data&&V.data.hasOwnProperty("is_promotional")?V.data.is_promotional:null,abType:V.data&&V.data.hasOwnProperty("ab_type")?V.data.ab_type:null,includeUnverified:!(!V.data||!V.data.hasOwnProperty("includeUnverified"))&&V.data.includeUnverified,includeSoftBounce:!(!V.data||!V.data.hasOwnProperty("includeSoftBounce"))&&V.data.includeSoftBounce},JSON.stringify(i)==JSON.stringify(T)){r.next=14;break}if(!(R>0)){r.next=12;break}return r.prev=4,r.next=7,c()({path:Object(f.y)("/broadcast/".concat(R)),method:"POST",data:{data:{title:T.title,description:T.description,type:T.type,promotional:T.isPromotional,ab_type:T.abType,modified_by:Object(f.L)(),includeUnverified:T.includeUnverified,includeSoftBounce:T.includeSoftBounce,exclude:W},step:1},headers:{"Content-Type":"application/json"}}).then((function(t){if(200==t.code){q("data",x(x({},V),{},{title:t.result.title,description:t.result.description,type:t.result.type,data:t.result.data})),A({message:t.message,type:1});var r=V.data&&!Object(o.isNull)(V.data)&&V.data.hasOwnProperty("filters")?V.data.filters:{},n=z(r);Object(o.isEmpty)(n)||Object(s.k)(n,"/",e),q("step",2)}else A({message:t.message,type:0})}));case 7:r.next=12;break;case 9:r.prev=9,r.t0=r.catch(4),A({message:r.t0.message,type:0});case 12:r.next=18;break;case 14:n=V.data&&V.data.hasOwnProperty("filters")?V.data.filters:{},a=z(n),Object(o.isEmpty)(a)||Object(s.k)(a,"/",e),q("step",2);case 18:t.setPending(!1);case 19:case"end":return r.stop()}var i}),r,null,[[4,9]])})),function(){var t=this,e=arguments;return new Promise((function(n,o){var a=r.apply(t,e);function i(t){P(a,n,o,i,c,"next",t)}function c(t){P(a,n,o,i,c,"throw",t)}i(void 0)}))});return function(){return n.apply(this,arguments)}}();return Object(n.createElement)(n.Fragment,null,Object(n.createElement)(m.a,null),S||Object(o.isEmpty)(T)?Object(n.createElement)("div",{className:"bwf-crm-campaign-preview bwf-placeholder-content"},[0,1,2,3,4].map((function(t){return Object(n.createElement)("div",{className:"bwf-crm-campaign-field",key:t},Object(n.createElement)("div",{className:"is-placeholder long",style:{width:"20%"}}),Object(n.createElement)("div",{className:"is-placeholder long",style:{width:"100%"}}))}))):Object(n.createElement)(n.Fragment,null,Object(n.createElement)("div",{className:"bwf-campaign-step-div bwf-card-wrap bwf-campaign-step-1"},Object(n.createElement)("div",{className:"bwf-card-header"},Object(n.createElement)("span",{className:"bwf-form-title"},Object(a.__)("Information","wp-marketing-automations"))),Object(n.createElement)("div",{className:"bwf-card-bg-wrap"},Object(n.createElement)(u.TextControl,{value:T.title,label:Object(a.__)("Name","wp-marketing-automations"),className:"bwf-campaign-input-field",placeholder:Object(a.__)("Enter Name","wp-marketing-automations"),onChange:function(t){I(x(x({},T),{},{title:t}))}}),Object(n.createElement)("div",null,Object(n.createElement)(u.Flex,{gap:5,justify:"start",align:"start"},Object(n.createElement)(u.FlexItem,null,Object(n.createElement)("p",{className:"bwf-c-input-label"},Object(a.__)("Type","wp-marketing-automations")),Object(n.createElement)("div",{className:"bwf-display-flex gap--8"},Object(n.createElement)(l.a,{isSecondary:"standard"===T.abType,isTertiary:"standard"!==T.abType,className:"bwf-btn-small "+("standard"===T.abType?"is-border is-blue-bg":""),onClick:function(){I(x(x({},T),{},{abType:"standard"}))}},Object(a.__)("Standard","wp-marketing-automations")),Object(n.createElement)(l.a,{isSecondary:"ab"===T.abType,isTertiary:"ab"!==T.abType,className:"bwf-btn-small "+("ab"===T.abType?"is-border is-blue-bg":""),onClick:function(){I(x(x({},T),{},{abType:"ab"}))}},Object(a.__)("A/B Test","wp-marketing-automations")))))),Object(n.createElement)("div",{className:"bwf_clear_8"}),!$&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)(g.a,{className:"bwf-crm-campaign-toggle",label:Object(a.__)("Include Unverified Contacts","wp-marketing-automations"),checked:!!T.hasOwnProperty("includeUnverified")&&T.includeUnverified,onChange:function(t){H([]),I(x(x({},T),{},{includeUnverified:t}))}}),Object(n.createElement)(g.a,{className:"bwf-crm-campaign-toggle",label:Object(a.__)("Include Soft Bounce Contacts","wp-marketing-automations"),checked:!!T.hasOwnProperty("includeSoftBounce")&&T.includeSoftBounce,onChange:function(t){H([]),I(x(x({},T),{},{includeSoftBounce:t}))}}),Object(f.oc)()&&Object(n.createElement)(g.a,{className:"bwf-crm-campaign-toggle",label:Object(a.__)("Include Unsubscribed contacts","wp-marketing-automations"),checked:!T.isPromotional,onChange:function(t){H([]),I(x(x({},T),{},{isPromotional:!t}))}})),M&&Object(n.createElement)(u.Modal,{title:Object(a.__)("Configure SMS Setting","wp-marketing-automations"),onRequestClose:function(){return Y(!1)},style:{minWidth:"540px",height:"fit-content"},className:"bwf-crm-merge-tag-model"},Object(n.createElement)("p",null,Object(n.createElement)(b.a,{icon:"profile"})),Object(n.createElement)("a",{href:"admin.php?page=autonami&tab=connector",className:"bwf-a-no-underline"},Object(a.__)("Click Here to go configuration page","wp-marketing-automations")),Object(n.createElement)("p",null,Object(n.createElement)(l.a,{isPrimary:!0,onClick:function(){return Y(!1)}},Object(a.__)("Cancel","wp-marketing-automations")))),Object(n.createElement)(y.a,{message:U.message,type:U.type,removeMessage:function(){return A({message:"",type:1})}})),Object(n.createElement)("div",{className:"bwf-crm-stepper-navigation bwf_text_right"},Object(n.createElement)(l.a,{isPrimary:!0,className:"bwf-crm-navigation-next",disabled:G||O,onClick:function(){Q(),K()},isBusy:t.isPending},Object(a.__)("Next","wp-marketing-automations"))))))}}}]);