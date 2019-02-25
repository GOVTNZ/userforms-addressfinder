<?php

namespace GovtNZ\SilverStripe\UserForms;

use SilverStripe\Forms\FormField;
use SilverStripe\Core\Config\Config;
use SilverStripe\View\Requirements;

class NZAddressFinderProvider implements AddressFinderProvider
{
    /**
     * @return string
     */
    public static function getTitle()
    {
        return "New Zealand Address Finder Provider";
    }

    /**
     * @return void
     */
    public function init(FormField $field)
    {
        $key = Config::inst()->get('Addressfinder', 'key');

        if (!isset($key)) {
            $key = 'ADDRESSFINDER_NZ_DEMO_KEY';
        }

        $field->addExtraClass('addressfinder-nz');
        $field->setAttribute('data-key', $key);

        Requirements::javascript(
            'https://api.addressfinder.io/assets/v3/widget.js'
        );

        $autoSetup = Config::inst()->get('Addressfinder', 'auto_setup');

        if (!isset($autoSetup) || $autoSetup === true) {
            Requirements::javascript(
                'govtnz/silverstripe-userforms-addressfinder:javascript/nz-addressfinder-provider.js'
            );
        }
    }
}
