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

/**
 * Helper function for getting a random element in an array
 * @param $list -> an array which holds the list of elements to be chosen from
 * @return string
 */
  function get_random_element($list) {
    $min = 0;
    $max = count($list) - 1;
    $index = rand($min, $max);
    $retval = $list[$index];
    return $retval;
  }


/**
 * Helper function that checks if a string contains a number. Returns false
 * otherwise.
 * @param $string
 *
 * @return bool
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
 * Helper function to check if string is a course code
 * This assumes all course code will always start with a letter and end with either
 * a number or an uppercase letter. Furthermore, every course code will have at
 * least one number
 * @param $string
 * @return bool
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
 * Helper function to check if a string is a PD course
 * This assumes that every PD course will start with "PD" and the last character
 * of the string is a number
 * @param $string
 * @return bool
 */
  function is_pd_course($string) {
    $pd = $string[0] . $string[1];
    $last = $string[drupal_strlen($string) - 1];
    return (ctype_digit($last) && $pd == "PD");
  }

/**
 * Helper function to check if position is a Don position
 * @param $string
 *
 * @return bool
 */
  function is_don_position($string) {
    $length = drupal_strlen($string);
    $word = "";
    for ($i = 4; $i > 0; $i--) {
      $word .= $string[$length-$i];
    }
    return ($word == " Don" || $word == " don");
  }

/**
 * Helper function which filters the list into a list with only one Don position
 * @param $list
 *
 * @return array
 */
  function filter_don_positions($list) {
    $length = count($list);

    for ($i = 0; $i < $length; $i++) {
      if (is_don_position($list[$i])) {
        unset($list[$i]);
        //Reindex the keys in array
        $list = array_values($list);
        $length--;
      }
    }
    return $list;
  }

/**
 * Helper function which filters the list into a list with only one Don position
 * @param $list
 *
 * @return array
 */
  function filter_don($list) {
    $length = count($list);

    for ($i = 0; $i < $length; $i++) {
      if (is_don_position($list[$i]->result)) {
        unset($list[$i]);
        //Reindex the keys in array
        $list = array_values($list);
        $length--;
      }
    }
    return $list;
  }

/**
 * Cross checks submission values with the given rule
 * @param $data
 * @param $rule
 *
 * @return bool
 */
  function rule_met($data, $rule) {
    $length = count($data);
    //reindex array
    $data = array_values($data);
    for ($i = 0; $i < $length; $i++) {
      if (isset($data[$i])) {
        $number_of_selections = count($data[$i]);
        for ($j = 0; $j < $number_of_selections; $j++) {
          if(in_array($data[$i][$j], $rule)) {
            $index = array_search($data[$i][$j], $rule);
            unset($rule[$index]);
            //Reindex the keys in array
            $rule = array_values($rule);
          }
        }
      }
    }
    return empty($rule);
  }

/**
 * Obtains the 1st component of the EDGE path
 * @param $submission
 *
 * @return string
 */
  function get_component1($submission) {
    $query = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer')
      ->condition('component', '1')
      ->execute()
      ->fetchAll();

    $length = count($query);
    $results = array();
    for ($i = 0; $i < $length; $i++) {
      $rule = explode(',', str_replace(' ', '', $query[$i]->rule));
      if ($rule[0] == 'NORULE' || rule_met($submission->data, $rule)) {
        $ruleset = new stdClass();
        $ruleset->result = $query[$i]->result;
        $ruleset->description = $query[$i]->description;
        $ruleset->url = $query[$i]->url;
        if (!in_array($ruleset, $results)) {
          $results[] = $ruleset;
        }
      }
    }
    return get_random_element($results);
  }


/**
 * Obtains the 2nd component of the EDGE path
 * @param $submission
 *
 * @return string
 */
  function get_component2($submission) {
    $query = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer')
      ->condition('component', '2')
      ->execute()
      ->fetchAll();

    $length = count($query);
    $results = array();
    for ($i = 0; $i < $length; $i++) {
      $rule = explode(',', str_replace(' ', '', $query[$i]->rule));
      if ($rule[0] == 'NORULE' || rule_met($submission->data, $rule)) {
        $ruleset = new stdClass();
        $ruleset->result = $query[$i]->result;
        $ruleset->description = $query[$i]->description;
        $ruleset->url = $query[$i]->url;
        if (!in_array($ruleset, $results)) {
          $results[] = $ruleset;
        }
      }
    }
    return get_random_element($results);
  }

