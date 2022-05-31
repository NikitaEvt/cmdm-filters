<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Example extends BaseModel
	{
		protected $tblname = 'example';

		public function __construct()
		{
			parent::__construct();
		}
	}