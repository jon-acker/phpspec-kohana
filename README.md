phpspec-kohana
==============

Extension for using PhpSpec with Kohana framework

Create a composer.json file:
```
{
   "repositories": [
        {
            "url": "https://github.com/jon-acker/phpspec-kohana.git",
            "type": "git"
        }
    ],
    "require-dev": {
        "phpspec/kohana-extension": "dev-master"
    },
    "config": {
        "bin-dir": "bin"
    },
    "autoload": {"psr-0": {"": "public/application/classes"}}
}
```

```
cp vendor/phpspec/kohana-extension/phpspec.yml.dist phpspec.yml
```

```
bin/phpspec describe Acme_Driver_Formatter
```

```
bin/phpspec run
```
You specify the applicaiton root in phpspec.yml, for example:
```
application_root: public/application
```
This will usually match the path you set for your composer autoload to search for classes.

For documentation on how to use phpspec, see: http://www.phpspec.net/
