(window.webpackJsonp=window.webpackJsonp||[]).push([[78],{1476:function(e,t,a){"use strict";a.r(t);var n=a(0),r=a(1092),c=a(1086),l=a(1216),o=a(68),i=a(1),s=a(29),m=a(5);function b(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var a=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=a){var n,r,c,l,o=[],i=!0,s=!1;try{if(c=(a=a.call(e)).next,0===t){if(Object(a)!==a)return;i=!1}else for(;!(i=(n=c.call(a)).done)&&(o.push(n.value),o.length!==t);i=!0);}catch(e){s=!0,r=e}finally{try{if(!i&&null!=a.return&&(l=a.return(),Object(l)!==l))return}finally{if(s)throw r}}return o}}(e,t)||function(e,t){if(e){if("string"==typeof e)return u(e,t);var a={}.toString.call(e).slice(8,-1);return"Object"===a&&e.constructor&&(a=e.constructor.name),"Map"===a||"Set"===a?Array.from(e):"Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a)?u(e,t):void 0}}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function u(e,t){(null==t||t>e.length)&&(t=e.length);for(var a=0,n=Array(t);a<t;a++)n[a]=e[a];return n}var f=function(e){return Object(i.__)("Saved form does not exist.","wp-marketing-automations")},p=function(){var e=bwfcrm_contacts_data&&bwfcrm_contacts_data.form_nice_names?bwfcrm_contacts_data.form_nice_names:{},t=bwfcrm_contacts_data&&bwfcrm_contacts_data.available_forms?bwfcrm_contacts_data.available_forms:[],a=Object(c.a)().getFeed,l=Object(r.a)(),o=l.setFormSource,u=l.resetSelection,p=a(),d=(p||{}).source,O=void 0===d?"":d,j=b(Object(n.useState)(O&&!t.includes(O)?f(e[O]):""),2),w=j[0],v=j[1];return Object(n.createElement)(n.Fragment,null,!!e&&Object.keys(e).length>0&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)("div",{className:"bwf-input-label bwf-mb-8"},Object(i.__)("Form Type","wp-marketing-automations")),Object(n.createElement)("div",{className:"bwf-display-flex bwf-flex-start gap-24 bwf-flex-wrap"},e.map((function(e){var a=e.value,r=void 0===a?"":a,c=e.label,l=void 0===c?"":c;return""===r?null:Object(n.createElement)(m.Button,{key:r,onClick:function(){o(r),t.includes(r)?v(""):(v(f()),u())},isSecondary:r===O,isTertiary:r!==O,className:"bwf-btn-small "+(r===O?"is-border is-blue-bg":"")},l)})))),!!w&&Object(n.createElement)(n.Fragment,null,Object(n.createElement)("div",{className:"bwf_clear_30"}),Object(n.createElement)(s.a,{isDismissible:!1,status:"error"},w)))},d=a(55),O=function(e){var t=Object(c.a)(),a=t.getSelectionOptions,l=t.getSelections,o=t.getLoading,s=Object(r.a)().setSelection,m=o(),b=a(),u=l();return Object(n.createElement)("div",{className:"bwf-crm-form-selection-wrap"},b&&Object.keys(b).map((function(e){var t=b[e],a=t.slug,r=void 0===a?"":a,c=r&&u[r]?u[r]:"";return t&&t.options?Object(n.createElement)("div",{key:e},Object(n.createElement)("div",{className:"bwf-input-label bwf-mb-8"},Object(i.__)("Select ","wp-marketing-automations")+t.name),Object(n.createElement)("select",{onChange:function(e){return s(r,e.target.value)},value:c},Object(n.createElement)("option",{value:""},Object(i.__)("Choose ","wp-marketing-automations")+t.name),Object.keys(t.options).map((function(e){var a=t.options[e],r=a?Object.keys(a).map((function(e){return Object(n.createElement)("option",{key:e,value:e},a[e])})):[];return"default"!==e?Object(n.createElement)("optgroup",{key:e,label:e},r):r})))):null})),m&&Object(n.createElement)(d.a,{size:"l"}))},j=a(14),w=function(e,t,a){return!(!e||parseInt(t)>Object.keys(e).length)&&Object.keys(a).reduce((function(t,n){var r=a[n];if(!e[r.slug])return!1;for(var c in r.options){var l=r.options[c];for(var o in l)if(o===e[r.slug]||parseInt(o)===parseInt(e[r.slug]))return t}return!1}),!0)},v=bwfcrm_contacts_data&&bwfcrm_contacts_data.available_forms?bwfcrm_contacts_data.available_forms:[];t.default=function(e){var t=e.feedId,a=Object(r.a)(),s=a.syncSelection,m=a.setStep,b=Object(c.a)(),u=b.getFeed,f=b.getSelections,d=b.getSelectionOptionsTotal,_=b.getSelectionOptions,g=u(),y=(g||{}).source,E=void 0===y?"":y,k=f(),S=d(),h=_();return Object(n.useEffect)((function(){g&&parseInt(g.id)===parseInt(t)&&E&&v.includes(E)&&s(t,k,!0)}),[E,k]),Object(n.createElement)(n.Fragment,null,g&&parseInt(g.id)===parseInt(t)?Object(n.createElement)(n.Fragment,null,Object(n.createElement)(o.a,null),Object(n.createElement)("div",{className:"bwf-crm-stepper-wrap bwf-card-wrap"},Object(n.createElement)("div",{className:"bwf-card-header"},Object(n.createElement)("span",{className:"bwf-form-title"},Object(i.__)("Select Form","wp-marketing-automations"))),Object(n.createElement)("div",{className:"bwf-crm-background-wrap"},Object(n.createElement)(p,null),Object(n.createElement)("div",{className:"bwf_clear_24"}),Object(n.createElement)(O,null)),Object(n.createElement)("div",{className:"bwf-crm-stepper-navigation bwf_text_right"},Object(n.createElement)(j.a,{className:"bwf-crm-stepper-next",isPrimary:!0,disabled:!w(k,S,h),onClick:function(){w(k,S,h)&&m("mapping")}},Object(i.__)("Next","wp-marketing-automations"))))):Object(n.createElement)(l.a,null))}}}]);