<?php defined('_JEXEC') or die;

/**
 * File       plg_whatismyip.php
 * Created    1/8/15 12:02 AM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2015 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v2 or later
 */
class plgSystemWhatismyip extends JPlugin
{
	/**
	 * Constructor.
	 *
	 * @param   object &$subject The object to observe
	 * @param   array  $config   An optional associative array of configuration settings.
	 *
	 * @since   0.1
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
		$this->app = JFactory::getApplication();
	}

	/**
	 * Event triggered after the framework has loaded and the application initialise method has been called.
	 *
	 * @return bool
	 */
	function onAfterInitialise()
	{

		if (JFactory::getApplication()->input->get('whatismyip'))
		{

			$client  = @$_SERVER['HTTP_CLIENT_IP'];
			$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
			$remote  = $_SERVER['REMOTE_ADDR'];

			if (filter_var($client, FILTER_VALIDATE_IP))
			{
				$ip = $client;
			}
			elseif (filter_var($forward, FILTER_VALIDATE_IP))
			{
				$ip = $forward;
			}
			else
			{
				$ip = $remote;
			}

			echo '<pre>' . print_r($ip, true) . '</pre>';
		}

		return true;
	}
}