/**
 * Obtains the 3rd component of the EDGE path.
 * Note: Only 1 Don position can be used as an experience at a time.
 * Furthermore, once a specific on-campus experience has been found, its
 * corresponding general result will be removed from the list of possible results
 * @param $submission
 *
 * @return array
 */
  function get_component3($submission) {
    $query = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer')
      ->condition('component', '3')
      ->execute()
      ->fetchAll();

    $faculties = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer', array('result'))
      ->condition('rule', '%FAC%', 'LIKE')
      ->condition('result', array('Faculties'), 'NOT IN')
      ->execute()
      ->fetchCol();

    $university_colleges = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer', array('result'))
      ->condition('rule', '%UC%', 'LIKE')
      ->condition('result', array('University colleges'), 'NOT IN')
      ->execute()
      ->fetchCol();

    $student_society = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer', array('result'))
      ->condition('rule', '%SSOC%', 'LIKE')
      ->condition('result', array('Student societies'), 'NOT IN')
      ->execute()
      ->fetchCol();

    $clubs = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer', array('result'))
      ->condition('rule', '%CLUBS%', 'LIKE')
      ->condition('result', array('Feds clubs'), 'NOT IN')
      ->execute()
      ->fetchCol();

    $housing = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer', array('result'))
      ->condition('rule', '%HOUSEATHL%', 'LIKE')
      ->condition('result', array('Student services'), 'NOT IN')
      ->execute()
      ->fetchCol();

    $feds = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer', array('result'))
      ->condition('rule', '%FEDS%', 'LIKE')
      ->condition('result', array('Feds services'), 'NOT IN')
      ->execute()
      ->fetchCol();

    $has_faculty = FALSE;
    $has_university_college = FALSE;
    $has_student_society = FALSE;
    $has_clubs = FALSE;
    $has_housing = FALSE;
    $has_feds = FALSE;

    $length = count($query);
    $results = array();
    for ($i = 0; $i < $length; $i++) {
      $rule = explode(',', str_replace(' ', '', $query[$i]->rule));
      if ($rule[0] == 'NORULE' || rule_met($submission->data, $rule)) {
        $ruleset = new stdClass();
        $ruleset->result = $query[$i]->result;
        $ruleset->description = $query[$i]->description;
        $ruleset->url = $query[$i]->url;
        if (!in_array($ruleset, $results)) {
          $results[] = $ruleset;
        }
        //Check if we've found a specific result
        if(in_array($ruleset->result, $faculties)) {
          $has_faculty = TRUE;
        }
        elseif(in_array($ruleset->result, $university_colleges)) {
          $has_university_college = TRUE;
        }
        elseif(in_array($ruleset->result, $student_society)) {
          $has_student_society = TRUE;
        }
        elseif(in_array($ruleset->result, $clubs)) {
          $has_clubs = TRUE;
        }
        elseif(in_array($ruleset->result, $housing)) {
          $has_housing = TRUE;
        }
        elseif(in_array($ruleset->result, $feds)) {
          $has_feds = TRUE;
        }
      }
    }//End for loop

    //If we've gotten a specific result, then unset the general result
    $results_length = count($results);
    if($has_faculty) {
      for ($i = 0; $i < $results_length; $i++) {
        if ($results[$i]->result == 'Faculties') {
          unset($results[$i]);
          //Reindex the keys in array
          $results = array_values($results);
          $results_length--;
          break;
        }
      }
    }
    if($has_university_college) {
      for ($i = 0; $i < $results_length; $i++) {
        if ($results[$i]->result == 'University colleges') {
          unset($results[$i]);
          //Reindex the keys in array
          $results = array_values($results);
          $results_length--;
          break;
        }
      }
    }
    if($has_student_society) {
      for ($i = 0; $i < $results_length; $i++) {
        if ($results[$i]->result == 'Student societies') {
          unset($results[$i]);
          //Reindex the keys in array
          $results = array_values($results);
          $results_length--;
          break;
        }
      }
    }
    if($has_housing) {
      for ($i = 0; $i < $results_length; $i++) {
        if ($results[$i]->result == 'Student services') {
          unset($results[$i]);
          //Reindex the keys in array
          $results = array_values($results);
          $results_length--;
          break;
        }
      }
    }
    if($has_clubs) {
      for ($i = 0; $i < $results_length; $i++) {
        if ($results[$i]->result == 'Feds clubs') {
          unset($results[$i]);
          //Reindex the keys in array
          $results = array_values($results);
          $results_length--;
          break;
        }
      }
    }
    if($has_feds) {
      for ($i = 0; $i < $results_length; $i++) {
        if ($results[$i]->result == 'Feds services') {
          unset($results[$i]);
          //Reindex the keys in array
          $results = array_values($results);
          $results_length--;
          break;
        }
      }
    }

    if (count($results) < 3) {
      while (count($results) < 3) {
        $ruleset = new stdClass();
        $ruleset->result = "Other Experience";
        //No lines breaks since it will be picked up when generating the PDF
        $ruleset->description = "We couldn't create a full set of experiences based on your responses. You can still complete this milestone using experiences that aren't in our database. Visit our page devoted to the different <a href=\"https://uwaterloo.ca/edge/students/types-edge-experiences\" target=\"_blank\">types of EDGE experiences</a> to learn more about the criteria for this milestone.";
        $ruleset->url = "";
        $results[] = $ruleset;
      }
      $return_list = $results;
    }
    else {
      for ($i = 0; $i < 3; $i++) {
        $return_list[] = get_random_element($results);
        //Delete from array to avoid duplicates
        $index = array_search($return_list[$i], $results);
        unset($results[$index]);
        //Reindex the keys in array
        $results = array_values($results);

        //If we've found a Don position, filter out the rest so we can't get another
        //This should only be true at most ONCE
        if (is_don_position($return_list[$i]->result)) {
          $results = filter_don($results);
        }
      }
    }
    return $return_list;
  }


