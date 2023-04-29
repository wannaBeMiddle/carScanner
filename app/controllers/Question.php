<?php

namespace App\Controllers;

use App\Modules\CarScanner\User\User;
use App\Modules\System\Container\Container;
use App\Modules\System\Controller\ControllerInterface;
use App\Modules\System\Request\Request;
use App\Modules\System\View\View;

class Question implements ControllerInterface
{
    public function addQuestion()
    {
	    if(!Container::getInstance()->get(\App\Modules\System\User\User::class)->isAuthorized())
	    {
		    header('Location: /');
		    die();
	    }
        $request = Container::getInstance()->get(Request::class);
        $view = Container::getInstance()->get(View::class);
        $result = false;
        if($request->getPostParameters())
        {
            User::addQuestion($request);
            $result = true;
        }

        $view->show('question', [
            'result' => $result
        ], true);
    }
}