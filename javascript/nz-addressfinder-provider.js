(function(){

    'use strict';

    $( document ).ready(function() {
        $('input.addressfinder-nz').each(function(i, e) {

            var key = $(e).attr('data-key');
            if (key === undefined || key === 'ADDRESSFINDER_NZ_DEMO_KEY') {
                window.console.error('Using a demo-key for AddressFinder. Please setup a new key, see https://github.com/govtnz/userforms-addressfinder/setup.md');
            }

            var widget = new AddressFinder.Widget(
                e,
                key,
                'NZ'
            );
        });
    });

})();
