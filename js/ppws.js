//ppws server connection and message listening proc

var ws, url = 'ws://127.0.0.1:5001/089354e184f38196bfe27283dd44';

window.onbeforeunload = function() {
	ws.send('quit');
};

window.onload = function() {
	try {
		ws = new WebSocket(url);
		console.log('Connecting... (readyState '+ws.readyState+')');
		ws.onopen = function(msg) {
			console.log('Connection successfully opened (readyState ' + this.readyState+')');
		};
		ws.onmessage = function(msg) {
			write('Server says: '+msg.data);
			
		};
		ws.onclose = function(msg) {
			if(this.readyState == 2)
				console.log('Closing... The connection is going throught the closing handshake (readyState '+this.readyState+')');
			else if(this.readyState == 3)
				console.log('Connection closed... The connection has been closed or could not be opened (readyState '+this.readyState+')');
			else
				console.log('Connection closed... (unhandled readyState '+this.readyState+')');

		};
		ws.onerror = function(event) {
			console.log(event.data);
		};

	}
	catch(exception) {
		write(exception);
	}
};

function send(){
	var txt,msg;
	txt = $("msg");
	msg = txt.value;
	if(!msg) { 
		alert("Message can not be empty"); 
		return; 
	}
	txt.value="";
	txt.focus();
	try { 
		ws.send(123); 
		log('Sent: '+msg); 
	} catch(ex) { 
		log(ex); 
	}
}
