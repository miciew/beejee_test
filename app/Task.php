<?php

namespace Miciew;


class Task extends Model
{
    protected static  $_table = 'tasks';

    public function safe()
    {
        return [
            'title', 'description', 'status', 'username', 'email'
        ];
    }
}