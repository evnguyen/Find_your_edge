<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $progressbar: The progress bar 100% filled (if configured). This may not
 *   print out anything if a progress bar is not enabled for this node.
 * - $confirmation_message: The confirmation message input by the webform
 *   author.
 * - $sid: The unique submission ID of this submission.
 * - $url: The URL of the form (or for in-block confirmations, the same page).
 */
?>

<?php
/**
 * Include constant definitions
 * This section includes the file that holds all the constant definitions
 */
  include 'const_defs.php';

/**
 * Obtain the values of the current submission
 */
  $sid = $_GET['sid'];
  global $submission;
  $submission = webform_get_submission($node->nid, $sid);
  //Debug
  dsm($submission);

/**
 * @param $list -> an array which holds the list of elements to be chosen from
 * @return string
 * Helper function for getting a random element in an array
 */
  function get_random_element($list) {
    $min = 0;
    $max = count($list) - 1;
    $index = rand($min, $max);
    $retval = $list[$index];
    return $retval;
  }

/**
 * @return string
 * Helper function to return the major selected
 */
  function get_major() {
    global $submission;
    $faculty = $submission->data[2][0];
    if ($faculty == "AHS") {
      $major = $submission->data[3][0];
    }
    elseif ($faculty == "ART") {
      $major = $submission->data[4][0];
    }
    elseif ($faculty == "ENV") {
      $major = $submission->data[5][0];
    }
    elseif ($faculty == "MATH") {
      $major = $submission->data[6][0];
    }
    elseif ($faculty == "SCI") {
      $major = $submission->data[7][0];
    }
    elseif ($faculty == "NOFAC") {
      $major = "NOMAJOR";
    }
    else{
      print '<script> console.log("Error: Having trouble finding $major")</script>';
      return "null";
    }
    return $major;
  }

/**
 * @param $string
 *
 * @return bool
 * Helper function that checks if a string contains a number. Returns false
 * otherwise.
 */
  function has_number($string) {
    $len = drupal_strlen($string);
    for ($i = 0; $i < $len; $i++) {
      if(ctype_digit($string[$i])) {
        return true;
      }
    }
    return false;
  }

/**
 * @param $string
 * @return bool
 * Helper function to check if string is a course code
 * This assumes all course code will always start with a letter and end with either
 * a number or an uppercase letter. Furthermore, every course code will have at
 * least one number
 */
  function is_course($string) {
    $first = $string[0];
    $last = $string[drupal_strlen($string) - 1];

    if (has_number($string) && ctype_alpha($first) && (ctype_digit($last) || ctype_upper($last))) {
      return true;
    }
    else {
      return false;
    }
  }


/**
 * @param $faculty
 * @param $major
 *
 * @return array
 * Helper function to get Faculty type experiences
 */
  function get_faculty_positions($faculty, $major) {
    global $comp3_faculties;
    global $comp3_ahs_ambassador;
    global $comp3_kin_trainer;
    global $comp3_earth_museum;
    global $comp3_sci_outreach;
    $results = array();

    if ($faculty == "AHS") {
      if ($major == "KIN") {
        $results = array_merge($results, $comp3_kin_trainer);
      }
      $results = array_merge($results, $comp3_ahs_ambassador);
    }
    elseif ($faculty == "SCI") {
      if ($major == "EARTH") {
        $results = array_merge($results, $comp3_earth_museum);
      }
      $results = array_merge($results, $comp3_sci_outreach);
    }
    else {
      $results = array_merge($results, $comp3_faculties);
    }

    return $results;
  }


/**
 * @param $string
 *
 * @return bool
 * Helper function that checks if key is a student society position
 */
  function is_student_society_position($string) {
    $positions = array(
      "GBDA Society",
      "HIST Society",
      "PSYCH Society",
      "MathSoc",
      "Bioinformatics Club",
      "FARMSA",
    );
    return in_array($string, $positions);
  }


