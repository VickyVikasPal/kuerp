<?php
namespace App\Common\Datetime;
/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004 - 2009 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/
//require_once('include/timezone/timezones.php');

use Config;
use Auth;
use Session;
use App\Models\UserPreference;
use DateTime;
use DateTimeZone;


class TimeDate {
	var $dbDayFormat = 'Y-m-d';
	var $dbTimeFormat = 'H:i:s';

	protected $laravel_config;
	
	var $supported_strings = array(
		'a' => '[ap]m',
		'A' => '[AP]M',
		'd' => '[0-9]{1,2}',
		'h' => '[0-9]{1,2}',
		'H' => '[0-9]{1,2}',
		'i' => '[0-9]{1,2}',
		'm' => '[0-9]{1,2}',
		'Y' => '[0-9]{4}',
		's' => '[0-9]{1,2}'
	);
	
	/**
	 * Map the tokens passed into this as a "format" string to
	 * PHP's internal date() format string values.
	 *
	 * @var array
	 * @access private
	 * @see build_format()
	 */
	var $time_token_map = array(
		'a' => 'a', // meridiem: am or pm
		'A' => 'A', // meridiem: AM or PM
		'd' => 'd', // days: 1 through 31
		'h' => 'h', // hours: 01 through 12
		'H' => 'H', // hours: 00 through 23
		'i' => 'i', // minutes: 00 through 59
		'm' => 'm', // month: 1 - 12
		'Y' => 'Y', // year: four digits
		's' => 's', // seconds
	);
    
    /**
     * The current timezone information for the current user
     */
    private $current_user_timezone = null;
	
    /**
     * The current user timezone adjustment
     */
    private $current_user_adjustment = null;
    
	/**
	 * function getUserTimeZone()
	 * Returns the current users timezone info or another user;
	 * 
	 * $user user object for which you want to display, null for current user
	 * @return Array of timezone info 
	 * 
	 */
	public function __construct(){
		$this->laravel_config = config('config');
	}
		
	function getUserTimeZone($user = null){
		$current_user = Auth::User();
		$usertimezone = array();
		$timezones = array();
		$timezones = Config::get('timezones');
		if(empty($user) || (!empty($user->id) && $user->id == $current_user->id)) {
			if(isset($this->current_user_timezone)) return $this->current_user_timezone; // current user, return saved timezone info
			$user = $current_user;
		}
		
		if(isset($user))
		{	
			if($usertimezone = 'Asia/Calcutta') { //$user->getPreference('timezone')
					if(empty($timezones[$usertimezone])) {
						$GLOBALS['log']->fatal('TIMEZONE:NOT DEFINED-'. $usertimezone);
						$usertimezone = array();
					} else {
						$usertimezone = $timezones[$usertimezone];
					}
			}
		}
		
		if(!empty($user->id) && $user->id == $current_user->id) $this->current_user_timezone = $usertimezone; // save current_user
		return $usertimezone;
	}
	
	/**
	 * function adjustmentForUserTimeZone()
	 * this returns the adjustment for a user against the server time
	 * 
	 * $timezone pass in a timezone to adjust for 
	 * @return INT number of minutes to adjust a time by to get the appropriate time for the user
	 */
	function adjustmentForUserTimeZone($timezone_to_adjust = null){
		static $tz_to_adjust;
		if(isset($this->current_user_adjustment) && $tz_to_adjust == $timezone_to_adjust){
			return $this->current_user_adjustment;
		} 
		
		$adjustment = 0;
		$tz_to_adjust = $timezone_to_adjust;
		
		if(empty($timezone_to_adjust)) {
			$timezone = $this->getUserTimeZone();
		}
		else { 
			$timezone = $timezone_to_adjust;
		}
		if(empty($timezone)) {
			return $adjustment;
		}

		$server_offset = date('Z')/60;
		$server_in_ds = date('I');
		$user_in_ds = $this->inDST(date('Y-m-d H:i:s'), $timezone);
		$user_offset = $timezone['gmtOffset'] ;

		//compensate for ds for user
		if($user_in_ds) {
			$user_offset += 60;
		}
		
		//either both + or -
		$adjustment += $server_offset - $user_offset;
		if(empty($timezone_to_adjust)) $this->current_user_adjustment = $adjustment; // save current_user adj

		return $adjustment;
	}
	
