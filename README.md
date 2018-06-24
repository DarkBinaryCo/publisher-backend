# CodeIgniter Boilerplate
Boilerplate code for any codeigniter project. Includes ionauth with bootstrap
## Prerequisites
These are the prerequisites for using this boilerplate code: 
- CodeIgniter 3.x
- PHP >=5.4

## Getting started
The code is split into two directories `ci` and `public`
- The `public` dir contains assets and a htaccess file, this will be posted on your web server's `public_html` or equivalent directory
- The `ci` directory contains codeigniter files, this is where any of your backend code will reside. By default, you can upload this in the root of your server. This prevents it from being publicly accessible.

## Environments
Production and development environments are setup to work automatically with the assumption being that `localhost` is a development environment and anything else is production.

## Helpers
The boilerplate comes with a few helpers to help with various common functionality
- `asset_helper` - This helper contains functions that can be used to retrieve asset urls

## Libraries
No extra libraries included as yet

## Defaults that have been changed
The default base_url value for production is set to `'http://localhost'` as opposed to being blank

## Core overrides
- `MY_Model` contains a constructor that loads a database, all our models will extend the `MY_Model` class which is an extension of the `CI_Model` class.
