<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-10-30 16:46:04 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: title ~ APPPATH/classes/Controller/Index.php [ 17 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:46:04 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(17): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 17, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:46:38 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: title ~ APPPATH/views/index.php [ 15 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 16:46:38 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php(15): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 15, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(348): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Response.php(160): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(18): Kohana_Response->body(Object(View))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#9 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#12 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 16:47:36 --- EMERGENCY: ErrorException [ 8 ]: Undefined property: Response::$title ~ APPPATH/classes/Controller/Index.php [ 17 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:47:36 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(17): Kohana_Core::error_handler(8, 'Undefined prope...', '/Applications/M...', 17, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:48:02 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: title ~ APPPATH/views/index.php [ 15 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 16:48:02 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php(15): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 15, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(348): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Response.php(160): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(18): Kohana_Response->body(Object(View))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#9 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#12 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 16:48:49 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Response::get() ~ APPPATH/classes/Controller/Index.php [ 17 ] in file:line
2013-10-30 16:48:49 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-30 16:51:53 --- EMERGENCY: ErrorException [ 8 ]: Undefined property: Response::$content ~ APPPATH/classes/Controller/Index.php [ 17 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:51:53 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(17): Kohana_Core::error_handler(8, 'Undefined prope...', '/Applications/M...', 17, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:52:01 --- EMERGENCY: ErrorException [ 8 ]: Undefined property: Response::$title ~ APPPATH/classes/Controller/Index.php [ 17 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:52:01 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(17): Kohana_Core::error_handler(8, 'Undefined prope...', '/Applications/M...', 17, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php:17
2013-10-30 16:53:16 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Response::values() ~ APPPATH/classes/Controller/Index.php [ 17 ] in file:line
2013-10-30 16:53:16 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-30 16:54:56 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: title ~ APPPATH/views/index.php [ 15 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 16:54:56 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php(15): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 15, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(348): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Response.php(160): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(18): Kohana_Response->body(Object(View))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#9 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#12 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 17:03:21 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: title ~ APPPATH/views/index.php [ 15 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 17:03:21 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php(15): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 15, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(348): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Response.php(160): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Index.php(18): Kohana_Response->body(Object(View))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Index->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#9 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#12 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/index.php:15
2013-10-30 17:20:47 --- EMERGENCY: Kohana_Exception [ 0 ]: Controller failed to return a Response ~ SYSPATH/classes/Kohana/Request/Client/Internal.php [ 102 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php:114
2013-10-30 17:20:47 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#3 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php:114
2013-10-30 17:35:57 --- EMERGENCY: ErrorException [ 2 ]: Missing argument 1 for Controller_Supplier::action_add(), called in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php on line 84 and defined ~ APPPATH/classes/Controller/Supplier.php [ 49 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:49
2013-10-30 17:35:57 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(49): Kohana_Core::error_handler(2, 'Missing argumen...', '/Applications/M...', 49, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:49
2013-10-30 20:55:44 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected 'echo' (T_ECHO), expecting ',' or ';' ~ APPPATH/views/addSupplier.php [ 24 ] in file:line
2013-10-30 20:55:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-30 20:56:11 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected 'echo' (T_ECHO), expecting ',' or ';' ~ APPPATH/views/addSupplier.php [ 24 ] in file:line
2013-10-30 20:56:11 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-30 21:04:28 --- EMERGENCY: ErrorException [ 2 ]: Missing argument 1 for Controller_Supplier::action_add(), called in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php on line 84 and defined ~ APPPATH/classes/Controller/Supplier.php [ 54 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:54
2013-10-30 21:04:28 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(54): Kohana_Core::error_handler(2, 'Missing argumen...', '/Applications/M...', 54, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:54
2013-10-30 21:05:09 --- EMERGENCY: ErrorException [ 2 ]: Missing argument 1 for Controller_Supplier::action_add(), called in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php on line 84 and defined ~ APPPATH/classes/Controller/Supplier.php [ 54 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:54
2013-10-30 21:05:09 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(54): Kohana_Core::error_handler(2, 'Missing argumen...', '/Applications/M...', 54, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:54
2013-10-30 21:05:15 --- EMERGENCY: ErrorException [ 2 ]: Missing argument 1 for Controller_Supplier::action_add(), called in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php on line 84 and defined ~ APPPATH/classes/Controller/Supplier.php [ 54 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:54
2013-10-30 21:05:15 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(54): Kohana_Core::error_handler(2, 'Missing argumen...', '/Applications/M...', 54, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:54
2013-10-30 21:07:36 --- EMERGENCY: ErrorException [ 2 ]: Missing argument 1 for Controller_Supplier::action_add(), called in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php on line 84 and defined ~ APPPATH/classes/Controller/Supplier.php [ 55 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:55
2013-10-30 21:07:36 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(55): Kohana_Core::error_handler(2, 'Missing argumen...', '/Applications/M...', 55, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:55
2013-10-30 21:11:30 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: post ~ APPPATH/classes/Controller/Supplier.php [ 53 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:53
2013-10-30 21:11:30 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(53): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 53, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:53
2013-10-30 21:12:16 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: faxeNumber ~ APPPATH/classes/Controller/Supplier.php [ 56 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:56
2013-10-30 21:12:16 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(56): Kohana_Core::error_handler(8, 'Undefined index...', '/Applications/M...', 56, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#2 [internal function]: Kohana_Controller->execute()
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#7 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php:56
2013-10-30 21:12:31 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: suppliers ~ APPPATH/views/suppliers.php [ 20 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/suppliers.php:20
2013-10-30 21:12:31 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/suppliers.php(20): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 20, Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(348): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Response.php(160): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(66): Kohana_Response->body(Object(View))
#6 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Controller.php(84): Controller_Supplier->action_add()
#7 [internal function]: Kohana_Controller->execute()
#8 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Supplier))
#9 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/index.php(118): Kohana_Request->execute()
#12 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/views/suppliers.php:20