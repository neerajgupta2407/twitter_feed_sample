<?php
require_once('lib/Phirehose.php');
require_once('lib/OauthPhirehose.php');

/**
 * Example of using Phirehose to display the 'sample' twitter stream.
 */
class SampleConsumer extends OauthPhirehose
{
  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process.
     */
    $data = json_decode($status, true);
    if (is_array($data) && isset($data['user']['screen_name'])) 
    {
      //print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
      
    	
    	
    	$path = 'feed/twitter_feed.txt';
    	$str =  json_encode($data,true);
    	$string = date('d-m-Y H:i:s',time()).":::::".$str."\n";
    	
    	$file=fopen($path,a);
    	fwrite($file, $string);
    	fclose($file);
    	echo $string;
    	//exit;
    	
    	
    }
  }
}

// The OAuth credentials you received when registering your app at Twitter
define("TWITTER_CONSUMER_KEY", "ET6U0YxbmWrhierxw6kwA");
define("TWITTER_CONSUMER_SECRET", "efZsp7vhp2dBTSFtkslUpIlXmMj6rGdZbdYc0wI");


// The OAuth data for the twitter account
define("OAUTH_TOKEN", "322518002-wfqVNQ527yfbrHTVdsY7Mg3BKjwqCPTTAm96ieZP");
define("OAUTH_SECRET", "1dLWnaP5thupOLwKzaTTGRXL0eQvYiXisaVhbLyQg");

// Start streaming
$sc = new SampleConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_SAMPLE);
$sc->setLang("en");
$sc->consume();
