<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-10-24 01:46:31 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:46:31 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:46:36 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:46:36 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:50:10 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:50:10 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:11 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:11 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:15 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:15 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:18 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:18 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:25 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:25 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:30 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 01:51:30 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 02:00:23 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 02:00:23 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 02:00:27 --- EMERGENCY: Exception [ 0 ]: Fetching the query result and constructing object failed. ~ APPPATH/classes/Repository/AbstractRepository.php [ 41 ] in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 02:00:27 --- DEBUG: #0 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php(20): Repository_AbstractRepository->fetchNConstruct('SELECT * FROM v...', Array)
#1 /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Controller/Supplier.php(16): Repository_Supplier->getAll()
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
#14 {main} in /Applications/MAMP/htdocs/seg4910-project/Code/RestaurantManagementSoftware/application/classes/Repository/Supplier.php:20
2013-10-24 19:35:51 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:35:51 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:35:54 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:35:54 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:41:58 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:41:58 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:11 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:11 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:11 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:11 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:11 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:11 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:12 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:12 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:12 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:12 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:12 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-24 19:47:13 --- EMERGENCY: ErrorException [ 1 ]: Class 'Repository_User' not found ~ APPPATH/classes/Controller/Login.php [ 13 ] in file:line
2013-10-24 19:47:13 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line