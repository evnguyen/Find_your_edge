<?php
/**
 * Created by PhpStorm.
 * User: evnguyen
 * Date: 5/31/2017
 * Time: 1:51 PM
 */

/**
 * Variable definitions.
 * This section defines the values associated with each variable.
 * In order to access submission values, syntax is as follows:
 * $submission->data[i][j] where i is the question number and j is 0
 * TODO: Change variable names for compX_all_courses
 * TODO: Remove keys in arrays if required
 */
  global $comp1_all_courses;
  global $comp1_ahs_courses;
  global $comp1_env_courses;
  global $comp1_math_courses;

  global $comp2_all_courses;
  global $comp2_arts_all_courses;
  global $comp2_arts_psci_courses;

  global $comp3_ahs_health_courses;
  global $comp3_ahs_kin_courses;
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
  global $comp3_arts_gbda_courses;
  global $comp3_arts_soc_courses;
  global $comp3_env_enbus_courses;
  global $comp3_env_ers_courses;
  global $comp3_env_indev_courses;
  global $comp3_env_integ_courses;
  global $comp3_sci_scbus_courses;
  global $comp3_uni_college;
  global $comp3_student_soc;
  global $comp3_offices_services;
  global $comp3_full_time;
  global $comp3_part_time;
  global $comp3_volunteering;
  global $comp3_service_learning;



/**
 * Arrays specific to COMPONENT 1
 */
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

/**
 * Arrays specific to COMPONENT 2
 */
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


/**
 * Arrays specific to COMPONENT 3
 */

  $comp3_ahs_health_courses = array(
    1 => "HLTH 481",
  );
  $comp3_ahs_kin_courses = array(
    1 => "KIN 492A", //KIN 492A includes 492B
    2 => "KIN 493",
  );
  $comp3_ahs_rec_courses = array(
    1 => "REC 253",
    2 => "REC 312",
    3 => "REC 450",
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
  $comp3_arts_gbda_courses = array(
    1 => "SMF 460",
    2 => "SMF 461",
    3 => "SMF 490",
    4 => "SMF 491",
  );
  $comp3_arts_soc_courses = array(
    1 => "SOC 434",
  );
  $comp3_env_enbus_courses = array(
    1 => "ENBUS 402A", //ENBUS 402A includes 402B
  );
  $comp3_env_ers_courses = array(
    1 => "ERS 340",
    2 => "ERS 341",
    4 => "ERS 382",
  );
  $comp3_env_indev_courses = array(
    1 => "INDEV 401",
    2 => "INDEV 401",
    4 => "ERS 382",
  );
  $comp3_env_integ_courses = array(
    1 => "INTEG 452A", //INTEG 452A includes 452B
  );
  $comp3_sci_scbus_courses = array(
    1 => "SCBUS 223",
  );
  $comp3_uni_college = array(
    1 => "University/College",
  );
  $comp3_student_soc = array(
    1 => "Student Society",
  );
  $comp3_offices_services = array(
    1 => "Offices and Services",
  );
  $comp3_full_time = array(
    1 => "Full Time",
  );
  $comp3_part_time = array(
    1 => "Part Time",
  );
  $comp3_volunteering = array(
    1 => "Volunteering",
  );
  $comp3_service_learning = array(
    1 => "Service Learning",
  );

