/**
 * @author xujingsheng
 * sp1 for register_step_one.jsp
 */
if(!window.JSON){

    	window.JSON = {};
    }
	if(window.JSON){
    	JSON.parse = function(str){
    		return new Function('return ' + str)();
    	};
    }

	 MICE_SP1 = {
	 	control:{
	 		init: function() {
	 		    var allForms = $('form[class*="ppt."]');
	 		    for (var i = 0, j = allForms.length; i < j; i++) {
	 		        var formElement = allForms.get(i);
	 		        var classNames = $(formElement).attr('class').split(' ');
	 		        for (var k = 0, l = classNames.length; k < l; k++) {
	 		            if (classNames[k].indexOf('ppt.') >= 0) {
	 		                var ruleURI = '/ppt/$$$.json'.replace('$$$', classNames[k].substr(4));
	 		                $.getJSON(ruleURI, {}, function(json) {
	 		                    window.MICE.control.injectRules(json, formElement);
	 		                    initComplexSettings();
	 		                });
	 		                break;
	 		            }
	 		        }
	 		    }
	 		},
	 		addValidator: function(el, setting) {
	 		    var jQElement = $(el);
	 		    var initCarrier = window.MICE.control.elementIsValid(el, true);
	 		    window.MICE.view.initTipContainer(initCarrier);
	 		    window.MICE.view.showMessage(initCarrier);
	 		    var defaultValue = setting.defaultValue;
	 		    if (defaultValue) {
	 		        jQElement.val(defaultValue);
	 		    }
	 		    var sTag = el.tagName;
	 		    var sType = el.type;
	 		    if ('INPUT' == sTag || 'TEXTAREA' == sTag || 'SELECT' == sTag) {
	 		        jQElement.bind('focus', function() {
	 		            var carrier = $.extend({}, initCarrier);
	 		            refreshUserType();
	 		            carrier.tipContent = carrier.el.settings[0].onFocusTip;
	 		            carrier.validState = 'onFocus';
	 		            window.MICE.view.showMessage(carrier);
	 		        });
	 		        if (sTag == 'SELECT') {
	 		        	var tempId = jQElement.attr("id");
	 		        	if (!(tempId=="comProvince" || tempId == "comCity" || tempId == "subComCity")){
	 			            jQElement.bind('blur', function() {
	 			                $(this).trigger('change');
	 			            });
	 		        	}
	 		            jQElement.bind('keyup', function() {
	 		                $(this).trigger('change');
	 		            });
	 		            jQElement.bind('change', function() {
	 		                var carrier = window.MICE.control.elementIsValid(this);
	 		                window.MICE.view.showMessage(carrier);
	 		            });
	 		        }
	 		        else {
	 		            jQElement.bind(setting.triggerOccasion, function() {
	 		                var carrier = window.MICE.control.elementIsValid(this);
	 		                window.MICE.view.showMessage(carrier);
	 		                var carrierId = carrier.el.id;
	 		                var needForSuccess = carrierId.indexOf('userEmail') > -1 || carrierId.indexOf('memberId') > -1
	         				|| carrierId.indexOf('passwd') > -1 || carrierId.indexOf('Password') > -1
	         				|| carrierId.indexOf('userName') > -1 || carrierId.indexOf('comName') > -1
	         				|| carrierId.indexOf('keywords') > -1 || carrierId.indexOf('comTelephone') > -1;

	         				var tipName = $(carrier.el).attr('name');
	 	                	var tipView = [$('#' + tipName + '_Right')[0], $('#' + tipName + '_Tip')[0]];
	 	                	if(carrierId.indexOf('comTelephone') > -1){
	                 			tipView = [$('#comTelephone_Right')[0], $('#comTelephone_Tip')[0]];
	 	                	}
	                 		if(carrierId.indexOf('comFax') > -1){
	                 			tipView = [$('#comFax_Right')[0], $('#comFax_Tip')[0]];
	 	                	}

	 		                if (!carrier.isValid) {
	 		                    var sType = this.type;
	 		                    if (setting.autoModify && ('text' == sType || 'textarea' == sType || 'file' == sType)) {
	 		                        // TODO
	 		                        window.MICE.control.doAutoModify(carrier);
	 		                        window.MICE.view.showMessage(initCarrier);
	 		                    }
	 		                    else {
	 		                        if (setting.forceValid) {
	 		                            this.focus();
	 		                        }
	 		                    }

	 		                    if (carrierId == 'passwd' && !$('#passwd').val()){
	 		                		jQuery('#logPassword_Tip').val('').hide();
	 		                	}else if (carrierId == 'confirm_passwd' && !$('#confirm_passwd').val()){
	 		                		jQuery('#confirmPassword_Tip').val('').hide();
	 		                	}else if (carrierId.indexOf('comTelephone') > -1){
	                                 /*var $comTelTip = $('#comTelephone_Tip');
	 			                	var $comTel1 = $('#comTelephone1');
	 			                    var $comTel2 = $('#comTelephone2');
	 			                    var $comTel3 = $('#comTelephone3');
	                                 var comTel1 = $.trim($comTel1.val());
	 			                    var comTel2 = $.trim($comTel2.val());
	 			                    var comTel3 = $.trim($comTel3.val());

	 			                    var isComTel2Valid = (new RegExp(window.MICE.rule.pattern[window.isMainlandSupplier ? 'chinadistrictcode' : 'districtcode'])).test(comTel2);
	 		                    	if(comTel1 == '' && (comTel2 == '' || $comTel2.hasClass('grayColor')) && (comTel3 == '' || $comTel3.hasClass('grayColor'))){
	 		                    		$comTelTip.hide();
	 		                    	}else if (carrierId == 'comTelephone1' || carrierId == 'comTelephone3') {
	 			                        if ((comTel3 == '' || $comTel3.hasClass('grayColor')) && comTel1.length > 0 && notChinese(comTel1) && (isComTel2Valid || comTel2 == '' || $comTel2.hasClass('grayColor'))) {
	 			                        	$comTelTip.hide();
	 			                        }
	 			                    }else if(carrierId == 'comTelephone2'){
	 			                    	var isComTel1Valid = (new RegExp(window.MICE.rule.pattern['ascii'])).test(comTel1);
	 			                    	var isComTel3Valid = (new RegExp(window.MICE.rule.pattern['phonetax'])).test(comTel3) && (window.isMainlandSupplier ? comTel3.length > 4 : true);
	 			                    	if((comTel2 == '' || $comTel2.hasClass('grayColor') || isComTel2Valid) && isComTel1Valid && (isComTel3Valid || comTel3 == '' || $comTel3.hasClass('grayColor'))){
	 			                    		$comTelTip.hide();
	 			                    	}
	 			                    }  */
	 		                	}
	 		                	// hide correct tip
	 	                		if(tipView[0]){
	 	                			$(tipView[0]).addClass('hidden');
	 	                		}
	 		                }else{
	 		                	if(carrierId == 'userEmail' && $(tipView[1]).attr('class').indexOf('onPass') > -1 && typeof mistypeEmailSuggestion == 'function') {
	 		                		// do nothing
	 		                	}else{
	 		                		if(tipView[0]){
	 		                			$(tipView[0]).removeClass('hidden');
	 		                		}else if(needForSuccess){
	 		                			$(tipView[1]).html('&nbsp;').removeClass().addClass('input-right').show();
	 		                		}
	 		                	}
	 		                }
	 		            });
	 		        }
	 		    }
	 		    return true;
	 		}
	 	},
	 	view:{
	 		showTip: function(tipSelector, validState, tipContent, showClass) {
	 	        var tip = $(tipSelector);
	         	if((showClass || validState) == 'onFocus'){
	         		if(tip.hasClass('onError')){
	         			if(tip.filter(':hidden').length === 0){	// visible
	         				return;
	         			}
	         		}
	 	        }
	 	        tip.removeClass().addClass(showClass || validState).html(tipContent);
	 	        if (!tipContent) {
	 	            tip.hide();
	 	        }
	 	        else {
	 	            tip.show();
	 	        }
	 	    }
	 	},
	 	rule:{
	 		pattern: {
	             phonetax: "^[\\s\\~\\`\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\-\\+\\=\\{\\[\\}\\]\\|\\x5c\\:\\;\\x22\\'\\<\\,\\>\\.\\?\\/0-9]+$",
	             chinadistrictcode: "^\\d{0,4}$",
	             districtcode: "^\\d+$",
	             chinamobile: "^\\d{11}$",
	             complexmobile: "^\\d{11}([\\s\\~\\`\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\-\\+\\=\\{\\[\\}\\]\\|\\x5c\\:\\;\\x22\\'\\<\\,\\>\\.\\?\\/][\\s\\~\\`\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\-\\+\\=\\{\\[\\}\\]\\|\\x5c\\:\\;\\x22\\'\\<\\,\\>\\.\\?\\/0-9]{0,18})?$"
	 		}
	 	}
	 };

	 // initial settings of validation which both include buyer's and supplier's.
	 function initComplexSettings(){
	 	var tel3 = $('#comTelephone3');
	 	if(tel3[0]){
	 		var tel3buyerSettings = tel3[0].settings;
	 		tel3.data('tel3buyerSettings', tel3buyerSettings);
	 		var tel3supplierSettings = $.extend(true, [], tel3buyerSettings);
	 		tel3supplierSettings[0].onFocusTip = 'The extension number could be separated with "-", e.g. 66677777-1234.';
	 		tel3.data('tel3supplierSettings', tel3supplierSettings);
	 	}
	 }

	 function switchConfig(){
	 	var tel3 = $('#comTelephone3');
	 	if(window.isMainlandSupplier){
	 		if(tel3[0]){
	 			var tel3supplierSettings = tel3.data('tel3supplierSettings');
	 			tel3[0].settings = tel3supplierSettings;
	 		}
	 	}else{
	 		if(tel3[0]){
	 			var tel3buyerSettings = tel3.data('tel3buyerSettings');
	 			tel3[0].settings = tel3buyerSettings;
	 		}
	 	}
	 }

	 function isDirectKey(e){
	 	return e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40 && e.keyCode != 46;
	 }
	 function refreshUserType(){
	 	if($('form#command>input:hidden[name=xcase]').val() == 'completeForm'){	//step2
	 		var countryCodeForTel = $('#comTelephone1').val();
	 		var countryCodeForFax = $('#comFax1').val();
	 		var countryCodeForMobile = $('#mobileZoneCode').val();
	 		if($('#comProvince').find('option[value=Macao],option[value=Hongkong],option[value=Taiwan]').size()){	// HongKong, Macao or Taiwan
	 			window.isMainlandSupplier = false;
	 			window.isMainlandSupplierForFax = false;
	 			window.isMainlandSupplierForMobile = false;
	 		}else{	// Mainland
	 			if(countryCodeForTel == '86' || countryCodeForTel == '086'){
	 				window.isMainlandSupplier = true;
	 			}else{
	 				window.isMainlandSupplier = false;
	 			}
	 			if(countryCodeForFax == '86' || countryCodeForFax == '086'){
	 				window.isMainlandSupplierForFax = true;
	 			}else{
	 				window.isMainlandSupplierForFax = false;
	 			}
	 			if(countryCodeForMobile == '86' || countryCodeForMobile == '086'){
	 				window.isMainlandSupplierForMobile = true;
	 			}else{
	 				window.isMainlandSupplierForMobile = false;
	 			}
	 		}
	 	}else{	//step1
	 		var country = $('#comCountry').val();
	 		if(country == 'China'){
	 			var supplier = $('#comIdentity0:checked').size();
	 			if(supplier){
	 				var countryCode = $('#comTelephone1').val();
	 				if(countryCode == '86' || countryCode == '086'){
	 					window.isMainlandSupplier = true;
	 				}else{
	 					window.isMainlandSupplier = false;
	 				}
	 			}else{
	 				window.isMainlandSupplier = false;
	 			}
	 		}else{
	 			window.isMainlandSupplier = false;
	 		}
	 	}
	 	switchConfig();
	 }

	 // override checkTel
	 function checkTel() {
	     return validatePhone('comTelephone');
	 }

	 // override checkFax
	 function checkFax() {
	     return validatePhone('comFax');
	 }

	 function validatePhone(name) {
	     if (!window['formRules']) {
	         return true;
	     }

	     var _name = (name.indexOf('comFax') !== -1 ? 'comFax' : 'comTelephone'),
	         phoneRule = window['formRules'].phoneRule('en'),
	         countryCode = $('#'+ _name + '1')[0],
	         areaCode = $('#'+ _name + '2')[0],
	         telNumber = $('#'+ _name + '3')[0];

	     var bol = phoneRule.countryCode.validate(countryCode, countryCode.value, (_name === 'comTelephone'));
	     if (!bol) {
	         return phoneRule.countryCode.message;
	     }

	     if (areaCode) {
	         bol = phoneRule.areaCode.validate(areaCode, areaCode.value);
	         if (!bol) {
	             return phoneRule.areaCode.message;
	         }
	     }

	     bol = phoneRule.telNumber.validate(telNumber, telNumber.value, (_name === 'comTelephone'));
	     if (!bol) {
	         return phoneRule.telNumber.message;
	     }

	     return bol;
	 }

	 $(function(){
	 	/*$('#comTelephone2').keydown(function(e){
	 		if(window.isMainlandSupplier && this.value.length > 3 && isDirectKey(e)){
	 			return false;
	 		}
	 		return true;
	 	});
	 	$('#comFax2').keydown(function(e){
	 		if(window.isMainlandSupplierForFax && this.value.length > 3 && isDirectKey(e)){
	 			return false;
	 		}
	 		return true;
	 	});*/
	 	$('#comTelephone3, #comFax3').keydown(function(e){
	 		refreshUserType();
	 		var isFax = this.id.indexOf('comFax') > -1;
	 		var tip = $('#comTelephone_Tip');
	 		if(isFax){
	 			tip = $('#comFax_Tip');
	 		}
	 		if(this.value.length > 20 && isDirectKey(e)){
	 			if(isFax ? window.isMainlandSupplierForFax : window.isMainlandSupplier){
	 				tip.removeClass().addClass('onFocus').html('The maximum of number is 20 characters.').show();
	 			}
	 			return false;
	 		}else{
	 			tip.removeClass('onFocus').html('').hide();
	 		}
	 	});
	 });



