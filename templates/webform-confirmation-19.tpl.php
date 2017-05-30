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
  //Global declarations
  $sid = $_GET['sid'];
  global $submission;
  global $comp1_ahs_courses;
  global $comp1_env_courses;
  global $comp1_math_courses;
  global $comp2_arts_all_courses;
  global $comp2_arts_psci_courses;
  $submission = webform_get_submission($node->nid, $sid);
    //$submission->data[i][j] where i is the question number and j is = 0

  $comp1_ahs_courses = array(
    1 => "AHS 107",
    2 => "CCA workshop",);
  $comp1_env_courses = array(
    1 => "ENVS 178",
    2 => "CCA workshop",);
  $comp1_math_courses = array(
    1 => "ENGL 119",
    2 => "CCA workshop",);
  $comp2_arts_all_courses = array(
    1 => "PSCI 299",
    2 => "PD1", );
  $comp2_arts_psci_courses = array(
    1 => "PSCI 299",
    2 => "PD1", );

  //Debug
  //dsm($submission);
  //dsm($node);
  $test = webform_submission_data($node, $submission->data);
  //dsm($test);

/**
 * Generate the results for Component 1: Skills identification
 */
  function getComp1(){
    global $submission;

  }

/**
 * Generate the results for Component 2: Career Development Course
 */
  function getComp2(){
    global $submission;
    global $comp2_arts_all_courses;
    global $comp2_arts_psci_courses;

    if($submission->data[2][0] == "ART" && $submission->data[4][0] == "PSCI"){
      $max = count($comp2_arts_psci_courses);
      $min = 1;
      $index = rand($min, $max);
      $retval = $comp2_arts_psci_courses[$index];
      return $retval;
    }
    else{
      $max = count($comp2_arts_psci_courses);
      $min = 1;
      $index = rand($min, $max);
      $retval = $comp2_arts_all_courses[$index];
      return $retval;
    }
  }

/**
 * Create a multiple functions that get called.
 * At least one for each component.
 */


/**
 * @param $string -> the string of the course code
 * @return string -> The return value will have the form  https://ugradcalendar.uwaterloo.ca/courses/$string[0-i]/$string[i-j]
 * The purpose of this function is to generate the href for the course code.
 */
  function genLink($string){
    $link = "https://ugradcalendar.uwaterloo.ca/courses/";
    $course_alpha = "";
    $course_num = "";
    $len = strlen($string);
    $string = str_replace(' ', '', $string);
    for ($i = 0; $i < strlen($string); $i++){
      $char = $string[$i];
      if(!ctype_alpha($char)){
        $course_num = substr($string, $i, $len);
        break;
      }
      else{
        $course_alpha .= $char;
      }
    }
    $link .= $course_alpha . "/" . $course_num;
    return $link;
  }

?>

<!--HTML section -->
<!--TODO: Make the text translatable through php AND check accessibility levels-->
<!--TODO: Adjust the alignment of the buttons -->
<!--TODO: Hover effect bug -->
<!--TODO: Stop webpage refresh from re-running the function calls -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.js"></script>
<div class="container-grid">
  <div class="grid-item webform-confirmation">
    <p>Based on your program of study and interests, here are some courses and
    experiences you can take to fulfill the components of the EDGE program</p>
  </div>

  <div class="component1 margin_top">
    <p>Component 1: Skills identification and Articulation Workshop</p>
  </div>

  <?php print
  '<div class="component1_block">' .
    '<div class="width_adjust">'.
      '<div class="call-to-action-top-wrapper">'.
        '<a href="' . genLink("AHS 107") . '"' . '>' .
          '<div class="call-to-action-wrapper">' .
            '<div class="call-to-action-theme-uWaterloo border_radius">'.
              '<div class="call-to-action-big-text">'. $comp1_ahs_courses[1] .
              '</div>' .
            '</div>'.
          '</div>' .
        '</a>' .
      '</div>' .
  '</div>'.
  '</div>'
  ?>

  <div class="component1_descr">
    <div>
      <?php print "<p>" . t("Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block. ") . "</p>" ?>
    </div>
  </div>

  <div class="component2 margin_top">
    <p>Component 2: Career Development Course</p>
  </div>


  <?php
  $comp2 = getComp2();
    print
      '<div class="component2_block">' .
        '<div class="width_adjust">'.
          '<div class="call-to-action-top-wrapper">'.
            '<a href="' . genLink($comp2) . '"' . '>' .
              '<div class="call-to-action-wrapper">' .
                '<div class="call-to-action-theme-uWaterloo">'.
                  '<div class="call-to-action-big-text">'. $comp2 . '</div>' .
                '</div>'.
              '</div>' .
            '</a>' .
          '</div>' .
        '</div>'.
      '</div>'
  ?>


  <div class="component2_descr">
    <div>
      <p>Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block.</p>
    </div>
  </div>

  <div class="component3">
    <p>Component 3: Work/Community Experiences</p>
  </div>

  <div class="component4">
    <p>Component 4: Capstone Workshop</p>
  </div>

</div>


<!--Bottom buttons-->
<div class="links">
  <!-- TODO: Add the href link -->
  <a href=""><?php print t('Go back to the form'); ?></a>
</div>