	/**
	 * function getWeekDayName($indexOfDay)
	 * Returns a days name
	 *
	 * @param INT(WEEKDAY INDEX) $indexOfDay
	 * @return STRING representing the given weekday
	 */
	function getWeekDayName($indexOfDay){
		static $dow = array ( 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' );
		return $dow[$indexOfDay];
	}
	/**
	 * function getMonthName($indexMonth)
	 * Returns a Months Name
	 *
	 * @param INT(MONTH INDEX) $indexMonth
	 * @return STRING representation of the month
	 */
	function getMonthName($indexMonth){
		static $months = array ( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
		return $months[$indexMonth];
	}
		
	/**
	 * function getDateFromRules($year, $startMonth, $startDate, $weekday, $startTime )
	 * Converts the rules for a timezones dst into a string representation of a date for the given year
	 *
	 * @param STRING(YEAR) $year
	 * @param INT(MONTH INDEX) $startMonth
	 * @param INT(DATE INDEX) $startDate
	 * @param INT(WEEKDAY INDEX) $weekday
	 * @param INT(START TIME IN SECONDS) $startTime
	 * @return unknown
	 */
	function getDateFromRules($year, $startMonth, $startDate, $weekday, $startTime ){
		if($weekday < 0)return date( 'Y-m-d H:i:s', strtotime("$year-$startMonth-$startDate") + $startTime);
		$dayname = TimeDate::getWeekDayName($weekday);
		if($startDate > 0)$startMonth--;
		$month = TimeDate::getMonthName($startMonth);
		$startWeek = floor($startDate/7);
		//echo "$startWeek week $dayname - $month 1, $year<br>";
		return date( 'Y-m-d H:i:s', strtotime( "$startWeek week $dayname", strtotime( "$month 1, $year" ) ) + $startTime );
	
	}
	
	/**
	 * 	function getDSTRange($year, $zone)
	 * 
	 * returns the start and end date for dst for a given timezone and year or false if that zone doesn't support dst
	 *
	 * @param STRING(Year e.g. 2005) $year
	 * @param ARRAY (TIME ZONE INFO) $zone
	 * @return ARRAY OF DATE REPRESENTING THE START AND END OF DST or FALSE if the zone doesn't support dst
	 */
	function getDSTRange($year, $zone){
		$range = array();
		if(empty($zone['dstOffset'])){
			return false;
		}
	
		$range['start'] = $this->getDateFromRules($year, $zone['dstMonth'], $zone['dstStartday'], $zone['dstWeekday'],  $zone['dstStartTimeSec']);
		$range['end'] = $this->getDateFromRules($year, $zone['stdMonth'], $zone['stdStartday'], $zone['stdWeekday'],  $zone['stdStartTimeSec']);
		return $range;
	}
	
	function inDST($date, $zone){
		$datetime = explode(' ', $date);
		$dateSplit = explode('-', $datetime[0]);
		if(empty($dateSplit[2]))return false;
		$dstRange = $this->getDSTRange($dateSplit[0], $zone);
		if(!$dstRange){
			return false;
		}
		$datestamp = strtotime($date);
		$startstamp = strtotime($dstRange['start']);
		$endstamp = strtotime($dstRange['end']);
		if((($datestamp >= $startstamp  || $datestamp < $endstamp) && $startstamp > $endstamp)
			|| ($datestamp >= $startstamp && $datestamp < $endstamp)
		){
			return true;
		}
		return false;
	}

	function get_regular_expression($format) {
		$newFormat = '';
		$regPositions = array();
		$ignoreNextChar = false;
		$count = 1;
		$format_characters = str_split($format, 1);
		foreach ($format_characters as $char) {
			if (!$ignoreNextChar && isset($this->supported_strings[$char])) {
				$newFormat.= '('.$this->supported_strings[$char].')';
				$regPositions[$char] = $count;
				$count++;
			} else {
				$ignoreNextChar = false;

				$newFormat.= $char;

			}
			if ($char == "\\") {
				$ignoreNextChar = true;
			}
		}

		return array('format'=>$newFormat, 'positions'=>$regPositions);

	}

	function check_matching_format($date, $format, $toformat = '') {
		$regs = array();
		$startreg = $this->get_regular_expression($format);
		if (!empty($toformat)) {
			$otherreg = $this->get_regular_expression($toformat);
			//if the other format has the same regular expression then maybe it is shifting month and day position or something similar let it go for formating
			if ($startreg['format'] == $otherreg['format']) {
				return false;
			}
		}
		preg_match('@'.$startreg['format'].'@', $date, $regs);
			if (empty($regs)) {
			return false;
		}
		return true;
	}

	/**
	 * Build a true PHP format string from a user supplied format string
	 *
	 * @param string $format
	 * @return string
	 * @access private
	 * @see $time_token_map
	 */
	function build_format($format)
	{
		$format = str_split($format, 1);
		$return = '';
		foreach ($format as $char) {
			$return .= (isset($this->time_token_map[$char])) ?
				$this->time_token_map[$char] :
				$char;
		}
		return $return;
	}
	
	function swap_formats($date, $startFormat, $endFormat) {
		$regs = array();
		$startreg = $this->get_regular_expression($startFormat);
		
		preg_match('@'.$startreg['format'].'@', $date, $regs);
		
		$newDate = $endFormat;
		
		//handle 12 to 24 hour conversion
		//if (isset($startreg['positions']['h']) && !isset($startreg['positions']['H']) && $regs[$startreg['positions']['h']] !== '' && strpos($endFormat, 'H') > -1) {
		if (isset($startreg['positions']['h']) && !isset($startreg['positions']['H']) && isset($regs[$startreg['positions']['h']]) && $regs[$startreg['positions']['h']] !== '' && strpos($endFormat, 'H') > -1) {
		$startreg['positions']['H'] = sizeof($startreg['positions']) + 1;
			$regs[$startreg['positions']['H']] = $regs[$startreg['positions']['h']];
			if ((isset($startreg['positions']['A']) && isset($regs[$startreg['positions']['A']]) && $regs[$startreg['positions']['A']] == 'PM') || (isset($startreg['positions']['a']) && isset($regs[$startreg['positions']['a']]) && $regs[$startreg['positions']['a']] == 'pm')) {
				if ($regs[$startreg['positions']['h']] != 12) {
					$regs[$startreg['positions']['H']] = $regs[$startreg['positions']['h']] + 12;
				}
			}
			if ((isset($startreg['positions']['A']) && isset($regs[$startreg['positions']['A']])&& $regs[$startreg['positions']['A']] == 'AM') || (isset($startreg['positions']['a']) && isset($regs[$startreg['positions']['a']]) && $regs[$startreg['positions']['a']] == 'am')) {
				if ($regs[$startreg['positions']['h']] == 12) {
					$regs[$startreg['positions']['H']] = 0;
				}
			}
		}
		if (!empty($startreg['positions']['H']) && !empty($regs[$startreg['positions']['H']]) && !isset($startreg['positions']['h']) && strpos($endFormat, 'h') > -1) {
			$startreg['positions']['h'] = sizeof($startreg['positions']) + 1;
			$regs[$startreg['positions']['h']] = $regs[$startreg['positions']['H']];
			if (!isset($startreg['positions']['A'])) {
				$startreg['positions']['A'] = sizeof($startreg['positions']) + 1;
				$regs[$startreg['positions']['A']] = 'AM';
			}
			if (!isset($startreg['positions']['a'])) {
				$startreg['positions']['a'] = sizeof($startreg['positions']) + 1;
				$regs[$startreg['positions']['a']] = 'am';
			}
			if ($regs[$startreg['positions']['H']] > 11) {
				$regs[$startreg['positions']['h']] = $regs[$startreg['positions']['H']] - 12;
				if ($regs[$startreg['positions']['h']] == 0) {
					$regs[$startreg['positions']['h']] = 12;
				}
				$regs[$startreg['positions']['a']] = 'pm';
				$regs[$startreg['positions']['A']] = 'PM';
			}
			if ($regs[$startreg['positions']['H']] == 0) {
				$regs[$startreg['positions']['h']] = 12;
				$regs[$startreg['positions']['a']] = 'am';
				$regs[$startreg['positions']['A']] = 'AM';
			}
		}
		if (!empty($startreg['positions']['h'])) {
			if (!isset($regs[$startreg['positions']['h']])) {
				$regs[$startreg['positions']['h']] = '12';
			} else if (strlen($regs[$startreg['positions']['h']]) < 2)
				$regs[$startreg['positions']['h']] = '0'.$regs[$startreg['positions']['h']];
		}
		if (!empty($startreg['positions']['H'])) {
			// if no hour is set or it is equal to 0, set it explicitly to "00"
			if (empty($regs[$startreg['positions']['H']])) {
				$regs[$startreg['positions']['H']] = '00';
			} else if (strlen($regs[$startreg['positions']['H']]) < 2)
				$regs[$startreg['positions']['H']] = '0'.$regs[$startreg['positions']['H']];
		}
		if (!empty($startreg['positions']['d'])) {
			if (!isset($regs[$startreg['positions']['d']])) {
				$regs[$startreg['positions']['d']] = '01';
			} else if (strlen($regs[$startreg['positions']['d']]) < 2)
				$regs[$startreg['positions']['d']] = '0'.$regs[$startreg['positions']['d']];
		}
		if (!empty($startreg['positions']['i'])) {
			// if no minute is set or it is equal to 0, set it explicitly to "00"
			if (empty($regs[$startreg['positions']['i']])) {
				$regs[$startreg['positions']['i']] = '00';
			} else if (strlen($regs[$startreg['positions']['i']]) < 2)
				$regs[$startreg['positions']['i']] = '0'.$regs[$startreg['positions']['i']];
		}
		if (!empty($startreg['positions']['m'])) {
			if (!isset($regs[$startreg['positions']['m']])) {
				$regs[$startreg['positions']['m']] = '01';
			} elseif(strlen($regs[$startreg['positions']['m']]) < 2)
				$regs[$startreg['positions']['m']] = '0'.$regs[$startreg['positions']['m']];
		}
		if (!empty($startreg['positions']['Y'])) {
			if (!isset($regs[$startreg['positions']['Y']])) {
				$regs[$startreg['positions']['Y']] = '2000';
			}
		}
		if (!empty($startreg['positions']['s'])) {
			if (!isset($regs[$startreg['positions']['s']])) {
				$regs[$startreg['positions']['s']] = '00';
			} else if (strlen($regs[$startreg['positions']['s']]) < 2)
				$regs[$startreg['positions']['s']] = '0'.$regs[$startreg['positions']['s']];
		} else {
			$startreg['positions']['s'] = sizeof($startreg['positions']) + 1;
			$regs[$startreg['positions']['s']] = '00';
		}
		
		foreach($startreg['positions'] as $key=>$val) {
			if (isset($regs[$val])) {
				
				$newDate = str_replace($key, $regs[$val], $newDate);
			}
		}
		
		return $newDate;

	}
	function to_display_time($date, $meridiem = true, $offset = true) {

		$date = trim($date);
		if (empty($date)) {
			return $date;
		}
		if ($offset) {
			$date = $this->handle_offset($date, $this->get_db_date_time_format(), true);
		}
		return $this->to_display($date, $this->dbTimeFormat, $this->get_time_format($meridiem));
	}

	function to_display_date($date, $use_offset = true) {
		$date = trim($date);

		if (empty($date)) {
			return $date;
		}
		if ($use_offset)
			 $date = $this->handle_offset($date, $this->get_db_date_time_format(), true);

		return $this->to_display($date, $this->dbDayFormat, $this->get_date_format());
	}

	function to_display_date_time($date, $meridiem = true, $offset = true, $user = null) {
		$date = trim($date);
	
		if (empty($date)) {
			return $date;
		}

		$args = array(
		    'time' => $date,
		    'meridiem' => $meridiem,
		    'offset' => $offset,
		    'user' => $user,
		);

		// todo use __METHOD__ once PHP5 minimum verison is required
		/* $cache_key = md5('TimeDate::to_display_date_time_' . serialize($args));
		$cached_value = sugar_cache_retrieve($cache_key);
		if (!is_null($cached_value)) {
		    return $cached_value;
		} */

		if ($offset) {
			$date = $this->handle_offset($date, $this->get_db_date_time_format(), true, $user);
		}

		$return_value = $this->to_display($date, $this->get_db_date_time_format(), $this->get_date_time_format($meridiem, $user));

		//sugar_cache_put($cache_key, $return_value);
		return $return_value;
	}

	function to_display($date, $fromformat, $toformat) {
		$date = trim($date);
		if (empty($date)) {
			return $date;
		}
		return $this->swap_formats($date, $fromformat, $toformat);
	}

	function to_db($date) {
		$date = trim($date);
	
		if (empty($date)) {
			return $date;
		}
		if (strlen($date) <= 10) {
			$date .= ' ' . $this->get_default_midnight();
		}
		$date = $this->swap_formats($date, $this->get_date_time_format(), $this->get_db_date_time_format());
		return $this->handle_offset($date, $this->get_db_date_time_format(), false);
	}

	/**
	 * @todo This should return the raw text to be included within a <script> tag.
	 *	   Having this display it's own <script> keeps it from being able to be embedded
	 *	   in another Javascript file to allow for better caching
	 */
	function get_javascript_validation() {
		$cal_date_format = $this->get_cal_date_format();
		$timereg = $this->get_regular_expression($this->get_time_format());
		$datereg = $this->get_regular_expression($this->get_date_format());
		$date_pos = '';
		foreach($datereg['positions'] as $type=>$pos) {
			if (empty($date_pos)) {
				$date_pos.= "'$type': $pos";
			} else {
				$date_pos.= ",'$type': $pos";
			}

		}
		$date_pos = '{'.$date_pos.'}';
		if (preg_match('/\)([^\d])\(/', $timereg['format'], $match)) {
			$time_separator = $match[1];
		} else {
			$time_separator = ":";
		}
		$hour_offset = $this->get_hour_offset() * 60 * 60;

		$the_script = "<script type=\"text/javascript\">\n"
			."\tvar time_reg_format = '".$timereg['format']."';\n"
			."\tvar date_reg_format = '".$datereg['format']."';\n"
			."\tvar date_reg_positions = $date_pos;\n"
			."\tvar time_separator = '$time_separator';\n"
			."\tvar cal_date_format = '$cal_date_format';\n"
			."\tvar time_offset = $hour_offset;\n"
			."</script>";

		return $the_script;

	}

	function to_db_datetime($date, $time="") {
		$user = Auth::user();
		$date = trim($date);
		$timezones = array();
		$timezones = Config::get('timezones');
		
		if (empty($date)) {
			return $date;
		}else{
			if(!empty($date) && empty($time)){
			$curddat = str_replace(' GMT 0530 (India Standard Time)','',$date);
			$old_date_timestamp = strtotime($curddat);

			 $date = date('Y-m-d', $old_date_timestamp);
			}else{
				
				$current_user = UserPreference::where('branch_id', $user->branch_id)->where('deleted', 0)->where('created_by', $user->id)->get()->toArray();
				if(isset($current_user[0])){
				
					$current_user = unserialize(base64_decode($current_user[0]['contents']));
				}
				
				$timezone = $current_user['timezone']??config('config')['default_time_zone'];
				//$timezone = config('config')['default_time_zone'];
				$offset = "";
				foreach ($timezones as $key => $value) {
					if($key == $timezone)
					{
						$offset = $value['gmtOffset'];
					}
				}

				$curddat = str_replace(' GMT 0530 (India Standard Time)','',$date);
				$old_date_timestamp = strtotime($curddat);

			 	$date = date('Y-m-d', $old_date_timestamp);

				$new_time = date("H:i:s",strtotime("-".$offset."minutes", strtotime($time)));
				
				$date = $date." ".$new_time;
			}
           
		}
		return $date;
	}

	function to_db_date($date, $use_offset = true) {
		$date = trim($date);
		if (empty($date)) {
			return $date;
		}
		if ($use_offset) {
			$date = $this->to_db($date);
			$date = $this->swap_formats($date, $this->dbDayFormat, $this->dbDayFormat);
		} else {
			$date = $this->swap_formats($date, $this->get_date_format(), $this->dbDayFormat);
		}

		return $date;
	}


	function to_db_time($date, $use_offset = true) {
		$date = trim($date);
		if (empty($date)) {
			return $date;
		}
		if ($use_offset){
			$date =$this->to_db($date, $use_offset);
		 	$date = $this->swap_formats($date, $this->get_db_date_time_format(), $this->dbTimeFormat);
		}else{
		 	$date = $this->swap_formats($date, $this->get_time_format(), $this->dbTimeFormat);
		}
		return $date;
	}

	
	/* takes a local Date & Time value, concats it, and returns the separate but
	 * properly calculated GMT value as an array*/
	function to_db_date_time($date, $time) {
		$user = Auth::user();
		$current_user = UserPreference::where('branch_id', $user->branch_id)->where('deleted', 0)->where('created_by', $user->id)->get()->toArray();
		$current_user = unserialize(base64_decode($current_user[0]['contents']));
		$date = date("d/m/Y",strtotime($date));
		if(is_array($current_user)) {
			
			$timeFormat['time'] = $current_user['timeformat']??config('config')['default_time_format'];
			$timeFormat['date'] = $current_user['dateformat']??config('config')['default_date_format'];
		} else {
			$timeFormat['date'] = $this->dbDayFormat;
			$timeFormat['time'] = $this->dbTimeFormat;
		}
		$dt = '';
		$newDate = '';
		$retDateTime = array();
		
		// concat: ('.' breaks strtotime())
		$time = str_replace('.',':',$time);
		$dt = $date." ".$time;
		
		$newDate = $this->swap_formats($dt, $timeFormat['date'].' '.$timeFormat['time'] , $this->dbDayFormat.' '.$this->dbTimeFormat);
		
		$retDateTime = explode(' ', $newDate);
		
		return $retDateTime;
	}
	
	function getUserEventOffset($user_in_dst, $event_in_dst){
		if($user_in_dst && !$event_in_dst ){
			return -3600;
		}
		if(!$user_in_dst && $event_in_dst ){
			return 3600;
		}
		return 0;
	}
	
/**************************************************************
U	S	E	Time	GMT	Delta Server Client	U/E	Delta Server GMT
USER IN LA and server in NY
D	D	D	12	19	-3	0	-4
D	D	S	12	20	-3	-1	-4
D	S	D	12	19	-2	0	-5
D	S	S	12	20	-2	-1	-5
S	D	D	12	19	-4	1	-4
S	D	S	12	20	-4	0	-4
S	S	D	12	19	-3	1	-5
S	S	S	12	20	-3	0	-5
							
							
User in LA and server in gmt there are no DST for server
D	S	D	12	19	-7	0	0
D	S	S	12	20	-7	-1	0
														
S	S	D	12	19	-8	1	0
S	S	S	12	20	-8	0	0

***************************************************************/
	
	/**
	 * handles offset values for Timezones and DST
	 * @param	$date	     string		date/time formatted in user's selected
	 * format
	 * @param	$format	     string		destination format value as passed to PHP's
	 * date() funtion
	 * @param	$to		     boolean 
	 * @param	$user	     object		user object from which Timezone and DST
     * @param	$usetimezone string		timezone name as it appears in timezones.php
	 * values will be derived
	 * @return 	 string		date formatted and adjusted for TZ and DST  
	 */
	function handle_offset($date, $format, $to = true, $user = null, $usetimezone = null) {
		$this->laravel_config;
		$date = trim($date);
		// Samir Gandhi
		// This has been commented out because it is going through the wrong code path
		// Email module was broken and thats why its commented
		//if($this->use_old_gmt()){
			//return $this->handle_offset_depricated($date, $format, $to);
		//}
		if (empty($date)) {
			return $date;
		}
		$args = array(
		    'date' => $date,
		    'format' => $format,
		    'to' => $to,
		    'user' => $user,
		    'usetimezone' => $usetimezone,
		);
		/* $cache_key = md5('TimeDate::handle_offset_' . serialize($args));
		$cached_result = sugar_cache_retrieve($cache_key);
		if (!is_null($cached_result)) {
		    return $cached_result;
		} */
		if (strtotime($date) == -1) {
			return $date;
		}
		$deltaServerGMT = date('Z');
		
		if ( !empty($usetimezone) )
			$timezone = $GLOBALS['timezones'][$usetimezone];
		else
			$timezone = $this->getUserTimeZone($user);
		$deltaServerUser = $this->get_hour_offset($to, $timezone);
		$event_in_ds = $this->inDST($date,$timezone );
		$user_in_ds = $this->inDST(date('Y-m-d H:i:s'),$timezone );
		$server_in_ds = date('I');
		$ue = $this->getUserEventOffset($user_in_ds, $event_in_ds);
		$zone = 1;
		if (!$to) {
			$zone = -1;
		}
		// jennyg - Bug 10547: strtotime doesn't work correctly with mm-dd-yyyy, but works with mm/dd/yyyy
		$date = str_replace("-", "/", $date);
		// end Bug 10547
		$result = date($format, strtotime($date) + $deltaServerUser * 3600 + ($ue + $deltaServerGMT) * $zone);
		//sugar_cache_put($cache_key, $result);
		return $result;
	}
	
	function use_old_gmt(){
		if(isset($_SESSION['GMTO'])){
			return $_SESSION['GMTO'];
		}
		$db = DBManagerFactory::getInstance();
		$fix_name = 'DST Fix';
		$result =$db->query("Select * from  versions  where  name='$fix_name'");
		$valid = $db->fetchByAssoc($result);
		if($valid){
			$_SESSION['GMTO'] = false;
		}else{
			$_SESSION['GMTO'] = true;
		}
		return $_SESSION['GMTO'];
	}
	
	/**
	 *This function is depricated don't use it. It is only for backwards compatibility until the admin runs the upgrade script
	 *
	 * @param unknown_type $date
	 * @param unknown_type $format
	 * @param unknown_type $to
	 * @return unknown
	 */
	function handle_offset_depricated($date, $format, $to = true) {
		
		$date = trim($date);
		if (empty($date)) {
			return $date;
		}
		if (strtotime($date) == -1) {
			return $date;
		}
		$zone = date('Z');
		if (!$to) {
			$zone *= -1;
		}
		return date($format, strtotime($date) + $this->get_hour_offset($to) * 60 * 60 + $zone);
	}
	
	/*	this method will take an input $date variable (expecting Y-m-d format)
	 *	and get the GMT equivalent - with an hour-level granularity :
	 *	return the max value of a given locale's 
	 *	date+time in GMT metrics (i.e., if in PDT, "2005-01-01 23:59:59" would be 
	 *	"2005-01-02 06:59:59" in GMT metrics)
	 */
	function handleOffsetMax($date, $format, $to = true) {
		global $current_user;
		$gmtDateTime = array($date); // for errors
		/* check for bad date formatting */
		$date = trim($date);

		if (empty($date)) {
			return $gmtDateTime;
		}

		if (strtotime($date) == -1) {
			return $gmtDateTime;
		}

		/*	cn: passed $date var will be a "MAX" value, which we need to return 
			as a GMT date/time pair to provide for hour-level granularity */
		/* this ridiculousness b/c PHP returns current time when passing "today"
			or "tomorrow" as strtotime() args */
		$dateNoTime = date('Y-m-d', strtotime($date));

		/* handle timezone and daylight savings */
		$dateWithTimeMin = $dateNoTime.' 00:00:00';
		$dateWithTimeMax = $dateNoTime.' 23:59:59';
		
		
		$offsetDateMin = $this->handle_offset($dateWithTimeMin, $this->dbDayFormat.' '.$this->dbTimeFormat, false);
		$offsetDateMax = $this->handle_offset($dateWithTimeMax, $this->dbDayFormat.' '.$this->dbTimeFormat, false);
		
		
		$exOffsetDateMax = explode(' ', $offsetDateMax);
		$exOffsetDateMin = explode(' ', $offsetDateMin);
		$gmtDateTime['date'] = $exOffsetDateMax[0];
		$gmtDateTime['time'] = $exOffsetDateMax[1];
		$gmtDateTime['min'] = $offsetDateMin;
		$gmtDateTime['max'] = $offsetDateMax;
		
		return $gmtDateTime;
	}
	

	function get_gmt_db_datetime() {
		return gmdate('Y-m-d H:i:s');
	}

	function get_gmt_db_date() {
		return gmdate($this->dbDayFormat);
	}

	/*
	 * assumes that olddatetime is in Y-m-d H:i:s format
	 */
	function convert_to_gmt_datetime($olddatetime) {
		if (!empty($olddatetime)) {
			return date('Y-m-d H:i:s', strtotime($olddatetime) - date('Z'));
		}
	}



	function merge_date_time($date, $time) {
		$merged =  $date.' '.$time;
	
		return $merged;
	}
	function merge_time_meridiem($date, $format, $mer) {
		$date = trim($date);
		if (empty($date)) {
			return $date;
		}
		 $fakeMerFormat = str_replace(array('a', 'A'), array('!@!', '!@!'), $format);
		$noMerFormat = str_replace(array('a', 'A'), array('', ''), $format);
		$newDate = $this->swap_formats($date, $noMerFormat, $fakeMerFormat);
		return str_replace('!@!', $mer, $newDate);

	}
	
	/*
	 *  AMPMMenu
	 *  This method renders a <select> HTML form element based on the
	 *  user's time format preferences.  
	 * 
	 *  todo: There is hardcoded HTML in here that does not allow for localization
	 *  of the AM/PM am/pm Strings in this drop down menu.  Also, perhaps
	 *  change to the substr_count function calls to strpos 
	 * 
	 */
	function AMPMMenu($prefix, $date, $attrs = '') {

		if (substr_count($this->get_time_format(), 'a') == 0 && substr_count($this->get_time_format(), 'A') == 0) {
			return '';
		}
		$menu = "<select name='".$prefix."meridiem' ".$attrs.">";

		if (strpos($this->get_time_format(), 'a') > -1) {

			if (substr_count($date, 'am') > 0)
				$menu.= "<option value='am' selected>am";
			else
				$menu.= "<option value='am'>am";
			if (substr_count($date, 'pm') > 0)
				$menu.= "<option value='pm' selected>pm";
			else
				$menu.= "<option value='pm'>pm";

		} else {

			if (substr_count($date, 'AM') > 0)
				$menu.= "<option value='AM' selected>AM";
			else
				$menu.= "<option value='AM'>AM";
			if (substr_count($date, 'PM') > 0) {
				$menu.= "<option value='PM' selected>PM";
			} else
				$menu.= "<option value='PM'>PM";

		}

		return $menu.'</select>';
	}

	function get_hour_offset($to = true, $timezone = null) {
	
		$timeDelta = $this->adjustmentForUserTimeZone($timezone) /60.0;
		if ($to) {
			return -1.0 * $timeDelta;
		}
		return 1.0 * $timeDelta;
	}
	
	function get_time_format($meridiem = true, $user = null) {
		global $current_user;
		$this->laravel_config;

		if(empty($user)) $user = $current_user;
		
		if ($user instanceof User && $user->getPreference('timef')) {
			$timeFormat = $user->getPreference('timef');
		} else {
			$timeFormat = $this->laravel_config['default_time_format'];
		}
		if (!$meridiem) {
			$timeFormat = str_replace(array('a', 'A'), array('', ''), $timeFormat);
		}
		return $timeFormat;
	}

	function get_date_format($user = null) {
		global $current_user;
		$this->laravel_config;
		
		if(empty($user)) $user = $current_user;
		
		if ($user instanceof User && $user->getPreference('datef')) {
			return $user->getPreference('datef');
		}
		if(!empty($this->laravel_config['default_date_format'])){
			return $this->laravel_config['default_date_format'];
		}else{
			return '';
		}
	}

	function get_date_time_format($meridiem = true, $user = null) {
		return $this->get_date_format($user).' '.$this->get_time_format($meridiem, $user);
	}

	function get_db_date_time_format() {
		return $this->dbDayFormat.' '.$this->dbTimeFormat;
	}
	function get_cal_date_format() {
		$format = str_replace('Y', '%Y', $this->get_date_format());
		$format = str_replace('m', '%m', $format);
		$format = str_replace('d', '%d', $format);
		return $format;
	}

	function get_user_date_format() {
		$format = str_replace('Y', 'yyyy', $this->get_date_format());
		$format = str_replace('m', 'mm', $format);
		$format = str_replace('d', 'dd', $format);
		return $format;
	}

	function get_user_time_format() {
		$this->laravel_config;
		$time_pref = $this->get_time_format();
		
		if(!empty($time_pref) && !empty($this->laravel_config['time_formats'][$time_pref])) {
		   return $this->laravel_config['time_formats'][$time_pref];	
		}
		
		return '23:00'; //default
		/*
		// Commented out by Collin (doesn't seem to work properly)
		return $this->to_display_time('23:00:00', true, false);
		*/
	}

	function get_microtime_string() {
		$now = (string) microtime();
		$now = explode(' ', $now);
		$unique_id = $now[1].str_replace('.', '', $now[0]);
		unset($now);

		return $unique_id;
	}

	function get_default_midnight($refresh = false)
	{
		static $default_midnight = null;
		if (is_null($default_midnight) || $refresh) {
			$time_mapping = array(
				'H' => '00',
				'h' => '12',
				'i' => '00',
				's' => '00',
				'a' => 'am',
				'A' => 'AM',
			);
			$default_midnight = str_replace(
				array_keys($time_mapping),
				$time_mapping,
				$this->get_time_format() // should this be using get_user_time_format()? 
			);
		}
		return $default_midnight;
	}
    
	/**
	 * Function To Get Current Age  
	 * 
	 * @param String $dob Birthdate in Y-m-d format
	 * @param String $date_to Date till age to be calculated in Y-m-d, if null then current date will be assumed
	 * @param Array $reg_date   with reg_date in Y-m-d Format, years, months, days e.g. array('reg_date'=>'2013-01-10', 'years'=>'8', months=>'3', days=>'15')
	 * 
	 * @return array array('Years' => $years, 'Months' => $months, 'Days' => $dayss);
	 * */
    function get_current_age_array($dob =NULL, $date_to = NULL, $reg_date = NULL, $as_string = false)
    { 
        
    	if ($dob == NULL && !empty($reg_date) )
    	{

    		$years = 0;
    		$months = 0;
    		$days = 0;
    		
    		
    		if (isset($reg_date['reg_date'])){
	    			
	    		if(isset($reg_date['years']) && $reg_date['years'] != ''){
	    			$years = $reg_date['years'];
	    		}
	    		if(isset($reg_date['months']) && $reg_date['months'] != ''){
	    			$months = $reg_date['months'];
	    			
	    			if ($years){
	    				$months = (12*$years) + $months;
	    			}
	    		}
	    		if(isset($reg_date['days']) && $reg_date['days'] != ''){
	    			$days = $reg_date['days'];
	    		}
	    		 
	    		$timeinseconds = strtotime($reg_date['reg_date']. " -{$months} months -{$days} days");
	    		 
	    		$dob = date('Y-m-d', $timeinseconds);
	    	}
	    		
	    }
    	
        $date1 = $dob;
        if($date_to == '' || $date_to == NULL){    
        $date2 = $this->get_gmt_db_date();
        }else{
        $date2 = $date_to;
        }

        $d1 = explode('-', $date1);
        $d2 = explode('-', $date2);
        if(isset($d1[1]) && isset($d2[1])){
        $dayss=0;
        $months=0;
        $years=0;
        
        //if current month is grter than birth month   and curr date is greater than birthdate
        if($d2[1] >= $d1[1] && $d2[2] >= $d1[2])
        {    
            $years =  $d2[0] - $d1[0];       
            $months =  $d2[1] - $d1[1];
            $dayss =  $d2[2] - $d1[2];

            if($dayss == 0)
                $dayss = 1;
/*            if($d1[1] == 2 && $d2[2] >){
               $dayss =  $this->get_days_in_month( $d1[0],2) - $d1[2];  
           }
*/        }
        //if current month is grter than birth month   and curr date is less than birthdate
        if($d2[1] >= $d1[1] && $d2[2] < $d1[2])
        {
                                 
            if($d2[1] >$d1[1]){
            $years =  $d2[0] - $d1[0];                     
            $months =  $d2[1] - $d1[1] - 1;
            }else{
            $years =  $d2[0] - $d1[0]-1;         
            $months =  12 + $d2[1] - $d1[1]-1;
            }
            if($d1[1] == 1 || $d1[1] == 3 || $d1[1] == 5 || $d1[1] == 7 || $d1[1] == 8 || $d1[1] == 10 || $d1[1] == 12)
            $dayss =  31 + $d2[2] - $d1[2];
            else{
               if($d1[1] == 2){
                 $dayss =  $this->get_days_in_month( $d1[0],2) + $d2[2] - $d1[2];  
               }
               else{
                  $dayss =  30 + $d2[2] - $d1[2];  
               }
            }
        }
        
        //if current month is less than birth month   and curr date is greater than birthdate
        if($d2[1] < $d1[1] && $d2[2] >= $d1[2])
        {            

            $years =  $d2[0] - $d1[0] -1;
            $months =  12 + $d2[1] - $d1[1]; 
            $dayss =  $d2[2] - $d1[2];

        }
        //if current month is less than birth month   and curr date is less than birthdate
        if($d2[1] < $d1[1] && $d2[2] < $d1[2])
        {            
            $years =  $d2[0] - $d1[0] -1;
            
            $months =  12 + $d2[1] - $d1[1] -1;
            
            if($d1[1] == 1 || $d1[1] == 3 || $d1[1] == 5 || $d1[1] == 7 || $d1[1] == 8 || $d1[1] == 10 || $d1[1] == 12)
            $dayss =  31 + $d2[2] - $d1[2];
            else{
                if($d1[1] == 2){
                  $dayss =  $this->get_days_in_month( $d1[0],2) + $d2[2] - $d1[2];  
                }
                else{
                  $dayss =  30 + $d2[2] - $d1[2];  
                }
            }
        }
           if (!$as_string){
           	return  array('Years' => $years, 'Months' => $months, 'Days' => $dayss);//$years .' yr '. $months .' mth '. $dayss .' days';
           }else{
           	$return = '';
           	if ($years){
           		$return = $years .' yr ';
           	}
           	if ($months){
           		$return .= $months .' mo ';
           	}
           	if ($years <= 0 && $months <= 0 && $dayss){
           		$return .= $dayss .' D ';
           	}
           	return $return;
           }
            
            
        }
    }
    function get_age_ymd($dob=NULL,$reg_date=NULL,$reg_age=NULL) {
        $date2 = $this->get_gmt_db_date();
        if(!empty($dob))
        {
            $years = 0;
            $months = 0;
            $date1 = $dob;
            
           
            $d1 = explode('-', $date1);
            $d2 = explode('-', $date2);
            if(isset($d1[1]) && isset($d2[1])){
                $dayss=0;
                $months=0;
                $years=0;
                
                //if current month is grter than birth month   and curr date is greater than birthdate
                if($d2[1] >= $d1[1] && $d2[2] >= $d1[2])
                {
                    $years =  $d2[0] - $d1[0];
                    $months =  $d2[1] - $d1[1];
                    $dayss =  $d2[2] - $d1[2];
                    
                    if($dayss == 0)
                        $dayss = 1;
                        /*            if($d1[1] == 2 && $d2[2] >){
                         $dayss =  $this->get_days_in_month( $d1[0],2) - $d1[2];
                         }
                         */        }
                        //if current month is grter than birth month   and curr date is less than birthdate
                        if($d2[1] >= $d1[1] && $d2[2] < $d1[2])
                        {
                            
                            if($d2[1] >$d1[1]){
                                $years =  $d2[0] - $d1[0];
                                $months =  $d2[1] - $d1[1] - 1;
                            }else{
                                $years =  $d2[0] - $d1[0]-1;
                                $months =  12 + $d2[1] - $d1[1]-1;
                            }
                            if($d1[1] == 1 || $d1[1] == 3 || $d1[1] == 5 || $d1[1] == 7 || $d1[1] == 8 || $d1[1] == 10 || $d1[1] == 12)
                                $dayss =  31 + $d2[2] - $d1[2];
                                else{
                                    if($d1[1] == 2){
                                        $dayss =  $this->get_days_in_month( $d1[0],2) + $d2[2] - $d1[2];
                                    }
                                    else{
                                        $dayss =  30 + $d2[2] - $d1[2];
                                    }
                                }
                        }
                        
                        //if current month is less than birth month   and curr date is greater than birthdate
                        if($d2[1] < $d1[1] && $d2[2] >= $d1[2])
                        {
                            
                            $years =  $d2[0] - $d1[0] -1;
                            $months =  12 + $d2[1] - $d1[1];
                            $dayss =  $d2[2] - $d1[2];
                            
                        }
                        //if current month is less than birth month   and curr date is less than birthdate
                        if($d2[1] < $d1[1] && $d2[2] < $d1[2])
                        {
                            $years =  $d2[0] - $d1[0] -1;
                            
                            $months =  12 + $d2[1] - $d1[1] -1;
                            
                            if($d1[1] == 1 || $d1[1] == 3 || $d1[1] == 5 || $d1[1] == 7 || $d1[1] == 8 || $d1[1] == 10 || $d1[1] == 12)
                                $dayss =  31 + $d2[2] - $d1[2];
                                else{
                                    if($d1[1] == 2){
                                        $dayss =  $this->get_days_in_month( $d1[0],2) + $d2[2] - $d1[2];
                                    }
                                    else{
                                        $dayss =  30 + $d2[2] - $d1[2];
                                    }
                                }
                        }
                           $return = '';
                            if ($years>0){
                                $return = $years .' yr ';
                            }
                            if ($months>0){
                                $return .= $months .' mo ';
                            }
                            if ($dayss>=0){
                                if ($years <= 0 && $months <= 0){
                                    $dayss=($dayss==0)?1:$dayss;
                                    
                                }
                                $return .= $dayss .' D ';
                            }
                         
                            return $return;
                       
                        
                        
            }
        }
        elseif (!empty($reg_age)){
            $d1 = new DateTime($date2);
            $d2 = new DateTime($reg_date);
            $diff = $d2->diff($d1);
            $year_gap=$diff->y;
            return $reg_age+$year_gap.' yr ';
        }else{
           return  $return='';
        }
        
        
    }
    //to Get Number Of Days   
    function get_days_in_month($year, $month) {
        return( date( "t", mktime( 0, 0, 0, $month, 1, $year) ) );
    }
    
    function getWeekDayNumber($indexOfDay){
        $indexOfDay = strtolower($indexOfDay);
        $dow1 = array ( 'sunday' => 1, 'monday' => 2, 'tuesday' => 3, 'wednesday' => 4, 'thursday' =>5, 'friday' =>6, 'saturday' => 7);
        return $dow1[$indexOfDay];
    }
    function validateDate($date){
    	if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date, $matches)) {
    		if (checkdate($matches[2], $matches[3], $matches[1])) {
    			return true;
    		}
    	}
    	if (preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches)) {
    		if (checkdate($matches[2], $matches[3], $matches[1])) {
    			return true;
    		}
    	}
    	return false;
    }
    
    /**
     * 
     * @param date $date
     * @param date $compareFrom
     * @param boolean $futurepast
     * 
     * purpose : this method is used to compare $date parameter with current date if second parameter will not passed, it will compare IST dates only
     */
    function compareISTdate($date,$compareFrom = '',$futurepast = true){
        if(empty($date))
            return $date;
        
            $return = false;
            
            $formatdate = (strlen($date) > 10) ? $this->get_date_time_format() : $this->get_date_format();
            
            if(strpos($date,'/') === false)
                $formatdate = (strlen($date) > 10) ? $this->get_db_date_time_format() : $this->dbDayFormat;
                             
            $date = $this->swap_formats($date, $formatdate, $this->dbDayFormat);
        
        if(empty($compareFrom))
            $compareFrom = date('Y-m-d'); // current date
        else{
            
            $formatdate = (strlen($compareFrom) > 10) ? $this->get_date_time_format() : $this->get_date_format();
            
            if(strpos($compareFrom,'/') === false)
                $formatdate = (strlen($compareFrom) > 10) ? $this->get_db_date_time_format() : $this->dbDayFormat;
                            
                $compareFrom = $this->swap_formats($compareFrom, $formatdate, $this->dbDayFormat);
                
//             if (strlen($compareFrom) > 10) {
//                 $dateonly = explode(' ',$compareFrom);
//                 $compareFrom = $dateonly[0];
//             }
//             $compareFrom = str_replace('/','-',$compareFrom);        
        }
//         return $date .'---'. $compareFrom;
        
        if($futurepast){
            if(strtotime($date) > strtotime($compareFrom)) // compare for future dates
                $return = true;
        }else{
            if(strtotime($date) < strtotime($compareFrom)) // compare for past dates 
                $return = true;
        }
        
        return $return;
    }
    
    
    function datetimedifference($date1,$date2 = ''){
        // Declare and define two dates
        $date1 = (strpos($date1,'/') !== false) ? $this->to_db($date1) : $date1;
        $date2 = (!empty($date2)) ? ((strpos($date2,'/') !== false) ? $this->to_db($date2) : $date2) : $this->get_gmt_db_datetime();
        
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        
        // Formulate the Difference between two dates
        $diff = abs($date2 - $date1);
        
        $returnStr = '';
        
        // To get the year divide the resultant date into
        // total seconds in a year (365*60*60*24)
        $years = floor($diff / (365*60*60*24));
        
        $returnStr .= (!empty($years) ? $years .' yr ' : '');
        
        // To get the month, subtract it with years and
        // divide the resultant date into
        // total seconds in a month (30*60*60*24)
        $months = floor(($diff - $years * 365*60*60*24)
            / (30*60*60*24));
        
        $returnStr .= (!empty($months) ? $months .' mo ' : '');
        
        // To get the day, subtract it with years and
        // months and divide the resultant date into
        // total seconds in a days (60*60*24)
        $days = floor(($diff - $years * 365*60*60*24 -
            $months*30*60*60*24)/ (60*60*24));
        
        $returnStr .= (!empty($days) ? $days .' d ' : '');
        // To get the hour, subtract it with years,
        // months & seconds and divide the resultant
        // date into total seconds in a hours (60*60)
        $hours = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24)
            / (60*60));
        
        
        $returnStr .= (!empty($hours) ? $hours .' hr ' : '');
        // To get the minutes, subtract it with years,
        // months, seconds and hours and divide the
        // resultant date into total seconds i.e. 60
        $minutes = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24
            - $hours*60*60)/ 60);
        
        $returnStr .= (!empty($minutes) ? $minutes .' min ' : '');
        // To get the minutes, subtract it with years,
        // months, seconds, hours and minutes
//         $seconds = floor(($diff - $years * 365*60*60*24
//             - $months*30*60*60*24 - $days*60*60*24
//             - $hours*60*60 - $minutes*60));
        
        // Print the result
//         printf("%d years, %d months, %d days, %d hours, "
//             . "%d minutes, %d seconds", $years, $months,
//             $days, $hours, $minutes, $seconds);  
        return $returnStr;
    }

}

?>
