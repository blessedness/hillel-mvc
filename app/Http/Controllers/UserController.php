<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Users\User;
use Symfony\Component\HttpFoundation\Request;
use System\Web\Controller;

class UserController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $users = (new User())->all();

        return $this->render('user/index', compact('users'));
    }

    public function view(int $id)
    {
        $user = (new User())->findById($id);

        return $this->render('user/view', compact('user'));
    }

    public function create()
    {
        $form = (new UserRequest);

        if ($this->request->getMethod() === 'POST' && $form->validate()) {
            (new User())->create($form->getFields());

            $this->redirect('/user');
        }

        $errors = $form->getErrors();

        return $this->render('user/create', compact('errors'));
    }
}
