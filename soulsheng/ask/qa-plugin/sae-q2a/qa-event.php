<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net     
 * Created  Feb 16, 2012
 *
 *
 */
 class SAE_QA_Event{
 	
 	public function process_event($event, $userid, $handle, $cookieid, $params){
 		$this->trigger_clear_page_cache($event, $params);
 		
 	}
 	
 	//根据不同事件，完成网页缓存的清理工作
 	private function trigger_clear_page_cache($event, $params){
 		$keys = '';
 		switch($event){
 			case 'q_post' :
 				$keys = get_list_page_uri('post');
 				break;
 			case 'a_select' :
 			case 'a_unselect':
 			case 'a_flag':
 			case 'a_post' :
 			case 'a_hide':
 			case 'a_reshow':
 			case 'a_approve':
 			case 'a_reject':
 			case 'a_delete':
 			case 'a_claim':
 				$keys = get_question_page_cache_key($params['parentid']);
 				break;
 			case 'q_edit' :
 			case 'q_unflag':
 			case 'q_flag':
 			case 'q_clearflags':
 			case 'q_claim':
 				$keys = get_question_page_cache_key($params['postid']);
 				break;
 			case 'c_edit' :
 			case 'c_flag':
 			case 'a_edit' :
 			case 'c_post' :
 			case 'c_hide' :
 			case 'c_reshow':
 			case 'c_approve':
 			case 'c_reject':
 			case 'c_delete':
 			case 'a_to_c':
 				$keys = get_question_page_cache_key($params['questionid']);
 				break;
 			case 'q_close' :
			case 'q_reopen' :
			case 'q_reshow':
			case 'q_hide':
			case 'q_approve':
			case 'q_reject':
			case 'q_delete':
			case 'q_move':
			case 'q_vote_up':
			case 'q_vote_down':
			case 'q_vote_nil':
 				$keys = get_list_page_uri('post');
 				$keys[] = get_question_page_cache_key($params['postid']);
 				break;	
 			case 'a_unflag':
 			case 'c_unflag':
 			case 'a_clearflags':
 			case 'c_clearflags':
 			case 'c_claim':
 			case 'a_vote_down':
 			case 'a_vote_nil':
 			case 'a_vote_up':
 				$post=qa_db_single_select(qa_db_full_post_selectspec(null, $params['postid']));
 				if(is_array($post) && isset($post['postid']) && $post['basetype'] == 'Q'){
 					$keys = get_question_page_cache_key($post['postid']);
 				}
 				break;
 		}
 		$keys && $this-> clear_page_cache($keys);
 	}
 	
 	//删除页面缓存
 	private function clear_page_cache($keys){
 		if(is_string($keys)){
 			mset($keys, '');
 		}
 		if(is_array($keys)){
 			foreach($keys as $key){
 				mset($key, '');
 			}
 		}
 	}
 }
?>
