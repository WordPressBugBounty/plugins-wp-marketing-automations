(window.webpackJsonp=window.webpackJsonp||[]).push([[46],{1076:function(t,e,n){"use strict";var a=n(73),o=n(0),r=n(1),i=n(3),c=function(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n={workflow:{name:Object(r.__)("Workflow","wp-marketing-automations"),link:e?"admin.php?page=autonami&path=/automation/".concat(t):"admin.php?page=autonami-automations&edit=".concat(t),redirect:!e}};return e&&(n.single_a_contacts={name:Object(r.__)("Contacts","wp-marketing-automations"),link:"admin.php?page=autonami&path=/automation/".concat(t,"/contacts"),showOnClick:!0},n.analytics={name:Object(r.__)("Analytics","wp-marketing-automations"),link:e?"admin.php?page=autonami&path=/automation/".concat(t,"/analytics"):"admin.php?page=autonami&path=/automation-v1/".concat(t,"/analytics"),isPro:!0,showOnClick:!0}),n.engagement={name:Object(r.__)("Engagements","wp-marketing-automations"),link:e?"admin.php?page=autonami&path=/automation/".concat(t,"/engagements"):"admin.php?page=autonami&path=/automation-v1/".concat(t,"/engagements"),isPro:!0,showOnClick:!0},Object(i.fc)()&&(n.orders={name:Object(r.__)("Orders","wp-marketing-automations"),link:e?"admin.php?page=autonami&path=/automation/".concat(t,"/orders"):"admin.php?page=autonami&path=/automation-v1/".concat(t,"/orders"),isPro:!0,showOnClick:!0}),n};e.a=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",i=arguments.length>3&&void 0!==arguments[3]&&arguments[3],u=arguments.length>4&&void 0!==arguments[4]?arguments[4]:"",s=arguments.length>5&&void 0!==arguments[5]?arguments[5]:0,l=arguments.length>6&&void 0!==arguments[6]&&arguments[6],f=arguments.length>7&&void 0!==arguments[7]&&arguments[7],m=arguments.length>8&&void 0!==arguments[8]&&arguments[8],p=bwfcrm_contacts_data&&bwfcrm_contacts_data.header_data?bwfcrm_contacts_data.header_data:{},b=(p.automation_nav,p.automationv2_nav),g=Object(a.a)(),d=g.setActiveMultiple,y=g.resetHeaderMenu,O=g.setL2NavType,v=g.setL2Nav,j=g.setBackLink,w=g.setL2Title,h=g.setL2Content,P=g.setBackLinkLabel,C=g.setL2NavAlign,_=g.setPageHeader,S=g.setTabHeader;return Object(o.useEffect)((function(){y(!0),!i&&O("menu");var a=c(s,f);m||v(s?a:b),t&&a.hasOwnProperty(t)&&a[t].hasOwnProperty("name")&&S(a[t].name),d({leftNav:"automations-v2",rightNav:t}),n&&j(n),s&&j(n&&!f?"admin.php?page=autonami&path=/automations-v1":"admin.php?page=autonami&path=/automations"),i||f&&s&&P(Object(r.__)("All Automations","wp-marketing-automations")),!f&&s&&P(Object(r.__)("All Automations","wp-marketing-automations")),s&&C("left"),e&&""!==e&&w(e),!n&&u&&h(u),_(Object(r.__)("Automations","wp-marketing-automations")),l&&v({})}),[t,f,m]),!0}},1080:function(t,e,n){"use strict";var a=n(48),o=n(148);function r(t){return(r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}var i=["getStateProp"];function c(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function u(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?c(Object(n),!0).forEach((function(e){s(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function s(t,e,n){return(e=function(t){var e=function(t,e){if("object"!=r(t)||!t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var a=n.call(t,e||"default");if("object"!=r(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"==r(e)?e:e+""}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}e.a=function(){var t=Object(a.a)("automationList"),e=t.getStateProp,n=function(t,e){if(null==t)return{};var n,a,o=function(t,e){if(null==t)return{};var n={};for(var a in t)if({}.hasOwnProperty.call(t,a)){if(e.includes(a))continue;n[a]=t[a]}return n}(t,e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);for(a=0;a<r.length;a++)n=r[a],e.includes(n)||{}.propertyIsEnumerable.call(t,n)&&(o[n]=t[n])}return o}(t,i),r=Object(a.a)(o.a.recipient).getStateProp,c=Object(a.a)(o.a.conversion).getStateProp,s=Object(a.a)(o.a.contacts).getStateProp,l=Object(a.a)(o.a.analytics).getStateProp;return u(u({},n),{},{getAutomations:function(){return e("automations")},getPageNumber:function(){return parseInt(e("offset"))/parseInt(e("limit"))+1},getPerPageCount:function(){return parseInt(e("limit"))},getOffset:function(){return parseInt(e("offset"))},getTotalCount:function(){return parseInt(e("total"))},getLoadingStatus:function(){return e("isLoading")},getRecipientData:function(){return r("data")},getRecipientLoading:function(){return r("isLoading")},getRecipientOffset:function(){return r("offset")},getRecipientAutomationId:function(){return r("automationId")},getRecipientTotal:function(){return r("total")},getRecipientAutomation:function(){return r("automation")},getRecipientPage:function(){return parseInt(r("offset"))/parseInt(r("limit"))+1},getRecipientLimit:function(){return r("limit")},getRecipientSingleAutomationFailedCount:function(){return r("failedCount")},getConversionData:function(){return c("data")},getConversionLoading:function(){return c("isLoading")},getConversionOffset:function(){return c("offset")},getConversionAutomationId:function(){return c("automationId")},getConversionTotal:function(){return c("total")},getConversionAutomation:function(){return c("automation")},getConversionPage:function(){return parseInt(c("offset"))/parseInt(c("limit"))+1},getConversionLimit:function(){return c("limit")},getCountData:function(){return e("countData")},getConversionSingleAutomationFailedCount:function(){return c("failedCount")},getContactData:function(){return s("data")},getContactLoading:function(){return s("isLoading")},getContactOffset:function(){return s("offset")},getContactAutomationId:function(){return s("automationId")},getContactTotal:function(){return s("total")},getContactAutomation:function(){return s("automation")},getContactPage:function(){return parseInt(s("offset"))/parseInt(s("limit"))+1},getContactLimit:function(){return s("limit")},getContactCountData:function(){return s("contactCount")},getContactSingleAutomationFailedCount:function(){return s("failedCount")},getAnalyticsData:function(){return l("analytics")},getAnalyticsTileData:function(){return l("tiles")},getAnalyticsTableData:function(){return l("tableData")},getAnalyticsLoading:function(){return l("isLoading")},getAnalyticsType:function(){return l("type")},getAnalyticsAutomationData:function(){return l("automation")},getAnalyticsSingleAutomationFailedCount:function(){return l("failedCount")}})}},1096:function(t,e,n){"use strict";var a=n(47),o=n(3),r=n(148),i=n(19);function c(t){return(c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}var u=["fetch","setStateProp"],s=["s","page","filter","path"];function l(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function f(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?l(Object(n),!0).forEach((function(e){m(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function m(t,e,n){return(e=function(t){var e=function(t,e){if("object"!=c(t)||!t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var a=n.call(t,e||"default");if("object"!=c(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"==c(e)?e:e+""}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function p(t,e){if(null==t)return{};var n,a,o=function(t,e){if(null==t)return{};var n={};for(var a in t)if({}.hasOwnProperty.call(t,a)){if(e.includes(a))continue;n[a]=t[a]}return n}(t,e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);for(a=0;a<r.length;a++)n=r[a],e.includes(n)||{}.propertyIsEnumerable.call(t,n)&&(o[n]=t[n])}return o}e.a=function(){var t=Object(a.a)("automationList"),e=t.fetch,n=t.setStateProp,c=p(t,u),l=Object(a.a)(r.a.recipient),m=l.fetch,b=l.setStateProp,g=Object(a.a)(r.a.conversion),d=g.fetch,y=g.setStateProp,O=Object(a.a)(r.a.contacts),v=O.fetch,j=O.setStateProp,w=Object(a.a)(r.a.analytics),h=w.fetch,P=w.setStateProp;return f(f({},c),{},{fetch:function(t,a,r,i){var c=arguments.length>4&&void 0!==arguments[4]&&arguments[4];n("automation",{});var u=a.s,l=void 0===u?"":u,f=(a.page,a.filter,a.path,p(a,s)),m={offset:r,limit:i,status:t,search:l,filters:f,version:c?2:1};e("GET",Object(o.y)("/automations"),m)},setAutomationListValues:function(t,e){n(t,e)},fetchRecipient:function(t,e,n){m("GET",Object(o.y)("/v3/automation/".concat(t,"/recipients?limit=").concat(e,"&offset=").concat(n)))},setRecipientsValues:function(t,e){b(t,e)},fetchConversion:function(t,e,n){y("automation",{}),d("GET",Object(o.y)("/v3/automation/".concat(t,"/conversions?limit=").concat(e,"&offset=").concat(n)))},setConversionValues:function(t,e){y(t,e)},fetchContacts:function(t,e,n,a){var r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:"";j("automation",{}),v("GET",Object(o.y)("/automation/".concat(t,"/contacts?limit=").concat(e,"&offset=").concat(n,"&type=").concat(a,"&search=").concat(r)))},setContactValues:function(t,e){j(t,e)},fetchAnalytics:function(t,e,n,a){var r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:1,c=arguments.length>5&&void 0!==arguments[5]?arguments[5]:1,u=0;4===parseInt(c)&&(u=1),h("GET",Object(o.y)("/analytics/emails/chart/")+"?"+Object(i.stringify)({after:e,before:n,interval:a,oid:t,type:r,mode:c,contact:u}))},setAnalyticsValues:function(t,e){P(t,e)}})}},1150:function(t,e,n){},1217:function(t,e,n){"use strict";n.r(e);var a=n(0),o=n(1),r=n(143),i=n(1096),c=n(1080),u=n(144),s=n(332),l=n(54),f=n(3),m=n(147),p=n(2),b=(n(1150),n(53)),g=n(31),d=n(334),y=n(1076),O=n(73),v=n(145),j=n(6),w=n.n(j);function h(t){return(h="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function P(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null!=n){var a,o,r,i,c=[],u=!0,s=!1;try{if(r=(n=n.call(t)).next,0===e){if(Object(n)!==n)return;u=!1}else for(;!(u=(a=r.call(n)).done)&&(c.push(a.value),c.length!==e);u=!0);}catch(t){s=!0,o=t}finally{try{if(!u&&null!=n.return&&(i=n.return(),Object(i)!==i))return}finally{if(s)throw o}}return c}}(t,e)||function(t,e){if(t){if("string"==typeof t)return C(t,e);var n={}.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?C(t,e):void 0}}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function C(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,a=Array(e);n<e;n++)a[n]=t[n];return a}function _(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function S(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?_(Object(n),!0).forEach((function(e){E(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):_(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function E(t,e,n){return(e=function(t){var e=function(t,e){if("object"!=h(t)||!t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var a=n.call(t,e||"default");if("object"!=h(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"==h(e)?e:e+""}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}e.default=function(t){var e=t.match.params.automationId,n=t.isV2,j=void 0===n||n,h=Object(c.a)(),C=h.getConversionData(),_=h.getConversionAutomation(),E=h.getConversionSingleAutomationFailedCount(),k=Object(O.a)(),A=k.setL2NavAlign,D=k.setL2Title,I=k.setPageCountData,L=(0,Object(v.a)().getPageCountData)(),N=Object(i.a)(),T=N.fetchConversion,R=N.setConversionValues,F=Object(u.a)(),V=F.getAutomationData,H=F.getAutomationId,M=V().title,G=void 0===M?"":M,x=(_.v,_.title),q=void 0===x?"":x,B=H(),J=Object(s.a)().setAutomationData;Object(a.useEffect)((function(){Object(p.isEmpty)(_)||J("data",_)}),[_]),Object(a.useEffect)((function(){Q||I(S(S({},L),{},{single_a_contacts:E}))}),[E]),Object(a.useEffect)((function(){return function(){R("automation",{})}}),[]),Object(y.a)("orders","",!0,!1,null,e,!1,j);var Q=h.getConversionLoading(),U=h.getConversionLimit(),W=h.getConversionOffset(),$=h.getConversionTotal(),z=Object(l.a)(Object(f.sb)()).formatAmount;Object(a.useEffect)((function(){D(parseInt(e)===parseInt(B)&&""!==G&&""===q?G:""!==q?q:Object(a.createElement)("div",{className:"bwf-placeholder-temp bwf-h-15 bwf-w-90"}))}),[G,q,e]),Object(a.useEffect)((function(){T(e,U,W)}),[U,W]),Object(a.useEffect)((function(){A("left"),Object(f.l)("Automation #"+e)}),[Q]);var K=w()("bwf-crm-campaign-report-conversion"),X=[{key:"orderid",label:Object(o.__)("Order ID","wp-marketing-automations"),cellClassName:"bwf-crm-col-stats-m bwf-w-120"},{key:"contact",label:Object(o.__)("Contact","wp-marketing-automations"),required:!0,cellClassName:"bwf-crm-col-contact bwf-w-210"},{key:"purchaseitems",label:Object(o.__)("Purchased Items","wp-marketing-automations"),cellClassName:"bwf-crm-col-contact-details "},{key:"revenue",label:Object(o.__)("Revenue","wp-marketing-automations"),cellClassName:"bwf-crm-col-stats-m bwf-w-210"},{key:"date",label:Object(o.__)("Date","wp-marketing-automations"),cellClassName:"bwf-crm-col-stats-m"}],Y=h.getConversionPage(),Z=function(t){t!==U&&(R("limit",t),R("offset",0))},tt=function(t){return Object(a.createElement)(a.Fragment,null,t.hasOwnProperty("cid")&&t.cid>0?Object(a.createElement)(g.a,{href:"admin.php?page=autonami&path=/contact/"+t.cid,type:"bwf-crm",className:"bwf-crm-campaign-order-contact-link bwf-a-no-underline",key:t.cid},Object(a.createElement)(d.a,{contact:t,date:t.date,dateText:Object(o.__)("Placed on","wp-marketing-automations")})):Object(a.createElement)(d.a,{contact:t,date:t.date,dateText:Object(o.__)("Placed on","wp-marketing-automations")})," ")},et=function(t){return t.hasOwnProperty("order_deleted")&&t.order_deleted?Object(a.createElement)(a.Fragment,null,"#"+t.wcid):Object(a.createElement)("a",{target:"_blank",className:"bwf-a-no-underline",href:"post.php?post="+t.wcid+"&action=edit",rel:"noreferrer"},"#"+t.wcid)};return Object(a.createElement)(a.Fragment,null,Object(a.createElement)("div",{dangerouslySetInnerHTML:{__html:"<style>#bwfcrm-page{ overflow: auto !important; }</style>"}}),Object(a.createElement)(b.a,null),Object(a.createElement)("div",{className:"bwf-single-automation-body-header bwf-conversion-recipient"},Object(a.createElement)("div",{className:"bwf-content-header-left"},Object(a.createElement)("div",{className:"bwf-content-header-title2"},Object(o.__)("Orders","wp-marketing-automations")),parseInt($)>0&&Object(a.createElement)("div",{className:"bwf-content-header-count"},Object(o.sprintf)(Object(o.__)("(%s Results)","wp-marketing-automations"),$)))),Object(a.createElement)("div",{className:"bwf-position-relative"},Object(a.createElement)(r.a,{className:K,rows:C.map((function(t){return[{display:t.hasOwnProperty("wcid")?et(t):"-",value:t.hasOwnProperty("wcid")?t.wcid:"-"},{display:tt(t),value:t.hasOwnProperty("contact_name")?t.contact_name:"-"},{display:t.hasOwnProperty("items")?(n=t.items,r="",i=[],Object.entries(n).map((function(t){var e=P(t,2),n=e[0],o=e[1];Object(p.isEmpty)(r)&&(r=Object(a.createElement)("a",{className:"bwf-a-no-underline",target:"_blank",href:"post.php?action=edit&post="+n,rel:"noreferrer"},o)),i.push(Object(a.createElement)("a",{className:"bwf-a-no-underline",target:"_blank",href:"post.php?action=edit&post="+n,rel:"noreferrer"},o))})),Object(a.createElement)(a.Fragment,null,Object(p.isEmpty)(r)?"-":r,!Object(p.isEmpty)(i)&&i.length>1&&Object(a.createElement)(m.a,{items:i}))):Object(o.__)("Order Deleted","wp-marketing-automations"),value:"purchase_item"},{display:(e=t,e.hasOwnProperty("wctotal")?e.hasOwnProperty("currency")?Object(a.createElement)("span",{className:"bwf-tags bwf-tag-green"},Object(l.a)(e.currency).formatAmount(e.wctotal)):Object(a.createElement)(a.Fragment,null,parseFloat(e.wctotal)>0?Object(a.createElement)("span",{className:"bwf-tags bwf-tag-green"},z(e.wctotal)):"-"):"-"),value:t.hasOwnProperty("wctotal")?t.wctotal:0},{display:t.hasOwnProperty("date")?Object(f.cb)(t.date):"-",value:t.hasOwnProperty("date")?t.date:"-"}];var e,n,r,i})),headers:X,query:{paged:Y},rowsPerPage:U,totalRows:$,isLoading:Q,onPageChange:function(t){R("offset",(t-1)*U)},onQueryChange:function(t){return"per_page"!==t?function(){}:Z},rowHeader:!0,showMenu:!1,emptyMessage:Object(o.__)("No orders found","wp-marketing-automations"),hideHeader:"yes"})))}}}]);