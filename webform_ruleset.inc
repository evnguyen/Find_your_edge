<?php
/**
 * Created by PhpStorm.
 * User: evnguyen
 * Date: 6/30/2017
 * Time: 9:11 AM
 */

/**
 * @file
 * Handlers for configuring ruelsets
 */

/**
 * TODO: Need a way to prompt user there is unsaved work ->
 * TODO: Add a method to import CSV file?
 * TODO: Need a way to check for empty textfield?
 * TODO: Add some cool CSS (red delete button, red 'unsaved' ruleset)
 * TODO: Add no experiences fieldset OR use norule for it and just add some logic
 * TODO: Add drupal_set_message for all deletions
 */

/**
 * @param $form
 * @param $add_count
 * @param $ids
 * @param $component
 * @param int $start
 *
 * @return int
 * Creates new empty forms to be saved.
 */
function generate_form(&$form, $add_count, $ids, $component, $start = 0) {
  $index = $start;
  for (; $index < $add_count+$start; $index++) {
    $ruleset_id = $ids[$index];
    $form[$component]['ruleset' . $ruleset_id] = array(
      '#type' => 'fieldset',
      '#title' => t('Unsaved Ruleset'),
      '#collapsible' => TRUE,
    );
    $form[$component]['ruleset' . $ruleset_id]['rule' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('Rule'),
      '#description' => t('Set the rule using answer KEYS delimited by commas. Use key NORULE for results that apply to everything'),
      '#default_value' => FALSE,
    );
    $form[$component]['ruleset' . $ruleset_id]['result' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('Result'),
      '#description' => t('Set the result text'),
      '#default_value' => FALSE,
    );
    $form[$component]['ruleset' . $ruleset_id]['description' . $ruleset_id] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
      '#description' => t('Set the description text for the result. HTML markup is recognized'),
      '#resizable' => TRUE,
      '#default_value' => FALSE,
    );
    $form[$component]['ruleset' . $ruleset_id]['url' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('URL'),
      '#description' => t('Set the url for the result'),
      '#default_value' => FALSE,
    );
    $form[$component]['ruleset' . $ruleset_id]['component' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('Component'),
      '#description' => t('Specify which component the ruleset will be in (1,2,3,pd,4)'),
      '#maxlength' => 2,
      '#size' => 2,
      '#element_validate' => array('webform_ruleset_component_validate'),
      '#default_value' => FALSE,
    );
    $form[$component]['ruleset' . $ruleset_id]['delete_ruleset' . $ruleset_id] = array(
      '#type' => 'submit',
      '#value' => t('Delete ruleset'),
      '#submit' => array('webform_ruleset_form_delete_ruleset'),
      '#name' => 'delete_ruleset' . $ruleset_id . '-' . $component,
      '#ajax' => array(
        'callback' => 'webform_ruleset_unsaved_callback',
        'wrapper' => $component . '-fieldset-wrapper',
      ),
    );
  }//End For loop
  return $index;
}

/**
 * @param $form
 * @param $form_state
 *
 * @return mixed
 * AJAX callback function. Only two types of buttons should be calling this:
 * Add new ruleset and Delete EXISTING ruleset.
 */
function webform_ruleset_callback($form, $form_state) {
  $element = $form_state['triggering_element']['#name'];
  if ($element == 'component1_add') {
    return $form['component1'];
  }
  elseif ($element == 'component2_add') {
    return $form['component2'];
  }
  elseif ($element == 'component3_add') {
    return $form['component3'];
  }
  elseif ($element == 'componentpd_add') {
    return $form['componentpd'];
  }
  elseif ($element == 'component4_add') {
    return $form['component4'];
  }
  //Else delete button is being called
  else {
    $id = get_number($element);
    $component = 'component' . $form_state['values']['component' . $id];
    return $form[$component];
  }
}

/**
 * @param $form
 * @param $form_state
 *
 * @return mixed
 * Another AJAX callback function to be only used to delete unsaved rulesets.
 */
function webform_ruleset_unsaved_callback($form, $form_state) {
  $element = $form_state['triggering_element']['#name'];
  $component = get_component_number($element);
  //dsm($component);
  return $form[$component];
}

/**
 * @param $element
 * @param $form_state
 * @param $form
 * Validation check for component value.
 */
function webform_ruleset_component_validate($element, &$form_state, $form) {
  if ($element['#value'] != '1' && $element['#value'] != '2' &&
      $element['#value'] != '3' && $element['#value'] != 'pd' &&
      $element['#value'] != '4' && !empty($element['#value'])) {
      form_error($element, t('Component value must be either 1, 2, 3, pd, 4.'));
  }
}

