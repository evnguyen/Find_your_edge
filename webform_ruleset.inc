<?php
/**
 * Created by PhpStorm.
 * User: evnguyen
 * Date: 6/30/2017
 * Time: 9:11 AM
 */

/**
 * Implements hook_form()
 * TODO: Loop through form_state[num_rulesets] and push a new textfield entry to $form. (No need to specify key)
 * TODO:: On submit handler for add_new_rule, increment form_state[num_rulesets] and rebuild form on reload
 * @param $form
 * @param $form_state
 *
 * @return mixed
 */
function webform_ruleset_form($form, &$form_state) {
  $form['rule'] = array(
    '#type' => 'textfield',
    '#title' => t('Rule'),
    '#size' => 5,
    '#description' => t('Set the rule'),
  );
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
  uw_find_your_edge_form_submit($form, $form_state);
}

function webform_ruleset_form_add_ruleset($form, &$form_state) {
  $form_state['rule']++;
  $form_state['rebuild'] = TRUE;
}

function webform_ruleset_form_add_ruleset_callback($form, &$form_state) {
  return $form['rule'];
}