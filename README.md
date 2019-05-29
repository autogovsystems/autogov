# [AUTOGOV](http://autogov.systems)

* Project: [github.com/autogovsystems/autogov](https://github.com/toddmotto/html5blank)
* Website: [autogov.systems](http://autogov.systems)

## Contributors
Zury Asse,  
[Grafreak Team](https://www.grafreak.net):
Adrián Cobo,
Pau Camps,
Joel Adorno,
Miguel Pérez

## Getting Started with AUTOGOV

Download the latest version from [autogov.systems](http://autogov.systems) or clone/download this repository.  
Follow the instructions on doc/manual_autogov.odt  
If you have any problem in the installation put an issue on the repository

## Get involved! Make AUTOGOV better

There are a few ways to get involved, submit a Pull Request, or submit a comment on this repository or on universe platform - [universe.autogov.systems](http://universe.autogov.systems)

## Do your own AutoGov themes

You can change all the styles and extend functionalities with child themes. Read carefully the WP documentation about.  
[https://developer.wordpress.org/themes/advanced-topics/child-themes/](https://developer.wordpress.org/themes/advanced-topics/child-themes/)

## Features

Initially developed with Wordpress HTML5Blank [https://github.com/toddmotto/html5blank](https://github.com/toddmotto/html5blank)

#### Javascript Libraries

* JQuery 3.3.1 [https://api.jquery.com/](https://api.jquery.com/)
* Conditionizr 4.3.0 [https://github.com/conditionizr/conditionizr](https://github.com/conditionizr/conditionizr)
* Modernizr 2.7.1 [https://modernizr.com/docs](https://modernizr.com/docs)
* Flickity [https://flickity.metafizzy.co/](https://flickity.metafizzy.co/)
* Bootstrap 4.1 [https://getbootstrap.com/docs/4.1/getting-started/introduction/](https://getbootstrap.com/docs/4.1/getting-started/introduction/)
* Popper [https://popper.js.org/](https://popper.js.org/)
* MaterialDesign-Bootstrap [https://mdbootstrap.com/](https://mdbootstrap.com/)
* Chosen JQuery [https://harvesthq.github.io/chosen/](https://harvesthq.github.io/chosen/)
* JQueryUI [https://jqueryui.com/](https://jqueryui.com/)

#### PHP Functionality Included and Wordpress extensions

* TGM Plugin Activation [http://tgmpluginactivation.com/](http://tgmpluginactivation.com/)
* Custom Taxonomy Sort [https://github.com/tollmanz/custom-taxonomy-sort](https://github.com/tollmanz/custom-taxonomy-sort)
* Add images on term taxonomies [https://pluginrepublic.com/adding-an-image-upload-field-to-categories/](https://pluginrepublic.com/adding-an-image-upload-field-to-categories/)
* Custom Posts Type for Vontests (Questions, Answers & Resolutions)
This controller is on includes/vontest.php but the class/model is on includes/classes/class.vontest.php
Default CRON execution on emails for vontests near to be closed (behaviour on includes/cron.php)
Vontests are closed when an user enters on his page when is closed.
* Custom comments on Answers
Functionality has been override to add a field for Pro or Contra and generate his own view
* Custom Posts Type for About Autogov and About community
Included on includes/about-autogov.php and includes/about-community.php
* Configuration page
Once you are logged, if you are an administrator, you can enter on wp-admin section and configure your general parameters. You can disable any of the autogov section, change the votes quantities

#### Wordpress Plugins Included

These plugins are included with TGM Plugin Activation, all are needed for the correct view and operation.
All plugins can be extended with his own documentation and methods.
* [woocommerce](https://docs.woocommerce.com)
For all the economy pages
* [buddypress](https://codex.buddypress.org/)
For all the social pages
* [BBPress](https://codex.bbpress.org/)
For create forums and groups on buddypress
* [Dokan lite](https://wedevs.com/docs/dokan/)
For create vendor users and create multistores  
You can try Dokan full for your own to extend his capabilities (like bookings)
* [MyCred](https://codex.mycred.me/)
For custom money and social gamification. You can extend your own hooks or configure on your way
* [Comment Popularity](https://github.com/humanmade/comment-popularity)
For thumbs up and down, stackoverflow comments styles
* [rtMedia](https://rtmedia.io/docs/)
For add users media on social
* [BuddyPress Activity As Wire](https://buddydev.com/plugins/bp-activity-as-wire/)
For name someone on your wall

Be free for add plugin and if you feel that you install some that makes Autogov look exciting and fullness, please add to the TGM Plugin Activation (includes/tgm.php) and create a pull request.

## Tips for programming

- Be clear in your code and use Wordpress Standards. Use clear variables name and functions name.
- Override the plugins templates on his folder and add extra functionality through actions and filters on /includes/{name_of_the_plugin}.php
- For extra libraries use the "vendor" folder and include on functions.php
- Home is the front-page.php file on the theme's root folder.
- Politics page is a virtual page generate on includes/virtual-pages.php
- Economy page is the woocommerce shop page. (woocommerce/archive-product.php)
- Social page is the Buddypress activity page (buddypress/activity/index.php)
- Common templates are on template-parts folder
