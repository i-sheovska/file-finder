# File Finder

File Finder finds files by a given criteria in a directory tree. The strategy pattern is used for selecting the right method for searching the files. There are 2 strategies implemented - by name and by content, as there should be passed the corresponding parameters for each of them.

# Installation

Add to composer.json file:
```json
{
	"require": {
		"file-finder/file-finder": "*"
	},
	"repositories": [
		{
			"type": "vcs",
			"url": "https://github.com/isheovska/file-finder.git"
		}
	]
}
```
# Basic Usage

```php
use FileFinder\Finder;

//create the Finder by a given starting directory and max depth for searching
$finder = new Finder($path, 1);

//find files which have 'searched' string in their content
$filesByContent = $finder->find($['searched' => 'suscipit laboriosam, nisi'], 'content');
```
