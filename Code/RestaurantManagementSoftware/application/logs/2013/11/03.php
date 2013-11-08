<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-11-03 15:14:33 --- EMERGENCY: View_Exception [ 0 ]: The requested view supplier/suppliers could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php:137
2013-11-03 15:14:33 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(137): Kohana_View->set_filename('supplier/suppli...')
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(30): Kohana_View->__construct('supplier/suppli...', NULL)
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(21): Kohana_View::factory('supplier/suppli...')
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_findAll()
#4 [internal function]: Kohana_Controller->execute()
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#8 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(13): Kohana_Request->execute()
#9 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#10 [internal function]: Kohana_Controller->execute()
#11 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#12 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#14 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#15 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php:137