/**
 * Implements hook_form().
 * @param $form
 * @param $form_state
 *
 * @return mixed
 */
function webform_ruleset_form($form, &$form_state) {

  if (!isset($form_state['ruleset_add_count_comp1'])) {
    //$form_state['ruleset_add_count'] = 0;
    $form_state['ruleset_add_count_comp1'] = 0;
    $form_state['ruleset_add_count_comp2'] = 0;
    $form_state['ruleset_add_count_comp3'] = 0;
    $form_state['ruleset_add_count_comppd'] = 0;
    $form_state['ruleset_add_count_comp4'] = 0;
  }

  //Load existing rulesets
  $query = db_select('find_your_edge_rulesets', 'fyer')
    ->fields('fyer')
    ->execute()
    ->fetchAll();

  //dsm($query);
  $form_state['existing_rules_count'] = count($query);
  if ($form_state['existing_rules_count'] > 0) {
    $form_state['largest_ruleset_id'] = $query[$form_state['existing_rules_count']-1]->ruleset_id;
  }
  else {
    $form_state['largest_ruleset_id'] = 0;
  }

  if (!isset($form_state['ruleset_ids_to_save'])) {
    $form_state['ruleset_ids_to_save'] = array();
    $form_state['ruleset_ids_to_save_component1'] = array();
    $form_state['ruleset_ids_to_save_component2'] = array();
    $form_state['ruleset_ids_to_save_component3'] = array();
    $form_state['ruleset_ids_to_save_componentpd'] = array();
    $form_state['ruleset_ids_to_save_component4'] = array();

  }


  //First create base form
  $form['component1'] = array(
    '#type' => 'fieldset',
    '#title' => t('Component 1'),
    '#collapsible' => TRUE,
    '#prefix' => '<div id="component1-fieldset-wrapper">',
    '#suffix' => '</div>',
  );
  $form['component2'] = array(
    '#type' => 'fieldset',
    '#title' => t('Component 2'),
    '#collapsible' => TRUE,
    '#prefix' => '<div id="component2-fieldset-wrapper">',
    '#suffix' => '</div>',
  );
  $form['component3'] = array(
    '#type' => 'fieldset',
    '#title' => t('Component 3'),
    '#collapsible' => TRUE,
    '#prefix' => '<div id="component3-fieldset-wrapper">',
    '#suffix' => '</div>',
  );
  $form['componentpd'] = array(
    '#type' => 'fieldset',
    '#title' => t('Component PD'),
    '#collapsible' => TRUE,
    '#prefix' => '<div id="componentpd-fieldset-wrapper">',
    '#suffix' => '</div>',
  );
  $form['component4'] = array(
    '#type' => 'fieldset',
    '#title' => t('Component 4'),
    '#collapsible' => TRUE,
    '#prefix' => '<div id="component4-fieldset-wrapper">',
    '#suffix' => '</div>',
  );

  //Then create existing forms within each component
  for ($i = 0; $i < $form_state['existing_rules_count']; $i++) {
    if (isset($query[$i])) {
      $form['component' . $query[$i]->component]['ruleset' . $query[$i]->ruleset_id] = array(
        '#type' => 'fieldset',
        '#title' => t('Ruleset'),
        '#collapsible' => TRUE,
      );
      $form['component' . $query[$i]->component]['ruleset' . $query[$i]->ruleset_id]['rule' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('Rule'),
        '#description' => t('Set the rule using answer KEYS delimited by commas. Use key NORULE for results that apply to everything'),
        '#default_value' => $query[$i]->rule,
      );
      $form['component' . $query[$i]->component]['ruleset' . $query[$i]->ruleset_id]['result' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('Result'),
        '#description' => t('Set the result text'),
        '#default_value' => $query[$i]->result,
      );
      $form['component' . $query[$i]->component]['ruleset' . $query[$i]->ruleset_id]['description' . $query[$i]->ruleset_id] = array(
        '#type' => 'textarea',
        '#title' => t('Description'),
        '#description' => t('Set the description text for the result. HTML markup is recognized'),
        '#resizable' => TRUE,
        '#default_value' => $query[$i]->description,
      );
      $form['component' . $query[$i]->component]['ruleset' . $query[$i]->ruleset_id]['url' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('URL'),
        '#description' => t('Set the url for the result'),
        '#default_value' => $query[$i]->url,
      );
      $form['component' . $query[$i]->component]['ruleset' . $query[$i]->ruleset_id]['component' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('Component'),
        '#description' => t('Specify which component the ruleset will be in (1,2,3,pd,4)'),
        '#maxlength' => 2,
        '#size' => 2,
        '#default_value' => $query[$i]->component,
      );
      $form['component' . $query[$i]->component]['ruleset' . $query[$i]->ruleset_id]['delete_ruleset' . $query[$i]->ruleset_id] = array(
        '#type' => 'submit',
        '#value' => t('Delete ruleset'),
        '#submit' => array('webform_ruleset_form_delete_ruleset'),
        '#name' => 'delete_ruleset' . $query[$i]->ruleset_id,
        '#ajax' => array(
          'callback' => 'webform_ruleset_callback',
          'wrapper' => 'component' . $query[$i]->component . '-fieldset-wrapper',
        ),
      );
    }
  }

  //Then create empty forms
  generate_form($form, $form_state['ruleset_add_count_comp1'], $form_state['ruleset_ids_to_save_component1'], 'component1');
  generate_form($form, $form_state['ruleset_add_count_comp2'], $form_state['ruleset_ids_to_save_component2'], 'component2' );
  generate_form($form, $form_state['ruleset_add_count_comp3'], $form_state['ruleset_ids_to_save_component3'], 'component3');
  generate_form($form, $form_state['ruleset_add_count_comppd'], $form_state['ruleset_ids_to_save_componentpd'], 'componentpd');
  generate_form($form, $form_state['ruleset_add_count_comp4'], $form_state['ruleset_ids_to_save_component4'], 'component4');

  //Finally create the rest of the action buttons
  $form['component1']['add_new_ruleset'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset'),
    '#submit' => array('webform_ruleset_form_add_ruleset'),
    '#name' => 'component1_add',
    '#ajax' => array(
      'callback' => 'webform_ruleset_callback',
      'wrapper' => 'component1-fieldset-wrapper',
    ),
  );
  $form['component2']['add_new_ruleset'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset'),
    '#submit' => array('webform_ruleset_form_add_ruleset'),
    '#name' => 'component2_add',
    '#ajax' => array(
      'callback' => 'webform_ruleset_callback',
      'wrapper' => 'component2-fieldset-wrapper',
    ),
  );
  $form['component3']['add_new_ruleset'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset'),
    '#submit' => array('webform_ruleset_form_add_ruleset'),
    '#name' => 'component3_add',
    '#ajax' => array(
      'callback' => 'webform_ruleset_callback',
      'wrapper' => 'component3-fieldset-wrapper',
    ),
  );
  $form['componentpd']['add_new_ruleset'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset'),
    '#submit' => array('webform_ruleset_form_add_ruleset'),
    '#name' => 'componentpd_add',
    '#ajax' => array(
      'callback' => 'webform_ruleset_callback',
      'wrapper' => 'componentpd-fieldset-wrapper',
    ),
  );
  $form['component4']['add_new_ruleset'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset'),
    '#submit' => array('webform_ruleset_form_add_ruleset'),
    '#name' => 'component4_add',
    '#ajax' => array(
      'callback' => 'webform_ruleset_callback',
      'wrapper' => 'component4-fieldset-wrapper',
    ),
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );

  //dsm($form);
  //dsm($form_state);
  return $form;
}