/**
 * @param $faculty
 * @param $major
 *
 * @return array
 * Helper function to return Student Society positions
 */
  function get_student_society_positions($faculty, $major) {
    global $comp3_student_soc;
    global $comp3_gbda_soc;
    global $comp3_hist_soc;
    global $comp3_psych_soc ;
    global $comp3_soc_soc;
    global $comp3_mathsoc;
    global $comp3_bioinformatics_club ;
    global $compr3_farmsa ;
    $results = array();

    if ($faculty == "ART") {
      if ($major == "GBDA") {
        $results = array_merge($results, $comp3_gbda_soc);
      }
      if ($major == "HIST") {
        $results = array_merge($results, $comp3_hist_soc);
      }
      if ($major == "PSYCH") {
        $results = array_merge($results, $comp3_psych_soc);
      }
      if ($major == "SOC") {
        $results = array_merge($results, $comp3_soc_soc);
      }
    }
    elseif ($faculty == "MATH") {
      if ($major == "CS") {
        $results = array_merge($results, $comp3_bioinformatics_club);
      }
      elseif ($major == "ACTSC" || $major == "STAT") {
        $results = array_merge($results, $compr3_farmsa);
      }
      $results = array_merge($results, $comp3_mathsoc);
    }
    elseif ($faculty == "SCI") {
      if ($major == "BIO") {
        $results = array_merge($results, $comp3_bioinformatics_club);
      }
    }
    else{
      $results = array_merge($results, $comp3_student_soc);
    }

    return $results;
  }

/**
 * @param $faculty
 * @param $skills
 *
 * @return array
 * Helper function to get University college positions
 */
  function get_university_colleges_positions($faculty, $skills) {
    global $comp3_uni_college;
    global $comp3_renison_don;
    global $comp3_renison_base;
    global $comp3_renison_eli;
    global $comp3_stpaul_don;
    global $comp3_stpaul_leader;
    $results = array();

    if($faculty == "ENV") {
      if(in_array("COMM", $skills) || in_array("LEAD", $skills) || in_array("TEAM", $skills)){
        $results = array_merge($results, $comp3_stpaul_leader);
      }
    }
    if (in_array("COMM", $skills)) {
      $results = array_merge($results, $comp3_renison_don);
      $results = array_merge($results, $comp3_renison_base);
      $results = array_merge($results, $comp3_renison_eli);
      $results = array_merge($results, $comp3_stpaul_don);
    }
    if (in_array("CULT", $skills)) {
      $results = array_merge($results, $comp3_renison_base);
      $results = array_merge($results, $comp3_renison_eli);
    }
    if (in_array("LEAD", $skills)) {
      $results = array_merge($results, $comp3_renison_don);
      $results = array_merge($results, $comp3_stpaul_don);
    }
    if (in_array("TEAM", $skills)) {
      $results = array_merge($results, $comp3_renison_don);
      $results = array_merge($results, $comp3_stpaul_don);
    }
    if (empty($results)) {
      $results = array_merge($results, $comp3_uni_college);
    }
    return array_unique($results);
  }

