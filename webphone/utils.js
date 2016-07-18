function getWebAppVersion() {
    return '1.1.13';
}

function __linphone_init(a) {
    var b = "1.0.14",
        c = b.replace(/\./g, ","),
        d = !1,
        e = {
            files: {
                Windows: {
                    x86: {
                        Explorer: {
                            file: "http://web.linphone.org/downloads/linphone-web-" + b + "-Win32.cab",
                            version: c
                        },
                        DEFAULT: "http://web.linphone.org/downloads/linphone-web-" + b + "-Win32.msi"
                    },
                    x86_64: {
                        Explorer: {
                            file: "http://web.linphone.org/downloads/linphone-web-" + b + "-Win32.cab",
                            version: c
                        },
                        DEFAULT: "http://web.linphone.org/downloads/linphone-web-" + b + "-Win32.msi"
                    }
                },
                Linux: {
                    x86: {
                        Firefox: {
                            file: "http://web.linphone.org/downloads/linphone-web-" + b + "-Linux-x86.xpi",
                            icon: "http://web.linphone.org/style/img/linphone.ico"
                        },
                        DEFAULT: "http://web.linphone.org/downloads/linphone-web-" + b + "-Linux-x86.tar.gz"
                    },
                    x86_64: {
                        Firefox: {
                            file: "http://web.linphone.org/downloads/linphone-web-" + b + "-Linux-x86_64.xpi",
                            icon: "http://web.linphone.org/style/img/linphone.ico"
                        },
                        DEFAULT: "http://web.linphone.org/downloads/linphone-web-" + b + "-Linux-x86_64.tar.gz"
                    }
                },
                Mac: {
                    x86: {
                        Firefox: {
                            file: "http://web.linphone.org/downloads/linphone-web-" + b + "-Mac-x86_64.xpi",
                            icon: "http://web.linphone.org/style/img/linphone.ico"
                        },
                        DEFAULT: "http://web.linphone.org/downloads/linphone-web-" + b + "-Mac-x86_64.pkg"
                    },
                    x86_64: {
                        Firefox: {
                            file: "http://web.linphone.org/downloads/linphone-web-" + b + "-Mac-x86_64.xpi",
                            icon: "http://web.linphone.org/style/img/linphone.ico"
                        },
                        DEFAULT: "http://web.linphone.org/downloads/linphone-web-" + b + "-Mac-x86_64.pkg"
                    }
                }
            },
            name: "Linphone Web",
            version: b,
            webapp_version: getWebAppVersion(),
            mimetype: "x-linphone-web",
            copyright: "Copyright© Belledonne Communications 2013. All rights reserved.",
            linphone_account: {
                cls: "createAccount",
                link: "https://www.linphone.org/eng/linphone/register-a-linphone-account.html"
            },
            links: [{
                cls: "support",
                text: "support",
                link: "https://www.linphone.org/eng/linphone/support.html"
            }, {
                cls: "sales",
                text: "sales",
                link: "http://www.belledonne-communications.com/contact.html"
            }, {
                cls: "license ",
                text: "license",
                link: "http://www.gnu.org/licenses/agpl-3.0.html"
            }],
            appLinks: {
                windows_phone: {
                    cls: "windows_phone",
                    text: "windows_phone",
                    appLink: "http://www.windowsphone.com/fr-FR/store/app/linphone/99661466-8c5c-489b-a567-569c1f480d29"
                },
                iOS: {
                    cls: "iOS",
                    text: "iOS",
                    appLink: "https://itunes.apple.com/app/linphone/id360065638?mt=8"
                },
                android: {
                    cls: "android",
                    text: "android",
                    appLink: "https://play.google.com/store/apps/details?id=org.linphone"
                }
            },
            locales: [{
                name: "US",
                title: "English",
                locale: "en_US"
            }, {
                name: "FR",
                title: "Français",
                locale: "fr_FR"
            }],
            models: {
                contacts: new linphone.models.contacts.core.engine(a, d),
                history: new linphone.models.history.core.engine(a, d)
            },
            checkOutdated: !0,
            disableChat: !1,
            disableChatFileTransfert: !1,
            disableConference: !0,
            disablePresence: !1
        };
    e.debug = d, e.logs = d, ("1" === jQuery.getUrlVar("lpdebug") || "true" === jQuery.getUrlVar("lpdebug") || "yes" === jQuery.getUrlVar("lpdebug")) && (e.logs = !0), "undefined" != typeof jQuery.getUrlVar("mimetype") && (e.mimetype = jQuery.getUrlVar("mimetype"), e.checkOutdated = !1), linphone.ui.init(a, e), linphone.ui.core.load(a)
}! function(a, b, c) {
    function d() {
        function a(a, b) {
            var c = document.createElement("script");
            c.src = a, c.type = "text/javascript";
            var d = document.getElementsByTagName("head")[0],
                e = !1;
            c.onload = c.onreadystatechange = function() {
                e || this.readyState && "loaded" != this.readyState && "complete" != this.readyState || (e = !0, b(), c.onload = c.onreadystatechange = null, d.removeChild(c))
            }, d.appendChild(c)
        }

        function b(c) {
            if (e.length > 0) {
                var d = e[0];
                e.shift(), a(d.url, function() {
                    b(c)
                })
            } else c()
        }
        b(function() {
            jQuery(".linphoneweb").each(function(a) {
                var b = linphone.ui.getBase(jQuery(this));
                __linphone_init(b)
            })
        })
    }
    var e = [{
        url: "http://web.linphone.org/js/jquery-1.10.1.min.js"
    }, {
        url: "http://web.linphone.org/js/jquery.client.min.js"
    }, {
        url: "http://web.linphone.org/js/analytics.min.js"
    }, {
        url: "http://web.linphone.org/js/i18n.min.js"
    }, {
        url: "http://web.linphone.org/js/persistent.min.js"
    }, {
        url: "http://web.linphone.org/js/jsonsql-0.1.min.js"
    }, {
        url: "http://web.linphone.org/js/jquery-ui-1.10.3.min.js"
    }, {
        url: "http://web.linphone.org/js/jquery.mousewheel.min.js"
    }, {
        url: "http://web.linphone.org/js/vertical.slider.min.js"
    }, {
        url: "http://web.linphone.org/js/jquery.geturlvars.min.js"
    }, {
        url: "http://web.linphone.org/js/jquery.watermark.min.js"
    }, {
        url: "http://web.linphone.org/js/handlebars.runtime.min.js"
    }, {
        url: "http://web.linphone.org/js/sha1.min.js"
    }, {
        url: "http://web.linphone.org/js/linphone-1.1.13.min.js"
    }];
    a.addEventListener ? a.addEventListener("load", d, !1) : a.attachEvent && a.attachEvent("onload", d)
}(window, document, "script");
			
