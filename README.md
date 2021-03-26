# php-template-compiler
A pre-deployment process to compile SourcePot templates into html

---

## Goals

As part of efforts to streamline development and lessen server loads, the idea with this template compiler is to process template files and create simple PHP files for deployment to a production environment.

This project is also intended to be dependency-free and is not integrated with any other package managers.  Installation is as simple as downloading the files in this repository and placing somewhere you can execute the entry point.
Including as part of your workflow is also easy - include/require the main file to gain access to the functions to use.

Why bother, you ask?  Why not just use PHP or even another full blown templating engine like Smarty, Blade, or Twig?  The reason is simple - simplicity.  By keeping the code as light as possible, server loads are decreased through less CPU and lower memory requirements.  By using a separate "language", front end developers and even designers can create templates without needing to know PHP, and this all helps with the golden Separation of Concerns principle of keeping parts of your application functionally separate.

## Usage

Simply execute `php template-compiler --in "path/to/input_file --out "output/directory` and your template will be "compiled".

Other options available:
* `--in path/to/files` if given path is a directory, reads each file in that directory and attempts to parse them.  If path is a file, attempts to parse that single file
* `--out path/to/output` any files created will keep the same base filename but have `.php` appended to it, they will be created in this directory

## Template creation

Template syntax is designed to be as straightforward as possible with 2 main use cases:
* Simple variable replacement is done using `{{ moustaches }}`.  In this case, the global php variable `$moustache` will be echo'd out
* keyword-based directives appear between `{%  %}`.  Keywords available are:
  * `{% for index,value of array %}`. Provides an index (or key in the case of an associative array) and a value for each item in the array given. Mark the end of the block with `{% endfor %}`.  When inside a looping block, use the `{{ moustache }}` syntax to display variables.
  * `{% if condition %}`, `{% else condition %}`, `{% else %}`, `{% endif %}` for simple conditional statements.  The condition must be parsable PHP.
  * `{^ filename ^}` includes another file.  If this is a template file, it will be parsed and the result placed inline in this file.  The filename can be either absolute, or relative.


> When displaying variables, associative arrays can be accessed using a "dot notation", e.g. `array.property`, or square-bracket notation (), e.g. `array['property']`.  These can be as deep as you like. For standard indexed arrays, use square-bracket notation, e.g. `array[1]`