function delayHide(){setTimeout(function(){hide("tinyNotifer")},4500)}function divCloseMessage(a){null!=document.getElementById(a)&&(-1!=navigator.appVersion.indexOf("MSIE")?setTimeout(function(){ieDivClose(a)},4500):setTimeout(function(){firefoxDivClose(a)},4500))}function ieDivClose(a){var b=document.getElementById(a);b&&(b.filters.alpha.opacity-=5,0<b.filters.alpha.opacity?setTimeout(function(){ieDivClose(a)},50):(currentPos="LayerMenu",b.className+=" collapsed",b.filters.alpha.opacity=101))}
function firefoxDivClose(a){var b=document.getElementById(a);b&&(b.style.MozOpacity-=.05,0<b.style.MozOpacity?setTimeout(function(){firefoxDivClose(a)},50):(currentPos="LayerMenu",b.className+=" collapsed",b.style.MozOpacity=101))}function now(a){document.getElementById(a).className="now"}
function show(a){null!=document.getElementById(a)&&(clearTimeout(voTimer),0<=document.getElementById(a).className.indexOf("collapsed")&&(document.getElementById(a).className=document.getElementById(a).className.replace("collapsed","expanded")))}function hide(a){null!=document.getElementById(a)&&0<=document.getElementById(a).className.indexOf("expanded")&&(document.getElementById(a).className=document.getElementById(a).className.replace("expanded","collapsed"))}var voTimer=null;
function slowHide(a){null!=document.getElementById(a)&&0<=document.getElementById(a).className.indexOf("expanded")&&(voTimer=setTimeout(function(){document.getElementById(a).className=document.getElementById(a).className.replace("expanded","collapsed")},500))}
function showHide(a){0<=document.getElementById(a).className.indexOf("expanded")?document.getElementById(a).className=document.getElementById(a).className.replace("expanded","collapsed"):document.getElementById(a).className=document.getElementById(a).className.replace("collapsed","expanded")}
function homeExp(a){0<=document.getElementById(a).className.indexOf("open")?document.getElementById(a).className=document.getElementById(a).className.replace("open","close"):document.getElementById(a).className=document.getElementById(a).className.replace("close","open")}
function showPopMenu(a){var b=document.getElementsByTagName("select");if(b&&0<b.length)for(var c=0;c<b.length;c++)0>b[c].name.indexOf("popselect")&&"select2"!=b[c].id&&(b[c].style.visibility="hidden");window.popInterval&&clearInterval(window.popInterval);window.popInterval=setInterval(function(){GetCenterXY_ForLayer(document.getElementById(a));+"\v1"||window.XMLHttpRequest||showAlpha()},50);if(b=document.getElementById(a))c=b.className,0<=c.indexOf("collapsed")&&(b.className=c.replace("collapsed",
"expanded")),showAlpha()}function hidePopMenu(a){window.popInterval&&clearInterval(window.popInterval);setTimeout(unshowAlpha,0);if(a=document.getElementById(a)){var b=a.className;0<=b.indexOf("expanded")&&(a.className=b.replace("expanded","collapsed"));if((a=document.getElementsByTagName("select"))&&0<a.length)for(b=0;b<a.length;b++)a[b].style.visibility="inherit"}}
function SelectPopMenu(a){if(a=document.getElementById(a)){var b=a.className;0<=b.indexOf("expanded")&&(a.className=b.replace("expanded","collapsed"));if((a=document.getElementsByTagName("select"))&&0<a.length)for(b=0;b<a.length;b++)a[b].style.visibility="inherit";unshowAlpha()}}
function showAlpha(){var a=document.getElementById("showdiv");if(a){a.className="Alpha";var b=document.documentElement||document.body;if(b.scrollWidth>b.clientWidth||b.scrollWidth>window.screen.availWidth)a.style.minWidth=b.scrollWidth+"px";if(b.scrollHeight>b.clientHeight||b.scrollHeight>window.screen.availHeight)a.style.height=b.scrollHeight+"px";a.style.display=""}}function unshowAlpha(){var a=document.getElementById("showdiv");a&&(a.style.display="none")}
function GetCenterXY_ForLayer(a){var b=parseInt(a.clientWidth),c=parseInt(a.clientHeight);b=parseInt((document.documentElement.scrollLeft||document.body.scrollLeft)+(document.documentElement.clientWidth-b)/2)+"px";c=parseInt((document.documentElement.scrollTop||document.body.scrollTop)+(document.documentElement.clientHeight-c)/2)+"px";a.style.top=c;a.style.left=b;window.popInterval&&window.XMLHttpRequest&&clearInterval(window.popInterval)}
function checkAndResetStyleTop(a){var b=a.clientHeight,c=parseInt(a.style.top);b+c>bodyScrollHeight&&(a.style.top=bodyScrollHeight-b+"px")}function showElement(a){null!=document.getElementById(a)&&0<=document.getElementById(a).className.indexOf("collapsed")&&(document.getElementById(a).className=document.getElementById(a).className.replace("collapsed","expanded"))}
function hideElement(a){null!=document.getElementById(a)&&0<=document.getElementById(a).className.indexOf("expanded")&&(document.getElementById(a).className=document.getElementById(a).className.replace("expanded","collapsed"))}function choose(a){for(var b=document.getElementsByTagName("input"),c=[],e=0,d=a.checked?"h":" ",f=0;f<b.length;f++)"checkbox"!=b[f].type||b[f].disabled||(c[e++]=b[f]);for(b=1;b<c.length;b++)c[b].checked=a.checked,c[b].parentNode.parentNode.className=0!=b%2?" "+d:" o "+d}
function addFavorite(){var a=location.protocol+"//www.made-in-china.com";try{-1!=navigator.userAgent.toLowerCase().indexOf("msie")?window.external.AddFavorite(a,"Made-in-China.com"):window.sidebar.addPanel("Made-in-China.com",a,"")}catch(b){alert("Sorry! Please Press [Ctrl + D].")}}
function initForm(a,b){window.addEventListener?document.getElementById(a).addEventListener("submit",function(){document.getElementById(b).disabled="disabled"},!1):window.attachEvent&&document.getElementById(a).attachEvent("onsubmit",function(){document.getElementById(b).disabled="disabled"})}function changeAd(a,b){for(var c=10*Math.random(),e=0,d=0;d<a.length;d++)e<c&&c<=a[d]+e?document.getElementById(b[d]).className="expanded":document.getElementById(b[d]).className="collapsed",e=a[d]+e}
function getShortString(a,b){a=a.replace(/(^\s*)|(\s*$)/g,"");return b>=a.length?a:a.substring(0,b-1)+"..."}function lanDivOver(){document.getElementById("lanCh").style.display="block"}function lanDivOut(){document.getElementById("lanCh").style.display="none"}var addRefererParamHandle=function(){try{for(var a=document.getElementById("lanCh").getElementsByTagName("a"),b="\x26ref\x3d"+encodeURIComponent(window.location.href),c=0;c<a.length;c++)a[c].setAttribute("href",a[c].href+b)}catch(e){}};
window.addEventListener?window.addEventListener("load",addRefererParamHandle,!1):window.attachEvent("onload",addRefererParamHandle);


