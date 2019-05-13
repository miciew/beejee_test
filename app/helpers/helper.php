<?php

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */
function request()
{
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

function auth()
{
    return $auth = new \pmill\Auth\Authenticate;
}