/**
 * @param $faculty
 * @param $skills
 *
 * @return array
 * Helper function to get Offices and Services positions
 */
  function get_offices_servies_positions($faculty, $major ,$skills) {
    global $comp3_offices_services;
    global $comp3_first_aid;
    global $comp3_intramural_referee;
    global $comp3_lifeguard;
    global $comp3_bike_centre;
    global $comp3_response_team;
    global $comp3_coop_connection;
    global $comp3_fed_clubs;
    global $comp3_food_bank;
    global $comp3_glow;
    global $comp3_student_network;
    global $comp3_mates;
    global $comp3_community_don;
    global $comp3_sustainable_campus;
    global $comp3_volunteer_centre;
    global $comp3_warrior_tribe;
    global $comp3_womens_centre;
    global $comp3_leave_the_pack;
    global $comp3_health_educator;
    global $comp3_single_sexy_performer;
    global $comp3_residence_don;
    global $comp3_library_associate;
    global $comp3_food_services;
    global $comp3_computing_consultant;
    global $comp3_student_ambassador;
    $results = array();
    if($faculty == "MATH" && $major == "CS"){
      $results = array_merge($results, $comp3_computing_consultant);
    }

    if (in_array("COMM", $skills)) {
      $results = array_merge($results, $comp3_response_team);
      $results = array_merge($results, $comp3_mates);
      $results = array_merge($results, $comp3_community_don);
      $results = array_merge($results, $comp3_warrior_tribe);
      $results = array_merge($results, $comp3_leave_the_pack);
      $results = array_merge($results, $comp3_health_educator);
      $results = array_merge($results, $comp3_single_sexy_performer);
      $results = array_merge($results, $comp3_residence_don);
      $results = array_merge($results, $comp3_library_associate);
      $results = array_merge($results, $comp3_student_ambassador);
    }
    if (in_array("CULT", $skills)) {
      $results = array_merge($results, $comp3_food_bank);
      $results = array_merge($results, $comp3_glow);
      $results = array_merge($results, $comp3_student_network);
      $results = array_merge($results, $comp3_sustainable_campus);
      $results = array_merge($results, $comp3_womens_centre);
      $results = array_merge($results, $comp3_single_sexy_performer);
    }
    if (in_array("LEAD", $skills)) {
      $results = array_merge($results, $comp3_first_aid);
      $results = array_merge($results, $comp3_intramural_referee);
      $results = array_merge($results, $comp3_lifeguard);
      $results = array_merge($results, $comp3_response_team);
      $results = array_merge($results, $comp3_coop_connection);
      $results = array_merge($results, $comp3_fed_clubs);
      $results = array_merge($results, $comp3_mates);
      $results = array_merge($results, $comp3_community_don);
      $results = array_merge($results, $comp3_residence_don);
    }
    if (in_array("TEAM", $skills)) {
      $results = array_merge($results, $comp3_first_aid);
      $results = array_merge($results, $comp3_intramural_referee);
      $results = array_merge($results, $comp3_lifeguard);
      $results = array_merge($results, $comp3_bike_centre);
      $results = array_merge($results, $comp3_response_team);
      $results = array_merge($results, $comp3_coop_connection);
      $results = array_merge($results, $comp3_fed_clubs);
      $results = array_merge($results, $comp3_food_bank);
      $results = array_merge($results, $comp3_student_network);
      $results = array_merge($results, $comp3_mates);
      $results = array_merge($results, $comp3_community_don);
      $results = array_merge($results, $comp3_sustainable_campus);
      $results = array_merge($results, $comp3_volunteer_centre);
      $results = array_merge($results, $comp3_warrior_tribe);
      $results = array_merge($results, $comp3_womens_centre);
      $results = array_merge($results, $comp3_leave_the_pack);
      $results = array_merge($results, $comp3_health_educator);
      $results = array_merge($results, $comp3_single_sexy_performer);
      $results = array_merge($results, $comp3_residence_don);
      $results = array_merge($results, $comp3_food_services);
      $results = array_merge($results, $comp3_student_ambassador);
    }
    if (empty($results)) {
      $results = array_merge($results, $comp3_offices_services);
    }
    return array_unique($results);
  }

/**
 * @return array
 * Generate the results for Component 1: Skills identification
 */
  //TODO: Change if conditions to switch statements if required
  function get_comp1() {
    global $submission;
    global $comp1_all_courses;
    global $comp1_ahs_courses;
    global $comp1_env_courses;
    global $comp1_math_courses;
    global $comp1_descr;

    if ($submission->data[2][0] == "AHS") {
      $retval[] = get_random_element($comp1_ahs_courses);
    }
    elseif ($submission->data[2][0] == "ENV") {
      $retval[] = get_random_element($comp1_env_courses);
    }
    elseif ($submission->data[2][0] == "MATH") {
      $retval[] = get_random_element($comp1_math_courses);
    }
    else {
      $retval[] = get_random_element($comp1_all_courses);
    }

    if (is_course($retval[0])) {
      $retval[] = $retval[0] . $comp1_descr["COURSE"];
    }
    else {
      $retval[] = $comp1_descr[$retval[0]];
    }
    return $retval;
  }

/**
 * @return array
 * Generate the results for Component 2: Career Development Course
 */
  function get_comp2() {
    global $submission;
    global $comp2_all_courses;
    global $comp2_arts_all_courses;
    global $comp2_arts_psci_courses;
    global $comp2_descr;

    $major = get_major();
    if ($submission->data[2][0] == "ART" && $major == "PSCI") {
      $retval[] = get_random_element($comp2_arts_psci_courses);
    }
    elseif ($submission->data[2][0] == "ART") {
      $retval[] = get_random_element($comp2_arts_all_courses);
    }
    else {
      $retval[] = get_random_element($comp2_all_courses);
    }
    $retval[] = $retval[0] . $comp2_descr["COURSE"];
    return $retval;
  }