/**
 * @param $node
 *
 * @return mixed
 * Handler for obtaining form.
 */
function webform_ruleset_get_form($node) {
  $output = drupal_get_form('webform_ruleset_form');
  return $output;
}

/**
 * @param $form
 * @param $form_state
 * Submit handler.
 */
function webform_ruleset_form_submit($form, &$form_state) {
  $ruleset = new stdClass();
  //dsm($form_state);
  $query = db_select('find_your_edge_rulesets', 'fyer')
    ->fields('fyer')
    ->execute()
    ->fetchAll();

  //First update any existing rules
  for ($i = 0; $i < $form_state['existing_rules_count']; $i++) {
    $id = $query[$i]->ruleset_id;
    if ($form_state['values']['rule' . $id] !== $query[$i]->rule ||
        $form_state['values']['result' . $id] !== $query[$i]->result ||
        $form_state['values']['description' . $id] !== $query[$i]->description ||
        $form_state['values']['url' . $id] !== $query[$i]->url ||
        $form_state['values']['component' . $id] !== $query[$i]->component) {

      $ruleset->ruleset_id = $id;
      $ruleset->rule = $form_state['values']['rule' . $id];
      $ruleset->result = $form_state['values']['result' . $id];
      $ruleset->description = $form_state['values']['description' . $id];
      $ruleset->url = $form_state['values']['url' . $id];
      $ruleset->component = $form_state['values']['component' . $id];
      drupal_write_record('find_your_edge_rulesets', $ruleset, 'ruleset_id');
    }
  }
  //Then save the new rulesets
  $total_add_count = $form_state['ruleset_add_count_comp1'] + $form_state['ruleset_add_count_comp2'] +
                    $form_state['ruleset_add_count_comp3'] + $form_state['ruleset_add_count_comppd'] +
                    $form_state['ruleset_add_count_comp4'];
  for ($i = 0; $i < $total_add_count; $i++) {
    $ruleset_id = $form_state['ruleset_ids_to_save'][$i];
    $ruleset->ruleset_id = $ruleset_id;
    $ruleset->rule = $form_state['values']['rule' . $ruleset_id];
    $ruleset->result = $form_state['values']['result' . $ruleset_id];
    $ruleset->description = $form_state['values']['description' . $ruleset_id];
    $ruleset->url = $form_state['values']['url' . $ruleset_id];
    $ruleset->component = $form_state['values']['component' . $ruleset_id];
    drupal_write_record('find_your_edge_rulesets', $ruleset);
  }
  $form_state['ruleset_ids_to_save'] = array();
  $form_state['ruleset_add_count'] = 0;
  $form_state['ruleset_add_count_comp1'] = 0;
  $form_state['ruleset_add_count_comp2'] = 0;
  $form_state['ruleset_add_count_comp3'] = 0;
  $form_state['ruleset_add_count_comppd'] = 0;
  $form_state['ruleset_add_count_comp4'] = 0;
}

