(window.webpackJsonp=window.webpackJsonp||[]).push([[66],{1123:function(t,e,r){"use strict";var n=r(0),o=r(66),a=r(9),i=r.n(a),c=r(3),u=r(1);function l(t){return(l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function s(){s=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",a=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function u(t,e,r,n){var o=e&&e.prototype instanceof p?e:p,a=Object.create(o.prototype),i=new k(n||[]);return a._invoke=function(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return L()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=j(i,r);if(c){if(c===h)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var u=f(t,e,r);if("normal"===u.type){if(n=r.done?"completed":"suspendedYield",u.arg===h)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(n="completed",r.method="throw",r.arg=u.arg)}}}(t,r,i),a}function f(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var h={};function p(){}function m(){}function y(){}var d={};c(d,o,(function(){return this}));var b=Object.getPrototypeOf,v=b&&b(b(x([])));v&&v!==e&&r.call(v,o)&&(d=v);var g=y.prototype=p.prototype=Object.create(d);function w(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function O(t,e){var n;this._invoke=function(o,a){function i(){return new e((function(n,i){!function n(o,a,i,c){var u=f(t[o],t,a);if("throw"!==u.type){var s=u.arg,h=s.value;return h&&"object"==l(h)&&r.call(h,"__await")?e.resolve(h.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(h).then((function(t){s.value=t,i(s)}),(function(t){return n("throw",t,i,c)}))}c(u.arg)}(o,a,n,i)}))}return n=n?n.then(i,i):i()}}function j(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,j(t,e),"throw"===e.method))return h;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return h}var n=f(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,h;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,h):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,h)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function _(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function k(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function x(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,a=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:L}}function L(){return{value:void 0,done:!0}}return m.prototype=y,c(g,"constructor",y),c(y,"constructor",m),m.displayName=c(y,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,y):(t.__proto__=y,c(t,i,"GeneratorFunction")),t.prototype=Object.create(g),t},t.awrap=function(t){return{__await:t}},w(O.prototype),c(O.prototype,a,(function(){return this})),t.AsyncIterator=O,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new O(u(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},w(g),c(g,i,"Generator"),c(g,o,(function(){return this})),c(g,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=x,k.prototype={constructor:k,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(_),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),u=r.call(a,"finallyLoc");if(c&&u){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,h):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),h},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),_(r),h}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;_(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:x(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),h}},t}function f(t,e,r,n,o,a,i){try{var c=t[a](i),u=c.value}catch(t){return void r(t)}c.done?e(u):Promise.resolve(u).then(n,o)}function h(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var r=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==r)return;var n,o,a=[],i=!0,c=!1;try{for(r=r.call(t);!(i=(n=r.next()).done)&&(a.push(n.value),!e||a.length!==e);i=!0);}catch(t){c=!0,o=t}finally{try{i||null==r.return||r.return()}finally{if(c)throw o}}return a}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return p(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return p(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function p(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}e.a=function(t){var e=Object(n.useContext)(c.h),r=h(Object(n.useState)(""),2),a=r[0],l=r[1],p=t.isOpen,m=t.cartId,y=t.onRequestClose,d=function(){var t,r=(t=s().mark((function t(){return s().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,i()({path:Object(c.y)("/carts"),method:"DELETE",data:{abandoned_ids:[m]}}).then((function(t){e(t.message)}));case 3:t.sent,b(),t.next=11;break;case 7:t.prev=7,t.t0=t.catch(0),l(t.t0&&t.t0.message?t.t0.message:Object(u.__)("Unknown error occurred","wp-marketing-automations")),console.log(a);case 11:Object(c.Eb)(e,3e3);case 12:case"end":return t.stop()}}),t,null,[[0,7]])})),function(){var e=this,r=arguments;return new Promise((function(n,o){var a=t.apply(e,r);function i(t){f(a,n,o,i,c,"next",t)}function c(t){f(a,n,o,i,c,"throw",t)}i(void 0)}))});return function(){return r.apply(this,arguments)}}(),b=function(){y(!a),l("")};return Object(n.createElement)(o.a,{modalTitle:Object(u.__)("Delete Cart","wp-marketing-automations"),deleteDescriptionText:Object(u.__)("You are about to delete cart. This action cannot be undone. Cancel to stop, Delete to proceed.","wp-marketing-automations"),confirmButtonText:Object(u.__)("Delete","wp-marketing-automations"),cancelButtonText:Object(u.__)("Cancel","wp-marketing-automations"),onConfirm:d,errorMessage:a,onRequestClose:b,isOpen:p,isDelete:!0})}},1410:function(t,e,r){"use strict";r.r(e);var n=r(0),o=r(3),a=r(9),i=r.n(a),c=r(1),u=r(62),l=r(63),s=r(18),f=r(137),h=r(1089),p=r(140),m=r(54),y=r(1122),d=r(1123),b=r(322),v=r(31),g=r(6),w=r.n(g),O=r(2),j=r(65),E=r(12),_=r(8),k=r(321),x=r(139),L=r(1124),S=r(44),A=r(189),N=r(28),C=r(1087);function P(t){return(P="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function T(){return(T=Object.assign?Object.assign.bind():function(t){for(var e=1;e<arguments.length;e++){var r=arguments[e];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(t[n]=r[n])}return t}).apply(this,arguments)}function I(){I=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",a=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function u(t,e,r,n){var o=e&&e.prototype instanceof f?e:f,a=Object.create(o.prototype),i=new E(n||[]);return a._invoke=function(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return k()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=w(i,r);if(c){if(c===s)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var u=l(t,e,r);if("normal"===u.type){if(n=r.done?"completed":"suspendedYield",u.arg===s)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(n="completed",r.method="throw",r.arg=u.arg)}}}(t,r,i),a}function l(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var s={};function f(){}function h(){}function p(){}var m={};c(m,o,(function(){return this}));var y=Object.getPrototypeOf,d=y&&y(y(_([])));d&&d!==e&&r.call(d,o)&&(m=d);var b=p.prototype=f.prototype=Object.create(m);function v(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function g(t,e){var n;this._invoke=function(o,a){function i(){return new e((function(n,i){!function n(o,a,i,c){var u=l(t[o],t,a);if("throw"!==u.type){var s=u.arg,f=s.value;return f&&"object"==P(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(f).then((function(t){s.value=t,i(s)}),(function(t){return n("throw",t,i,c)}))}c(u.arg)}(o,a,n,i)}))}return n=n?n.then(i,i):i()}}function w(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,w(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=l(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,s;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function O(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function j(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function E(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(O,this),this.reset(!0)}function _(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,a=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:k}}function k(){return{value:void 0,done:!0}}return h.prototype=p,c(b,"constructor",p),c(p,"constructor",h),h.displayName=c(p,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===h||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,p):(t.__proto__=p,c(t,i,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},v(g.prototype),c(g.prototype,a,(function(){return this})),t.AsyncIterator=g,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new g(u(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},v(b),c(b,i,"Generator"),c(b,o,(function(){return this})),c(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=_,E.prototype={constructor:E,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(j),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),u=r.call(a,"finallyLoc");if(c&&u){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,s):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),j(r),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;j(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:_(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},t}function G(t,e,r,n,o,a,i){try{var c=t[a](i),u=c.value}catch(t){return void r(t)}c.done?e(u):Promise.resolve(u).then(n,o)}function F(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var r=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==r)return;var n,o,a=[],i=!0,c=!1;try{for(r=r.call(t);!(i=(n=r.next()).done)&&(a.push(n.value),!e||a.length!==e);i=!0);}catch(t){c=!0,o=t}finally{try{i||null==r.return||r.return()}finally{if(c)throw o}}return a}(t,e)||D(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function D(t,e){if(t){if("string"==typeof t)return R(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);return"Object"===r&&t.constructor&&(r=t.constructor.name),"Map"===r||"Set"===r?Array.from(t):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?R(t,e):void 0}}function R(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}e.default=function(){var t=Object(E.i)(),e=F(Object(n.useState)(25),2),r=e[0],a=e[1],g=F(Object(n.useState)(0),2),P=g[0],R=g[1],q=F(Object(n.useState)(0),2),M=q[0],Y=q[1],B=F(Object(n.useState)([]),2),U=B[0],z=B[1],J=F(Object(n.useState)([]),2),Q=J[0],$=J[1],H=F(Object(n.useState)(!1),2),V=H[0],K=H[1],W=F(Object(n.useState)(),2),X=W[0],Z=W[1],tt=F(Object(n.useState)(!1),2),et=tt[0],rt=tt[1],nt=F(Object(n.useState)(0),2),ot=nt[0],at=nt[1];Object(h.a)("lost",Q);var it=t.s,ct=void 0===it?"":it,ut=Object(n.useRef)(new AbortController),lt=function(){var t,e=(t=I().mark((function t(){var e,n,u,l,s,f,h,p=arguments;return I().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return p.length>0&&void 0!==p[0]&&p[0],K(!0),t.prev=2,t.next=5,i()({method:"GET",path:Object(o.y)("/carts/lost?offset=".concat(P,"&limit=").concat(r,"&search=").concat(ct)),signal:ut.current.signal});case 5:if((e=t.sent)&&e.result&&Array.isArray(e.result)){t.next=9;break}return Z(Object(c.__)("Blank response returned","wp-marketing-automations")),t.abrupt("return");case 9:n=e.total_count,u=void 0===n?0:n,l=e.result,s=void 0===l?[]:l,f=e.limit,h=e.offset,Y(parseInt(u)),z(s),f&&a(parseInt(f)),h&&R(parseInt(h)),e.hasOwnProperty("count_data")&&$(e.count_data),K(!1),t.next=21;break;case 18:t.prev=18,t.t0=t.catch(2),"AbortError"===t.t0.name?console.log(t.t0.message):(Z(t.t0&&t.t0.message?t.t0.message:Object(c.__)("Unknown Error Occurred","wp-marketing-automations")),K(!1));case 21:case"end":return t.stop()}}),t,null,[[2,18]])})),function(){var e=this,r=arguments;return new Promise((function(n,o){var a=t.apply(e,r);function i(t){G(a,n,o,i,c,"next",t)}function c(t){G(a,n,o,i,c,"throw",t)}i(void 0)}))});return function(){return e.apply(this,arguments)}}(),st=F(Object(n.useState)([]),2),ft=st[0],ht=st[1],pt=F(Object(n.useState)(!1),2),mt=pt[0],yt=pt[1],dt=F(Object(n.useState)(""),2),bt=dt[0],vt=dt[1],gt=function(){xt&&xt(),ht([])},wt=Object(n.useCallback)((function(t,e){ht(e),vt(t),yt(!0)}),[]);Object(n.useEffect)((function(){Object(o.l)(Object(c.__)("Lost Carts","wp-marketing-automations")),Object(o.Ib)()&&lt()}),[P,r,ct]),Object(n.useEffect)((function(){return gt(),function(){ut.current.abort()}}),[]),Object(n.useLayoutEffect)((function(){z([]),K(!0)}),[]);var Ot=Object(n.useMemo)((function(){var t={};if(Array.isArray(U)){var e,r=function(t,e){var r="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!r){if(Array.isArray(t)||(r=D(t))||e&&t&&"number"==typeof t.length){r&&(t=r);var n=0,o=function(){};return{s:o,n:function(){return n>=t.length?{done:!0}:{done:!1,value:t[n++]}},e:function(t){throw t},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,i=!0,c=!1;return{s:function(){r=r.call(t)},n:function(){var t=r.next();return i=t.done,t},e:function(t){c=!0,a=t},f:function(){try{i||null==r.return||r.return()}finally{if(c)throw a}}}}(U);try{for(r.s();!(e=r.n()).done;){var n=e.value;t[n.id]=n}}catch(t){r.e(t)}finally{r.f()}}return t}),[U]),jt=Object(x.b)(Ot),Et=jt.singleSelectProps,_t=jt.selectAllProps,kt=jt.floatingBarProps,xt=jt.resetSelection,Lt=jt.selected,St=void 0===Lt?{}:Lt,At=Object.keys(St).filter((function(t){return St[t]})).length,Nt=[{key:"select",label:Object(n.createElement)(S.a,T({type:"checkbox",checked:!1,onChange:function(){}},_t)),isLeftAligned:!0,required:!0,cellClassName:"bwf-col-action bwf-w-30 bwf-table-col-sticky bwf-sticky-left"},{key:"action",label:"",isLeftAligned:!0,required:!0,cellClassName:"bwf-col-action bwf-w-30 bwf-table-col-sticky bwf-sticky-left"},{key:"name",label:Object(c.__)("Contact","wp-marketing-automations"),isLeftAligned:!0,cellClassName:"bwf-w-210 bwf-table-col-sticky bwf-sticky-left"},{key:"contact",label:Object(c.__)("Details","wp-marketing-automations"),isLeftAligned:!0},{key:"created_date",label:Object(c.__)("Created On","wp-marketing-automations"),isLeftAligned:!0},{key:"items",label:Object(c.__)("Items","wp-marketing-automations"),isLeftAligned:!0,cellClassName:"bwf-max-w-360"},{key:"total",label:Object(c.__)("Total","wp-marketing-automations"),isLeftAligned:!0,cellClassName:"bwf-w-100"},{key:"show",label:Object(c.__)("Action","wp-marketing-automations"),isLeftAligned:!0,cellClassName:"bwf-w-100 bwf-table-col-sticky bwf-sticky-right"}],Ct=function(t){t!==r&&(R(0),a(t))},Pt=function(e){return Object(n.createElement)(u.a,{label:Object(c.__)("Quick Actions","wp-marketing-automations"),menuPosition:"bottom right",renderContent:function(r){var o=r.onToggle;return Object(n.createElement)(n.Fragment,null,Object(n.createElement)(l.a,{isClickable:!0,onInvoke:function(){Object(E.k)({path:"/carts/lost/".concat(e.id,"/tasks")},"/",t),o()}},Object(n.createElement)(s.a,{justify:"flex-start"},Object(n.createElement)(s.c,null,Object(c.__)("View Automations","wp-marketing-automations")))),Object(n.createElement)(l.a,{isClickable:!0,onInvoke:function(){at(e.id),rt(!0),o()}},Object(n.createElement)(s.a,{justify:"flex-start"},Object(n.createElement)(s.c,null,Object(c.__)("Delete","wp-marketing-automations")))))}})},Tt=function(t){return t.total?Object(n.createElement)("span",{className:"bwf-tags bwf-tag-red"},t.currency?Object(m.a)(t.currency).formatAmount(t.total):t.total):"-"},It=function(t){return Object(n.createElement)("div",{className:"bwf-c-contact-details-cell"},t.hasOwnProperty("email")&&t.email&&Object(n.createElement)(s.a,{justify:"justify",align:"top"},Object(n.createElement)(s.c,null,t.email)),t.phone&&Object(n.createElement)(s.a,{justify:"justify",align:"top"},Object(n.createElement)(s.c,null,t.phone)),!t.phone&&!t.email&&Object(n.createElement)("span",null,"-"))},Gt=function(e){var r=Object(n.createElement)(b.a,{contact:{f_name:e.f_name?e.f_name:"",l_name:e.l_name?e.l_name:"",email:e.email},dateText:e.date&&e.diffstring?Object(c.__)("Last Active:","wp-marketing-automations"):"",lowerText:e.date&&e.diffstring?Object(n.createElement)(n.Fragment,null,Object(n.createElement)("span",{title:Object(o.db)(e.date,!0)},e.diffstring)):""});return e.contact_id?Object(n.createElement)(v.a,{href:"admin.php?page=autonami&path=/contact/"+e.contact_id+"&return_to=".concat(t.path),type:"bwf-crm",className:"bwf-a-no-underline"},r):r},Ft=Array.isArray(U)?U.map((function(t){return[{display:Et.hasOwnProperty(t.id)?Object(n.createElement)(S.a,T({type:"checkbox",checked:!1,onChange:function(){}},Et[t.id])):Object(n.createElement)(n.Fragment,null),value:null},{display:Pt(t),value:""},{display:Gt(t),value:""},{display:It(t),value:""},{display:(i=t,i.hasOwnProperty("created_on")?Object(o.db)(i.created_on,!1,!1):"-"),value:""},{display:(e=t.items,r=[],a=[],Object.entries(e).map((function(t){var e=F(t,2),o=e[0],i=e[1];r.length<5&&r.push(Object(n.createElement)("a",{target:"_blank",className:"bwf-a-no-underline",href:"post.php?action=edit&post="+o,rel:"noreferrer"},i)),a.push(Object(n.createElement)("a",{target:"_blank",className:"bwf-a-no-underline",href:"post.php?action=edit&post="+o,rel:"noreferrer"},i))})),Object(n.createElement)("div",{className:"bwf-table-v-center"},!Object(O.isEmpty)(r)&&r.map((function(t,e){return Object(n.createElement)("span",{key:e},t,e!==r.length-1&&", ")})),!Object(O.isEmpty)(a)&&a.length>5&&Object(n.createElement)(p.a,{items:a,count:5}))),value:""},{display:Tt(t),value:t.total},{display:Object(n.createElement)(y.a,{cart:t}),value:""}];var e,r,a,i})):[];Object(n.createElement)(_.a,{icon:"zero-carts"}),Object(c.__)("There is no contact for lost cart","wp-marketing-automations"),Object(c.__)("Contact will appear in the list once customers abandonment the cart and cart expires as per settings","wp-marketing-automations");return Object(n.createElement)(n.Fragment,null,Object(n.createElement)(j.a,null),Object(n.createElement)("div",{className:"bwf-content-header-new"},Object(n.createElement)("div",{className:"bwf-content-header-left"},Object(n.createElement)("div",{className:"bwf-content-header-title"},Object(c.__)("Lost Carts","wp-marketing-automations")),parseInt(M)>0&&Object(n.createElement)("div",{className:"bwf-content-header-count"},Object(c.sprintf)(Object(c._n)("(%s Result)","(%s Results)",M,"wp-marketing-automations"),M)))),Object(o.Ib)()?Object(n.createElement)(n.Fragment,null,X&&Object(n.createElement)(N.a,{status:"error"},X),Object(n.createElement)(f.a,{className:w()("bwfcrm-forms-list-table",{"has-search":!0}),rows:Ft,headers:Nt,query:{paged:P/r+1},rowsPerPage:r,totalRows:M,isLoading:V,onPageChange:function(t,e){R((t-1)*r)},onQueryChange:function(t){return"per_page"!==t?function(){}:Ct},rowHeader:!0,showMenu:!1,actions:At>0?[Object(n.createElement)(x.a,T({key:"list-bulk-action",actions:[{id:"delete",icon:"trash",hint:Object(c.__)("Delete","wp-marketing-automations")}],onAction:wt,inLine:!0,reset:gt},kt))]:[Object(n.createElement)(A.a,{key:"search",isLoading:V,searchTerm:null==t?void 0:t.s,showResultCount:!1,setSearchData:function(e){if(Object(O.size)(e))Object(E.k)({s:e},"/",t);else{var r=Object(O.cloneDeep)(t);r.hasOwnProperty("s")&&(null==r||delete r.s),Object(E.k)(r,"/",{})}}})],emptyMessage:""!==ct?Object(c.__)("No results found","wp-marketing-automations"):Object(c.__)("No Data Available! Contact will appear in the list once customers abandonment the cart and cart expires as per settings ","wp-marketing-automations")}),Object(n.createElement)(d.a,{cartId:ot,isOpen:et,onRequestClose:function(t){rt(!1),t&&lt()}}),Object(n.createElement)(L.a,{tasks:ft,isOpen:mt,onSuccess:function(){lt(),gt()},onError:gt,onRequestClose:function(){return yt(!1)},screenType:"cart",screenTypeId:"cart-bulk",actionType:bt,type:"cart"})):Object(n.createElement)(k.a,{data:C.a}))}}}]);