/**
 * Obtains the PD course for the EDGE path
 * @param $submission
 *
 * @return string
 */
  function get_component_pd($submission) {
    $query = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer')
      ->condition('component', 'pd')
      ->execute()
      ->fetchAll();

    $length = count($query);
    $results = array();
    for ($i = 0; $i < $length; $i++) {
      $rule = explode(',', str_replace(' ', '', $query[$i]->rule));
      if ($rule[0] == 'NORULE' || rule_met($submission->data, $rule)) {
        $ruleset = new stdClass();
        $ruleset->result = $query[$i]->result;
        $ruleset->description = $query[$i]->description;
        $ruleset->url = $query[$i]->url;
        if (!in_array($ruleset, $results)) {
          $results[] = $ruleset;
        }
      }
    }
    return get_random_element($results);
  }


/**
 * Obtains the 4th component of the EDGE path
 * @param $submission
 *
 * @return string
 */
  function get_component4($submission) {
    $query = db_select('find_your_edge_rulesets', 'fyer')
      ->fields('fyer')
      ->condition('component', '4')
      ->execute()
      ->fetchAll();

    $length = count($query);
    $results = array();
    for ($i = 0; $i < $length; $i++) {
      $rule = explode(',', str_replace(' ', '', $query[$i]->rule));
      if ($rule[0] == 'NORULE' || rule_met($submission->data, $rule)) {
        $ruleset = new stdClass();
        $ruleset->result = $query[$i]->result;
        $ruleset->description = $query[$i]->description;
        $ruleset->url = $query[$i]->url;
        if (!in_array($ruleset, $results)) {
          $results[] = $ruleset;
        }
      }
    }
    return get_random_element($results);
  }


/**
 * @param $string
 * @param $link
 * Provides the start <a> tag if $string is not "Other Experience"
 */
  function gen_href_start($string, $link){
    if ($string != "Other Experience") {
      print  '<a href="' . $link . '" target="_blank">';
    }
  }

/**
 * @param $string
 * Provides the end <a> tag if $string is not "Other Experience"
 */
  function gen_href_end($string){
    if ($string != "Other Experience") {
      print '</a>';
    }
  }

/**
 * @param $string
 *
 * @return mixed
 * Process the string so that it can properly added to a pdf template
 */
  function pdf_process($key, $string) {
    //$value = preg_replace('/  +/', ' ' , preg_replace(array('/  +/', '/\n/', '/\r/'), ' ', $string));
    $value = preg_replace('/<a href=.*/', '', $string);
    if((is_course($key) && !is_pd_course($key)) || $key == "PD1") {
      $value .= 'EDGE courses.';
    }
    elseif ($key == "Other Experience") {
      $value .= 'types of EDGE experiences to learn more about the criteria for this milestone.';
    }
    return $value;
  }

