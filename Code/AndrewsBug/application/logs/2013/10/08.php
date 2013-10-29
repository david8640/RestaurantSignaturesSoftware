<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-10-08 21:06:17 --- EMERGENCY: ErrorException [ 1 ]: Class 'Configuration' not found ~ APPPATH/classes/Controller/Supplier.php [ 18 ] in file:line
2013-10-08 21:06:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-08 21:13:56 --- EMERGENCY: ErrorException [ 1 ]: Class 'Configuration' not found ~ APPPATH/classes/Controller/Supplier.php [ 18 ] in file:line
2013-10-08 21:13:56 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-08 21:16:09 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected 'Configuration' (T_STRING), expecting variable (T_VARIABLE) or '$' ~ APPPATH/classes/Controller/Supplier.php [ 18 ] in file:line
2013-10-08 21:16:09 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-08 21:16:36 --- EMERGENCY: ErrorException [ 1 ]: Class 'Configuration' not found ~ APPPATH/classes/Controller/Supplier.php [ 18 ] in file:line
2013-10-08 21:16:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-08 21:17:58 --- EMERGENCY: ErrorException [ 1 ]: Class 'Configuration' not found ~ APPPATH/classes/Controller/Supplier.php [ 18 ] in file:line
2013-10-08 21:17:58 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-08 21:18:07 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: password ~ APPPATH/classes/Configuration.php [ 42 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Configuration.php:42
2013-10-08 21:18:07 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Configuration.php(42): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 42, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(22): Configuration->getConnectionString()
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_findAll()
#3 [internal function]: Kohana_Controller->execute()
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(13): Kohana_Request->execute()
#8 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#9 [internal function]: Kohana_Controller->execute()
#10 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#11 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#13 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Configuration.php:42
2013-10-08 21:18:31 --- EMERGENCY: ErrorException [ 1 ]: Class 'Configuration' not found ~ APPPATH/classes/Controller/Supplier.php [ 18 ] in file:line
2013-10-08 21:18:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line