/**
 * @return array
 * Generate the results for Component 3: Work/Community Experiences
 * TODO: Refactor code to use a class instead of listing global variables?
 */
  function get_comp3() {
    global $submission;
    global $comp3_ahs_health_courses;
    global $comp3_ahs_kin_courses;
    global $comp3_ahs_therap_courses;
    global $comp3_ahs_rec_courses;
    global $comp3_arts_drama_courses;
    global $comp3_arts_fine_courses;
    global $comp3_arts_gbda_courses;
    global $comp3_arts_ger_courses;
    global $comp3_arts_ls_courses;
    global $comp3_arts_pac_courses;
    global $comp3_arts_psci_courses;
    global $comp3_arts_psych_courses;
    global $comp3_arts_sds_courses;
    global $comp3_arts_smf_courses;
    global $comp3_arts_soc_courses;
    global $comp3_env_enbus_courses;
    global $comp3_env_ers_courses;
    global $comp3_env_indev_courses;
    global $comp3_env_integ_courses;
    global $comp3_sci_scbus_courses;
    global $comp3_full_time;
    global $comp3_part_time;
    global $comp3_volunteering;
    global $comp3_service_learning;
    global $comp3_descr;

    $results_list = array();
    $faculty = $submission->data[2][0];
    $major = get_major();
    $skills = $submission->data[14];
    if (in_array("ACA", $submission->data[8])) {
      if ($faculty == "AHS") {
        switch ($major) {
          case "HLTH":
            $results_list = array_merge($results_list, $comp3_ahs_health_courses);
            break;
          case "KIN":
            $results_list = array_merge($results_list, $comp3_ahs_kin_courses);
            break;
          case "RECBUS":
            $results_list = array_merge($results_list, $comp3_ahs_rec_courses);
            break;
          case "THERAP":
            $results_list = array_merge($results_list, $comp3_ahs_therap_courses);
            $results_list = array_merge($results_list, $comp3_ahs_rec_courses);
            break;
          case "TOUR":
            $results_list = array_merge($results_list, $comp3_ahs_rec_courses);
            break;
          default:
            break;
        }
      }
      elseif ($faculty == "ART") {
        switch ($major) {
          case "THEAT":
            $results_list = array_merge($results_list, $comp3_arts_drama_courses);
            break;
          case "FINE":
            $results_list = array_merge($results_list, $comp3_arts_fine_courses);
            break;
          case "GBDA":
            $results_list = array_merge($results_list, $comp3_arts_gbda_courses);
            break;
          case "GER":
            $results_list = array_merge($results_list, $comp3_arts_ger_courses);
            break;
          case "LS":
            $results_list = array_merge($results_list, $comp3_arts_ls_courses);
            break;
          case "PACS":
            $results_list = array_merge($results_list, $comp3_arts_pac_courses);
            break;
          case "PSCI":
            $results_list = array_merge($results_list, $comp3_arts_psci_courses);
            break;
          case "PSYCH":
            $results_list = array_merge($results_list, $comp3_arts_psych_courses);
            break;
          case "SDS":
            $results_list = array_merge($results_list, $comp3_arts_sds_courses);
            break;
          case "SMF":
            $results_list = array_merge($results_list, $comp3_arts_smf_courses);
            break;
          case "SOC":
            $results_list = array_merge($results_list, $comp3_arts_soc_courses);
            break;
          default:
            break;
        }
      }
      elseif ($faculty == "ENV") {
        switch ($major) {
          case "ENBUS":
            $results_list = array_merge($results_list, $comp3_env_enbus_courses);
            break;
          case "ERS":
            $results_list = array_merge($results_list, $comp3_env_ers_courses);
            break;
          case "INDEV":
            $results_list = array_merge($results_list, $comp3_env_indev_courses);
            break;
          case "INTEG":
            $results_list = array_merge($results_list, $comp3_env_integ_courses);
            break;
          default:
            break;
        }
      }
      elseif ($faculty == "SCI") {
        switch ($major) {
          case "SCBUS":
            $results_list = array_merge($results_list, $comp3_sci_scbus_courses);
            break;
          case "BIOTECO":
            $results_list = array_merge($results_list, $comp3_sci_scbus_courses);
            break;
        }
      }
    }//End outer if (type==aca)

    if (in_array("ON", $submission->data[8])) {
      $exp = $submission->data[9];
      if (in_array("FAC", $exp)) {
        $results_list = get_faculty_positions($faculty, $major);
      }
      if (in_array("UC", $exp)) {
        $results_list = get_university_colleges_positions($faculty, $skills);
      }
      if (in_array("SSOC", $exp)) {
        $results_list = get_student_society_positions($faculty, $major);
      }
      if (in_array("OAS", $exp)) {
        $results_list = get_offices_servies_positions($faculty, $major, $skills);
      }
    }

    if (in_array("OFF", $submission->data[8])) {
      $exp = $submission->data[10];
      //Full time and Part time can only available to Non-international students
      if (in_array("FULL", $exp) && $submission->data[1][0] == 2) {
        $results_list = array_merge($results_list, $comp3_full_time);
      }
      if (in_array("PART", $exp) && $submission->data[1][0] == 2) {
        $results_list = array_merge($results_list, $comp3_part_time);
      }
      if (in_array("VOL", $exp)) {
        $results_list = array_merge($results_list, $comp3_volunteering);
      }
      if (in_array("SERVICE", $exp)) {
        $results_list = array_merge($results_list, $comp3_service_learning);
      }
    }

    //Debug
    dsm($results_list);

    $results = array();
    $descr = array();
    //Must check if there is not enough experiences
    if (count($results_list) < 3) {
      while (count($results_list) < 3) {
        $results_list[] = "No experiences";
      }
      $results = $results_list;
    }
    else {
      for ($i = 0; $i < 3; $i++) {
        $results[$i] = get_random_element($results_list);
        //Delete from array to avoid duplicates
        $element = array_search($results[$i], $results_list);
        unset($results_list[$element]);
        //Reindex the keys in array
        $results_list = array_values($results_list);
      }
    }

    //Now obtain the corresponding description for each result
    for ($i = 0; $i < 3; $i++) {
      if (is_course($results[$i])) {
        $descr[] = $results[$i] . $comp3_descr["COURSE"];
      }
      elseif (is_student_society_position($results[$i])) {
        $descr[] = $comp3_descr["SSOC_POSITIONS"];
      }
      else {
        $descr[] = $comp3_descr[$results[$i]];
      }
    }
    $retval = array(
      "RESULT" => $results,
      "DESCR" => $descr,
    );
    return $retval;
  }//End function