/**
 * @param $sid
 * @param $comp1
 * @param $comp2
 * @param $comp3
 * @param $comp4
 * Write to database for pdf use
 */
  function pdf_store_results($sid, $component1, $component2, $component3, $component_pd, $component4) {
    $result_db = new stdClass();
    $result_db->sid = $sid;
    $result_db->component1 = $component1->result;
    $result_db->component1_descr = pdf_process($component1->result, $component1->description);
    $result_db->component2 = $component2->result;
    $result_db->component2_descr = pdf_process($component2->result, $component2->description);
    $result_db->component3a = $component3[0]->result;
    $result_db->component3a_descr = pdf_process($component3[0]->result, $component3[0]->description);
    $result_db->component3b = $component3[1]->result;
    $result_db->component3b_descr = pdf_process($component3[1]->result, $component3[1]->description);
    $result_db->component3c = $component3[2]->result;
    $result_db->component3c_descr = pdf_process($component3[2]->result, $component3[2]->description);
    $result_db->component3_pd = $component_pd->result;
    $result_db->component3_pd_descr = pdf_process($component_pd->result, $component_pd->description);
    $result_db->component4 = $component4->result;
    $result_db->component4_descr = pdf_process($component4->result, $component4->description);
    $query = db_select('find_your_edge_results', 'fyer')
      ->fields('fyer')
      ->condition('sid', $sid)
      ->execute()
      ->fetchAll();

    if(count($query) == 0) {
      drupal_write_record('find_your_edge_results', $result_db);
    }
    else{
      drupal_write_record('find_your_edge_results', $result_db, 'sid');
    }
  }

  $sid = $_GET['sid'];
  $submission = webform_get_submission($node->nid, $sid);
  $access_token = token_replace('[submission:access-token]', array('webform-submission' => $submission));
  //Debug
  //dsm($submission);

  $component1 = get_component1($submission);
  $component2 = get_component2($submission);
  $component3 = get_component3($submission);
  $component_pd = get_component_pd($submission);
  $component4 = get_component4($submission);

  pdf_store_results($sid, $component1, $component2, $component3, $component_pd, $component4);
?>

<!--TODO: BUG: Stop webpage refresh from re-running the function calls -->
<!--TODO: BUG: CAPTCHA session reuse attack detected -->
<!--TODO: purge submissions and results table-->

<div class="flex-container">

  <div class="flex-message">
    <p>We're recommending the following EDGE courses, workshops and opportunities
      based on your responses. You can complete these milestones during any term
      and in almost any order you choose. It may be possible for you to complete
      EDGE with an entirely different set of milestones — these are just recommendations.
      The choice is ultimately yours. Each milestone will provide a link for further information in a separate tab.</p>
    <p>If you're ready to take the next step, you can register for EDGE by submitting the
      <a href="https://uwaterloo.ca/edge/registration-form" target="_blank">registration form</a>
      available on our website. If you have any questions or concerns about the registration process,
      contact EDGE instructional support coordinator Ben McDonald at
      <a href="mailto:ben.mcdonald@uwaterloo.ca">ben.mcdonald@uwaterloo.ca.</a>
    </p>
  </div>

  <div class="flex-component-title margin-top">
    <h2>Skills Identification and Articulation Workshop</h2>
