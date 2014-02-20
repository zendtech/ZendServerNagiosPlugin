<?php
return array (
		'nagios_threshold' => array(
				/*
				 * Cluster status
				 * Threshold based on the percentage of unavailable nodes
				 */
				'clusterstatus' => array (
						'0' => 'NAGIOS_OK',
						'1' => 'NAGIOS_WARNING',
						'33' => 'NAGIOS_CRITICAL' 
				),
				/*
				 * Notifications
				 * Threshold based on the inner notification severity level
				 */
				'notifications' => array (
						'0' => 'NAGIOS_OK',
						'1' => 'NAGIOS_WARNING',
						'2' => 'NAGIOS_CRITICAL' 
				),
				/*
				 * Licence validity
				 * Based on license status
				 */
				'license' => array (
						'TYPE_LICENSE_INVALID' => 'NAGIOS_CRITICAL',
						'TYPE_LICENSE_ABOUT_TO_EXPIRE' => 'NAGIOS_CRITICAL',
						'TYPE_LICENSE_ABOUT_TO_EXPIRE_15' => 'NAGIOS_CRITICAL',
						'TYPE_LICENSE_ABOUT_TO_EXPIRE_45' => 'NAGIOS_WARNING' 
				),
				/*
				 * Events
				 * Based on events severity status
				 */
				'events' => array (
						'Notice' => 'NAGIOS_WARNING',
						'Warning' => 'NAGIOS_WARNING',
						'Critical' => 'NAGIOS_CRITICAL' 
				),
				/*
				 * Audit Trail - Depending on audit type
				 */
				'audittrail' => array (
						'AUDIT_APPLICATION_DEPLOY' => 'NAGIOS_CRITICAL',
						'AUDIT_APPLICATION_REMOVE' => 'NAGIOS_CRITICAL',
						'AUDIT_APPLICATION_UPGRADE' => 'NAGIOS_CRITICAL',
						'AUDIT_APPLICATION_ROLLBACK' => 'NAGIOS_CRITICAL',
						'AUDIT_APPLICATION_REDEPLOY' => 'NAGIOS_CRITICAL',
						'AUDIT_APPLICATION_REDEPLOY_ALL' => 'NAGIOS_CRITICAL',
						'AUDIT_APPLICATION_DEFINE' => 'NAGIOS_CRITICAL',
						
						'AUDIT_DIRECTIVES_MODIFIED' => 'NAGIOS_CRITICAL',
						'AUDIT_EXTENSION_ENABLED' => 'NAGIOS_CRITICAL',
						'AUDIT_EXTENSION_DISABLED' => 'NAGIOS_CRITICAL',
						'AUDIT_RESTART_DAEMON' => 'NAGIOS_CRITICAL',
						'AUDIT_RESTART_PHP' => 'NAGIOS_CRITICAL',
						
						'AUDIT_GUI_AUTHENTICATION' => 'NAGIOS_WARNING',
						'AUDIT_GUI_CHANGE_AUTHENTICATION_SETTINGS' => 'NAGIOS_WARNING',
						'AUDIT_GUI_CHANGE_PASSWORD' => 'NAGIOS_WARNING',
						'AUDIT_GUI_AUTHORIZATION' => 'NAGIOS_WARNING',
						'AUDIT_GUI_AUTHENTICATION_LOGOUT' => 'NAGIOS_WARNING', // not used
						
						'AUDIT_GUI_AUDIT_SETTINGS_SAVE' => 'NAGIOS_WARNING',
						'AUDIT_GUI_BOOTSTRAP_CREATEDB' => 'NAGIOS_WARNING',
						'AUDIT_GUI_BOOTSTRAP_SAVELICENSE' => 'NAGIOS_WARNING',
						
						'AUDIT_SERVER_JOIN' => 'NAGIOS_CRITICAL',
						'AUDIT_SERVER_ADD' => 'NAGIOS_CRITICAL',
						'AUDIT_SERVER_DISABLE' => 'NAGIOS_CRITICAL',
						'AUDIT_SERVER_ENABLE' => 'NAGIOS_CRITICAL',
						'AUDIT_SERVER_REMOVE' => 'NAGIOS_CRITICAL',
						'AUDIT_SERVER_REMOVE_FORCE' => 'NAGIOS_CRITICAL',
						'AUDIT_SERVER_RENAME' => 'NAGIOS_CRITICAL',
						'AUDIT_SERVER_SETPASSWORD' => 'NAGIOS_CRITICAL', // not used
						
						'AUDIT_CODETRACING_CREATE' => 'NAGIOS_WARNING',
						'AUDIT_CODETRACING_DELETE' => 'NAGIOS_WARNING',
						'AUDIT_CODETRACING_DEVELOPER_ENABLE' => 'NAGIOS_WARNING',
						'AUDIT_CODETRACING_DEVELOPER_DISABLE' => 'NAGIOS_WARNING',
						
						'AUDIT_MONITOR_RULES_ENABLE' => 'NAGIOS_WARNING',
						'AUDIT_MONITOR_RULES_DISABLE' => 'NAGIOS_WARNING',
						'AUDIT_MONITOR_RULES_SAVE' => 'NAGIOS_WARNING',
						'AUDIT_MONITOR_RULES_ADD' => 'NAGIOS_WARNING',
						'AUDIT_MONITOR_RULES_REMOVE' => 'NAGIOS_WARNING',
						
						'AUDIT_STUDIO_DEBUG' => 'NAGIOS_WARNING',
						'AUDIT_STUDIO_PROFILE' => 'NAGIOS_WARNING',
						'AUDIT_STUDIO_SOURCE' => 'NAGIOS_WARNING',
						'AUDIT_STUDIO_DEBUG_MODE_START' => 'NAGIOS_WARNING',
						'AUDIT_STUDIO_DEBUG_MODE_STOP' => 'NAGIOS_WARNING',
						
						'AUDIT_CLEAR_OPTIMIZER_PLUS_CACHE' => 'NAGIOS_WARNING',
						'AUDIT_CLEAR_DATA_CACHE_CACHE' => 'NAGIOS_WARNING',
						'AUDIT_CLEAR_PAGE_CACHE_CACHE' => 'NAGIOS_WARNING',
						'AUDIT_CLEAR_STATISTICS' => 'NAGIOS_WARNING',
						
						'AUDIT_PAGE_CACHE_SAVE_RULE' => 'NAGIOS_WARNING',
						'AUDIT_PAGE_CACHE_DELETE_RULES' => 'NAGIOS_WARNING',
						
						'AUDIT_JOB_QUEUE_SAVE_RULE' => 'NAGIOS_WARNING',
						'AUDIT_JOB_QUEUE_DELETE_RULES' => 'NAGIOS_WARNING',
						'AUDIT_JOB_QUEUE_DELETE_JOBS' => 'NAGIOS_WARNING',
						'AUDIT_JOB_QUEUE_REQUEUE_JOBS' => 'NAGIOS_WARNING',
						'AUDIT_JOB_QUEUE_RESUME_RULES' => 'NAGIOS_WARNING',
						'AUDIT_JOB_QUEUE_DISABLE_RULES' => 'NAGIOS_WARNING',
						'AUDIT_JOB_QUEUE_RUN_NOW_RULE' => 'NAGIOS_WARNING',
						
						'AUDIT_GET_PHPINFO' => 'NAGIOS_OK', // not used
						'AUDIT_WEBAPI_KEY_ADD' => 'NAGIOS_WARNING',
						'AUDIT_WEBAPI_KEY_REMOVE' => 'NAGIOS_WARNING',
						
						'AUDIT_GUI_SAVELICENSE' => 'NAGIOS_OK',
						
						'AUDIT_CONFIGURATION_EXPORT' => 'NAGIOS_OK',
						'AUDIT_CONFIGURATION_IMPORT' => 'NAGIOS_OK',
						'AUDIT_CONFIGURATION_RESET' => 'NAGIOS_OK',
						'AUDIT_RELOAD_CONFIGURATION' => 'NAGIOS_OK' 
				),
				/*
				 * Job Queue
				 * Based on number of failed jobs 
				*/
				'jobqueue' => array (
						0 => 'NAGIOS_OK',
						1 => 'NAGIOS_WARNING',
						5 => 'NAGIOS_CRITICAL'
				),
				/*
				 * Daemons probe
				 * Based on severity of daemon status
				 */
				'daemonsprobe' => array (
						'info' => 'NAGIOS_OK',
						'warning' => 'NAGIOS_WARNING',
						'error' => 'NAGIOS_CRITICAL',
				),
				/*
				 * PHP workers
				 * 
				 */
				'phpworkers' => array (
						'info' => 'NAGIOS_OK',
						'warning' => 'NAGIOS_WARNING',
						'error' => 'NAGIOS_CRITICAL',
				),
				/*
				 * Processing time
				 * Based on the average of requte processing time
				*/
				'processingtime' => array (
						'2000' => 'NAGIOS_WARNING',
						'5000' => 'NAGIOS_CRITICAL',
				),
				
		) 
);