/**
 * @return array
 * Generate result for Component 4: Capstone Workshop
 */
  function get_comp4() {
    global $submission;
    global $comp4_capstone_work;
    global $comp4_capstone_grad;
    global $comp4_capstone_prof;
    global $comp4_capstone_noplan;
    global $comp4_capstone_other;
    global $comp4_descr;

    $plans = $submission->data[11][0];
    $retval = array();
    switch ($plans) {
      case "WORK":
        $retval[] = get_random_element($comp4_capstone_work);
        break;
      case "GRAD":
        $retval[] = get_random_element($comp4_capstone_grad);
        break;
      case "PROF":
        $retval[] = get_random_element($comp4_capstone_prof);
        break;
      case "NOPLAN":
        $retval[] = get_random_element($comp4_capstone_noplan);
        break;
      case "OTHER":
        $retval[] = get_random_element($comp4_capstone_other);
        break;
      default:
        break;
    }
    $retval[] = $comp4_descr[$retval[0]];
    return $retval;
  }

/**
 * @param $string -> the string of the course code
 * @return string -> The return value will have the form
 * https://ugradcalendar.uwaterloo.ca/courses/$string[0-i]/$string[i-j]
 * The purpose of this function is to generate the href for the course code.
 */
  function gen_link($string) {
    global $comp3_urls;
    //TODO: Decide whether to put these into const_defs.php and combine in comp3_urls
    $on_campus_general = array(
      "University colleges",
      "Student societies",
      "Offices and services",
      "Faculties",
    );

    $off_campus_general = array(
      "Full-time",
      "Part-time",
      "Volunteering",
      "Service learning",
    );

    $capstone = array(
      "Working full-time",
      "Graduate school",
      "Professional school",
      "No plans",
      "Other",
    );

    if ($string == "No experiences") {
      return "";
    }
    elseif ($string == "CCA/EDGE Workshop") {
      return "https://uwaterloo.ca/career-action/appointments-workshops";
    }
    elseif (in_array($string, $on_campus_general)) {
      return "https://uwaterloo.ca/edge/students/edge-experiences";
    }
    elseif (in_array($string, $off_campus_general)) {
      return "https://uwaterloo.ca/edge/students/types-edge-experiences";
    }
    elseif (in_array($string, $capstone)) {
      return "https://uwaterloo.ca/edge/capstone-workshop";
    }
    elseif (is_course($string)) {
      $link = "https://ugradcalendar.uwaterloo.ca/courses/";
      $course_alpha = "";
      $course_num = "";
      $len = strlen($string);
      $string = str_replace(' ', '', $string);
      for ($i = 0; $i < strlen($string); $i++) {
        $char = $string[$i];
        if (!ctype_alpha($char)) {
          $course_num = substr($string, $i, $len);
          break;
        }
        else {
          $course_alpha .= $char;
        }
      }
      $link .= $course_alpha . "/" . $course_num;
      return $link;
    }
    else{
      return $comp3_urls[$string];
    }
  }

