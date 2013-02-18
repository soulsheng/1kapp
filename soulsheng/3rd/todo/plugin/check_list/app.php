<?php
/*** 
TeamToy extenstion info block  
##name Checklist 
##folder_name check_list
##author Easy
##email Easychen@qq.com
##reversion 1
##desp 为TODO添加checklist，用于必要步骤和流程的检查。 
##update_url http://tt2net.sinaapp.com/?c=plugin&a=update_package&name=check_list 
##reverison_url http://tt2net.sinaapp.com/?c=plugin&a=latest_reversion&name=check_list 
***/

if( !mysql_query("SHOW COLUMNS FROM `checklist`",db()) )
{

	$sql = "CREATE TABLE IF NOT EXISTS `checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` varchar(255) NOT NULL,
  `timeline` datetime NOT NULL,
  `uid` int(11) NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT '0',
  `sub_tid` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	run_sql( $sql );
}

add_action( 'UI_TODO_DETAIL_COMMENTBOX_BEFORE' , 'check_list_area' );
function check_list_area( $data )
{
	echo render_html( $data , dirname(__FILE__) . DS .'view' . DS . 'check_list_area.tpl.html' );
}

add_action( 'UI_HEAD' , 'check_list_js' );
function check_list_js()
{
	echo '<script type="text/javascript" src="plugin/check_list/jquery-sortable-min.js"></script>';
}

add_action( 'PLUGIN_CHECKLIST_ADD' , 'plugin_checklist_add' );
function plugin_checklist_add()
{
	$text = z(t(v('text')));
	if( strlen( $text ) < 1 ) return render( array( 'code' => 100002 , 'message' => 'bad args' ) , 'rest' );

	$tid = intval(v('tid'));
	if( $tid < 1 ) return render( array( 'code' => 100002 , 'message' => 'bad args' ) , 'rest' );

	$params = array();
	$params['text'] = $text;
	$params['tid'] = $tid;

	if($content = send_request( 'checklist_add' ,  $params , token()  ))
	{
		$data = json_decode($content , 1);
		if( $data['err_code'] == 0 )
		{
			return render( array( 'code' => 0 , 'data' =>  
				array( 'html' => render_html( array( 'item' => $data['data'] ) , dirname(__FILE__) . DS .'view' . DS . 'check_list_item.tpl.html'  ) ) ) , 'rest' );
		}
		else
			return render( array( 'code' => 100002 , 'message' => 'can not save data' ) , 'rest' );
		//return render( array( 'code' => 0 , 'data' => $data['data'] ) , 'rest' );
	}

	return render( array( 'code' => 100001 , 'message' => 'can not get api content' ) , 'rest' );
}

add_action( 'PLUGIN_CHECKLIST_REORDER' , 'plugin_checklist_reorder' );
function plugin_checklist_reorder()
{
	$ord = z(t(v('ord')));
	if( strlen( $ord ) < 1 ) return render( array( 'code' => 100002 , 'message' => 'bad args' ) , 'rest' );

	$tid = intval(v('tid'));
	if( $tid < 1 ) return render( array( 'code' => 100002 , 'message' => 'bad args' ) , 'rest' );

	$params = array();
	$params['ord'] = $ord;
	$params['tid'] = $tid;

	if($content = send_request( 'checklist_reorder' ,  $params , token()  ))
	{
		$data = json_decode($content , 1);
		if( $data['err_code'] == 0 )
		{
			return render( array( 'code' => 0 , 'data' =>  $data['data'] ) , 'rest' );
		}
		else
			return render( array( 'code' => 100002 , 'message' => 'can not save data' ) , 'rest' );
		//return render( array( 'code' => 0 , 'data' => $data['data'] ) , 'rest' );
	}

	return render( array( 'code' => 100001 , 'message' => 'can not get api content' ) , 'rest' );
}

add_action( 'PLUGIN_CHECKLIST_DONE' , 'plugin_checklist_done' );
function plugin_checklist_done()
{
	return ck_request( 'done' );
}

add_action( 'PLUGIN_CHECKLIST_REOPEN' , 'plugin_checklist_reopen' );
function plugin_checklist_reopen()
{
	return ck_request( 'reopen' );
}

add_action( 'PLUGIN_CHECKLIST_REMOVE' , 'plugin_checklist_remove' );
function plugin_checklist_remove()
{
	return ck_request( 'remove' );
}

function ck_request( $type = 'done' )
{
	$ckid = intval(v('ckid'));
	if( $ckid < 1 ) return render( array( 'code' => 100002 , 'message' => 'bad args' ) , 'rest' );

	$params = array();
	$params['ckid'] = $ckid;

	if( $type == 'done' ) $action = 'checklist_done';
	if( $type == 'remove' ) $action = 'checklist_remove';
	if( $type == 'reopen' ) $action = 'checklist_reopen';

	if($content = send_request( $action ,  $params , token()  ))
	{
		$data = json_decode($content , 1);
		if( $data['err_code'] == 0 )
		{
			return render( array( 'code' => 0 , 'data' =>  $data['data'] ) , 'rest' );
		}
		else
			return render( array( 'code' => 100002 , 'message' => 'can not save data' ) , 'rest' );
		//return render( array( 'code' => 0 , 'data' => $data['data'] ) , 'rest' );
	}

	return render( array( 'code' => 100001 , 'message' => 'can not get api content' ) , 'rest' );
}


