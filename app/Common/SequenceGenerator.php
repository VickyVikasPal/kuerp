<?php
/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd.
* Copyright Softdev Infotech Pvt. Ltd. 2010
*********************************************************************************/

namespace App\Common;

/**
 * This Class will help in reducing error caused because of include
 * also will give current sequence an object oriented approach
 * 
 * @author vinay
 *  */
class SequenceGenerator
{
	
    /**
	 * This function will be called to generate Sequences
	 * @param String $identifier module name
	 * @param date $generate_date display date format
	 * @param array $options additional options if required
	 *
	 *
	 * @return String code generated by this function
	 *   */
    
    
	public static function generate($identifier, $generate_date = null, $options = array())
	{
		global $db, $timedate, $current_user;
		global $heal_config;
		/* echo $generate_date;
		echo '<pre>';
		print_R($options);
		print_R($identifier);exit;
		 */
		/* //Added for the kiosk Patient to assign user id of healysta
	   if(isset($_REQUEST['method']) && $_REQUEST['method']=='add_kioskpatient' && ($current_user->id=='')){
		      $qry="SELECT id,branch_id FROM users WHERE user_name='healysta' AND user_hash='cc03e747a6afbbcbf8be7668acfebee5' AND deleted=0 AND branch_id='9197651b-e2b9-1924-b931-54f13cfc31c0'";
		    
		    $result1 =$GLOBALS['db']->limitQuery($qry,0,1,false);
		    $row1 = $GLOBALS['db']->fetchByAssoc($result1);
		    
		    
		    $current_user->id=$row1['id'];
		    $current_user->branch_id=$row1['branch_id'];
		    
		}   */
		
		
		$date = $timedate->to_display_date($timedate->get_gmt_db_datetime());
		
		$date_created = $timedate->get_gmt_db_datetime();
		
		if ($generate_date){
			$date = $generate_date;
		}
	
		if (isset($date)&&!empty($date)){
				
			if(isset($options['period']) && in_array($options['period'], array('Y','YM','YMD')))
			{
				$syear = date('Y', strtotime($timedate->to_db_date($date,false)));
			}
			else{
				$syear = "";
			}
			
			if(isset($options['period']) && in_array($options['period'], array('YM','YMD')))
			{
				$smonth = date('m', strtotime($timedate->to_db_date($date,false)));
			}
			else{
				$smonth = "";
			}
				
			if(isset($options['period']) && in_array($options['period'], array('YMD')))
			{
				$sday = date('d', strtotime($timedate->to_db_date($date,false)));
			}
			else{
				$sday = "";
			}
				
		}
		
		$period = $syear. $smonth. $sday;
	
		if (isset($options['period']) && !in_array($options['period'], array(false, 'Y', 'YM', 'YMD'))){
			$period = $options['period'];
		}
		
		if(!empty($current_user->branch_id))
		$where = "sequence_type='" .$identifier. "' and period='" .$period. "' AND branch_id = '{$current_user->branch_id}' AND deleted='0' ";
		else
		$where = "sequence_type='" .$identifier. "' and period='" .$period. "' AND branch_id IS NULL AND deleted='0' ";
				
		$seq_name = $identifier;
	
		if($heal_config['dbconfig']['db_type']== "mysql"){
			$lurser =" LOCK TABLE sequences WRITE";
			$lresult=$db->query($lurser);
		}
		
		$squery = "select id, seq_no from sequences where ".$where;
	
	
	
		$sresult = $db->query($squery);
		$srow = $db->fetchByAssoc($sresult);
		$rcnt = 0;
		if ($srow != null){
			$sdata_set[] = $srow;
			$uquery = "UPDATE sequences SET date_modified= '$date_created', modified_user_id = '$current_user->id', seq_no = seq_no+1 where id='".$sdata_set[$rcnt]['id']."'";
			$uresult = $db->query($uquery);
			$myseq =  $sdata_set[$rcnt]['seq_no'] + 1;
			//     $category_code='';
		}
		else
		{
				
			$seq_no = 1;
			if (isset($options['sequence'])){
				$seq_no = $options['sequence'];
			}
			$myseq =  $seq_no;
			
			
			$iquery = "INSERT INTO sequences(id,name,date_entered,date_modified,modified_user_id,created_by,sequence_type,seq_no,period,deleted,branch_id) VALUES ('".create_guid()."','$seq_name','$date_created','$date_created','$current_user->id','$current_user->id','$identifier',$seq_no,'$period',0,'$current_user->branch_id') ";
						
			$iresult = $db->query($iquery);
				
		}
		if($heal_config['dbconfig']['db_type']== "mysql"){
			$lurser =" UNLOCK TABLES";
			$lresult=$db->query($lurser);
		}
		
		$return = "$period"."$myseq";
	
		return "$return";
	
	}
		
}

