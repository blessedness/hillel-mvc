<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Users\User;
use System\Web\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = (new User())->all();

        return $this->render('user/index', compact('users'));
    }

    public function create()
    {
        $form = (new UserRequest);

        if ($this->getRequest()->getMethod() === 'POST' && $form->validate()) {
            (new User())->create($form->getFields());

            $this->redirect('/user');
        }

        $errors = $form->getErrors();

        return $this->render('user/create', compact('errors'));
    }
}