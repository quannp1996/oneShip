<?php
//get data
$tplShareGlobal = FunctionLib::tplShareGlobal('admin');
$tplShareGlobal['site_title'] = "Quản trị";

\View::share('def', $tplShareGlobal);
