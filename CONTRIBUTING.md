# Any changes MUST be released as a new version.

#### This applies only to changes in the source code


## Main rules
* All **proposals** and **questions** shall take the form of an **[issue](https://github.com/artem-solovev/artfolio/issues/new)**
* Follow **[WordPress Codex](https://codex.wordpress.org/Developer_Documentation)**
* Before **`Pull request`** make an **[issue](https://github.com/artem-solovev/artfolio/issues/new)**

***

### After your contribution you should follow the next steps
* Сhange the version number by following [these](https://github.com/artem-solovev/artfolio/wiki/Rules-versioning) rules in the next files
 * styles.css
 * README.md
 * CHANGELOG.md ( don't forget add new line to the list of the current version )
 * package.json
 * Gruntfile.js
* Regenerate
 * `POT` files by **GRUNT** ( in command line: `npm install` --> `grunt` )
 * `translations` by **[Loco translate](https://wordpress.org/plugins/loco-translate/)**
 * remove temporary files after the plug-in make its job
 