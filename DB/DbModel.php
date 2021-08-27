<?php

namespace App\Core\DB;

use App\Core\Application;
use App\Core\Model;

abstract class DbModel extends Model
{
    public static function findOne(array $where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($p) => ":$p", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    abstract public function primaryKey(): string;
}