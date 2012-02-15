<?php

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . "/mod/forum/lib.php");



class local_camtasia_relay_external extends external_api {

   /**
    * Returns description of method parameters
    * @return external_function_parameters
    */
   public static function add_discussion_parameters() 
   {
      return new external_function_parameters(
                array(
               'courseShortName' => new external_value(PARAM_TEXT, 'Course for which to add the discussion'),
               'subject' => new external_value(PARAM_RAW, 'Subject for discussion'),
               'message' => new external_value(PARAM_RAW, 'Message for discussion'),
               'username' => new external_value(PARAM_TEXT, 'User for which to post the discussion'),
               )
      );
   }

   public static function add_discussion($courseShortName, $subject, $message, $username)
   {
      global $USER;
      global $CFG;
      global $DB;
      
      //Parameter validation
      //REQUIRED
      $params = self::validate_parameters(self::add_discussion_parameters(),
            array(
            'courseShortName' => $courseShortName,
            'subject' => $subject,
            'message' => $message,
            'username' => $username
            ));
      
      // Determine the userid from the username
      if (!empty($username))
      {
         $query = "SELECT id FROM {$CFG->prefix}user WHERE ucase(username)=ucase('$username')";
         $records = $DB->get_records_sql($query);
         $userid = NULL;
         foreach ($records as $record) {
            $userid = $record->id;
            break;
         }
         if (! $userid ) {
            $errormsg = "Could not determine userid for username='$username'.";
            error_log(__FILE__.':'.__LINE__." $errormsg");
            return "$errormsg";
         }
         $USER->id = $userid;
      }
      
      //Context validation
      //OPTIONAL but in most web service it should present
      $context = get_context_instance(CONTEXT_USER, $USER->id);
      self::validate_context($context);
      
      //Capability checking
      //OPTIONAL but in most web service it should present
      if (!has_capability('mod/forum:startdiscussion', $context)) {
         throw new moodle_exception('mod/forum:startdiscussion is a required capability.');
      }

      // #
      // # Determine courseid from courseshortname
      // #
      
      $query = "SELECT id FROM {$CFG->prefix}course WHERE ucase(shortname) = ucase('" . $courseShortName . "')";
      $records = $DB->get_records_sql($query);
      $courseid = NULL;
      foreach ($records as $record) {
         $courseid = $record->id;
         break;
      }
      if (! $courseid ) {
         $errormsg = "Could not determine course id for course shortname='$courseShortName'";
         error_log(__FILE__.':'.__LINE__." $errormsg");
         return "$errormsg";
      }

      // #
      // # Determine forum id from courseid
      // #
      if (! $forum_record = $DB->get_record("forum", array( "course" => $courseid ))) {
         // $errormsg = "could not determine forum id for course $params['courseShortName']";
         error_log(__FILE__.':'.__LINE__." $errormsg");
         return "$errormsg";
      }

      $sd          = new stdClass;
      $sd->forum   = $forum_record->id;
      $sd->course  = $courseid;
      $sd->name    = $subject;
      $sd->message   = $message;
      $sd->messageformat  = 1; // HTML
      $sd->messagetrust = true;
      $sd->mailnow = 0;

      $result = forum_add_discussion($sd);

      return "$result";
   }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function add_discussion_returns() {
        return new external_value(PARAM_TEXT, 'The result from "forum_add_discussion"');
    }
}