/**
 * @param $string
 * @param $link
 * Provides the start <a> tag if $string is not "No experiences"
 */
  function gen_href_start($string, $link){
    if ($string != "No experiences") {
      print  '<a href="' . $link . '" target="_blank">';
    }
  }

/**
 * @param $string
 * Provides the end <a> tag if $string is not "No experiences"
 */
  function gen_href_end($string){
    if ($string != "No experiences") {
      print '</a>';
    }
  }

/**
 * Provides the start and end of <a> tag for edge courses
 */
  function link_to_edge_courses() {
    print '<a href="https://uwaterloo.ca/edge/edge-courses" target="_blank">' .
      t('EDGE courses.') . '</a>';
  }

  function gen_descr($key, $descr){
    print "<p>" . t('@descr', array('@descr' => $descr));
    if(is_course($key)) {
      link_to_edge_courses();
    }
    print "</p>";
  }

  $comp1 = get_comp1();
  $comp2 = get_comp2();
  $comp3 = get_comp3();
  $comp4 = get_comp4();

?>

<!--TODO: BUG: Stop webpage refresh from re-running the function calls -->
<!--TODO: BUG: CAPTCHA session reuse attack detected -->
<!--TODO: REQUIRED: adjust nid for production site (breadcrumbs, template file, theme registry) -->
<!--TODO: REQUIRED: remove todos in production -->
<!--TODO: REQUIRED: adjust URLS to match production (back-button, breadcrumbs) -->
<!--TODO: Find a clean way to incorporate course descriptions -->
<!--TODO: Clean up using coding standards/use drupal wrapper functions AND Clean up dead code -->
<!--TODO: Add a print option/button -->
<!--TODO: Check if JS is getting used on other nodes -->
<!--TODO: Make a new module which applies css to next/prev buttons-->
<!--TODO: purge submissions -->
<!--TODO: Idea: re-write logic where there is a function for each question that returns a modified array -->
<!--TODO: Use const in const_defs -->
<!--TODO: Only need to check $major, since there are no overlapping majors -->
<!--TODO: Next/Prev buttons may need to be reverted to original CSS -->

<div class="flex-container">

  <div class="flex-message">
    <p>Based on your program of study and interests, here are some courses and
      experiences you can take to fulfill the components of the EDGE program.
      You don't have to complete these courses and experience in the order in
      which they're displayed. Make sure to check out the prerequisites and
      scheduling governing your results before planning your journey through EDGE.
      If you need help making a plan, contact Ben McDonald at
    <a href="mailto:ben.mcdonald@uwaterloo.ca">ben.mcdonald@uwaterloo.ca.</a>
    </p>
  </div>

  <div class="flex-comp-title margin-top">
    <h5>Component 1: Skills Identification and Articulation Workshop</h5>
