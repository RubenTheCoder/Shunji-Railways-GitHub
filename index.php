<?php

# ████████████████████████████████
# ██ Local Settings             ██
# ████████████████████████████████

// Paths to directories
/*
  Path to folder with slash at end
*/
$root_dir = "./";
$pages_folder = "web/pages/";

// Paths to files
/*
  File path with extension
*/
$config_path = "config/config.json";





# ████████████████████████████████
# ██ Main Thread                ██
# ████████████████████████████████

/*
  Load the config.json as a object.
  If the config.json file is missing, the user gets redirected to the english homepage, skipping the rest of this file.
*/
if (
  file_exists(
    $root_dir .
    $config_path
  )
) {
  $config = json_decode(
    file_get_contents(
      $root_dir .
      $config_path
    ),
    true
  );
} else {
  header(
    "Location: " .
    $root_dir .
    $pages_folder .
    "en/home.php"
  );
}

/*
  Gets the users language code, or else chooses the English language code.
*/
$user_lang_code = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2)
  ?: "en";

/*
  Checks if the language code is supported and sets the sites language code to it, or else it chooses the English language code.
*/
$site_lang_code = in_array(
  $user_lang_code,
  $config["supported_languages"]
) ?
  $user_lang_code :
  "en";

/*
  Redirects the user to the homepage.
*/
header(
  "Location: " .
  $root_dir .
  $pages_folder .
  $site_lang_code .
  "/home.php"
);

/*
  Closes the program.
*/
exit();
