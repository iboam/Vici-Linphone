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
<script type="text/javascript" src="utils.js"></script>
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