</div>

  <div class="flex-component-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
      <?php gen_href_start($component1->result, $component1->url) ?>
        <div class="call-to-action-wrapper">
          <div class="call-to-action-theme-uWaterloo">
            <div class="call-to-action-big-text"> <?php print $component1->result ?> </div>
          </div>
        </div>
      <?php gen_href_end($component1->result) ?>
      </div>
    </div>
  </div>

  <div class="flex-component-description">
    <div>
      <?php print $component1->description?>
    </div>
  </div>

  <div class="flex-component-title margin-top">
    <h2>Career Development Course</h2>
  </div>

  <div class="flex-component-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($component2->result, $component2->url); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $component2->result ?> </div>
            </div>
          </div>
        <?php gen_href_end($component2->result); ?>
      </div>
    </div>
  </div>

  <div class="flex-component-description">
    <div>
      <?php print $component2->description ?>
    </div>
  </div>

   <div class="flex-component-title margin-top">
    <h2>Work and Community Experiences</h2>
  </div>

  <div class="flex-component-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($component3[0]->result , $component3[0]->url);?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $component3[0]->result ?> </div>
            </div>
          </div>
        <?php gen_href_end($component3[0]->result); ?>
      </div>
    </div>
  </div>

  <div class="flex-component-description">
    <div>
      <?php print $component3[0]->description ?>
    </div>
  </div>

  <div class="flex-component-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($component3[1]->result , $component3[1]->url); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $component3[1]->result ?> </div>
            </div>
          </div>
        <?php gen_href_end($component3[1]->result); ?>
      </div>
    </div>
  </div>

  <div class="flex-component-description">
    <div>
      <?php print $component3[1]->description ?>
    </div>
  </div>

  <div class="flex-component-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($component3[2]->result , $component3[2]->url); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $component3[2]->result ?> </div>
            </div>
          </div>
        <?php gen_href_end($component3[2]->result); ?>
      </div>
    </div>
  </div>

  <div class="flex-component-description">
    <div>
      <?php print $component3[2]->description ?>
    </div>
  </div>

  <div id="pd-block" class="flex-component-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($component_pd->result , $component_pd->url); ?>
        <div class="call-to-action-wrapper">
          <div class="call-to-action-theme-uWaterloo">
            <div class="call-to-action-big-text"> <?php print $component_pd->result ?> </div>
          </div>
        </div>
        <?php gen_href_end($component_pd->result); ?>
      </div>
    </div>
  </div>

  <?php
    if (isset($submission->data[1][0]) && $submission->data[1][0] == 1) {
      print '<div id="pd-description-international" class="flex-component-description pd-block">';
    }
    else {
      print '<div id="pd-description" class="flex-component-description pd-block">';
    }
  ?>
    <div>
      <?php print $component_pd->description ?>
    </div>
  </div>

  <div>
    <?php
        if(isset($submission->data[1][0]) && $submission->data[1][0] == 1) {
          print '<p> If you\'re an international student, you may need to adjust your path 
          through EDGE depending on your student visa and/or work permits. It\'s possible to complete 
          EDGE with experiential learning courses and on-campus experiences that don\'t involve permits. 
          For more information, contact the EDGE team at <a href="mailto:edge@uwaterloo.ca">edge@uwaterloo.ca</a>. </p>';
        }
      ?>
  </div>

  <div class="flex-component-title margin-top">
    <h2>Capstone Workshop</h2>
  </div>

  <div class="flex-component-block">
    <div class="component_square">
      <div class="call-to-action-top-wrapper">
        <?php gen_href_start($component4->result, $component4->url); ?>
          <div class="call-to-action-wrapper">
            <div class="call-to-action-theme-uWaterloo">
              <div class="call-to-action-big-text"> <?php print $component4->result ?> </div>
            </div>
          </div>
        <?php gen_href_end($component4->result); ?>
      </div>
    </div>
  </div>

  <div class="flex-component-description">
    <div>
      <?php print $component4->description ?>
    </div>
  </div>

  <div class="flex-message margin-top">
    <p> View a
      <?php
      $nid = variable_get('uw_find_your_edge_nid', 0);
        if(isset($submission->data[1][0]) && $submission->data[1][0] == 1) {
          $fid = variable_get('uw_find_your_edge_fid_international', 0);
          $url = fillpdf_pdf_link($form_id = $fid , $node_id = $nid);
          //print '<a href=' . $url . '"&fid=3&webform[sid]=' . $sid . '&sid=' . $sid . '&token=' . $access_token . '">PDF version of your EDGE path</a>';
          print '<a href=' . $url . '&webform[sid]=' . $sid . '&sid=' . $sid . '&token=' . $access_token . '">PDF version of your EDGE path</a>';
        }
        else {
          $fid = variable_get('uw_find_your_edge_fid_regular', 0);
          $url = fillpdf_pdf_link($form_id = $fid , $node_id = $nid);
          //print '<a href=' . $url . '&fid=3&webform[sid]=' . $sid . '&sid=' . $sid . '&token=' . $access_token .  '">PDF version of your EDGE path</a>';
          print '<a href=' . $url . '&webform[sid]=' . $sid . '&sid=' . $sid  . '&token=' . $access_token . '">PDF version of your EDGE path</a>';
        }
        ?>
    </p>
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
        <a id="redo-button-href" href="">
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
    <div class="text-box-hover-wrapper">
      <p class="text-box-hover">Please note that your path through EDGE is randomly generated.
        You may need to randomize several times to receive different results depending on your responses.
      </p>
    </div>
  </div>

</div>