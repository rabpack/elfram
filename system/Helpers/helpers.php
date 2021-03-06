<?php

function request(string $attribute)
{
    $request = new System\Http\Request();
    return $request->input($attribute);
}