function locateCountry(a,b){1>$("#"+a).size()||1>$("#"+b).size()||1!=$("#"+a).disabled&&""==$("#"+b).val()&&$.getScript("/account.do?xcase\x3dparseIPToCountryKey",function(){adjustPosition(a,countryKey)})}function adjustPosition(a,b){var d=$("#"+a).find("option[value\x3d'China']:first"),c=!1;"N/A"!=b&&$("#"+a).find("option").each(function(a){if($(this).val()==b)return $(this).attr("selected",!0),c=!0,!1});c||d.attr("selected",!0);$("#"+a).change()};

"undefined"==typeof validator&&(validator={});
validator.msg||(validator.msg={cn:{invalid_phone_number_err:"请填写有效的电话号码。",invalid_fax_number_err:"请填写有效的传真号码。",invalid_district_code_err:"请填写有效的区号。",max_district_code_err:"区号最多填写4个字符。",must_company_phone_number_err:"请填写公司电话号码。",max_company_phone_number_err:"公司电话号码最多40个数字。",max_company_fax_number_err:"公司传真最多40个数字。"},en:{invalid_phone_number_err:"Please enter your valid telephone number.",invalid_fax_number_err:"Please enter your valid fax number.",invalid_district_code_err:"Please enter numbers only.",max_district_code_err:"The maximum of area code is 4 characters.",
must_company_phone_number_err:"Please enter your valid telephone number.",max_company_phone_number_err:"Your telephone number is too long.",max_company_fax_number_err:"Your fax number is too long."}});
function checkCountryAndDistrictCode(a,b,c){if("tel"==c&&window.isMainlandSupplier||"fax"==c&&window.isMainlandSupplierForFax||"mob"==c&&window.isMainlandSupplierForMobile)if(a=$.trim(a),b=$.trim(b),("86"==a||"086"==a)&&"Area Code"!=b&&4<b.length)return window.isChinesePage?validator.msg.cn.max_district_code_err:validator.msg.en.max_district_code_err}function isDirectKey(a){return 8!=a.keyCode&&9!=a.keyCode&&37!=a.keyCode&&38!=a.keyCode&&39!=a.keyCode&&40!=a.keyCode&&46!=a.keyCode};