/* Method to create callbacks */
function addEvent(obj, name, func){
	var browser = searchString(getDataBrowser());
    if (browser !== 'Explorer') {
        obj.addEventListener(name, func, false); 
    } else {
        obj.attachEvent('on' + name, func);
    }
}

/* Function that display some text in a html element*/
function updateStatus(id,value){
	document.getElementById(id).innerHTML= value;
}

/* Method to set the link for downloaded the correct version of the plugin */
function setPluginLink(config,det){
	config.file = {};
	
	if (typeof config.files[det.os] !== 'undefined') {
		if (typeof config.files[det.os][det.arch][det.browser] !== 'undefined') {
			config.file.description = config.files[det.os][det.browser];
			config.file.browser = det.browser;
		} else {
			config.file.description = config.files[det.os][det.arch].DEFAULT;
			config.file.browser = 'DEFAULT';
		}
	}
}

function getDataBrowser(){
	var dataBrowser = [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	];
	return dataBrowser;
}

function getDataOS(){
	var dataOS = [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			string: navigator.userAgent,
			subString: "iPhone",
			identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	];
	return dataOS;
}

function browserDetect() {
	var dataBrowser = getDataBrowser();
	var dataOS = getDataOS();
	var object = {
		browser : null,
		version : null ,
		os : null,
		arch : null
	};

	object.browser = searchString(dataBrowser) || "An unknown browser";
	object.version = searchVersion(navigator.userAgent)
		|| searchVersion(navigator.appVersion)
		|| "an unknown version";
	object.os = searchString(dataOS) || "an unknown OS";
	object.arch = searchArch();
	
	return object;
}

function searchString(data) {
	for (var i=0;i<data.length;i++)	{
		var dataString = data[i].string;
		var dataProp = data[i].prop;
		this.versionSearchString = data[i].versionSearch || data[i].identity;
		if (dataString) {
			if (dataString.indexOf(data[i].subString) != -1)
				return data[i].identity;
		}
		else if (dataProp)
			return data[i].identity;
	}
}

function searchArch() {
	var lcua = navigator.userAgent.toLowerCase();
	if(lcua.indexOf("linux x86_64") != -1 || lcua.indexOf("win64") != -1) {
		return "x86_64";
	} else {
		return "x86";
	}
}

function searchVersion(dataString) {
	var index = dataString.indexOf(this.versionSearchString);
	if (index == -1) return;
	return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
}

function isValid(core){
	return typeof core !== 'undefined' && typeof core.valid !== 'undefined' && core.valid;
}

function outdated(actual, plugin) {
	var version1 = actual.split('.');
	var version2 = plugin.split('.');
	for(var i = 0; i < version1.length && i < version2.length; ++i) {
		if(i >= version1.length) {
			return false;
		}
		if(i >= version2.length) {
			return true;
		}
		var number1 = parseInt(version1[i], 10);
		var number2 = parseInt(version2[i], 10);
		if(number2 < number1) {
			return true;
		} else if(number2 > number1) {
			return false;
		}
	}
	return false;
}

function detect(config,core) {
	if (isValid(core)) {
		if(!outdated(config.version, core.pluginVersion)) {
			return 1;
		} else {
			// Browser update
			if (config.file.browser === 'Firefox') {
				if (InstallTrigger.updateEnabled()) {
					InstallTrigger.install({
						'Linphone-Web': {
							URL: config.file.description.file,
							IconURL: config.file.description.icon
						}
					});
				}
			}
			return 0;
		}
	} else {
		if(typeof config.file.description !== 'undefined'){		
			// Browser installation
			if (config.file.browser === 'Firefox') {
				if (InstallTrigger.updateEnabled()) {
					InstallTrigger.install({
					'Linphone-Web': {
							URL: config.file.description.file,
						IconURL: config.file.description.icon
						}
					});
				}
			}
		}
		return 0;
	}
}