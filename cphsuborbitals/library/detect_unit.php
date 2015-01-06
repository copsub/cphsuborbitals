<?php

/*
  en simpel klasse, hvormed man kan tjekke om klienten er på en mobil,tablet eller screen enhed
  skrevet af Kasper Adnuvo 21/5/2013
  
  ##>usage<##
  $unit = new detectUnit();
  if($unit->is_mobile()) echo 'Mobil';
  if($unit->is_screen()) echo 'Screen';
  if($unit->is_ipad())   echo 'Ipad';

*/
 
class detectUnit {

	private $user_agent;
	private $mobil_status;
	private $ipad_status;
	private $screen_status;
	
	function __construct() {
		$this->user_agent    = $_SERVER['HTTP_USER_AGENT'];
		$this->mobil_status  = false;
		$this->ipad_status   = false;
		$this->screen_status = false;
	}

	public function is_mobile() {
		if ( preg_match( '/(android|iemobile|kindle|windows phone|ipod|bada|iphone)/i', $this->user_agent ) ) $this->mobil_status = true;
		return $this->mobil_status;
	}

	public function is_ipad() {
		if ( preg_match( '/(ipad|tablet)/i', $this->user_agent ) ) $this->ipad_status = true;
		return $this->ipad_status;
	}

	public function is_desktop() {
		if ( ! $this->is_mobile() && ! $this->is_ipad() ) $this->screen_status = true;
		return $this->screen_status;
	}

}

 $unit = new detectUnit();

 define( 'UNIT_MOBILE', $unit->is_mobile(), TRUE );
 define( 'UNIT_IPAD', $unit->is_ipad(), TRUE );
 define( 'UNIT_DESKTOP', $unit->is_desktop(), TRUE );

?>