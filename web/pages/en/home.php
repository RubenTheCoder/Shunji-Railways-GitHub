<?php

# ████████████████████████████████
# ██ Set-up                     ██
# ████████████████████████████████

/*
  Enables error handler to retrieve working directory
*/
define('WORKING_DIRECTORY', getcwd());

# ████████████████████████████████
# ██ Local Settings             ██
# ████████████████████████████████

/*
  Path to directories
  Path to folder with slash at end
*/
$root_dir = "../../../";

/*
  Paths to files
  File path with extension
*/
$page_file_name = "home.php";

/*
  Site language code
  Two letter language code
*/
$page_lang = "en";





# ████████████████████████████████
# ██ Load Modules               ██
# ████████████████████████████████

/*
  Loads the error handler API
*/
require_once (
  $root_dir .
  "src/error_handler.php"
);

/*
  Create error handler class
*/
$error_handler = new ErrorHandler(
  $root_dir,
  "logs/errors.log"
);

/*
  Loads the functions API
*/
require_once (
  $root_dir .
  "src/functions.php"
);





# ████████████████████████████████
# ██ Main Thread                ██
# ████████████████████████████████

/*
  Loads page template
*/
require_once
  $root_dir .
  "templates/" .
  $page_file_name;