add_action( 'API_CHECKLIST_REORDER' , 'api_checklist_reorder' );
function api_checklist_reorder()
{
	$ordstring = z(t(v('ord')));
	$ords_array = explode( '|' , $ordstring );
	if( !is_array($ords_array) ) return apiController::send_error(  LR_API_ARGS_ERROR , 'ORDSTRING CAN\'T EMPTY' );
		
	$tid = intval(v('tid'));
	if( intval( $tid ) < 1 ) return apiController::send_error( LR_API_ARGS_ERROR , 'TID NOT EXISTS' );

	$i = 1;
	foreach( $ords_array as $item )
	{
		$sql = "UPDATE `checklist` SET `order` = '" . intval( $i ) . "' WHERE `tid` = '" . intval( $tid ) . "' AND `id` = '" . intval( $item ) . "' LIMIT 1 ";
		run_sql( $sql );
		$i++;
	}

	if( db_errno() != 0 )
		return apiController::send_error( LR_API_DB_ERROR , 'DATABASE ERROR ' . mysql_error() );
	else
		return apiController::send_result( array('msg'=>'ok') );


}


add_action( 'API_CHECKLIST_DONE' , 'api_checklist_done' );
function api_checklist_done()
{
	return ck_set( 'done');
}

add_action( 'API_CHECKLIST_REOPEN' , 'api_checklist_reopen' );
function api_checklist_reopen()
{
	return ck_set( 'reopen');
}

add_action( 'API_CHECKLIST_REMOVE' , 'api_checklist_remove' );
function api_checklist_remove()
{
	return ck_set( 'remove');
}

function ck_set( $type = 'done' )
{
	$ckid = intval(v('ckid'));
	if( intval( $ckid ) < 1 ) return apiController::send_error( LR_API_ARGS_ERROR , 'CKID NOT EXISTS' );

	// check user
	$ckinfo = get_line( "SELECT * FROM `checklist` WHERE `id` = '" . intval( $ckid ) . "' LIMIT 1" );
	if( uid() != $ckinfo['uid'] )
		return apiController::send_error( LR_API_FORBIDDEN , 'ONLY OWNER CAN REMOVE ' );

	if( $type == 'done' )
		$sql = "UPDATE `checklist` SET `is_done` = 1 WHERE `uid` = '" . intval(uid()) . "' AND `id` = '" . intval( $ckid ) . "' LIMIT 1";
	
	if( $type == 'reopen' )
		$sql = "UPDATE `checklist` SET `is_done` = 0 WHERE `uid` = '" . intval(uid()) . "' AND `id` = '" . intval( $ckid ) . "' LIMIT 1";
	
	if( $type == 'remove' )
		$sql = "DELETE FROM `checklist` WHERE `uid` = '" . intval(uid()) . "' AND `id` = '" . intval( $ckid ) . "' LIMIT 1";
	
//$sql = "DELETE FROM `checklist` WHERE `uid` = '" . intval(uid()) . "' AND `id` = '" . intval( $ckid ) . "' LIMIT 1";
	run_sql( $sql );

	if( db_errno() != 0 )
		return apiController::send_error( LR_API_DB_ERROR , 'DATABASE ERROR ' . mysql_error() );
	else
		return apiController::send_result( $ckinfo ); 
}






add_action( 'API_CHECKLIST_ADD' , 'api_checklist_add' );
function api_checklist_add()
{
	$content = z(t(v('text')));
	if( !not_empty($content) ) return apiController::send_error(  LR_API_ARGS_ERROR , 'TEXT CAN\'T EMPTY' );
		
	$tid = intval(v('tid'));
	if( intval( $tid ) < 1 ) return apiController::send_error( LR_API_ARGS_ERROR , 'TID NOT EXISTS' );

	// check user
	$tinfo = get_todo_info_by_id( $tid );
	if( (intval($tinfo['details']['is_public']) == 0) && (uid() != $tinfo['owner_uid']) )
		return apiController::send_error( LR_API_FORBIDDEN , 'ONLY PUBLIC TODO CAN ADD CHECKLIST BY OTHERS' );

	$sql = "INSERT INTO `checklist` ( `tid` , `title` , `content` , `timeline` , `uid` ) VALUES ( '" 
		. intval($tid) . "' , '" . s($content) . "' , '" . s($content) . "'  , NOW() , '" . intval(uid()) . "' ) ";

	run_sql( $sql );

	if( db_errno() != 0 )
		return apiController::send_error( LR_API_DB_ERROR , 'DATABASE ERROR ' . mysql_error() );
	else
		return apiController::send_result( get_line("SELECT * FROM `checklist` WHERE `id` = '" . intval(last_id()) . "' LIMIT 1" , db()) ); 

}

// 为user profile 接口追加css数据
add_filter( 'API_TODO_DETAIL_OUTPUT_FILTER' , 'api_check_list_detail' );
function api_check_list_detail( $data )
{
	$tid = intval($data['tid']);
	$data['checklists'] = get_data("SELECT * FROM `checklist` WHERE `tid` = '" . intval($tid) . "' ORDER BY `order` DESC , `id` ASC LIMIT 100");
	return $data;
}