(window.webpackJsonp=window.webpackJsonp||[]).push([[68],{1062:function(t,e,r){"use strict";var n=r(0),a=r(25),o=r(1),i=r(190);e.a=function(t){var e=t.selected,r=t.onTagsChange;return Object(n.createElement)("div",{className:"bwf-c-field-mapper-terms"},Object(n.createElement)("div",{className:"bwf-input-label"},Object(o.__)("Add Tags","wp-marketing-automations")),Object(n.createElement)(a.a,{autocompleter:i.b,multiple:!1,allowFreeTextSearch:!0,inlineTags:!1,selected:e,onChange:function(t){r(t)},onRemoveTag:function(t,n){var a=e.filter((function(e){return!(e.key==t&&e.label==n)}));r(a)},placeholder:Object(o.__)("Search by tag name","wp-marketing-automations"),showClearButton:!0,disabled:!1}))}},1451:function(t,e,r){"use strict";r.r(e);var n=r(0),a=r(200),o=r(5),i=r(1),c=r(13),l=r(1065),u=r(1064),s=r(65),f=r(18),m=r(9),b=r.n(m),d=r(3);function p(t){return(p="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}var h=["template"];function y(t,e){if(null==t)return{};var r,n,a=function(t,e){if(null==t)return{};var r,n,a={},o=Object.keys(t);for(n=0;n<o.length;n++)r=o[n],e.indexOf(r)>=0||(a[r]=t[r]);return a}(t,e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);for(n=0;n<o.length;n++)r=o[n],e.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(t,r)&&(a[r]=t[r])}return a}function g(){g=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},a=n.iterator||"@@iterator",o=n.asyncIterator||"@@asyncIterator",i=n.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function l(t,e,r,n){var a=e&&e.prototype instanceof f?e:f,o=Object.create(a.prototype),i=new k(n||[]);return o._invoke=function(t,e,r){var n="suspendedStart";return function(a,o){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===a)throw o;return x()}for(r.method=a,r.arg=o;;){var i=r.delegate;if(i){var c=_(i,r);if(c){if(c===s)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=u(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===s)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(t,r,i),o}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var s={};function f(){}function m(){}function b(){}var d={};c(d,a,(function(){return this}));var h=Object.getPrototypeOf,y=h&&h(h(S([])));y&&y!==e&&r.call(y,a)&&(d=y);var v=b.prototype=f.prototype=Object.create(d);function w(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function O(t,e){var n;this._invoke=function(a,o){function i(){return new e((function(n,i){!function n(a,o,i,c){var l=u(t[a],t,o);if("throw"!==l.type){var s=l.arg,f=s.value;return f&&"object"==p(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,i,c)}),(function(t){n("throw",t,i,c)})):e.resolve(f).then((function(t){s.value=t,i(s)}),(function(t){return n("throw",t,i,c)}))}c(l.arg)}(a,o,n,i)}))}return n=n?n.then(i,i):i()}}function _(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,_(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=u(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,s;var a=n.arg;return a?a.done?(e[t.resultName]=a.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):a:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function j(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function E(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function k(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(j,this),this.reset(!0)}function S(t){if(t){var e=t[a];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,o=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:x}}function x(){return{value:void 0,done:!0}}return m.prototype=b,c(v,"constructor",b),c(b,"constructor",m),m.displayName=c(b,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,b):(t.__proto__=b,c(t,i,"GeneratorFunction")),t.prototype=Object.create(v),t},t.awrap=function(t){return{__await:t}},w(O.prototype),c(O.prototype,o,(function(){return this})),t.AsyncIterator=O,t.async=function(e,r,n,a,o){void 0===o&&(o=Promise);var i=new O(l(e,r,n,a),o);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},w(v),c(v,i,"Generator"),c(v,a,(function(){return this})),c(v,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=S,k.prototype={constructor:k,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(E),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var a=this.tryEntries.length-1;a>=0;--a){var o=this.tryEntries[a],i=o.completion;if("root"===o.tryLoc)return n("end");if(o.tryLoc<=this.prev){var c=r.call(o,"catchLoc"),l=r.call(o,"finallyLoc");if(c&&l){if(this.prev<o.catchLoc)return n(o.catchLoc,!0);if(this.prev<o.finallyLoc)return n(o.finallyLoc)}else if(c){if(this.prev<o.catchLoc)return n(o.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return n(o.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var a=this.tryEntries[n];if(a.tryLoc<=this.prev&&r.call(a,"finallyLoc")&&this.prev<a.finallyLoc){var o=a;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,s):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),E(r),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var a=n.arg;E(r)}return a}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:S(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},t}function v(t,e,r,n,a,o,i){try{var c=t[o](i),l=c.value}catch(t){return void r(t)}c.done?e(l):Promise.resolve(l).then(n,a)}function w(t){return function(){var e=this,r=arguments;return new Promise((function(n,a){var o=t.apply(e,r);function i(t){v(o,n,a,i,c,"next",t)}function c(t){v(o,n,a,i,c,"throw",t)}i(void 0)}))}}var O=function(t){return{sendTestEmail:(a=w(g().mark((function t(e,r,n,a,o,i){var c,l,u,s,f,m=arguments;return g().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return c=m.length>6&&void 0!==m[6]&&m[6],l=m.length>7&&void 0!==m[7]?m[7]:{},u=m.length>8&&void 0!==m[8]&&m[8],s=m.length>9&&void 0!==m[9]?m[9]:{},t.prev=4,f={email:e,content:JSON.stringify({subject:r,body:n,type:a,mail_data:o,preheader:i,utmEnabled:c,utmDetails:l,overRideSenderInfo:u,overRideInfo:s})},t.next=8,b()({method:"POST",path:Object(d.y)("/send-test-email"),data:f});case 8:return t.abrupt("return",2);case 11:return t.prev=11,t.t0=t.catch(4),t.abrupt("return",3);case 14:case"end":return t.stop()}}),t,null,[[4,11]])}))),function(t,e,r,n,o,i){return a.apply(this,arguments)}),saveEditorContent:(n=w(g().mark((function e(r){var n,a,o,i,c;return g().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return"block"===r[0].type&&r[0].hasOwnProperty("block")&&(n=r[0].block,a=n.template,o=void 0===a?"":a,i=y(n,h),""!==o&&(r[0].body=r[0].block.template),r[0].block=i),e.prev=1,c={content:JSON.stringify(r)},e.next=5,b()({method:"POST",path:Object(d.y)("/form-feeds/".concat(t,"/save-email-content")),data:c});case 5:return e.abrupt("return",2);case 8:return e.prev=8,e.t0=e.catch(1),e.abrupt("return",3);case 11:case"end":return e.stop()}}),e,null,[[1,8]])}))),function(t){return n.apply(this,arguments)}),uploadImage:(r=w(g().mark((function t(e){var r,n;return g().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return(r=new FormData).append("image",e),t.prev=2,t.next=5,b()({method:"POST",path:Object(d.y)("/upload-image"),body:r});case 5:return n=t.sent,t.abrupt("return",n&&n.result?n.result:"");case 9:return t.prev=9,t.t0=t.catch(2),t.abrupt("return","");case 12:case"end":return t.stop()}}),t,null,[[2,9]])}))),function(t){return r.apply(this,arguments)}),fetchCurrentMailEditorContent:(e=w(g().mark((function e(){var r;return g().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,b()({method:"GET",path:Object(d.y)("/form-feeds/".concat(t,"/get-email-content"))});case 3:return r=e.sent,e.abrupt("return",r&&r.result?r.result:"");case 7:return e.prev=7,e.t0=e.catch(0),e.abrupt("return","");case 10:case"end":return e.stop()}}),e,null,[[0,7]])}))),function(){return e.apply(this,arguments)})};var e,r,n,a},_=r(1062),j=r(2),E=r(39),k=r(8);function S(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var r=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==r)return;var n,a,o=[],i=!0,c=!1;try{for(r=r.call(t);!(i=(n=r.next()).done)&&(o.push(n.value),!e||o.length!==e);i=!0);}catch(t){c=!0,a=t}finally{try{i||null==r.return||r.return()}finally{if(c)throw a}}return o}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return x(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return x(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function x(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}function N(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function C(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?N(Object(r),!0).forEach((function(e){T(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):N(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function T(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var L=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",r=bwfcrm_contacts_data&&bwfcrm_contacts_data.editor_settings&&bwfcrm_contacts_data.editor_settings.default&&bwfcrm_contacts_data.editor_settings.default.form?bwfcrm_contacts_data.editor_settings.default.form:{};return t&&0!==Object.keys(r).length?Array.isArray(t.content)&&t.content[0]?(t.content[0].body||(t.content[0].body=r.body?r.body:""),t.content[0].last_updated=e,t.content[0].editor||(t.content[0].editor=r.editor?r.editor:{}),t):C(C({},t),{},{content:[{body:r.body?r.body:"",editor:r.editor?C({},r.editor):{}}]}):t};e.default=function(t){var e,r=t.feedId,m=Object(l.a)(),b=Object(u.a)(),p=m.getUpdateStepThreeStatus(),h=m.getFeed(),y=h&&h.status?parseInt(h.status):1,g=h&&h.last_updated?h.last_updated:"",v=h&&h.data?h.data:{},w=!(!v||!("incentivize_email"in v))&&v.incentivize_email,x=!(!v||!("marketing_status"in v))&&v.marketing_status,N=!(!v||!("not_send_to_subscribed"in v))&&v.not_send_to_subscribed,T=!(!v||!("add_tag_enable"in v))&&v.add_tag_enable,P=v&&"tag_to_add"in v?v.tag_to_add:[],A=v&&"redirect_url"in v?v.redirect_url:"",I=v&&"redirect_mode"in v?v.redirect_mode:"url",F=S(Object(n.useState)(!1),2),D=F[0],R=F[1],G=S(Object(n.useState)(!1),2),B=G[0],M=G[1],z=S(Object(n.useState)(!1),2),U=z[0],J=z[1],Y=S(Object(n.useState)(!1),2),q=Y[0],$=Y[1],H=Object(n.useCallback)((function(t){Object(d.Sb)()?!1===w?b.updateStepThree(r,{incentivize_email:w,marketing_status:x},t):(M(t),R(!0)):$(!0)}),[w,x]),K=Object(n.useCallback)((function(t){b.updateStepThree(r,{incentivize_email:w,marketing_status:x,incentive_email:t,redirect_mode:I,redirect_url:A,add_tag_enable:T,tag_to_add:P,not_send_to_subscribed:N},B),R(!1)}),[w,x,B,I,A]),Q={objectId:"crm.form.".concat(r),mergeTagsContext:"forms"};return Object(n.createElement)("div",{className:"bwf-crm-stepper-wrap bwf-card-wrap bwf-crm-forms-step-3"},Object(n.createElement)(s.a,null),Object(n.createElement)("div",{className:"bwf-card-header"},Object(n.createElement)("span",{className:"bwf-form-title"},Object(i.__)("Lead Notification","wp-marketing-automations"))),Object(n.createElement)("div",{className:"bwf-crm-importer-wrap"},Object(n.createElement)("div",{className:"bwf-crm-import-section"},Object(n.createElement)(o.ToggleControl,{label:Object(i.__)("Enable email notification","wp-marketing-automations"),className:"bwf-tooglecontrol-advance",help:Object(i.__)("Note: Use {{contact_confirmation_link}} for double optin","wp-marketing-automations"),onChange:function(t){return b.setIncentivizeEmail(t)},checked:!!w})),!!w&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)("div",{className:"bwf-p-gap bwf-pt-0 bwf-pb-0"},Object(n.createElement)(a.a,{disableDefaultButtons:!0,onEmailContentReady:K,onEmailContentError:function(){return R(!1)},showTab:!1,initData:L(v&&"incentive_email"in v?C(C({},v.incentive_email),Q):Q,g),validateEmailContent:!!D,apiMethods:O?O(r):{},openTemplateModal:U,setTemplateModal:J,transactionalEnabled:!0})),Object(n.createElement)("div",{className:"bwf-p-gap"},Object(n.createElement)(o.Card,{className:"bwf-p-gap bwf-border"},Object(n.createElement)(o.ToggleControl,{label:Object(i.__)("Don't send email if contact is already subscribed","wp-marketing-automations"),className:"bwf-tooglecontrol-advance",onChange:function(t){return b.setNotSendToSubscribed(t)},checked:!!N}),Object(n.createElement)(f.a,{gap:5,justify:"start",align:"start"},Object(n.createElement)(o.FlexItem,null,Object(n.createElement)("p",{className:"bwf-heading7-new bwf-mb-8"},Object(i.__)("Redirect After Confirmation","wp-marketing-automations")),Object(n.createElement)("div",{className:"bwf-display-flex bwf-flex-start gap-16"},Object(n.createElement)(o.Button,{isSecondary:!I||"url"===I,isTertiary:I&&"url"!==I,onClick:function(){return b.setRedirectMode("url")},className:"bwf-btn-small "+(I&&"url"!==I?"":"is-border is-blue-bg")},Object(i.__)("URL","wp-marketing-automations")),Object(n.createElement)(o.Button,{isSecondary:I&&"file"===I,isTertiary:I&&"file"!==I,onClick:function(){return b.setRedirectMode("file")},className:"bwf-btn-small "+(I&&"file"===I?"is-border is-blue-bg":"")},Object(i.__)("File","wp-marketing-automations"))))),Object(n.createElement)("div",{className:"bwf_clear_24"}),Object(n.createElement)(o.TextControl,{label:"",value:A,onChange:function(t){return b.setRedirectUrl(t)},placeholder:Object(i.__)("Enter URL","wp-marketing-automations")}),Object(n.createElement)("div",{className:"bwf_clear_20"}),Object(n.createElement)(o.ToggleControl,{label:Object(i.__)("Add Tags after confirmation","wp-marketing-automations"),className:"bwf-tooglecontrol-advance",onChange:function(t){return b.setAddTagEnabled(t)},checked:!!T}),T&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)("div",{className:"bwf_clear_10"}),Object(n.createElement)(_.a,{onTagsChange:function(t){b.setTagList(t.map((function(t){return{id:t.key,value:t.label}})))},selected:(e=[],Object(j.isEmpty)(P)||P.map((function(t){e.push({key:t.id,label:t.value})})),e)})),Object(n.createElement)("p",{className:"bwf-mb-0"},Object(i.__)("Note: The settings will work when confirmation link is clicked","wp-marketing-automations"))))),Object(n.createElement)("div",{className:"bwf-crm-import-section sa",style:{paddingTop:"0"}},Object(n.createElement)(o.ToggleControl,{label:Object(i.__)("Auto-confirm Contacts","wp-marketing-automations"),help:Object(i.__)("This will automatically mark new Contacts as Subscribed","wp-marketing-automations"),onChange:function(t){return b.setMarketingStatus(t)},className:"bwf-tooglecontrol-advance",checked:!!x})),Object(n.createElement)("div",{className:"bwf_clear_24"}),Object(n.createElement)("div",{className:"bwf-p-gap bwf-pt-0"},Object(n.createElement)(f.a,null,Object(n.createElement)(f.b,null,Object(n.createElement)(c.a,{className:"bwf-display-flex",isSecondary:!0,onClick:function(){return b.setStep("mapping")}},Object(i.__)("Back","wp-marketing-automations"))),Object(n.createElement)(f.b,{className:"bwf_text_right"},3===parseInt(y)&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)(c.a,{onClick:function(){return H(y)},isSecondary:!0},Object(i.__)("Save","wp-marketing-automations")),Object(n.createElement)(c.a,{onClick:function(){return H(2)},className:"bwf-ml-10",isPrimary:!0,isBusy:1===p},Object(i.__)("Save & Activate","wp-marketing-automations"))),2===parseInt(y)&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)(c.a,{onClick:function(){return H(3)},isSecondary:!0},Object(i.__)("Deactivate","wp-marketing-automations")),Object(n.createElement)(c.a,{onClick:function(){return H(y)},className:"bwf-ml-10",isPrimary:!0,isBusy:1===p},Object(i.__)("Save","wp-marketing-automations"))),1===parseInt(y)&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)(c.a,{onClick:function(){return H(y)},isSecondary:!0},!Object(d.Sb)()&&Object(n.createElement)(k.a,{icon:"king",size:16}),Object(i.__)("Save As Draft","wp-marketing-automations")),Object(n.createElement)(c.a,{onClick:function(){return H(2)},className:"bwf-ml-10",isPrimary:!0,isBusy:1===p},!Object(d.Sb)()&&Object(n.createElement)(k.a,{icon:"king",size:16,color:"#fff"}),Object(i.__)("Activate","wp-marketing-automations"))))))),!Object(d.Sb)()&&Object(n.createElement)(E.b,{isOpen:q,onRequestClose:function(){return $(!1)},modalContent:{isFeature:!0,featureTitle:Object(i.__)("Form","wp-marketing-automations")}}))}}}]);