/**
 * @param $form
 * @param $form_state
 * Submit handler for adding new empty ruleset.
 */
function webform_ruleset_form_add_ruleset($form, &$form_state) {
  //Add 1 to sum since a new unsaved ruleset had been added
  $sum = $form_state['ruleset_add_count_comp1'] + $form_state['ruleset_add_count_comp2'] +
    $form_state['ruleset_add_count_comp3'] + $form_state['ruleset_add_count_comppd'] +
    $form_state['ruleset_add_count_comp4'] + 1;
  $form_state['ruleset_ids_to_save'][] = $form_state['largest_ruleset_id'] + $sum;

  $component = $form_state['triggering_element']['#name'];
  if ($component == 'component1_add') {
    $form_state['ruleset_add_count_comp1']++;
    $form_state['ruleset_ids_to_save_component1'][] = $form_state['largest_ruleset_id'] + $sum;
  }
  elseif ($component == 'component2_add') {
    $form_state['ruleset_add_count_comp2']++;
    $form_state['ruleset_ids_to_save_component2'][] = $form_state['largest_ruleset_id'] + $sum;
  }
  elseif ($component == 'component3_add') {
    $form_state['ruleset_add_count_comp3']++;
    $form_state['ruleset_ids_to_save_component3'][] = $form_state['largest_ruleset_id'] + $sum;
  }
  elseif ($component == 'componentpd_add') {
    $form_state['ruleset_add_count_comppd']++;
    $form_state['ruleset_ids_to_save_componentpd'][] = $form_state['largest_ruleset_id'] + $sum;
  }
  elseif ($component == 'component4_add') {
    $form_state['ruleset_add_count_comp4']++;
    $form_state['ruleset_ids_to_save_component4'][] = $form_state['largest_ruleset_id'] + $sum;
  }


  $form_state['rebuild'] = TRUE;
}

/**
 * @param $form
 * @param $form_state
 * Submit handler for deleting a ruleset.
 */
