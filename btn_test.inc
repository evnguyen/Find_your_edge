<?php
/**
 * File to be included with the uw_find_your_edge module to define a new component
 */


/**
 * @return array
 * Set the defaults of the btn component
 */
function _webform_defaults_btn() {
  return array(
    'name' => '',
    'form_key' => NULL,
    'pid' => 0,
    'weight' => 0,
    'value' => '',
    'mandatory' => 1,
    //Each index of extra will be the section displayed in the editing component page of the GUI
    'extra' => array(
      'label' => '',
      //TODO: Fix "undefined index private" bug. The line below might only be a temp fix.
      'private' => '',
    ),
  );
}

function _webform_edit_btn($component){
  $form = array();
  $form['extra']['label'] = array(
    '#type' => 'textfield',
    '#title' => t('Label'),
    '#default_value' => $component['extra']['label'],
    '#description' => t('Description of Label'),
    '#required' => TRUE,
  );
  return $form;
}

function _webform_render_btn($component, $value = NULL, $filter = TRUE){

  $form_item = array(
    '#type' => 'radio',
    '#title' => $filter ? _webform_filter_xss($component['extra']['label']) : $component['extra']['label'],
    '#description' => $filter ? _webform_filter_descriptions($component['extra']['description']) : $component['extra']['description'],
    '#default_value' => $filter ? _webform_filter_values($component['value']) : $component['value'],
    '#prefix' => '<div class="webform-component-button" id="webform-component-' . $component['form_key'] . '">',
    '#suffix' => '</div>',
    //'#value' => 'Btn label',
  );

  if (isset($value)) {
    $form_item['#default_value'] = $value[0];
  }
  dsm($component);
  return $form_item;
}