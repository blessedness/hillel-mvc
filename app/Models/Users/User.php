<?php

declare(strict_types=1);

namespace App\Models\Users;

use System\DB\MySql\Model;
use System\Exceptions\ModelException;

class User extends Model
{
    public function create(array $attributes)
    {
        $sql = 'INSERT user (name, email) VALUES (:name, :email)';

        $stmt = $this->getPdo()->prepare($sql);

        if (!$stmt->execute($attributes)) {
            throw new ModelException($stmt->errorInfo()[2], $stmt->errorInfo()[1]);
        }
    }

    public function findById(int $id)
    {
        $sql = 'select * from user WHERE id = :id';

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute(compact('id'));

        return $stmt->fetchObject();
    }

    public function all()
    {
        $sql = 'select * from user ORDER BY created_at DESC';

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS);
    }
}
