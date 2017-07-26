<?php
/**
 * Created by PhpStorm.
 * User: evnguyen
 * Date: 6/30/2017
 * Time: 9:11 AM
 */

/**
 * TODO: Need a way to specify which component in EDGE -> Can create another textfield for additional info???????
 * TODO: Need a way to prompt user there is unsaved work ->
 * TODO: Need a way to organize all the rulesets into on/off camps, courses, etc
 * TODO: Add a method to import CSV file?
 * TODO: Need a way to check for empty textfield?
 * TODO: Add some cool CSS
 *
 *
 * Implements hook_form()
 * @param $form
 * @param $form_state
 *
 * @return mixed
 */
function webform_ruleset_form($form, &$form_state) {

  if(!isset($form_state['ruleset_add_count'])){
    $form_state['ruleset_add_count'] = 0;
  }

  //Load existing rulesets
  $query = db_select('find_your_edge_rulesets', 'fyer')
    ->fields('fyer')
    ->execute()
    ->fetchAll();

  dsm($query);
  $form_state['existing_rules_count'] = count($query);
  if ($form_state['existing_rules_count'] > 0) {
    $form_state['largest_ruleset_id'] = $query[$form_state['existing_rules_count']-1]->ruleset_id;
  }
  else {
    $form_state['largest_ruleset_id'] = 0;
  }

  //First make existing forms
  for ($i = 0; $i <= $form_state['largest_ruleset_id']; $i++) {
    if(isset($query[$i])){
      $form['ruleset' . $query[$i]->ruleset_id] = array(
        '#type' => 'fieldset',
        '#title' => t('Ruleset'),
        '#collapsible' => TRUE,
      );
      $form['ruleset' . $query[$i]->ruleset_id]['rule' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('Rule'),
        '#description' => t('Set the rule'),
        '#default_value' => $query[$i]->rule,
        //Need a way to store the rid
      );
      $form['ruleset' . $query[$i]->ruleset_id]['result' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('Result'),
        '#description' => t('Set the result text'),
        '#default_value' => $query[$i]->result,
      );
      $form['ruleset' . $query[$i]->ruleset_id]['description' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('Description'),
        '#description' => t('Set the description text for the result'),
        '#default_value' => $query[$i]->description,
      );
      $form['ruleset' . $query[$i]->ruleset_id]['url' . $query[$i]->ruleset_id] = array(
        '#type' => 'textfield',
        '#title' => t('URL'),
        '#description' => t('Set the url for the result'),
        '#default_value' => $query[$i]->url,
      );
      $form['ruleset' . $query[$i]->ruleset_id]['delete_ruleset' . $query[$i]->ruleset_id] = array(
        '#type' => 'submit',
        '#value' => t('Delete ruleset'),
        '#submit' => array('webform_ruleset_form_delete_ruleset'),
        '#name' => 'delete_ruleset' . $query[$i]->ruleset_id,
      );
    }
  }

  //Then make forms that have yet to be saved
  for ($i = 0; $i < $form_state['ruleset_add_count']; $i++) {
    $ruleset_id = $form_state['ruleset_ids_to_save'][$i];
    $form['ruleset' . $ruleset_id] = array(
      '#type' => 'fieldset',
      '#title' => t('Ruleset'),
      '#collapsible' => TRUE,
    );
    $form['ruleset' . $ruleset_id]['rule' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('Rule'),
      '#description' => t('Set the rule'),
      '#default_value' => FALSE,
    );
    $form['ruleset' . $ruleset_id]['result' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('Result'),
      '#description' => t('Set the result text'),
      '#default_value' => FALSE,
    );
    $form['ruleset' . $ruleset_id]['description' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('Description'),
      '#description' => t('Set the description text for the result'),
      '#default_value' => FALSE,
    );
    $form['ruleset' . $ruleset_id]['url' . $ruleset_id] = array(
      '#type' => 'textfield',
      '#title' => t('URL'),
      '#description' => t('Set the url for the result'),
      '#default_value' => FALSE,
    );
    $form['ruleset' . $ruleset_id]['delete_ruleset' . $ruleset_id] = array(
      '#type' => 'submit',
      '#value' => t('Delete ruleset'),
      '#submit' => array('webform_ruleset_form_delete_ruleset'),
      '#name' => 'delete_ruleset' . $ruleset_id,
    );
  }

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  $form['add_new_ruleset'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset'),
    '#submit' => array('webform_ruleset_form_add_ruleset'),
  );

  //dsm($form);
  //dsm($form_state);
  return $form;
}

function webform_ruleset_get_form($node) {
  $output = drupal_get_form('webform_ruleset_form');
  return $output;
}

function webform_ruleset_form_submit($form, &$form_state) {
  $ruleset = new stdClass();
  dsm($form_state);
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
        $form_state['values']['url' . $id] !== $query[$i]->url) {

      $ruleset->ruleset_id = $id;
      $ruleset->rule = $form_state['values']['rule' . $id];
      $ruleset->result = $form_state['values']['result' . $id];
      $ruleset->description = $form_state['values']['description' . $id];
      $ruleset->url = $form_state['values']['url' . $id];
      drupal_write_record('find_your_edge_rulesets', $ruleset, 'ruleset_id');
    }
  }
  //Then save the new rulesets
  for ($i = 0; $i < $form_state['ruleset_add_count']; $i++) {
    $ruleset_id = $form_state['ruleset_ids_to_save'][$i];
    $ruleset->ruleset_id = $ruleset_id;
    $ruleset->rule = $form_state['values']['rule' . $ruleset_id];
    $ruleset->result = $form_state['values']['result' . $ruleset_id];
    $ruleset->description = $form_state['values']['description' . $ruleset_id];
    $ruleset->url = $form_state['values']['url' . $ruleset_id];
    drupal_write_record('find_your_edge_rulesets', $ruleset);
  }
  $form_state['ruleset_ids_to_save'] = array();
  $form_state['ruleset_add_count'] = 0;
}

function webform_ruleset_form_add_ruleset($form, &$form_state) {
  $form_state['ruleset_add_count']++;
  $form_state['ruleset_ids_to_save'][] = $form_state['largest_ruleset_id'] + $form_state['ruleset_add_count'];
  $form_state['rebuild'] = TRUE;
}

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
  if (count($query) == 0) {
    if(($index = array_search($ruleset_id, $form_state['ruleset_ids_to_save'])) !== false) {
      unset($form_state['ruleset_ids_to_save'][$index]);
      //Re-index array
      $form_state['ruleset_ids_to_save'] = array_values($form_state['ruleset_ids_to_save']);
      $form_state['ruleset_add_count']--;
    }
    //dsm($form_state['flagged_unsaved_ruleset_id']);
  }

  db_delete('find_your_edge_rulesets')
    ->condition('ruleset_id', $ruleset_id)
    //->condition('rule', $rule)
    ->execute();
  $form_state['rebuild'] = TRUE;
}

function get_number($string) {
  $length = drupal_strlen($string);
  $number = "";
  for ($i = 0; $i < $length; $i++) {
    if(ctype_digit($string[$i])) {
      $number .= $string[$i];
    }
  }
  return $number;
}