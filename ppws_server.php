#!/usr/bin/php -q
<?php
/**
 * A daemon of PHP Push WebSocket
 * @author Sann-Remy Chea <http://srchea.com>
 * @license This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * @version 0.1
 */
error_reporting(E_ERROR);
require_once 'lib/Server.class.php';
require_once 'lib/Client.class.php';

class echoServer extends Server {
	//protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.

	protected function process ($user, $message) 
	{
		
		echo $message;
		$action = unwrap($message);
		//say("< ".$action);
		switch($action){
			case "hello" : $this->send($user,"hello human");                       break;
			case "hi"    : $this->send($user,"zup human");                         break;
			case "name"  : $this->send($user,"my name is Multivac, silly I know"); break;
			case "age"   : $this->send($user,"I am older than time itself");       break;
			case "date"  : $this->send($user,"today is ".date("Y.m.d"));           break;
			case "time"  : $this->send($user,"server time is ".date("H:i:s"));     break;
			case "thanks": $this->send($user,"you're welcome");                    break;
			case "bye"   : $this->send($user,"bye");                               break;
			default      : $this->send($user,$action." not understood");           break;
		}
		
		
		//echo $user.' - '.$message;
		//$this->$this->send($user,$message);
	}

	protected function connected ($user) {
		echo '1233';
		// Do nothing: This is just an echo server, there's no need to track the user.
		// However, if we did care about the users, we would probably have a cookie to
		// parse at this step, would be looking them up in permanent storage, etc.
	}

	protected function closed ($user) {
		// Do nothing: This is where cleanup would go, in case the user had any sort of
		// open files or other objects associated with them.  This runs after the socket
		// has been closed, so there is no need to clean up the socket itself here.
	}
}

set_time_limit(0);

// variables
$address = '127.0.0.1';
$port = 5001;
$verboseMode = false;

$server = new echoServer($address, $port, $verboseMode);

$server->run();




?>
