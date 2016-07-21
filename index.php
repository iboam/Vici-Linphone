<html>
<head>    
<style>
input.register {
	font-family: Arial, Sans-Serif;
	font-size: 18px;
	color: #FFFFFF;
	font-weight: bold;
	background-color: #009900;
	border: 2px solid;
	border-top-color: #CCFFCC;
	border-left-color: #CCFFCC;
	border-right-color: #003300;
	border-bottom-color: #003300;
	border-radius: 10px;
	height: 36px;
}
</style>
<?php
function get_text($filename) {

    $fp_load = fopen("$filename", "rb");

    if ( $fp_load ) {

            while ( !feof($fp_load) ) {
                $content .= fgets($fp_load, 8192);
            }

            fclose($fp_load);

            return $content;

    }
}


$matches = array();

preg_match_all("/(a href\=\")([^\?\"]*)(\")/i", get_text('http://web.linphone.org/downloads'), $matches);
?>
<script type="text/javascript">
/* config of the plugin with the links for downloads and the version of the plugin */
function getConfig(){  
	var version = '<?php echo substr($matches[2][2], 13,6); ?>';
	var config = {
		version : version,
		files: {
			'Windows' : {
				'x86' : {
					'Explorer' : {
						file: 'http://web.linphone.org/downloads/linphone-web-' + version + '-Linux-x86.xpi',
						icon: 'style/img/linphone.ico'
					},
					'DEFAULT' : 'http://web.linphone.org/downloads/linphone-web-' + version + '-Win32.msi'
				},
				'x86_64' : {
					'Explorer' : {
						file: 'http://web.linphone.org/downloads/linphone-web-' + version + '-Linux-x86.xpi',
						icon: 'style/img/linphone.ico'
					},
					'DEFAULT' : 'http://web.linphone.org/downloads/linphone-web-' + version + '-Win32.msi'
				}
			},
			'Linux' : {
				'x86' : {
					'Firefox' : {
						file: 'http://web.linphone.org/downloads/linphone-web-' + version + '-Linux-x86.xpi',
						icon: 'style/img/linphone.ico'
					},
					'DEFAULT' : 'http://web.linphone.org/downloads/linphone-web-' + version + '-Linux-x86.tar.gz'
				}, 
				'x86_64' : {
					'Firefox' : {
						file: 'http://web.linphone.org/downloads/linphone-web-' + version + '-Linux-x86_64.xpi',
						icon: 'style/img/linphone.ico'
					},
					'DEFAULT' : 'http://web.linphone.org/downloads/linphone-web-' + version + '-Linux-x86_64.tar.gz'
				}
			},
			'Mac' : {
				'x86' : {
					'Firefox' : {
						file: 'http://web.linphone.org/downloads/linphone-web-' + version + '-Mac-x86.xpi',
						icon: 'style/img/linphone.ico'
					},
					'DEFAULT' : 'http://web.linphone.org/downloads/linphone-web-' + version + '-Mac-x86.pkg'
				}, 
				'x86_64' : {
					'Firefox' : {
						file: 'http://web.linphone.org/downloads/linphone-web-' + version + '-Mac-x86.xpi',
						icon: 'style/img/linphone.ico'
					},
					'DEFAULT' : 'http://web.linphone.org/downloads/linphone-web-' + version + '-Mac-x86.pkg'
				}
			}
		}
	};
	return config;
}


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
</script>
<script type="text/JavaScript">

	/* return the core object */
	function getCore(){
		return document.getElementById('core');
	}
	
	// Remove the core object
	function unload(){
		var core = getCore();
		delete core;
	}
	
	// Reload the test
	function reload(){
		unload();
		window.location.reload();
	}
	
	/* Main function */
	function load(){
		var config = getConfig();
		var browserDetection;
		var core;
		
		navigator.plugins.refresh(false);
		
		/* Detection of the system information : OS/Architecture/Browser */
		browserDetection = browserDetect();
		updateStatus('browser',"OS : " + browserDetection.os + " / Browser : " + browserDetection.browser );
		// Find the correct plugin file
		setPluginLink(config,browserDetection);
		core = getCore();

		// Detection of the plugin
		var ret = detect(config,core);
		if(ret === 0){ // The plugin is not installed or outdated
			updateStatus('plugin',"Plugin : Not installed or outdated");
			// Donwload the plugin
			window.open(config.file.description, '_self');	
		} else { // The plugin is installed
			updateStatus('plugin',"Plugin : Installed");
			loadCore();
		}
	}
	
	function loadCore(){
		var core = getCore();
		/* init the linphoneCore object */
		core.init();
		
		/* Display logs information in the console */
		core.logHandler = function(level, message) {
			window.console.log(message);
		}
		/* Start main loop for receiving notifications and doing background linphonecore work */
		core.iterateEnabled = true;
	}
