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
 * Variable definitions.
 * This section defines the values associated with each variable.
 * In order to access submission values, syntax is as follows:
 * $submission->data[i][j] where i is the question number and j is the answer #
 * Note that j begins at 0
 */
  $sid = $_GET['sid'];
  global $submission;
  $submission = webform_get_submission($node->nid, $sid);
  //Debug
  //dsm($submission);




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
 * Helper function to check if string is a course code
 * This assumes all course code will always start with a letter and end with a number
 */
  function is_course($string) {
    $first = $string[0];
    $last = $string[strlen($string) - 1];

    if (ctype_alpha($first) && (ctype_digit($last) || $last == "A")) {
      return true;
    }
    else {
      return false;
    }
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
    global $comp3_uni_college;
    global $comp3_student_soc;
    global $comp3_offices_services;
    global $comp3_faculties;
    global $comp3_full_time;
    global $comp3_part_time;
    global $comp3_volunteering;
    global $comp3_service_learning;
    global $comp3_descr;

    $results_list = array();
    if (in_array("ACA", $submission->data[8])) {
      $faculty = $submission->data[2][0];
      $major = get_major();
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
        $results_list = array_merge($results_list, $comp3_faculties);
      }
      if (in_array("UC", $exp)) {
        $results_list = array_merge($results_list, $comp3_uni_college);
      }
      if (in_array("SSOC", $exp)) {
        $results_list = array_merge($results_list, $comp3_student_soc);
      }
      if (in_array("OAS", $exp)) {
        $results_list = array_merge($results_list, $comp3_offices_services);
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

    for ($i = 0; $i < 3; $i++) {
      if (is_course($results[$i])) {
        $descr[] = $results[$i] . $comp3_descr["COURSE"];
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
    //TODO: replace placeholder link for CCA/EDGE Workshop
    if ($string == "CCA/EDGE Workshop") {
      return "https://uwaterloo.ca/career-action/appointments-workshops";
    }
    //TODO: replace placeholder link
    //TODO: code refactor on this?
    elseif ($string == "University colleges" || $string == "Student societies" ||
      $string == "Offices and services" || $string == "Faculties") {
      return "https://uwaterloo.ca/edge/students/edge-experiences";
    }
    elseif ($string == "Full-time" || $string == "Part-time" ||
      $string == "Volunteering" || $string == "Service learning") {
      return "https://uwaterloo.ca/edge/students/types-edge-experiences";
    }
    elseif ($string == "Working full-time" ||
      $string == "Graduate school" || $string == "Professional school"
      || $string == "No plans" || $string == "Other") {
      return "https://uwaterloo.ca/edge/capstone-workshop";
    }
    else {
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
    else {
      //print '<div>';
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
    else{
      //print '</div>';
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


<!--TODO: Check accessibility levels-->
<!--TODO: BUG: Stop webpage refresh from re-running the function calls -->
<!--TODO: Find a clean way to incorporate course descriptions -->
<!--TODO: Clean up using coding standards/use drupal wrapper functions AND Clean up dead code -->
<!--TODO: Change call to action hover effect based on faculty -->
<!--TODO: Add a print option/button -->
<!--TODO: BUG: CAPTCHA session reuse attack detected -->
<!--TODO: BUG: Double click on submit button -->
<!--TODO: Idea: re-write logic where there is a function for each question that returns a modified array -->
<!--TODO: REQUIRED: adjust nid for production site (breadcrumbs, template file, theme registary) -->
<!--TODO: REQUIRED: remove todos in production -->
<!--TODO: Remove Time off option -->
<!--TODO: Off campus exp should link to type of exp-->

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

  <div class="flex-comp-title margin_top">
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

  <div class="flex-comp-title margin_top">
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


   <div class="flex-comp-title margin_top">
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

  <div class="flex-comp-title margin_top">
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


  <div class="flex-back-btn-wrapper">
    <div id ="back-btn" class="footer_actions_wrapper adjust-height">
      <div class="call-to-action-wrapper">
        <a href="/edge/find-your-edge">
          <div class="call-to-action-wrapper adjust-height">
            <div class="fye_action_btn">
              <div class="call-to-action-big-text">
                <?php print t("Start over") ?>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="flex-redo-btn-wrapper">
    <div id="redo-btn" class="footer_actions_wrapper alignment adjust-height">
      <div class="call-to-action-wrapper">
        <a href="">
          <div class="call-to-action-wrapper adjust-height">
            <div class="fye_action_btn">
              <div class="call-to-action-big-text">
                <?php print t("Generate new EDGE path") ?>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

</div>




