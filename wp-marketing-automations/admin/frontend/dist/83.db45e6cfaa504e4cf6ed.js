(window.webpackJsonp=window.webpackJsonp||[]).push([[83],{1430:function(t,e,r){"use strict";r.r(e);var n=r(0),o=r(1),a=r(1048),i=r(331),c=function(t){var e=t.metrics,r=(0,a.a.getEmailAnalyticsLoading)();return Object(n.createElement)("div",{className:"bwf-crm-emails-report-tiles"},Object(n.createElement)(i.a,{items:e,title:Object(o.__)("Overview","wp-marketing-automations"),isLoading:r}))},l=r(327),u=r(33),s=r(2),f=r(5),p=r(6),m=r.n(p),h=r(12);function y(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var r=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==r)return;var n,o,a=[],i=!0,c=!1;try{for(r=r.call(t);!(i=(n=r.next()).done)&&(a.push(n.value),!e||a.length!==e);i=!0);}catch(t){c=!0,o=t}finally{try{i||null==r.return||r.return()}finally{if(c)throw o}}return a}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return d(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return d(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function d(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}var b=function(t){var e=t.query,r=t.metrics,i=e.chart?e.chart:"email_sents",c=a.a.getEmailAnalyticsLoading,p=a.a.getEmailAnalytics,d=c(),b=p(),v=y(Object(n.useState)(r[0]),2),g=v[0],w=v[1],O=Object(u.f)(e),j=Object(u.b)(function(t){return t.period&&null!=t.period&&""!=t.period||(t.period="month"),t.compare&&null!=t.compare&&""!=t.compare||(t.compare="previous_year"),t}(e));j.includes(O)||(O=j[j.length-1]);return Object(n.createElement)(l.a,{isRequesting:d,data:function(t){var e=[];b&&b.hasOwnProperty("intervals")&&b.intervals.map((function(r){"email_sents"===t&&e.push({date:r.start_date,email_sents:{label:Object(o.__)("SMS Sent","wp-marketing-automations"),value:parseInt(r.subtotals.email_sents)}}),"email_click"===t&&e.push({date:r.start_date,email_click:{label:Object(o.__)("SMS Clicks","wp-marketing-automations"),value:parseInt(r.subtotals.email_click)}}),"total_orders"===t&&e.push({date:r.start_date,total_orders:{label:Object(o.__)("Total Orders","wp-marketing-automations"),value:parseInt(r.subtotals.total_orders)}}),"total_revenue"===t&&e.push({date:r.start_date,total_revenue:{label:Object(o.__)("Total Revenue","wp-marketing-automations"),value:parseInt(r.subtotals.total_revenue)}})}));return e}(i),title:Object(n.createElement)(n.Fragment,null,Object(n.createElement)("div",{className:""},Object(o.__)("Performance","wp-marketing-automations"))),interval:O,layout:"item-comparison",interactiveLegend:!0,chartType:"curve-line",chartMeta:g,tabs:r,hideTypeSelect:!0,customHeaderItem:Object(n.createElement)(n.Fragment,null,r&&Object(s.isArray)(r)&&Object(n.createElement)("div",{className:"bwf-chart-tabs"},r.filter((function(t){return"convert_time"!==t.key})).map((function(t){return Object(n.createElement)(f.Button,{className:m()({"is-gray-light":g.key!==t.key,"is-secondary-light":g.key===t.key}),key:t.key,onClick:function(r){w(t),r.preventDefault(),delete e.compare,Object(h.k)({chart:t.key},"/",e)}},t.title)}))))})},v=r(3),g=r(341),w=r(351),O=r(36),j=r.n(O),_=r(9),k=r.n(_),E=r(19),S=r(34),L=r.n(S);function x(t){return(x="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function P(){P=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",a=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function l(t,e,r,n){var o=e&&e.prototype instanceof f?e:f,a=Object.create(o.prototype),i=new _(n||[]);return a._invoke=function(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return E()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=w(i,r);if(c){if(c===s)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=u(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===s)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(t,r,i),a}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var s={};function f(){}function p(){}function m(){}var h={};c(h,o,(function(){return this}));var y=Object.getPrototypeOf,d=y&&y(y(k([])));d&&d!==e&&r.call(d,o)&&(h=d);var b=m.prototype=f.prototype=Object.create(h);function v(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function g(t,e){var n;this._invoke=function(o,a){function i(){return new e((function(n,i){!function n(o,a,i,c){var l=u(t[o],t,a);if("throw"!==l.type){var s=l.arg,f=s.value;return f&&"object"==x(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(f).then((function(t){s.value=t,i(s)}),(function(t){return n("throw",t,i,c)}))}c(l.arg)}(o,a,n,i)}))}return n=n?n.then(i,i):i()}}function w(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,w(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=u(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,s;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function O(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function j(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function _(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(O,this),this.reset(!0)}function k(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,a=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:E}}function E(){return{value:void 0,done:!0}}return p.prototype=m,c(b,"constructor",m),c(m,"constructor",p),p.displayName=c(m,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===p||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,m):(t.__proto__=m,c(t,i,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},v(g.prototype),c(g.prototype,a,(function(){return this})),t.AsyncIterator=g,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new g(l(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},v(b),c(b,i,"Generator"),c(b,o,(function(){return this})),c(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=k,_.prototype={constructor:_,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(j),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),l=r.call(a,"finallyLoc");if(c&&l){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,s):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),j(r),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;j(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:k(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},t}function A(t,e,r,n,o,a,i){try{var c=t[a](i),l=c.value}catch(t){return void r(t)}c.done?e(l):Promise.resolve(l).then(n,o)}function M(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function D(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?M(Object(r),!0).forEach((function(e){N(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):M(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function N(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var T=D(D({},w.a),{options:function(t){return(e=P().mark((function t(e){var r,n,o;return P().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(!j()(e)){t.next=2;break}return t.abrupt("return",[]);case 2:return r={search:e,type:1,mode:2,limit:5,offset:0},t.next=5,k()({path:Object(v.y)("/analytics/engagements/search?"+Object(E.stringify)(r)),method:"GET"});case 5:return n=t.sent,o=L()(n,"result")?n.result.map((function(t){return{key:t.id,name:t.title,label:t.title}})):[],t.abrupt("return",o);case 8:case"end":return t.stop()}}),t)})),r=function(){var t=this,r=arguments;return new Promise((function(n,o){var a=e.apply(t,r);function i(t){A(a,n,o,i,c,"next",t)}function c(t){A(a,n,o,i,c,"throw",t)}i(void 0)}))},function(t){return r.apply(this,arguments)})(t);var e,r}});function Y(t){return(Y="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function I(){I=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",a=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function l(t,e,r,n){var o=e&&e.prototype instanceof f?e:f,a=Object.create(o.prototype),i=new _(n||[]);return a._invoke=function(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return E()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=w(i,r);if(c){if(c===s)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=u(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===s)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(t,r,i),a}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var s={};function f(){}function p(){}function m(){}var h={};c(h,o,(function(){return this}));var y=Object.getPrototypeOf,d=y&&y(y(k([])));d&&d!==e&&r.call(d,o)&&(h=d);var b=m.prototype=f.prototype=Object.create(h);function v(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function g(t,e){var n;this._invoke=function(o,a){function i(){return new e((function(n,i){!function n(o,a,i,c){var l=u(t[o],t,a);if("throw"!==l.type){var s=l.arg,f=s.value;return f&&"object"==Y(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(f).then((function(t){s.value=t,i(s)}),(function(t){return n("throw",t,i,c)}))}c(l.arg)}(o,a,n,i)}))}return n=n?n.then(i,i):i()}}function w(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,w(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=u(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,s;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function O(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function j(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function _(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(O,this),this.reset(!0)}function k(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,a=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return a.next=a}}return{next:E}}function E(){return{value:void 0,done:!0}}return p.prototype=m,c(b,"constructor",m),c(m,"constructor",p),p.displayName=c(m,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===p||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,m):(t.__proto__=m,c(t,i,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},v(g.prototype),c(g.prototype,a,(function(){return this})),t.AsyncIterator=g,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new g(l(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},v(b),c(b,i,"Generator"),c(b,o,(function(){return this})),c(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=k,_.prototype={constructor:_,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(j),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),l=r.call(a,"finallyLoc");if(c&&l){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,s):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),j(r),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;j(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:k(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},t}function F(t,e,r,n,o,a,i){try{var c=t[a](i),l=c.value}catch(t){return void r(t)}c.done?e(l):Promise.resolve(l).then(n,o)}function G(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function C(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?G(Object(r),!0).forEach((function(e){q(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):G(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function q(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var U=C(C({},r(1186).a),{options:function(t){return(e=I().mark((function t(e){var r,n,o;return I().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(!j()(e)){t.next=2;break}return t.abrupt("return",[]);case 2:return r={search:e,type:2,mode:2,limit:5,offset:0},t.next=5,k()({path:Object(v.y)("/analytics/engagements/search?"+Object(E.stringify)(r)),method:"GET"});case 5:return n=t.sent,o=L()(n,"result")?n.result.map((function(t){return{key:t.id,name:t.title,label:t.title}})):[],t.abrupt("return",o);case 8:case"end":return t.stop()}}),t)})),r=function(){var t=this,r=arguments;return new Promise((function(n,o){var a=e.apply(t,r);function i(t){F(a,n,o,i,c,"next",t)}function c(t){F(a,n,o,i,c,"throw",t)}i(void 0)}))},function(t){return r.apply(this,arguments)})(t);var e,r}});function H(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function R(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?H(Object(r),!0).forEach((function(e){B(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):H(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function B(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function Q(t){return function(t){if(Array.isArray(t))return $(t)}(t)||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(t)||function(t,e){if(!t)return;if("string"==typeof t)return $(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return $(t,e)}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function $(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}var J=function(t){var e=t.query,r=t.children,a=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",e=arguments.length>1?arguments[1]:void 0;if(e.hasOwnProperty("filter")){var r=0;return"broadcast"==e.filter?r=2:"automation"==e.filter&&(r=1),k()({path:Object(v.y)("/analytics/entity/data/?type=".concat(r,"&oid=").concat(t)),method:"GET"}).then((function(t){return 200==t.code&&t.hasOwnProperty("result")?[{key:t.result.id,label:t.result.title}]:[]}))}},i=[{staticParams:["page","path","period","chart","chartType"],param:"filter",showFilters:function(){return!0},filters:[{label:Object(o.__)("All SMS","wp-marketing-automations"),value:"all"}]}];if(Object(v.Sb)()){var c=[{label:Object(o.__)("Single Automation","wp-marketing-automations"),value:"select_automation",subFilters:[{component:"Search",value:"automation",path:["select_automation"],autocompleter:T,settings:{type:"custom",param:"id",selected:!0,getLabels:a,labels:{placeholder:Object(o.__)("Type to search for a automation","wp-marketing-automations"),button:Object(o.__)("Automation","wp-marketing-automations")}}}]},{label:Object(o.__)("Single Broadcast","wp-marketing-automations"),value:"select_broadcast",subFilters:[{component:"Search",value:"broadcast",path:["select_broadcast"],autocompleter:U,settings:{type:"custom",param:"id",getLabels:a,labels:{placeholder:Object(o.__)("Type to search for a broadcast","wp-marketing-automations"),button:Object(o.__)("Broadcast","wp-marketing-automations")}}}]}];i[0].filters=[].concat(Q(i[0].filters),c)}return Object(n.createElement)("div",{className:"bwf-crm-emails-report-filter"},r,Object(n.createElement)(g.a,{siteLocale:"en-US",path:"/",query:e,filterTitle:Object(o.__)("Email","wp-marketing-automations"),filters:i,onDateSelect:function(t){var r=R(R({},e),t);delete r.compare,Object(h.k)(r,"/",{})},showDatePicker:!0,isoDateFormat:u.g,hideCompare:!0,dateQuery:function(t){t.compare="previous_year";var e=Object(u.e)(t),r=e.period,n=e.compare,o=e.before,a=e.after,i=Object(u.c)(t);return{period:r,compare:n,before:o,after:a,primaryDate:i.primary,secondaryDate:i.secondary}}(e),currency:Object(v.sb)()}))},z=r(1068),K=r(1069),V=r(54),W=r(65),X=r(137),Z=r(1051),tt=r(1078);function et(t){return function(t){if(Array.isArray(t))return rt(t)}(t)||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(t)||function(t,e){if(!t)return;if("string"==typeof t)return rt(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return rt(t,e)}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function rt(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}e.default=function(){var t=Object(V.a)(Object(v.sb)()).formatAmount,e=Object(z.a)(),r=e.fetchEmailAnalytics,i=e.fetchEmailTable,l=e.setEmailTableData,f=e.setEmailAnalyticsData;Object(K.a)("sms",!1,"");var p=Object(h.i)(),m=function(t){return t.compare="previous_year",Object(u.c)(t).primary};p.hasOwnProperty("period")||(p.period="month");var y=a.a.getEmailTableLoading,d=a.a.getEmailTableLimit,g=a.a.getEmailTableOffset,w=a.a.getEmailTablePage,O=a.a.getEmailTableList,j=a.a.getEmailTableTotal,_=a.a.getEmailAnalytics,k=y(),E=g(),S=d(),L=w(),x=O(),P=j(),A=p.period,M=p.compare,D=p.interval,N=p.after,T=p.before,Y=p.id,I=p.filter,F=_(),G=function(t,e){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],o=arguments.length>3?arguments[3]:void 0,a=arguments.length>4?arguments[4]:void 0,c=m(t),l="",u="";c&&(Object(s.isEmpty)(c.after)||(l=c.after.format("YYYY-MM-DD HH:mm:ss")),Object(s.isEmpty)(c.before)||(u=c.before.format("YYYY-MM-DD 23:59:59")),Object(s.isEmpty)(l)||Object(s.isEmpty)(u)||(n&&r(l,u,e,Y,I,2),i(o,a,l,u,e,Y,I,2)))};Object(n.useEffect)((function(){if(Object(v.l)(Object(o.__)("SMS Analytics","wp-marketing-automations")),Object(v.Sb)()){var t=p.hasOwnProperty("interval")?p.interval:"day";G(p,t,!0,S,E)}else{for(var e=m(p),r=0,n=0,a=0,i=0,c=[],u=e.after;u.isBefore(e.before);u.add(1,"days")){var s=Math.floor(11*Math.random()),h=Math.floor(Math.random()*parseInt(s)),y=Math.floor(Math.random()*parseInt(h)),d=Math.floor(100*Math.random());c.push({date_end_gmt:u.format("YYYY-MM-DD")+" 23:59:59",date_start_gmt:u.format("YYYY-MM-DD")+" 00:00:00",end_date:u.format("YYYY-MM-DD")+" 23:59:59",interval:u.format("YYYY-MM-DD"),start_date:u.format("YYYY-MM-DD")+" 00:00:00",subtotals:{click_rate:(h/s*100).toFixed(2),email_click:h,email_sents:s,total_orders:y,total_revenue:d}}),r+=s,n+=h,a+=y,i+=d}f("data",{totals:{click_rate:(n/r*100).toFixed(2),email_click:n,email_sents:r,total_orders:a,total_revenue:i},intervals:c}),f("isLoading",!1),l("data",[{click_count:n,click_rate:(n/r*100).toFixed(2),conversions:a,oid:"5",revenue:i,sent:r,subject:Object(o.__)("Dummy Message","wp-marketing-automations"),template:"",tid:"52",title:Object(o.__)("Dummy SMS","wp-marketing-automations"),type:"1"}]),l("isLoading",!1)}}),[A,M,D,N,T,Y,I]);var C,q=[{key:"message",label:Object(o.__)("Message","wp-marketing-automations"),isLeftAligned:!0,cellClassName:"bwf-w-360 bwf-max-w-400"},{key:"source",label:Object(o.__)("Source","wp-marketing-automations"),isLeftAligned:!1},{key:"sent",label:Object(o.__)("Sent","wp-marketing-automations"),isLeftAligned:!0,isNumeric:!0},{key:"click",label:Object(o.__)("Click","wp-marketing-automations"),isLeftAligned:!1,isNumeric:!0},Object(v.fc)()?{key:"orders",label:Object(o.__)("Orders","wp-marketing-automations"),isLeftAligned:!0}:{},Object(v.fc)()?{key:"revenue",label:Object(o.__)("Revenue","wp-marketing-automations"),isLeftAligned:!1,isNumeric:!0}:{}],U=function(t){if(t!==S){l("limit",t);var e=p.hasOwnProperty("interval")?p.interval:"day";G(p,e,!1,t,E)}},H=function(t){if(!F||!F.hasOwnProperty("totals"))return 0;var e=F.totals;return e.hasOwnProperty(t)?e[t]:void 0},R=function(e){return[{key:"email_sents",title:Object(o.__)("Sent","wp-marketing-automations"),icon:"sent",value:parseInt(H("email_sents"))},{key:"email_click",title:Object(o.__)("Clicks","wp-marketing-automations"),icon:"open-rate",value:parseInt(H("email_click"))}].concat(et(Object(v.fc)()?[{key:"total_orders",title:Object(o.__)("Orders","wp-marketing-automations"),icon:"open-rate",value:parseInt(H("total_orders"))},{key:"total_revenue",title:Object(o.__)("Revenue","wp-marketing-automations"),icon:"open-rate",value:t(H("total_revenue")),isCurrency:!0}]:[]))};return Object(n.createElement)(n.Fragment,null,Object(n.createElement)("div",{className:"bwf-content-header-new"},Object(n.createElement)("div",{className:"bwf-content-header-left"},Object(n.createElement)("div",{className:"bwf-content-header-title"},Object(o.__)("SMS","wp-marketing-automations")))),Object(n.createElement)(W.a,null),Object(n.createElement)("div",{className:"bwf-crm-analytics-wrap bwf-crm-emails-report-wrap bwf-table-with-border"},!v.Qb&&!Object(v.Sb)()&&Object(n.createElement)(Z.a,{onPage:!0,modalContent:{proLink:Object(v.ab)("upgrade",{utm_medium:"SMS+Analytics+Upgrade+Modal"})}}),Object(n.createElement)(J,{query:p},v.Qb&&Object(n.createElement)(tt.a,{title:Object(o.__)("SMS Analytics","wp-marketing-automations"),message:Object(o.__)("Use our sample data to explore SMS Analytics. Use these trends to find out best time to send campaigns.","wp-marketing-automations"),proLink:Object(v.ab)("upgrade",{utm_medium:"SMS+Analytics+Sample+Data+Notice"})})),Object(n.createElement)("div",{className:"bwf_clear_2"}),Object(n.createElement)(c,{query:p,metrics:R()}),Object(n.createElement)(b,{query:p,metrics:R()}),Object(n.createElement)(X.a,{title:Object(o.__)("SMS","wp-marketing-automations"),rows:(C=[],Object(s.isEmpty)(x)||x.map((function(e){var r=parseFloat(e.click_rate)?" ( "+parseFloat(e.click_rate).toFixed(2)+"% ) ":"";C.push([{display:e.template?Object(n.createElement)("div",{className:"bwf-pre-line"},e.template):"-",value:e.subject},{display:e.title?e.title:"-",value:e.title},{display:parseInt(e.sent)?parseInt(e.sent):"-",value:e.sent},{display:parseInt(e.click_count)?e.click_count+r:"-",value:e.click_count},Object(v.fc)()?{display:parseInt(e.conversions)?parseInt(e.conversions):"-",value:e.conversions}:{},Object(v.fc)()?{display:e&&e.hasOwnProperty("revenue")&&e.revenue?t(e.revenue):"-",value:e.revenue,isCurrency:!0}:{}])})),C),headers:q,query:{paged:L},rowsPerPage:S?parseInt(S):25,totalRows:P,isLoading:k,onPageChange:function(t,e){var r=(t-1)*S;l("offset",r);var n=p.hasOwnProperty("interval")?p.interval:"day";G(p,n,!1,S,r)},onQueryChange:function(t){return"per_page"!==t?function(){}:U},showMenu:!1,rowHeader:!0,hideHeader:"yes",emptyMessage:Object(o.__)("No SMS found","wp-marketing-automations")})))}}}]);