function isTime(a){a=a.match(/^(\d{1,2})(:)?(\d{1,2})\2(\d{1,2})$/);return null==a||24<a[1]||60<a[3]||60<a[4]?!1:!0}function isDate(a){a=a.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);if(null==a)return!1;var b=new Date(a[1],a[3]-1,a[4]);return b.getFullYear()==a[1]&&b.getMonth()+1==a[3]&&b.getDate()==a[4]}
function isDateTime(a){a=a.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/);if(null==a)return!1;var b=new Date(a[1],a[3]-1,a[4],a[5],a[6],a[7]);return b.getFullYear()==a[1]&&b.getMonth()+1==a[3]&&b.getDate()==a[4]&&b.getHours()==a[5]&&b.getMinutes()==a[6]&&b.getSeconds()==a[7]}
function checkkeyWord(a){a=!0;for(var b=/[^\x00-\xff]/g,c="",d=jQuery.makeArray($(".full,.key,.tiny")),e=0;e<d.length;e++)if(0!=$.trim(d[e].value).length&&b.test(d[e].value)){a=!1;c=errorMsg1;break}if(!a)return c;for(e=b=0;e<d.length;e++)0==$.trim(d[e].value).length&&b++;b==d.length&&(a=!1,c=errorMsg3);return a?a:c}function notChinese(a){return/[^\x00-\xff]/g.test(a)?!1:!0}
var entityMap={"‰":"\x26permil;","−":"\x26minus;","×":"\x26times;","÷":"\x26divide;","¡":"\x26iexcl;","¤":"\x26curren;","§":"\x26sect;","©":"\x26copy;","ª":"\x26ordf;","«":"\x26laquo;","®":"\x26reg;","°":"\x26deg;","±":"\x26plusmn;","µ":"\x26micro;","¶":"\x26para;","»":"\x26raquo;","¿":"\x26iquest;","Ç":"\x26Ccedil;","Ø":"\x26Oslash;","Þ":"\x26THORN;","ß":"\x26szlig;","æ":"\x26aelig;","ð":"\x26eth;","ø":"\x26oslash;","Œ":"\x26OElig;","œ":"\x26oelig;","ƒ":"\x26fnof;","α":"\x26alpha;","β":"\x26beta;",
"γ":"\x26gamma;","δ":"\x26delta;","φ":"\x26phi;","ψ":"\x26psi;","ω":"\x26omega;","κ":"\x26kappa;","ˆ":"\x26circ;","‹":"\x26lsaquo;","›":"\x26rsaquo;","Δ":"\x26Delta;","¬":"\x26not;","Γ":"\x26Gamma;","ι":"\x26iota;","≈":"\x26asymp;","≠":"\x26ne;","≡":"\x26equiv;","≤":"\x26le;","≥":"\x26ge;","⊕":"\x26oplus;","⊥":"\x26perp;","¹":"\x26sup1;","²":"\x26sup2;","³":"\x26sup3;","€":"\x26euro;","™":"\x26trade;","∑":"\x26sum;","√":"\x26radic;","∝":"\x26prop;","∞":"\x26infin;","∧":"\x26and;","∨":"\x26or;","∩":"\x26cup;",
"∪":"\x26cup;","∫":"\x26int;","∴":"\x26there4;"};function replaceEntities(a){for(var b=[],c,d=0;d<a.length;d++)c=a.charAt(d),entityMap[c]?b.push(entityMap[c]):b.push(c);return b.join("")}
var cnen=[["!","��"],["@","��"],["$","��"],["^","����"],["\x26","��"],["(","��"],[")","��"],["_","����"],[":","��"],[";","��"],['"',"��"],['"',"��"],["'","��"],["|","|"],["\\","��"],["\x3c","��"],[",","��"],["\x3e","��"],[".","��"],["?","��"],["�^"," "]],cnenCode={65281:33,183:64,65509:36,8230:94,8212:38,65288:40,65289:41,8212:95,65306:58,65307:59,8220:34,8221:34,8216:39,124:124,12289:92,12298:60,65292:44,12299:62,12290:46,65311:63,8217:39,12304:91,12305:93,58596:32,160:32};
function replaceCn(a){for(var b="",c,d=0;d<a.length;d++)c=a.charCodeAt(d),12288==c?c=String.fromCharCode(c-12256):(65280<c&&65375>c&&(c-=65248),c=cnenCode[c]?String.fromCharCode(cnenCode[c]):String.fromCharCode(c)),b+=c;return replaceEntities(b)}function cnToEn(a){var b=a.value?a.value:a;b=replaceCn(b);b=b.replace(/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]|[\u300e-\u300f]|[\u3016-\u3017]|<textarea>|<\/textarea>|<textarea\/>/gi,"");a.value!=b&&(a.value=b)}
function cnToEn4T(a){a=replaceCn(a);return a=a.replace(/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/gi,"")}var errorTel1="Please enter your valid telephone number.",errorTel2="Your telephone number is too long",errorMsg1="Please enter product keyword(s) in English only.",errorMsg3="Please enter main product keyword(s).",errorFax1="Your fax number is too long.";function checkComDesc(){var a=document.getElementById("comdescid").value;if(checkChinese(a))return!0;open_window(a);return!1}
function initSet(a,b){jQuery("#"+a).blur(function(){var a=$(this),c=a.val();0!=c.length&&c!=b||a.val(b).addClass("grayColor").removeClass("blackColor")}).focus(function(){var a=$(this);a.hasClass("grayColor")&&a.val("").addClass("blackColor").removeClass("grayColor")});var c=jQuery("#"+a).val();0!=c.length&&c!=b||jQuery("#"+a).val(b).addClass("grayColor").removeClass("blackColor")}function storeCur(a){a.createTextRange&&(a.caretPos=document.selection.createRange().duplicate())}
function doAddSpecialChar(a){1==$("#textareaType").size()&&$("#textareaType").val(a.id);$("#pop").load("/script/specharen.html",function(){showPopMenu("pop")})}
function checkTel(){var a=$("#comTelephone1"),b=$("#comTelephone2"),c=$("#comTelephone3");a=$.trim(a.val());b=$.trim(b.val());var d=$.trim(c.val());return("86"===a||"086"===a)&&"Area Code"!=b&&4<b.length?"The maximum of number is 4 characters.":0==a.length||0==d.length||-1!=c.attr("class").indexOf("grayColor")?errorTel1:a&&!(new RegExp(window.MICE.rule.pattern.districtcode)).test(a)?"Please enter a valid telephone number.":b&&"Area Code"!=b&&!(new RegExp(window.MICE.rule.pattern.districtcode)).test(b)?
"Please enter numbers only.":(new RegExp(window.MICE.rule.pattern.phonetax)).test(d)?"Number"==d||window.isMainlandSupplier&&5>d.length?"Please enter a valid telephone number.":40<a.length+b.length+d.length?errorTel2:!0:errorTel1}
function checkFax(){var a=$("#comFax1"),b=$("#comFax2"),c=$("#comFax3");a=$.trim(a.val());b=$.trim(b.val());c=$.trim(c.val());return"86"===a&&"Area Code"!=b&&4<b.length?"The maximum of area code is 4 characters.":a&&!(new RegExp(window.MICE.rule.pattern.ascii)).test(a)?"Please enter a valid fax number.":b&&"Area Code"!=b&&!(new RegExp(window.MICE.rule.pattern.districtcode)).test(b)?"Please enter numbers only.":c&&"Number"!=c&&(window.isMainlandSupplierForFax&&5>c.length||!(new RegExp(window.MICE.rule.pattern.phonetax)).test(c))?
"Please enter a valid fax number.":40<a.length+b.length+c.length?"Your fax number is too long.":!0}
function checkMobile(){var a=$("#mobileZoneCode");a=$.trim(a.val());var b=$("#userMobile");b=$.trim(b.val());if(a){if(!(new RegExp(window.MICE.rule.pattern.asciicode)).test(a))return"Please enter your mobile phone in number only.";if(b&&"Number"!=b)if(window.isMainlandSupplierForMobile){if(!(new RegExp(window.MICE.rule.pattern.complexmobile)).test(b))return"Please enter a valid mobile number."}else if(!(new RegExp(window.MICE.rule.pattern.phonetax)).test(b))return"Please enter a valid mobile number."}else if(b&&"Number"!=
b&&!(new RegExp(window.MICE.rule.pattern.phonetax)).test(b))return"Please enter a valid mobile number.";return!0}function checkProvince(){return 0==document.getElementById("comCity").selectedIndex||0==document.getElementById("comProvince").selectedIndex?"Please select your province/city.":!0}
function handleQuestionChange(){$("#securityQuestion").change(function(){var a=$(this).val();setTimeout(function(){switch(a){case "0":$("#tr_ques").hide();$("#tr_answer").hide();$("#tr_security_ques").addClass("borderWhite");$("#customeQuestion,#answer").val("").each(function(){this.settings&&(this.settings[0].bind=!1)});break;case "5":$("#tr_ques").show();$("#tr_answer").show();$("#tr_security_ques").removeClass("borderWhite");$("#customeQuestion,#answer").each(function(){this.settings&&(this.settings[0].bind=
!0)});$("#securityQuestion_Tip,#customeQuestion_Tip,#answer_Tip").text("").removeClass().hide();break;default:$("#tr_ques").hide(),$("#tr_answer").show(),$("#tr_security_ques").removeClass("borderWhite"),$("#answer").each(function(){this.settings&&(this.settings[0].bind=!0)}),$("#customeQuestion").val("").each(function(){this.settings&&(this.settings[0].bind=!1)}),$("#securityQuestion_Tip,#answer_Tip").text("").removeClass().hide()}},50)});0<$.trim($("#customeQuestion").val()).length&&$("#tr_ques").show();
0<$.trim($("#answer").val()).length&&$("#tr_answer").show();setTimeout(function(){$("#securityQuestion").change()},50)}function getTelCode(a){$.get("/quickoffer.do",{xcase:"telCode",comCountry:a},function(a){$("#comTelephone1").val(a)})}
function telphoneNote(){var a=$("#comTelephone2"),b=$("#comTelephone3");a.blur(function(){var a=$.trim($(this).val());0!=a.length&&"Area Code"!=a||$(this).val("Area Code").addClass("grayColor")}).focus(function(){var a=$(this);a.hasClass("grayColor")&&a.val("").removeClass("grayColor")});b.blur(function(){var a=$.trim($(this).val());0!=a.length&&"Number"!=a||$(this).val("Number").addClass("grayColor")}).focus(function(){var a=$(this);a.hasClass("grayColor")&&a.val("").removeClass("grayColor")});0!=
$.trim(a.val()).length&&"Area Code"!=a.val()||a.val("Area Code").addClass("grayColor");0!=$.trim(b.val()).length&&"Number"!=b.val()||b.val("Number").addClass("grayColor")}
function mobileNote(){var a=$("#userMobile");a.blur(function(){var a=$.trim($(this).val());0!=a.length&&"Number"!=a||$(this).val("Number").addClass("grayColor")}).focus(function(){var a=$(this);"grayColor"==a.attr("class")&&a.val("").removeClass("grayColor")});0!=$.trim(a.val()).length&&"Number"!=a.val()||a.val("Number").addClass("grayColor")}
function faxNote(){var a=$("#comFax2"),b=$("#comFax3");a.blur(function(){var a=$.trim($(this).val());0!=a.length&&"Area Code"!=a||$(this).val("Area Code").addClass("grayColor")}).focus(function(){var a=$(this);"grayColor"==a.attr("class")&&a.val("").removeClass("grayColor")});b.blur(function(){var a=$.trim($(this).val());0!=a.length&&"Number"!=a||$(this).val("Number").addClass("grayColor")}).focus(function(){var a=$(this);"grayColor"==a.attr("class")&&a.val("").removeClass("grayColor")});0!=$.trim(a.val()).length&&
"Area Code"!=a.val()||a.val("Area Code").addClass("grayColor");0!=$.trim(b.val()).length&&"Number"!=b.val()||b.val("Number").addClass("grayColor")}function sameCheck1(){var a="5"==jQuery("#securityQuestion option:selected").val()?jQuery.trim(jQuery("#customeQuestion").val()).toLowerCase():jQuery.trim(jQuery("#securityQuestion option:selected").text());var b=jQuery.trim(jQuery("#answer").val()).toLowerCase();return a==b?"Do not use your password question as answer.":!0}
function sameCheck2(){return jQuery.trim(jQuery("#logPassword").val().toLowerCase())==jQuery.trim(jQuery("#customeQuestion").val().toLowerCase())?"Do not use your password as security question.":!0}
function removeTipMessage(){jQuery(":input:not(:checkbox)").blur(function(){var a=this;setTimeout(function(){0==jQuery.trim(a.value).length&&jQuery("#"+a.id+"_Tip,#"+a.id+"Tip").val("").hide();if("key"==a.className){var b=!0,c="";jQuery(".key").each(function(a,e){var d=$.trim($(e).val());if(0!=d.length)return c+=d,b=!1});c&&!notChinese(c)&&(b=!1);b&&jQuery("#keywords_Tip, #keyWordTip").hide()}},1)})}
function handleAlert(){$("#comCountry").change(function(){var a=$.trim($(this).val());"China"==a||"Hongkong_China"==a||"Macao_China"==a||"Taiwan_China"==a?$("#alertbox").hide():$("#alertbox").show()});0==$.trim($("#userEmail").val()).length&&$("#subscribeAlert1").attr("checked",!0);setTimeout(function(){$("#comCountry").change()},50)};