</div>

  <div class="flex-comp-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
      <?php gen_href_start($comp1[0], gen_link($comp1[0])); ?>
        <div class="call-to-action-wrapper">
          <div class="call-to-action-theme-uWaterloo">
            <div class="call-to-action-big-text"> <?php print $comp1[0] ?> </div>
          </div>
        </div>
      <?php gen_href_end($comp1[0]) ?>
      </div>
    </div>
  </div>

  <div class="flex-comp-descr">
    <div>
      <?php gen_descr($comp1[0], $comp1[1]); ?>
    </div>
  </div>

  <div class="flex-comp-title margin-top">
    <h5>Component 2: Career Development Course</h5>
  </div>

  <div class="flex-comp-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($comp2[0], gen_link($comp2[0])); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $comp2[0] ?> </div>
            </div>
          </div>
        <?php gen_href_end($comp2[0]); ?>
      </div>
    </div>
  </div>

  <div class="flex-comp-descr">
    <div>
      <?php gen_descr($comp2[0], $comp2[1]); ?>
    </div>
  </div>

   <div class="flex-comp-title margin-top">
    <h5>Component 3: Work/Community Experiences</h5>
  </div>

  <div class="flex-comp-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($comp3["RESULT"][0] , gen_link($comp3["RESULT"][0])); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $comp3["RESULT"][0] ?> </div>
            </div>
          </div>
        <?php gen_href_end($comp3["RESULT"][0]); ?>
      </div>
    </div>
  </div>

  <div class="flex-comp-descr">
    <div>
      <?php gen_descr($comp3["RESULT"][0], $comp3["DESCR"][0]); ?>
    </div>
  </div>

  <div class="flex-comp-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($comp3["RESULT"][1] , gen_link($comp3["RESULT"][1])); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $comp3["RESULT"][1] ?> </div>
            </div>
          </div>
        <?php gen_href_end($comp3["RESULT"][1]); ?>
      </div>
    </div>
  </div>

  <div class="flex-comp-descr">
    <div>
      <?php gen_descr($comp3["RESULT"][1], $comp3["DESCR"][1]); ?>
    </div>
  </div>

  <div class="flex-comp-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($comp3["RESULT"][2] , gen_link($comp3["RESULT"][2])); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $comp3["RESULT"][2] ?> </div>
            </div>
          </div>
        <?php gen_href_end($comp3["RESULT"][2]); ?>
      </div>
    </div>
  </div>

  <div class="flex-comp-descr">
    <div>
      <?php gen_descr($comp3["RESULT"][2], $comp3["DESCR"][2]); ?>
    </div>
  </div>

  <div>
    <?php
        if($submission->data[1][0] == 1){
          print '<p>'.
            t('If you\'re an international student and you\'ve expressed 
              an interest in full- or part-time work off-campus, contact the 
              EDGE team at <a href="@mail">edge@uwaterloo.ca.</a>',
              array('@mail' => 'mailto:edge@uwaterloo.ca')).
            '</p>';
        };
      ?>
  </div>

  <div class="flex-comp-title margin-top">
    <h5>Component 4: Capstone Workshop</h5>
  </div>

  <div class="flex-comp-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($comp4[0], gen_link($comp4[0])); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $comp4[0] ?> </div>
            </div>
          </div>
        <?php gen_href_end($comp4[0]); ?>
      </div>
    </div>
  </div>

  <div class="flex-comp-descr">
    <div>
      <?php gen_descr($comp4[0], $comp4[1]); ?>
    </div>
  </div>

  <div class="flex-back-button-wrapper">
    <div id ="back-button" class="edge-action-button-wrapper adjust-height">
      <div class="call-to-action-wrapper">
        <a href="/edge/find-your-edge">
          <div class="call-to-action-wrapper adjust-height">
            <div class="edge-action-button-gray"> 
              <div class="call-to-action-big-text">
                <?php print t("Start over") ?>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="flex-redo-button-wrapper">
    <div id="redo-button" class="edge-action-button-wrapper alignment adjust-height">
      <div class="call-to-action-wrapper">
        <a href="">
          <div id="redo-hover-area" class="call-to-action-wrapper adjust-height">
            <div class="edge-action-button-gray">
              <div class="call-to-action-big-text">
                <?php print t("Generate new EDGE path") ?>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="top-hover-wrapper">
      <p class="top-hover">Please note that your path through EDGE is randomly generated.
        You may need to randomize several times to receive different results depending on your responses.
      </p>
    </div>
  </div>

</div>




