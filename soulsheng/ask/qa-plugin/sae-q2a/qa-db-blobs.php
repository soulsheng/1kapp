<?php
/*
 * 使用文件存储这类数据
 * @author Tomheng
 * @date  2012-2-17
 */

/*
 Create a new blob in the database with $content and $format, returning its blobid
 */
function qa_db_blob_create($content, $format, $filename=null, $userid=null, $cookieid=null, $ip=null){
	if(preg_match('/jpeg|jpg|jpe|gif|png/i', $format) && defined('IMG_DOMAIN')){
		$filename = '';
		return Storage::write(IMG_DOMAIN, $filename, $content, -1,  array('Content-Type' => 'image/jpeg', 'encoding' => 'gzip'), TRUE);
	}
	return qa_db_blob_create_base($content, $format, $filename, $userid, $cookieid, $ip);
}

/*
 Get the content of blob $blobid from the database
 */
function qa_db_blob_read($blobid){
	return qa_db_read_one_assoc(qa_db_query_sub(
			'SELECT content, format, filename FROM ^blobs WHERE blobid=#',
	$blobid
	), true);
}

/*
 Delete blob $blobid in the database
 */
function qa_db_blob_delete($blobid){
	qa_db_query_sub(
			'DELETE FROM ^blobs WHERE blobid=#',
	$blobid
	);
}

/*
 Check if blob $blobid exists in the database
 */
function qa_db_blob_exists($blobid){
	return qa_db_read_one_value(qa_db_query_sub(
			'SELECT COUNT(*) FROM ^blobs WHERE blobid=#',
	$blobid
	)) > 0;
}