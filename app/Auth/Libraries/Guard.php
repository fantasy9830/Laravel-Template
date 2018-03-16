<?php

namespace App\Auth\Libraries;

use Adldap;

class Guard
{
    public function attempt(string $username = '', string $password = '')
    {
        [$username, $password] = $this->trimArray([$username, $password]);

        if (!$this->checkEmpty([$username, $password])) {
            return false;
        }

        // LDAP
        $ldap = Adldap::auth()->attempt($username, $password);

        return $ldap;
    }

    public function getUserID($value)
    {
        return trim($value);
        //return preg_replace('/^u/i', '', trim($value));
    }

    protected function trimArray(array $values)
    {
        return array_map(function ($value) {
            return trim($value);
        }, $values);
    }

    protected function checkEmpty(array $values)
    {
        return count(array_filter($values, function ($value) {
            return empty($value);
        })) == 0;
    }
}
