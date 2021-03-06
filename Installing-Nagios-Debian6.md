## Introduction ##

This tutorial explains how to set up a Nagios-monitored Zend Server using the Zend Server Nagios plugin, and how to configure the thresholds to personalize your alert severity levels.

Nagios is an open source system and network monitoring application. It watches hosts and services that you specify, alerting you when things go bad and when they get better.

Nagios defines probes named "services" that forward any information about a specific operating system or application metrics to the Nagios server. Nagios comes with plenty of built-in services, but it is easy to plugin additional services.

The Zend Server Nagios plugin has been designed to allow Nagios to monitor the main Zend Server metrics, such as: cluster node status, monitoring events, notifications, etc.

**Client / Server Architecture**

Nagios architectures are generally based on a central Nagios server collecting information from services hosted on Nagios clients. In this tutorial, the Nagios clients and the Nagios server are hosted by the same machine.

**About the Zend Server Nagios Plugin**

This plugin is a ZF2-based PHP CLI application. You can use it directly from the command line, and manually check the health of your system: 
index.php nagiosplugin <command> arguments.

Available commands are : 

- *clusterstatus* : monitors the percentage of cluster nodes currently down 
- *audittrail* : monitors Zend Server Audit Trail records
- *notifications* : monitors Zend Server notifications
- *license* : monitors license expiration delay
- *events* : monitors Zend Server monitoring events

## 1. Installing your System ##

The first step in this tutorial is to install Zend Server 6.x, Nagios, and the plugin.

**Installing Zend Server 6.x**

For detailed instructions on installing Zend Server 6.x, see: 	

http://files.zend.com/help/Zend-Server-6/zend-server.htm#installation_guide.htm

Important!
Before continuing, you will need to set your timezone by editing the 'date.timezone' PHP directive. You can do this using the Zend Server UI, on the Configurations | PHP page. 

**Installing Nagios**

Use apt-get to install Nagios. Run the following command:

	apt-get install nagios3 nagios-plugins nagios-nrpe-plugin nagios-nrpe-server

During the installation process, you will be asked for samba workgroup and WINS Settings.  Just leave the default settings.

You will also be asked to set the nagiosadmin password.
    
You should now be able to log in at: http://myhost/nagios3/ with the username nagiosadmin and the password you just set.

In the Service section, you will see that Nagios already provides a basic configuration for the localhost.

Note:
For this tutorial, we have to install packages for both the server and client side of Nagios on the same machine. In normal circumstances though: 

- nagios3 and nagios-nrpe-plugin are used by the Nagios server
- nagios-nrpe-server is used by the Nagios client
- nagios-plugins is used by both sides of Nagios

**Installing and Configuring the Plugin**

To install the Zend Server Nagios plugin: 

1. Unzip the application file in a directory. For example:
 	/usr/local/nagiosplugin.

2. Create a '/usr/local/nagiosplugin/config/config.ini' file, and set the configuration as follows: 

		;--------------------------------------------------------------------
		;	Zend server Webd Api configuration
		;--------------------------------------------------------------------
		;Zend Server Url
		zsapi.target.zsurl=http://192.168.220.151:10081/ZendServer

		;Web Api key name
		zsapi.target.zskey=admin

		;Web Api secret Key
		zsapi.target.zssecret=d2cc2bd7a8252700b5..

		;Zend Server version
		zsapi.target.zsversion=6.1

		;Directory where the plugin is installed
		nagios.plugin.directory = /usr/local/nagiosplugin

		;Configuration directory of nagios client
		nagios.client.config.directory = /etc/nagios

3. You can now access the plugin from the command line. To do this, run:

		php /usr/local/nagiosplugin/index.php nagiosplugin clustserstatus

4. Set index.php as executable

		chmod +x /usr/local/nagiosplugin/index.php

5. Run the installer a root :

		php /usr/local/nagiosplugin/index.php nagiosplugin install

	This will set up the /etc/nagios/nrpe.cfg, add the Zend Server specifics command to nrpe server and restart the nre-server.
	Follow the list of commands : 

		command[zs-clusterstatus]=/usr/local/nagiosplugin/index.php nagiosplugin clusterstatus
		command[zs-audittrail]=/usr/local/nagiosplugin/index.php nagiosplugin audittrail
		command[zs-notifications]=/usr/local/nagiosplugin/index.php nagiosplugin notifications
		command[zs-license]=/usr/local/nagiosplugin/index.php nagiosplugin license
		command[zs-events]=/usr/local/nagiosplugin/index.php nagiosplugin events

	Your plugin is ready to send information to the Nagios server.
 

