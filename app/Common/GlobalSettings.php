<?php

/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd. * Copyright Softdev Infotech Pvt. Ltd. 2010 * Developed By VK *********************************************************************************/

namespace App\Common;
use App\Common\Datetime\TimeDate;
use App\Common\SoftdevLog;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Common\DBManager\DBManagerFactory;
use Illuminate\Support\Facades\Cache;
use App\Models\GlobalSettings as GlobalModal;



class GlobalSettings
{
	use SoftdevLog;

	public static function getConfig($key = "", $fields = array())
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->getConfig()');
		//	$global_settings = Session::get('global_settings')->toArray();
		try
		{
			$global_settings = self::getCache('global_settings');
			if (empty($global_settings))
			{
				$global_settings = self::getAllConfigs();
			}
			//print_r($global_settings);die;
			if (!empty($global_settings))
			{
				foreach ($global_settings as $keys => $value)
				{

					if (isset($value['name']) && $value['name'] == $key)
					{
						$field = 'status';
						if (is_array($fields) && !empty($fields))
						{
							$field = $field . ', ' . implode(', ', $fields);
						}
						if ($field == 'status')
						{
							$instance->LogInfo('End: app->common->GlobalSettings->getConfig()');

							return (empty($value) && !isset($value[$field])) ? "" : $value[$field];
						}
						else
						{
							$instance->LogInfo('End: app->common->GlobalSettings->getConfig()');

							return $value[$key];
						}
					}
				}
				$instance->LogInfo('End: app->common->GlobalSettings->getConfig()');
			}
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->getConfig()', ['error' => $e->getMessage()]);

			return false;
		}
	}

	public static function getStatusNumber($key = "")
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->getStatusNumber()');
		try
		{
			global $global_settings;
			if ($key != "" && isset($global_settings[$key]))
			{
				$instance->LogInfo('End: app->common->GlobalSettings->getStatusNumber()');

				return (empty($global_settings) && !isset($global_settings[$key]["status_number"])) ? "" : $global_settings[$key]['status_number'];
			}

			$instance->LogInfo('End: app->common->GlobalSettings->getStatusNumber()');

			return false;
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->getStatusNumber()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}
	}

	public static function setConfig($key = "", $column = "", $value = "")
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->setConfig()');
		try
		{
			//global $db, $global_settings;global $current_user,$timedate;
			$global_settings = Cache::get('global_settings');
			$current_user = Auth::user();
			$timedate = new TimeDate();

			$current_datetime = $timedate->get_gmt_db_datetime();
			if ($key != "" && $column != "")
			{
				if (empty($db))
					$db = DBManagerFactory::getInstance();
				if ($column != 'other_configs')
				{

					//$q = "UPDATE global_settings SET $column = '{$value}',date_modified = '{$current_datetime}' WHERE name='{$key}' AND deleted=0";
					if (!empty($current_user->branch_id))
						//$q .= " AND branch_id = '$current_user->branch_id'";
						$branchid = $current_user->branch_id;
					else
						//$q .= " AND branch_id IS NULL";
						$branchid = 'NULL';

					//$r = $db::query($q);
					$r = $db::table('global_settings')->where('name', $key)->where('deleted', 0)->where('branch_id', $branchid)->update(array($column => $value, 'date_modified' => $current_datetime));
					;

				}
				else
				{
					//oracle clob type cannot inserrt more than 4000 character at one time

					$val = str_split($value, 3999);

					if (isset($val[0]))
					{
						$q = "UPDATE global_settings SET $column = '{$val[0]}',date_modified = '{$current_datetime}' WHERE name='{$key}'  AND deleted=0";
					}
					else
					{
						$q = "UPDATE global_settings SET $column = '{$value}',date_modified = '{$current_datetime}' WHERE name='{$key}'  AND deleted=0";
					}
					if (!empty($current_user->branch_id))
						$q .= " AND branch_id = '$current_user->branch_id'";
					else
						$q .= " AND branch_id IS NULL"; // 				echo $q.'.....................................';

					$r = $db::query($q);

					if (is_array($val) && count($val) > 1)
					{
						$c = count($val);
						for ($i = 1; $i < $c; $i++)
						{
							//$column = $column || '{$val[$i]}'
							$qU = "UPDATE global_settings SET $column=" . db_append('global_settings', array($column, array('type' => 'literal', 'value' => $val[$i]))) . ",date_modified = '{$current_datetime}' WHERE name='{$key}'  AND deleted=0";
							if (!empty($current_user->branch_id))
								$qU .= " AND branch_id = '$current_user->branch_id'";
							else
								$qU .= " AND branch_id IS NULL";

							$GLOBALS['log']->info("Update: " . $qU);
							$db::query($qU, true);
						}
					}
				}



				if ($r)
				{
					if ($key == 'Sequences')
					{
						$global_settings = self::getAllConfigs();
					}
					else
					{

					//$global_settings[$key][$column] = $value;

					}
				}
				else
				{
					$global_settings = self::getAllConfigs();
				}

				if ($key == 'Close_Bed_Charges' && $value == 'No' && !empty($current_user->branch_id))
				{

					$db->query("UPDATE admissionlocs SET last_bill_date = '{$current_datetime}' WHERE status = 'Discharged' AND branch_id = '$current_user->branch_id' ");

				}
				$instance->LogInfo('End: app->common->GlobalSettings->setConfig()');
				
				return $r;
			}

			$instance->LogInfo('End: app->common->GlobalSettings->setConfig()');

			return false;
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->setConfig()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}
	}



	public static function getCache($key)
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->getCache()');

		try
		{
			$current_user = Auth::user();

			$instance->LogInfo('End: app->common->GlobalSettings->getCache()');

			return Cache::get($key . $current_user->branch_id);
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->getCache()', ['error' => $e->getMessage()]);

			return false;
		}
	}

	public static function getAllConfigs()
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->getAllConfigs()');
		try
		{
			$db;
			$current_user = Auth::user();
			if (empty($db))
				$db = DBManagerFactory::getInstance();
			//	$GLOBALS['log']->fatal("fromglobalse");
			//	$GLOBALS['log']->fatal(print_r($_REQUEST,true));
			if (isset($_REQUEST['method']) && $_REQUEST['method'] == 'register_online_opd' && ($current_user->id == ''))
			{
				$qry = "SELECT id,branch_id FROM users WHERE user_name='admin.ether' AND user_hash='cc03e747a6afbbcbf8be7668acfebee5' AND deleted=0 AND branch_id='9197651b-e2b9-1924-b931-54f13cfc31c0'";
				$result1 = $GLOBALS['db']->limitQuery($qry, 0, 1, false);
				$row1 = $GLOBALS['db']->fetchByAssoc($result1);
				$current_user->retrieve($row1['id']);

			}
			else if (isset($_REQUEST['method']) && $_REQUEST['method'] == 'add_kioskpatient' && ($current_user->id == ''))
			{
				$qry = "SELECT id,branch_id FROM users WHERE user_name='healysta'  AND deleted=0 AND branch_id='9197651b-e2b9-1924-b931-54f13cfc31c0'";
				$result1 = $GLOBALS['db']->limitQuery($qry, 0, 1, false);
				$row1 = $GLOBALS['db']->fetchByAssoc($result1);
				$current_user->retrieve($row1['id']);

			}

			if (isset($current_user->branch_id) && !empty($current_user->branch_id))
				$q = "SELECT * FROM global_settings WHERE branch_id = '$current_user->branch_id' AND deleted=0 ";
			else
				$q = "SELECT * FROM global_settings WHERE deleted=0 AND branch_id IS NULL ";

			$r = $db::select($q);
			$a = array();
			if (count($r) > 0)
			{

				foreach ($r as $row)
				{

					if ($row->name == 'Sequences')
					{
						$vids = json_decode(str_replace('&quot;', '"', $row->other_configs), true);
						$other_configs = array();
						foreach ($vids as $vid)
						{
							if (isset($vid['module_name']))
								$other_configs[$vid['module_name']][] = $vid;
						}
						$row->configs = $other_configs;
						$row->other_configs = json_decode(str_replace('&quot;', '"', $row->other_configs), true);
					}

					$a[$row->name] = $row;
				}

				/* Cache::remember('global_settings', 100000, function () {
				 $user = Auth::user();
				 return GlobalModal::where('deleted', 0)->where('branch_id', $user->branch_id)->select('id', 'name', 'status_number', 'status')->get()->toArray();
				 }); */

				Cache::remember('global_settings' . $current_user->branch_id, 100000, function () {
					$user = Auth::user();
					return GlobalModal::where('deleted', 0)->where('branch_id', $user->branch_id)->select('id', 'name', 'status_number', 'status')->get()->toArray();
				});
				$instance->LogInfo('End: app->common->GlobalSettings->getAllConfigs()');
			//return $a;
			}
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->getAllConfigs()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}
	}
	/**
	 * Create New Config in System if not exist
	 * 
	 * @param String $key
	 * @param Array $values  */
	public static function createConfig($name, $values = array())
	{

		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->createConfig()');

		try
		{

			global $db, $global_settings, $current_user;

			//check if key exists or not
			if ($name != "" && !self::getConfig($name))
			{

				if (empty($db))
					$db = DBManagerFactory::getInstance();
				$q = "INSERT INTO global_settings ";

				$q .= " ( ";

				$id = create_guid();
				$curr_date = date('Y-m-d H:i:s');
				$q .= " id, name, date_entered, date_modified, deleted ,branch_id ";
				$val = "'$id', '$name', '$curr_date', '$curr_date', '0','$current_user->branch_id', ";

				foreach ($values as $key => $value)
				{
					$q .= ", " . $key;
					$val .= "'$value', ";
				}
				$val = rtrim($val, ', ');

				$q .= ") VALUES ($val)";

				$r = $db->query($q);

				if ($r)
				{
					$global_settings = self::getAllConfigs();
				}
				$instance->LogInfo('End: app->common->GlobalSettings->createConfig()');
				return $r;
			}
			$instance->LogInfo('End: app->common->GlobalSettings->createConfig()');
			return false;
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->createConfig()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}
	}

	/**
	 * Function to check whether night charges should be applicable for current timestamp or not
	 * @param $current_t  datetime Current DB datetime
	 * @return 0 or 1  */
	public static function getTimingsCheck($current_t = null)
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->getTimingsCheck()');

		try
		{

			if (self::getConfig('Night_Charges') == 'Enabled')
			{
				global $timedate;

				if ($current_t == null)
				{
					$current_t = $timedate->get_gmt_db_datetime();
				}

				$timings = explode(',', GlobalSettings::getConfig('Night_Charges_Timings'));
				if (isset($timings[1]))
				{ //print_r($timings);
					$from_time = $timedate->get_gmt_db_date() . ' ' . $timings[0];
					$from_time = $timedate->handle_offset($from_time, $timedate->get_db_date_time_format(), false);
					if (strtotime($current_t) <= strtotime($from_time . ' +' . $timings[1] . ' hours')
					&& strtotime($current_t) >= strtotime($from_time)
					)
					{
						$instance->LogInfo('End: app->common->GlobalSettings->getTimingsCheck()');
						return 1;
					}
				}
			}
			$instance->LogInfo('End: app->common->GlobalSettings->getTimingsCheck()');
			return 0;
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->getTimingsCheck()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}
	}


	public static function checkBillCancel()
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->checkBillCancel()');

		try
		{

			global $current_user;
			//check global permissions
			$BillCancel = self::getConfig('BillCancel', array('other_configs'));
			$globalDiscount = json_decode(str_replace('&quot;', '"', $BillCancel['other_configs']), true);
			if (!is_admin($current_user) && $BillCancel['status'] == 'Enabled')
			{

				$has_permission = false;

				foreach ($globalDiscount as $userType)
				{
					if (in_array($userType, $current_user->user_type))
					{
						$has_permission = true;
					}
				}

				$instance->LogInfo('End: app->common->GlobalSettings->checkBillCancel()');

				return $has_permission;


			}

			$instance->LogInfo('End: app->common->GlobalSettings->checkBillCancel()');

			return true;
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->checkBillCancel()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}
	}
	public static function checkPatientDiscount()
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->checkPatientDiscount()');

		try
		{

			global $current_user;
			//check global permissions
			$patientDiscount = self::getConfig('PatientDiscount', array('other_configs'));
			$globalDiscount = json_decode(str_replace('&quot;', '"', $patientDiscount['other_configs']), true);
			if (!is_admin($current_user) && $patientDiscount['status'] == 'Enabled')
			{

				$has_permission = false;

				foreach ($globalDiscount as $userType)
				{
					if (in_array($userType, $current_user->user_type))
					{
						$has_permission = true;
					}
				}

				$instance->LogInfo('End: app->common->GlobalSettings->checkPatientDiscount()');

				return $has_permission;


			}

			$instance->LogInfo('End: app->common->GlobalSettings->checkPatientDiscount()');

			return true;
		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->checkPatientDiscount()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}
	}

	public static function getApprovalByPass($module)
	{
		$instance = new self();

		$instance->LogInfo('Begin: app->common->GlobalSettings->getApprovalByPass()');

		try
		{

			global $db;


			$row = self::getConfig('BypassApproval', array('other_configs'));
			/* $query = "SELECT other_configs FROM global_settings WHERE name = 'BypassApproval' AND deleted = 0 ";
			 $result = $db->query($query);
			 $row = $db->fetchByAssoc($result); */
			$approval_info = json_decode(str_replace('&quot;', '"', $row['other_configs']), true);
			$output = 'Disabled';


			if (is_array($approval_info) && isset($approval_info[$module]))
			{
				$output = $approval_info[$module];
			}

			$instance->LogInfo('End: app->common->GlobalSettings->getApprovalByPass()');

			if ($output === 'Enabled')
				return true;
			else
				return false;
				

		}
		catch (\Throwable $e)
		{
			// Log a critical error message
			$instance->LogCritical('Failed: app->common->GlobalSettings->getApprovalByPass()', ['error' => $e->getMessage()]);

			return response()->json(['message' => 'Failed to get data'], 500);
		}

	}

}