var autoComplete=function(){function t(){if(!b.input||"text"!=b.input.type)throw Error("Please set correct input element");if(!b.tipCls)throw Error("Please set correct tipCls");if(!b.type||!b.datas[b.type])throw Error("Create mail list errror");b.disHisTip&&u(b.input);h=this;c=document.createElement("ul");c.className=b.tipCls;c.style.cssText="display:none";c.innerHTML=p(b.datas[b.type]);$(c).insertAfter($(b.input));$(b.input).bind("keyup",q);$(b.input).bind("focus",q);$(c).bind("mouseover",v);$(c).bind("mouseout",
w);$(c).bind("click",function(){r.call(b.input,d[0].innerHTML)})}function v(a){"li"===a.target.nodeName.toLowerCase()&&($(a.target).addClass("hover"),d=$(a.target))}function w(a){d&&d.removeClass("hover")}function k(a){a.stopPropagation();a.target!==b.input&&(c.style.display="none",$(document).unbind("click",k))}function q(a){f=this.value;c.style.display="none";if(-1!==f.indexOf("@")&&0!==f.indexOf("@")&&13!==a.keyCode&&""!==$.trim(f)){if(l!=f){RegExp("(.*?)@(.*)$","gi").test(f);a=RegExp.$2;if(""===
$.trim(a))a=b.datas[b.type];else{var e=[],g,m;for(m=0;g=b.datas[b.type][m];m++)-1!=g.indexOf(a)&&0===g.indexOf(a)&&a!==g&&e.push(g);a=e}c.innerHTML=p(a,RegExp.$1);d=null}c.getElementsByTagName("li").length&&(c.style.display="");l=f;$(document).bind("click",k);$(document).unbind("keydown",n).bind("keydown",n)}}function r(a){""!==a&&(this.value=a);c.style.display="none";$(document).unbind("keydown",n);$(document).unbind("click",k);h.onSelected&&h.onSelected()}function n(a){13===a.keyCode&&(d&&d[0]&&
r.call(b.input,d[0].innerHTML),a.preventDefault());d?d.removeClass("hover"):e=-1;38===a.keyCode&&(0===e?e=$(c).find("li").length-1:e--,a.preventDefault());40===a.keyCode&&(e===$(c).find("li").length-1?e=0:e++,a.preventDefault());d=$(c).find("li:eq("+e+")");d.addClass("hover")}function p(a,b){var c,d;var e="";for(d=0;c=a[d];d++)e+="\x3cli\x3e"+b+"@"+c+"\x3c/li\x3e";return e}function u(a){a.setAttribute("AutoComplete","off");a.getAttribute("style")?a.style.cssText+=" ime-mode:disabled":a.style.cssText=
"ime-mode:disabled"}function x(a){b.datas[a]&&(b.type=a,l="")}var b={input:null,tipCls:"",hoverCls:"",type:"login",datas:{suppler:"gmail.com hotmail.com 163.com 126.com qq.com yahoo.com sina.com live.cn".split(" "),buyer:"gmail.com hotmail.com hotmail.co.uk yahoo.com yahoo.co.uk aol.com mail.ru rediffmail.com live.com msn.com".split(" "),login:"gmail.com hotmail.com yahoo.com msn.com live.com 163.com sina.com sohu.com 126.com".split(" ")},disHisTip:!0},c,d,l,e=0,f,h;return function(a){$.extend(b,
a);this.changeType=x;this.onSelected=null;t.call(this)}}();