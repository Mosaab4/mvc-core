<?php

namespace Mosaab\MVC;

use Mosaab\MVC\DB\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName():string;
}