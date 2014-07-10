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
    "autoload": {"psr-0": {"": "application/classes"}}
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
