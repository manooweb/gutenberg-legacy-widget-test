# gutenberg-legacy-widget-test

This a legacy widget example with checkbox fields which needs to be manage by a jQuery script when they are checked or unchecked by the user.

It is a base to test the issue https://github.com/WordPress/gutenberg/issues/28668 in the Gutenberg project.

## How to use

Simply put in your `wp-content/mu-plugins/` folder of your WordPress instance the 2 files:
- legacy-gutenberg-widget.php
- legacy-gutenberg-widget.js

You can then add the `Legacy Gutenberg Test Widget` as a block in a widget area.

## What is the behaviours expected?

- check the `Displays as a dropdown` option should hide the two other options
- uncheck the `Displays as a dropdown` option should show the two other options
- `Displays language names` and `Displays flags` can't be unchecked together

## How to test

- Add 2 new `Legacy Gutenberg Test Widget` in a empty widget area to make sure the jQuery script targets correctly each legacy widget. See that the behaviours expected described above doesn't work.
- Save the widget screen
- Try again to check or uncheck the checkbox fields and see that they don't work as expected.
- Refresh the widget screen
- Try again to check or uncheck the checkbox fields and see that they work as expected now.
