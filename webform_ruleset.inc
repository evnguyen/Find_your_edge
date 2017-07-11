<?php
/**
 * Created by PhpStorm.
 * User: evnguyen
 * Date: 6/30/2017
 * Time: 9:11 AM
 */

/**
 * TODO: Need a way to save rulesets -> To save ruleset, use drupal_write_record where $record is an entry to $table
 * TODO: Need a way to load rulesets -> Get the number of records on table, and set default values for existing rulesets
 * TODO: Need a way to save mutliple rulesets -> Use ruleset_count
 * TODO: Need a way to get all records of table ->
 *
 * Implements hook_form()
 * @param $form
 * @param $form_state
 *
 * @return mixed
 */
function webform_ruleset_form($form, &$form_state) {

  if(!isset($form_state['ruleset_count'])){
    $form_state['ruleset_count'] = 0;
  }

  //Load existing rulesets
  $query = db_select('find_your_edge_rulesets', 'fyer')
    ->fields('fyer')
    ->execute()
    ->fetchObject();

  dsm($query);

  for ($i = 0; $i < $form_state['ruleset_count']; $i++){
    $form['ruleset' . $i] = array(
      '#type' => 'textfield',
      '#title' => t('Rule'),
      '#description' => t('Set the rule'),
    );
  }
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  $form['add_new_rule'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset'),
    '#submit' => array('webform_ruleset_form_add_ruleset'),
  );
  return $form;
}

function webform_ruleset_get_form($node) {
  $output = drupal_get_form('webform_ruleset_form');
  return $output;
}

function webform_ruleset_form_submit($form, &$form_state) {
  dsm("Saved");
  dsm($form_state);
  $ruleset = new stdClass();
  $num = $form_state['ruleset_count'];
  $ruleset->rule = $form_state['values']['ruleset0'];
  drupal_write_record('find_your_edge_rulesets', $ruleset);
  uw_find_your_edge_form_submit($form, $form_state);
}

function webform_ruleset_form_add_ruleset($form, &$form_state) {
  $form_state['ruleset_count']++;
  $form_state['rebuild'] = TRUE;
}

function webform_ruleset_form_add_ruleset_callback($form, &$form_state) {
  return $form['rule'];
}