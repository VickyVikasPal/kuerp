<?php
namespace App\Common;
use App\Common\SequenceGenerator;
use DB;
use Auth;
use App\Common\Datetime\TimeDate;

class Utils
{
/**
 * determines if a passed string matches the criteria for a Sugar GUID
 * @param string $guid
 * @return bool False on failure
 */
public function is_guid($guid){
	if(strlen($guid) != 36) {
		return false;
	}

	if(preg_match("/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/i", $guid)) {
		return true;
	}

	return true;;
}
/**
 * A temporary method of generating GUIDs of the correct format for our DB.
 * @return String contianing a GUID in the format: aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee
 *
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 */
public static function create_guid(){
	$microTime = microtime();
	list($a_dec, $a_sec) = explode(" ", $microTime);

	$dec_hex = dechex($a_dec* 1000000);
	$sec_hex = dechex($a_sec);

	self::ensure_length($dec_hex, 5);
	self::ensure_length($sec_hex, 6);

	$guid = "";
	$guid .= $dec_hex;
	$guid .= self::create_guid_section(3);
	$guid .= '-';
	$guid .= self::create_guid_section(4);
	$guid .= '-';
	$guid .= self::create_guid_section(4);
	$guid .= '-';
	$guid .= self::create_guid_section(4);
	$guid .= '-';
	$guid .= $sec_hex;
	$guid .= self::create_guid_section(6);

	return substr($guid, 0, 36);

}

public static function create_guid_section($characters){
	$return = "";
	for($i=0; $i<$characters; $i++)
	{
		$return .= dechex(mt_rand(0,15));
	}
	return $return;
}

public static function ensure_length(&$string, $length){
	$strlen = strlen($string);
	if($strlen < $length)
	{
		$string = str_pad($string,$length,"0");
	}
	else if($strlen > $length)
	{
		$string = substr($string, 0, $length);
	}
}


function autoGenerateKey($options=array()){
	//add unique visual number value
	$datetime = new TimeDate();
	$user = Auth::user();
	
	if(isset($options['tableName']) && isset($options['dateField'])){
		
		$return_val = '';
		$current_date = $datetime->get_gmt_db_datetime();

		$seq_master_data = DB::table('master_sequences')->where('sequence_type', $options['tableName'])->where('branch_id', $user->branch_id)->where('deleted', 0)->select('id', 'sequence_type', 'prefix', 'period', 'seq_no', 'field_name', 'date_field', 'period_format')->orderBy('date_entered', 'desc')->limit(1)->get();

		$masterPeriod = "";
		
		foreach ($seq_master_data as $key => $value) {
			
			$masterPeriod = '';
				if($value->period == 'Y'){
					$format = date("Y", strtotime($options['dateField']));
				}elseif ($value->period == 'YM') {
					$format = date("Ym", strtotime($options['dateField']));
				}elseif ($value->period == 'YMD') {
					$format = date("Ymd", strtotime($options['dateField']));
				}
				$masterPeriod = $format;
		}
		
		$seq_data = DB::table('sequences')->where('sequence_type', $options['tableName'])->where('branch_id', $user->branch_id)->where('deleted', 0)->where('period_format', $masterPeriod)->select('id', 'sequence_type', 'prefix', 'period', 'seq_no', 'field_name', 'date_field', 'period_format')->orderBy('date_entered', 'desc')->limit(1)->get();

		if(count($seq_data) > 0){

			foreach ($seq_data as $key => $value) {
				$seq_no = $value->seq_no + 1;
				$format = '';
				if($value->period == 'Y'){
					$format = date("Y", strtotime($options['dateField']));
				}elseif ($value->period == 'YM') {
					$format = date("Ym", strtotime($options['dateField']));
				}elseif ($value->period == 'YMD') {
					$format = date("Ymd", strtotime($options['dateField']));
				}
				$seq_format = $format;
				if($seq_format == $value->period_format){

					$seq_prefix = $value->prefix;

					$return_val = $seq_format.$seq_no;

					DB::table('sequences')
						->where('id',$value->id)
						->update(array(
									'date_modified'=>$current_date,
									'modified_user_id' => $user->id,
									'sequence_type'=>$value->sequence_type,
									'period'=>$value->period,
									'seq_no'=>$seq_no,
									'branch_id'=>$user->branch_id,
									'field_name'=>$value->field_name,
									'prefix'=>$value->prefix,
									'date_field'=>$value->date_field,
									'period_format'=>$seq_format,
									));

				}else{

					DB::table('sequences')
						->where('id',$value->id)
						->update(array(
									'deleted'=>1,
									));

					$return_val = self::generateKey($options);
				}
				
			}
			
		}else{
			$return_val = self::generateKey($options);
		}
		
		return $return_val;
		
	}
	

}

function generateKey($options=array()){
	$datetime = new TimeDate();
	$user = Auth::user();
	$return_val = 0;
	
	$current_date = $datetime->get_gmt_db_datetime();
	$seq_master_data = DB::table('master_sequences')->where('sequence_type', $options['tableName'])->where('branch_id', $user->branch_id)->where('deleted', 0)->select('id', 'sequence_type', 'prefix', 'period', 'seq_no', 'field_name', 'date_field', 'period_format')->orderBy('date_entered', 'desc')->limit(1)->get();
			
			foreach ($seq_master_data as $key => $value) {
				$seq_no = $value->seq_no;
				
				$format = '';
				
				if($value->period == 'Y'){
					$format = date("Y", strtotime($options['dateField']));
				}elseif ($value->period == 'YM') {
					$format = date("Ym", strtotime($options['dateField']));
					
				}elseif ($value->period == 'YMD') {
					$format = date("Ymd", strtotime($options['dateField']));
				}
				
				$seq_format = $format;
			
				if($seq_format == $value->period_format){
				$seq_prefix = $value->prefix;
				
				$return_val = $seq_format.$seq_no;
			//	echo self::create_guid();
				DB::table('sequences')
						->insert(array(
						'id' => self::create_guid(),
						'date_entered'=>$current_date,
						'date_modified'=>$current_date,
						'created_by' => $user->id,
						'modified_user_id' => $user->id,
						'sequence_type'=>$value->sequence_type,
						'period'=>$value->period,
						'seq_no'=>$seq_no,
						'branch_id'=>$user->branch_id,
						'field_name'=>$value->field_name,
						'prefix'=>$value->prefix,
						'date_field'=>$value->date_field,
						'period_format'=>$seq_format,
						));
					}else{

						$return_val = $seq_format.$seq_no;

						DB::table('sequences')
						->insert(array(
						'id' => self::create_guid(),
						'date_entered'=>$current_date,
						'date_modified'=>$current_date,
						'created_by' => $user->id,
						'modified_user_id' => $user->id,
						'sequence_type'=>$value->sequence_type,
						'period'=>$value->period,
						'seq_no'=>$seq_no,
						'branch_id'=>$user->branch_id,
						'field_name'=>$value->field_name,
						'prefix'=>$value->prefix,
						'date_field'=>$value->date_field,
						'period_format'=>$seq_format,
						));

					}
			}
		return $return_val;	
	}

	public function autoGeneratePrefix($options=array())
	{
		$datetime = new TimeDate();
	$user = Auth::user();
	$return_val = "";
	$current_date = $datetime->get_gmt_db_datetime();
	$seq_master_data = DB::table('master_sequences')->where('sequence_type', $options['tableName'])->where('branch_id', $user->branch_id)->where('deleted', 0)->select('id', 'prefix')->orderBy('date_entered', 'desc')->limit(1)->get();
		foreach ($seq_master_data as $key => $value) {
			$return_val = $value->prefix;
		}

		return $return_val;
	}

}
?>