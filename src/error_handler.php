<?php

# ████████████████████████████████
# ██ Classes                    ██
# ████████████████████████████████

class ErrorHandler
{
  ///////////////////////////////
  // Settings

  protected $max_err_lvl = 256;

  ///////////////////////////////
  // Protected fields

  protected $root_dir;
  protected $err_log_path;
  
  ///////////////////////////////
  // Protected methods

  /**
 * Handles the error given by firing the
 *  trigger_error() function.
 * It will then log the error to a log, and send
 *  the user to a error page
 *
 * @param int $err_number
 *  Error level number.
 *  Parsed automatically from trigger_error().
 * 
 * @param string $err_number
 *  Error message.
 *  Parsed automatically from trigger_error().
 * 
 * @param string $err_file
 *  File in which the error occured.
 *  Parsed automatically from trigger_error().

 * @param int $err_line
 *  Line on which the error occured.
 *  Parsed automatically from trigger_error().
 */
  public function handleError(
    $err_type = 512,
    $err_msg = "",
    $err_file = "",
    $err_line = 0
  ) {
    /*
      Set shorthands for class fields.
    */
    $root_dir = $this->root_dir;
    $err_log_path = $this->err_log_path;
    $max_err_lvl = $this->max_err_lvl;

    /*
      Create the message to put in the log.
    */
    if (is_integer($err_type)) {
      $err_log_msg = "[" . date('Y-m-d H:i:s') . "] [$err_type] Error: $err_msg in $err_file at line $err_line\n" . str_repeat("-", 48) . "\n";
    } else {
      $err_log_msg = "[" . date('Y-m-d H:i:s') . "] $err_type" . str_repeat("-", 48) . "\n";
    }

    /*
      Log the error to the file.
    */
    file_put_contents(
      $root_dir . $err_log_path,
      $err_log_msg,
      FILE_APPEND
    );

    /*
      Redirect the user to the error page when the error is too severe.
    */
    if (!$err_type > $max_err_lvl) {
      header(
        "Location: " .
        $root_dir .
        "web/error/server_error.html"
      );

      /*
        Close the program
      */
      exit();
    }

    /*
      Returns True, else the normal handler one will be used.
    */
    return true;
  }

  /**
   * Handles the shutdown of the file and logs php errors
   */
  public function register_shutdown()
  {
    /*
      Set shorthands for class fields.
    */
    $root_dir = $this->root_dir;
    $err_log_path = $this->err_log_path;
    $max_err_lvl = $this->max_err_lvl;

    /*
      Get current working directory back
    */
    chdir(WORKING_DIRECTORY);

    /*
      Get last error
    */
    $error = error_get_last();

    /*
      Report error if there is one
    */
    if ($error !== NULL) {
      /*
        Get error details
      */
      print_r($error);
      $err_number = $error["type"];
      $err_msg = $error["message"];
      $err_file = $error["file"];
      $err_line = $error["line"];

      print_r("Its" . $err_number);

      /*
        Log the error
      */
      $this->handleError($err_number, $err_msg, $err_file, $err_line);
    }
  }

  ///////////////////////////////
  // Public methods

  /**
   * Constructs the ErrorHandler class
   *
   * @param string $root_dir
   *  Path to the root directory
   * @param string $err_log_path
   *  Path to log file from the root
   */
  public function __construct(
    string $root_dir,
    string $err_log_path,
  ) {
    /*
      Sets the fields for this class.
    */
    $this->root_dir = $root_dir;
    $this->err_log_path = $err_log_path;

    /*
      Set the error handlers to the ones of this class.
    */
    set_error_handler([$this, "handleError"]);
    set_exception_handler([$this, "handleError"]);
    register_shutdown_function([$this, 'register_shutdown']);
  }
}