function webform_ruleset_form_delete_ruleset($form, &$form_state) {
  $ruleset_id = get_number($form_state['triggering_element']['#name']);
  //If creation/deletion gets messed up, delete by rule value
  //$rule = $form_state['values']['rule' . $ruleset_id];

  //dsm($form_state['triggering_element']['#name']);

  //Check if we are deleting an unsaved ruleset, if we are, then unset from list of unsaved rulesets
  $query = db_select('find_your_edge_rulesets', 'fyer')
    ->fields('fyer')
    ->condition('ruleset_id', $ruleset_id)
    ->execute()
    ->fetchAll();
  /*if (count($query) == 0) {
    if (($index = array_search($ruleset_id, $form_state['ruleset_ids_to_save'])) !== FALSE) {
      unset($form_state['ruleset_ids_to_save'][$index]);
      //Re-index array
      $form_state['ruleset_ids_to_save'] = array_values($form_state['ruleset_ids_to_save']);
      //$form_state['ruleset_add_count']--;
      if ($form_state['ruleset_add_count_comp1'] > 0) {
        $form_state['ruleset_add_count_comp1']--;
      }
      if ($form_state['ruleset_add_count_comp2'] > 0) {
        $form_state['ruleset_add_count_comp2']--;
      }
      if ($form_state['ruleset_add_count_comp3'] > 0) {
        $form_state['ruleset_add_count_comp3']--;
      }
      if ($form_state['ruleset_add_count_comppd'] > 0) {
        $form_state['ruleset_add_count_comppd']--;
      }
      if ($form_state['ruleset_add_count_comp4'] > 0) {
        $form_state['ruleset_add_count_comp4']--;
      }
    }*/
    if (count($query) == 0) {
      if (($index = array_search($ruleset_id, $form_state['ruleset_ids_to_save_component1'])) !== FALSE) {
        unset($form_state['ruleset_ids_to_save_component1'][$index]);
        //Re-index array
        $form_state['ruleset_ids_to_save_component1'] = array_values($form_state['ruleset_ids_to_save_component1']);
      }
      elseif (($index = array_search($ruleset_id, $form_state['ruleset_ids_to_save_component2'])) !== FALSE) {
        unset($form_state['ruleset_ids_to_save_component2'][$index]);
        //Re-index array
        $form_state['ruleset_ids_to_save_component2'] = array_values($form_state['ruleset_ids_to_save_component2']);
      }
      elseif (($index = array_search($ruleset_id, $form_state['ruleset_ids_to_save_component3'])) !== FALSE) {
        unset($form_state['ruleset_ids_to_save_component3'][$index]);
        //Re-index array
        $form_state['ruleset_ids_to_save_component3'] = array_values($form_state['ruleset_ids_to_save_component3']);
      }
      elseif (($index = array_search($ruleset_id, $form_state['ruleset_ids_to_save_componentpd'])) !== FALSE) {
        unset($form_state['ruleset_ids_to_save_componentpd'][$index]);
        //Re-index array
        $form_state['ruleset_ids_to_save_componentpd'] = array_values($form_state['ruleset_ids_to_save_componentpd']);
      }
      elseif (($index = array_search($ruleset_id, $form_state['ruleset_ids_to_save_component4'])) !== FALSE) {
        unset($form_state['ruleset_ids_to_save_component4'][$index]);
        //Re-index array
        $form_state['ruleset_ids_to_save_component4'] = array_values($form_state['ruleset_ids_to_save_component4']);
      }

      $index = array_search($ruleset_id, $form_state['ruleset_ids_to_save']);
      unset($form_state['ruleset_ids_to_save'][$index]);
      //Re-index array
      $form_state['ruleset_ids_to_save'] = array_values($form_state['ruleset_ids_to_save']);

      $form_state['ruleset_add_count_comp1'] = count($form_state['ruleset_ids_to_save_component1']);
      $form_state['ruleset_add_count_comp2'] = count($form_state['ruleset_ids_to_save_component2']);
      $form_state['ruleset_add_count_comp3'] = count($form_state['ruleset_ids_to_save_component3']);
      $form_state['ruleset_add_count_comppd'] = count($form_state['ruleset_ids_to_save_componentpd']);
      $form_state['ruleset_add_count_comp4'] = count($form_state['ruleset_ids_to_save_component4']);

    //dsm($form_state['flagged_unsaved_ruleset_id']);
    }

  db_delete('find_your_edge_rulesets')
    ->condition('ruleset_id', $ruleset_id)
    //->condition('rule', $rule)
    ->execute();
  $form_state['rebuild'] = TRUE;
}

/**
 * @param $string
 *
 * @return string
 * Returns the number of the string.
 * Note this assumes that the string's number is at the end of the string, but
 * before any hyphens.
 */
function get_number($string) {
  $length = drupal_strlen($string);
  $number = "";
  for ($i = 0; $i < $length; $i++) {
    if (ctype_digit($string[$i])) {
      $number .= $string[$i];
    }
    elseif ($string[$i] == '-') {
      break;
    }
  }
  return $number;
}

/**
 * @param $string
 *
 * @return mixed
 * Returns the component number portion of a delete button.
 * All unsaved rulesets will have a delete button with #name having the form
 * delete_rulesetID-componentID.
 */
function get_component_number($string) {
  $length = drupal_strlen($string);
  for ($i = 0; $i < $length; $i++) {
    if ($string[$i] == '-') {
      return drupal_substr($string, $i+1);
    }
  }
  return $string;
}