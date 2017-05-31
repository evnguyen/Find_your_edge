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
 * Declaration of global variable.
 * This section declares the following list of variables to have global access.
 * Having global access lets the variable be used within a function
 */
  global $submission;
  global $comp1_all_courses;
  global $comp1_ahs_courses;
  global $comp1_env_courses;
  global $comp1_math_courses;
  global $comp2_all_courses;
  global $comp2_arts_all_courses;
  global $comp2_arts_psci_courses;

/**
 * Variable definitions.
 * This section defines the values associated with each variable.
 * In order to access submission values, syntax is as follows:
 * $submission->data[i][j] where i is the question number and j is 0
 * TODO: Change variable names for compX_all_courses
 */
  $sid = $_GET['sid'];
  $submission = webform_get_submission($node->nid, $sid);

  $comp1_all_courses = array(
    1 => "CCA Workshop",
    );
  $comp1_ahs_courses = array(
    1 => "AHS 107",
    2 => "CCA Workshop",
    );
  $comp1_env_courses = array(
    1 => "ENVS 178",
    2 => "CCA Workshop",
    );
  $comp1_math_courses = array(
    1 => "ENGL 119",
    2 => "CCA Workshop",
    );

  $comp2_all_courses = array(
    1 => "PD1",
    );
  $comp2_arts_all_courses = array(
    1 => "ARTS 111",
    2 => "PD1",
    );
  $comp2_arts_psci_courses = array(
    1 => "PSCI 299",
    2 => "ARTS 111",
    3 => "PD1",
    );

  $comp3_arts_drama_courses = array(
    1 => "DRAMA 206",
    2 => "DRAMA 207",
    3 => "DRAMA 243",
    4 => "DRAMA 244",
    5 => "DRAMA 306",
    6 => "DRAMA 307",
    7 => "DRAMA 316",
    8 => "DRAMA 317",
    9 => "DRAMA 400",
    10 => "DRAMA 406",
    11 => "DRAMA 407",
    12 => "DRAMA 416",
    13 => "DRAMA 417",
  );
  $comp3_arts_fine_courses = array(
    1 => "FINE 243",
    2 => "FINE 343",
  );
  $comp3_arts_gbda_courses = array(
    1 => "GBDA 301",
    2 => "GBDA 302",
    3 => "GBDA 401",
    4 => "GBDA 402",
  );
  $comp3_arts_ger_courses = array(
    1 => "GER 407",
  );
  $comp3_arts_ls_courses = array(
    1 => "LS 434",
  );
  $comp3_arts_pac_courses = array(
    1 => "PAC 390",
    2 => "PAC 395",
  );
  $comp3_arts_psci_courses = array(
    1 => "PSCI 498C",
  );
  $comp3_arts_psych_courses = array(
    1 => "PSYCH 465",
    2 => "PSYCH 466",
    3 => "PSYCH 467",
  );
  $comp3_arts_sds_courses = array(
    1 => "SDS 370R",
    2 => "SDS 496R",
  );







/**
 * @param $list -> an array which holds the list of elements to be chosen from
 * @return string
 * Helper function for getting a random element in an array
 */
  function getRandomElement($list){
    $min = 1;
    $max = count($list);
    $index = rand($min, $max);
    $retval = $list[$index];
    return $retval;
  }

/**
 * @return string
 * Generate the results for Component 1: Skills identification
 */
  //TODO: Change if conditions to switch statements if required
  function getComp1(){
    global $submission;
    global $comp1_all_courses;
    global $comp1_ahs_courses;
    global $comp1_env_courses;
    global $comp1_math_courses;

    if($submission->data[2][0] == "AHS"){
      $retval = getRandomElement($comp1_ahs_courses);
      return $retval;
    }
    elseif ($submission->data[2][0] == "ENV"){
      $retval = getRandomElement($comp1_env_courses);
      return $retval;
    }
    elseif ($submission->data[2][0] == "MATH"){
      $retval = getRandomElement($comp1_math_courses);
      return $retval;
    }
    else{
      $retval = getRandomElement($comp1_all_courses);
      return $retval;
    }

  }