## 3. Configuring the Nagios Server ##

We're now going to see how the "zs-clusterstatus" command is used by the Nagios server.

**Defining the Command**

The command we've just defined on the client side has to be configured on the server side as well. 

1. Open the 'commands.cfg' file. It is usually located in the '/etc/nagios3' directory.

2. Add the new command: 

		define command {
        	command_name    zs-clusterstatus
			command_line $USER1$/check_nrpe -H $HOSTADDRESS$ -c zs-cluster- status
    	}

As you can see, the command set on the client is used with the nrpe plugin while the command set on the server side is 'nrpe_check', and not "zs-cluster-status".

A command.cfg template you could copy-paste to the main commad.cfg file is deliver with plugin in the /templates directory.

**Defining the Service**

We now have to define a Nagios service that uses the command.

1. Open the '/etc/nagios3/conf.d/localhost_nagios3.cfg' file.

2. Create a new service :

		define service {
			use	generic-service
			host_name	localhost
			service_description	ZS Cluster Status
			check_command	zs-cluster-status
		}

3. Restart the Nagios server. Run:

		service nagios3 restart

The new service is now available. Check it on the Nagios web console, at: http://myhost/nagios3/. 
Nagios checks its services every 1O minutes, so be patient.

A services configuration template you could copy-paste to the main file is deliver with plugin in the /templates/conf.d directory.

## 4. Setting Zend Server Nagios Plugin Thresholds ##

Nagios manages three severity levels:

- OK
- WARNING
- CRITICAL

The goal of this step in the tutorial is to show how Nagios severity levels depend on the plugin configurations.
As an example, we will use the plugin's "Notifications" command. 
This command is based on Zend Server's notification system, which has its own severity levels : 0,1,2 (where 2 is the highest level of severity). 
By default, the severity level returned to Nagios is the one associated with the notification owning the highest severity level, meaning that if a notification returned by Zend Server reaches severity level 2, a critical alert will be displayed by Nagios.

**Setting the ZS Notification Center Service**

We are now going to set a new service for integrating Nagios with Zend Server's Notification Center. 
To do this, repeat the same procedure as with the "zs-clusterstatus" command:

1. Define the command in the '/usr/nagios3/commands.cfg' files :

		define command{
			command_name zs-notifications
			command_line	$USER1$/check_nrpe -H $HOSTADDRESS$ -c zs-notifications
		}

2. Define the service using this command in the '/etc/nagios3/conf.d/localhost_nagios3.cfg':

		define service {
			use	generic-service
			host_name	localhost
			service_description	ZS Notifications center
			check_command	zs-notifications
		}

3. Restart the Nagios.
 
The new service is fully available.

**Generating a Notification**

Next, let's test to see how the new service is integrated with the Zend Server Notification Center.

1. Access the Zend Server UI.

2. Modify the value of a PHP directive, save the changes, but do not restart the server.

3. Access the Nagios UI.

You will see a warning alert "Restart is required" attached to the Zend Server Notifications Center service.

**Changing the Severity Level**

Our final step is to change the severity level of the Nagios alert for this service.

1. Open the 'zendservernagiosplugin.config.php' file (located in '/usr/local/nagiosplugin/module/ZednServerNagiosPlugin/config').
2. Modify the "notifications" threshold parameters:

Change 

	'1' => 'NAGIOS_WARNING',

into 

	'1' => 'NAGIOS_CRITICAL',

After the next Nagios check, the severity level of the ZS Notifications center will be CRITICAL instead of WARNING. 
Access the Nagios UI to verify.

**Commands parameters**

Audittrail and events commands returning one or more item at the same time. Generaly, the information actually returned to Nagios is the one having the highest severity level.Therefore, accuracy of the monitoring depends on the number of items returned at the same time. 

To limit this number of items computed by Nagios you can specify two additional parameters :

- delay : time interval to be used to fetch items. Only items sent out during the last "delay" seconds will be returned.
- limit : maximal number of items returned 

To configure these parameter just add theme in the commd.cfg file :

	define command{
		command_name zs-events
		command_line	$USER1$/check_nrpe -H $HOSTADDRESS$ -c zs-events --delay=10 --limit=5
	}

