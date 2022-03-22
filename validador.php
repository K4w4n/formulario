<?php
function validateName($name)
{
    $isString = is_string($name);
    $hasTreeChars = strlen($name) >= 3;
    $notHasNumber = !filter_var($name, FILTER_SANITIZE_NUMBER_INT);

    $validate = $isString && $hasTreeChars && $notHasNumber;

    return $validate;
}

function validatePhoneNumber($phoneNumber)
{
    $formattedPhoneNumber = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $phoneNumber))))));

    $regCellPhone = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/';

    $has11Chars = strlen($formattedPhoneNumber) <= 11;

    $validCellPhone = preg_match($regCellPhone, $formattedPhoneNumber);

    $validPhoneNumber = $has11Chars && $validCellPhone;

    return $validPhoneNumber;
}

function validateText($text)
{
    return str_word_count($text) >= 2;
}