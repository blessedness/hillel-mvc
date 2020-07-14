<?php

declare(strict_types=1);

namespace App\Http\Requests;

use System\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    public function validate(): bool
    {
        $emailValue = $_POST['email'] ?? null;
        $nameValue = $_POST['name'] ?? null;

        if (!$nameValue) {
            $this->setError('name', 'Поле name должно быть заполнено.');
        }

        $nameLen = mb_strlen($nameValue, 'UTF-8');

        if ($nameLen < 3 || $nameLen > 255) {
            $this->setError('name', 'Текст от 3 до 255 символов!');
        }

        if (!$emailValue) {
            $this->setError('email', 'Поле email должно быть заполнено.');
        }

        $email = filter_var($emailValue, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $this->setError('email', 'Введен не валидный email.');
        }

        $this->setFields([
            'email' => htmlspecialchars($emailValue),
            'name' => htmlentities($nameValue),
        ]);

        return !$this->hasErrors();
    }
}
