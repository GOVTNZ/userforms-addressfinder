<?php

namespace GovtNZ\SilverStripe\UserForms;

use SilverStripe\Forms\FormField;

interface AddressFinderProvider
{
    /**
     * @return string
     */
    public static function getTitle();

    /**
     * @return void
     */
    public function init(FormField $field);
}
