<?php

/**
 * Implementation of Invision Power Board converter.
 */
class Invision extends BBP_Converter_Base
{
	function __construct()
	{
		parent::__construct();
		$this->setup_globals();
	}

	public function setup_globals()
	{
		/** Forum Section ******************************************************/

		// Forum id. Stored in postmeta.
		$this->field_map[] = array(
			'from_tablename' => 'forums', 'from_fieldname' => 'id',
			'to_type' => 'forum', 'to_fieldname' => '_bbp_forum_id'
		);
		
		// Forum parent id.  If no parent, than 0. Stored in postmeta.
		$this->field_map[] = array(
			'from_tablename' => 'forums', 'from_fieldname' => 'parent_id',
			'to_type' => 'forum', 'to_fieldname' => '_bbp_parent_id'
		);
		
		// Forum title.
		$this->field_map[] = array(
			'from_tablename' => 'forums', 'from_fieldname' => 'name',
			'to_type' => 'forum', 'to_fieldname' => 'post_title'
		);
		
		// Forum slug. Clean name.
		$this->field_map[] = array(
			'from_tablename' => 'forums', 'from_fieldname' => 'name',
			'to_type' => 'forum', 'to_fieldname' => 'post_name',
			'callback_method' => 'callback_slug'
		);
		
		// Forum description.
		$this->field_map[] = array(
			'from_tablename' => 'forums', 'from_fieldname' => 'description',
			'to_type' => 'forum', 'to_fieldname' => 'post_content',
			'callback_method' => 'callback_null'
		);
		
		// Forum display order.  Starts from 1.
		$this->field_map[] = array(
			'from_tablename' => 'forums', 'f