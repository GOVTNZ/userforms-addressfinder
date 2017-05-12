(function(){

    'use strict';

    $( document ).ready(function() {
        $('input.addressfinder-nz').each(function(i, e) {
            var ariaElement = $(e).parent().parent().find('.addressfinder-live');

            var key = $(e).attr('data-key');
            if (key === undefined || key === 'ADDRESSFINDER_NZ_DEMO_KEY') {
                window.console.error('Using a demo-key for AddressFinder. Please setup a new key, see https://github.com/govtnz/userforms-addressfinder/setup.md');
            }

            var widget = new AddressFinder.Widget(
                e,
                key,
                'NZ'
            );

            $(e).focus(function() {
                ariaElement.text('');
            }).blur(function() {
                ariaElement.text('');
            });

            widget.on("results:update", function() {
                ariaElement.text('a dialog with addresses is available. use the arrow keys to select an address.');
            });

            widget.on("result:select", function(value, data) {
                ariaElement.text('you have selected ' + value);
            });

        });
    });

})();