</script>
<script type="text/JavaScript">

	/* return the core object */
	function getCore(){
		return document.getElementById('core');
	}
	
	/* Registration */
	function registration(username,password,server){
		var core = getCore();
		
		/*create proxy config*/        	
		var proxy = core.newProxyConfig();
		
		/*create authentication structure from identity*/
		var authinfo = core.newAuthInfo(username, null,password,null,null);
		/*add authentication info to LinphoneCore*/
		core.addAuthInfo(authinfo);
		
		/*configure proxy entries*/
		proxy.identity = 'sip:' + username + '@' + server; /*set identity with user name and domain*/
		proxy.serverAddr = 'sip:' + server; /* we assume domain = proxy server address*/
		proxy.registerEnabled = true; /*activate registration for this proxy config*/
		core.addProxyConfig(proxy); /*add proxy config to linphone core*/
		core.defaultProxy = proxy; /*set to default proxy*/
	}
	
	/* Basic call */
	function call(addressStr){
		var core = getCore();
		
		/*Create a new address with the paramaters*/
		var address = core.newAddress(addressStr);
		if(address !== null) {
			/* Start the call with the contact address*/
			core.inviteAddress(address);
			console.log("Call: " + address.asString());
		}
	}
		
	function loadCore(){
		var core = getCore();
		core.init();
			
		/* Add callback for registration and call state */
		addEvent(core,"callStateChanged",onCallStateChanged);
		addEvent(core,"registrationStateChanged",onRegistrationStateChanged);
		   
		/* Display logs information in the console */
		core.logHandler = function(level, message) {
			window.console.log(message);
		}
		
		/* Start main loop for receiving notifications and doing background linphonecore work */
		core.iterateEnabled = true;
	}
		
	/* Callback that display call states */
	function onCallStateChanged(event, call, state, message){
		updateStatus('statusC',message);
		console.log(message);
	}
	function onRegistrationStateChanged(event, proxy, state, message){
		updateStatus('statusR',message);
		console.log(message);
	}
	

	function onRegistration(form1){
		registration(document.form1.username.value,document.form1.password.value,document.form1.address1.value);
	}
/************ Auto Register Webphone ************/
	function runWhenFormLoad (){
		var intervalo = setInterval(function(){
			if(typeof(document.form1) !== "undefined"){
				clearInterval(intervalo);
				onRegistration();	
			}
		}, 1000 );	
	}
	window.onload = runWhenFormLoad();

	var CallStatusIdle = 0;
	var CallStatusIncomingReceived = 1;
	var CallStatusConnected = 6;
	var CallStatusStreamsRunning = 7;
	var CallStatusError = 12;
	var CallStatusEnd = 13;
	var LinphoneCallIncomingReceived = 0;
	
	var currentCall;
	var currentCallStatus = CallStatusIdle;

	function onCallStateChanged(event, call, state, message)
	{
		try {
	
			// Keep a reference for later use:
			currentCall = call;
			currentCallStatus = state;
	
			// Log new call state:
			window.console.log('Call state changed : ' + state);
	
			if ( CallStatusIncomingReceived === state ) 
			{           
				updateStatus('status', message, "#840121", '#FFFFFF');                       
			}               
			else if ( CallStatusConnected === state )
			{
				updateStatus('status', message, "#840121", '#FFFFFF');
			}       
			else if( CallStatusStreamsRunning === state )
			{       
				updateStatus('status', message, "#840121", '#FFFFFF');                          
			}
			else if( CallStatusEnd === state )
			{   
				updateStatus('status', message, "#840121", '#FFFFFF');      
			}
			else if( CallStatusError === state ) 
			{
				updateStatus('status', message, "#840121", '#FFFFFF');
			}                       
	
		} 
		catch (err)
		{
			var msg = "There was an error during call status change : " + err.message;
			console.log ( msg );
			updateStatus ( 'status', msg, "#840121", '#FFFFFF');
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Name : answerCall
	// Desc : User clicked button to answer call.
	//-------------------------------------------------------------------------------------------------------
	function answerCall() 
	{
		try {
	
			core.acceptCall ( currentCall) ;
			updateStatus ( 'status', msg, "#840121", '#FFFFFF');
		} 
		catch (err) 
		{
			var msg = "There was an error while answering call : " + err.message;
			console.log ( msg );
			updateStatus ( 'status', msg, "#840121", '#FFFFFF');                
		}
	}	
</script>
</head>
<body onLoad="load()">
<object id="core" type="application/x-linphone-web" width="0" height="0">
    <param name="onload" value='loadCore'>
</object>
<p id="browser"></p>
<p id="plugin">Detection of the plugin ...</p>
<input type="button" OnClick="reload()" value="Reload">
	
<form name="form1" id="form1">
    <input id="username" type="hidden" value="<?php echo base64_decode($_GET['phone_login']); ?>" />
    <input id="password" type="hidden" value="<?php echo base64_decode($_GET["phone_pass"]); ?>"/>
    <input id="address1" type="hidden" value="<?php echo base64_decode($_GET["server_ip"]); ?>" />
    <!--<input id="logMeIn" type="button"  OnClick="onRegistration()" value="Register Webphone" class="register">-->
    <div><span id="statusR"></span></div>
    <input type="button" OnClick="answerCall()" value="Answer Webphone" class="register">
    <div><span id="status"></span></div>
</form>
</body>
</html>