/**
 * @return string
 * Generate the results for Component 2: Career Development Course
 */
  function getComp2(){
    global $submission;
    global $comp2_all_courses;
    global $comp2_arts_all_courses;
    global $comp2_arts_psci_courses;

    if($submission->data[2][0] == "ART" && $submission->data[4][0] == "PSCI"){
      $retval = getRandomElement($comp2_arts_psci_courses);
      return $retval;
    }
    elseif($submission->data[2][0] == "ART"){
      $retval = getRandomElement($comp2_arts_all_courses);
      return $retval;
    }
    else{
      $retval = getRandomElement($comp2_all_courses);
      return $retval;
    }
  }


/**
 * @return string
 * Generate the results for Component 3: Work/Community Experiences
 */
  function getComp3(){
    global $submission;
    global $comp2_all_courses;
    global $comp2_arts_all_courses;
    global $comp2_arts_psci_courses;

    if($submission->data[2][0] == "ART" && $submission->data[4][0] == "PSCI"){
      $retval = getRandomElement($comp2_arts_psci_courses);
      return $retval;
    }
    elseif($submission->data[2][0] == "ART"){
      $retval = getRandomElement($comp2_arts_all_courses);
      return $retval;
    }
    else{
      $retval = getRandomElement($comp2_all_courses);
      return $retval;
    }
  }



/**
 * @param $string -> the string of the course code
 * @return string -> The return value will have the form
 * https://ugradcalendar.uwaterloo.ca/courses/$string[0-i]/$string[i-j]
 * The purpose of this function is to generate the href for the course code.
 */
  function genLink($string){
    //TODO: replace this placeholder link for CCA workshop
    if($string == "CCA Workshop"){
      return "https://uwaterloo.ca/career-action/appointments-workshops";
    }
    else{
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
  }

?>

<!--HTML section -->
<!--TODO: Make the text translatable through php AND check accessibility levels-->
<!--TODO: Stop webpage refresh from re-running the function calls -->
<!--TODO: Make the width of the confirmation page wider -->
<!--TODO: Find a clean way to incorporate course descriptions -->
<!--TODO: Clean up dead code -->
<!--TODO: Clean up using coding standards -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.js"></script>
<div class="container-grid">
  <div class="grid-item webform-confirmation">
    <p>Based on your program of study and interests, here are some courses and
    experiences you can take to fulfill the components of the EDGE program</p>
  </div>

  <!-- COMPONENT 1 -->
  <div class="component1 margin_top">
    <p>Component 1: Skills identification and Articulation Workshop</p>
  </div>

  <?php
  $comp1 = getComp1();
  print
  '<div class="component1_block">' .
    '<div class="width_adjust">'.
      '<div class="call-to-action-top-wrapper">'.
        '<a href="' . genLink($comp1) . '"' . '>' .
          '<div class="call-to-action-wrapper">' .
            '<div class="call-to-action-theme-uWaterloo">'.
              '<div class="call-to-action-big-text">'. $comp1 .
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

  <!-- COMPONENT 2 -->
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

  <!-- COMPONENT 3 -->
  <div class="component3 margin_top">
    <p>Component 3: Work/Community Experiences</p>
  </div>

  <?php
  $comp2 = "Comp3";
  print
    '<div class="component3_block1">' .
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

  <div class="component3_descr1">
    <div>
      <p>Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block.</p>
    </div>
  </div>

  <?php
  $comp2 = "Comp3";
  print
    '<div class="component3_block2">' .
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

  <div class="component3_descr2">
    <div>
      <p>Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block.</p>
    </div>
  </div>

  <?php
  $comp2 = "Comp3";
  print
    '<div class="component3_block3">' .
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

  <div class="component3_descr3">
    <div>
      <p>Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block. Some text that describes the block.</p>
    </div>
  </div>



  <!-- COMPONENT 4 -->
  <div class="component4">
    <p>Component 4: Capstone Workshop</p>
  </div>

</div>


<!--Bottom buttons-->
<div class="links">
  <!-- TODO: Add the href link -->
  <a href=""><?php print t('Go back to the form'); ?></a>
</div>
