<?php

class NZAddressFinderProvider implements AddressFinderProvider {

    public static function getTitle() {
        return "New Zealand Address Finder Provider";
    }

    public function init(FormField $field) {
        // retrieve the configured key from the options, fallback to demo key if not configured.
        $key = Config::inst()->get('Addressfinder', 'key');
        if (!isset($key)) {
            $key = 'ADDRESSFINDER_NZ_DEMO_KEY';
        }

        $field->addExtraClass('addressfinder-nz');
        $field->setAttribute('data-key', $key);

        Requirements::javascript('https://api.addressfinder.io/assets/v3/widget.js');

        $autoSetup = Config::inst()->get('Addressfinder', 'auto_setup');
        if (!isset($autoSetup) || $autoSetup === true) {
            Requirements::javascript(USERFORMS_ADDRESSFINDER_DIR . '/javascript/nz-addressfinder-provider.js');
        }
    }

}
