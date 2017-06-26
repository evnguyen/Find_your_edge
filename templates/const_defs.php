<?php
/**
 * Created by PhpStorm.
 * User: evnguyen
 * Date: 5/31/2017
 * Time: 1:51 PM
 * @file
 * Definitions for all constants used for the quiz
 */

/**
 * Variable definitions.
 * This section defines the values associated with each variable.
 * In order to access submission values, syntax is as follows:
 * $submission->data[i][j] where i is the question number and j is 0
 * TODO: Change variable names for compX_all_courses
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

  global $comp4_capstone_work;
  global $comp4_capstone_grad;
  global $comp4_capstone_prof;
  global $comp4_capstone_noplan;
  global $comp4_capstone_other;

  global $comp1_descr;
  global $comp2_descr;
  global $comp3_descr;
  global $comp4_descr;



/**
 * Arrays specific to COMPONENT 1
 */
  $comp1_all_courses = array(
    "CCA/EDGE Workshop",
    );
  $comp1_ahs_courses = array(
    "AHS 107",
    "CCA/EDGE Workshop",
    );
  $comp1_env_courses = array(
    "ENVS 178",
    "CCA/EDGE Workshop",
    );
  $comp1_math_courses = array(
    "ENGL 119",
    "CCA/EDGE Workshop",
    );

/**
 * Arrays specific to COMPONENT 2
 */
  $comp2_all_courses = array(
    "PD1",
    );
  $comp2_arts_all_courses = array(
    "ARTS 111",
    "PD1",
    );
  $comp2_arts_psci_courses = array(
    "PSCI 299",
    "ARTS 111",
    "PD1",
    );


/**
 * Arrays specific to COMPONENT 3
 */

  $comp3_ahs_health_courses = array(
    "HLTH 481",
  );
  $comp3_ahs_kin_courses = array(
    "KIN 492A", //KIN 492A includes 492B
    "KIN 493",
  );

  $comp3_ahs_therap_courses = array(
    "REC 253",
    "REC 450",
  );

  $comp3_ahs_rec_courses = array(
    "REC 312",
  );
  $comp3_arts_drama_courses = array(
    "DRAMA 206",
    "DRAMA 207",
    "DRAMA 243",
    "DRAMA 244",
    "DRAMA 306",
    "DRAMA 307",
    "DRAMA 316",
    "DRAMA 317",
    "DRAMA 400",
    "DRAMA 406",
    "DRAMA 407",
    "DRAMA 416",
    "DRAMA 417",
  );
  $comp3_arts_fine_courses = array(
    "FINE 243",
    "FINE 343",
  );
  $comp3_arts_gbda_courses = array(
    "GBDA 301",
    "GBDA 302",
    "GBDA 401",
    "GBDA 402",
  );
  $comp3_arts_ger_courses = array(
    "GER 407",
  );
  $comp3_arts_ls_courses = array(
    "LS 434",
  );
  $comp3_arts_pac_courses = array(
    "PAC 390",
    "PAC 395",
  );
  $comp3_arts_psci_courses = array(
    "PSCI 498C",
  );
  $comp3_arts_psych_courses = array(
    "PSYCH 465",
    "PSYCH 466",
    "PSYCH 467",
  );
  $comp3_arts_sds_courses = array(
    "SDS 370R",
    "SDS 496R",
  );
  $comp3_arts_smf_courses = array(
    "SMF 460",
    "SMF 461",
    "SMF 490",
    "SMF 491",
  );
  $comp3_arts_soc_courses = array(
    "SOC 434",
  );
  $comp3_env_enbus_courses = array(
    "ENBUS 402A", //ENBUS 402A includes 402B
  );
  $comp3_env_ers_courses = array(
    "ERS 340",
    "ERS 341",
    "ERS 382",
  );
  $comp3_env_indev_courses = array(
    "INDEV 401",
    "INDEV 402",
  );
  $comp3_env_integ_courses = array(
    "INTEG 452A", //INTEG 452A includes 452B
  );
  $comp3_sci_scbus_courses = array(
    "SCBUS 223",
  );
  $comp3_uni_college = array(
    "University colleges",
  );
  $comp3_student_soc = array(
    "Student societies",
  );
  $comp3_offices_services = array(
    "Offices and services",
  );
  $comp3_faculties = array(
    "Faculties",
  );
  $comp3_full_time = array(
    "Full-time",
  );
  $comp3_part_time = array(
    "Part-time",
  );
  $comp3_volunteering = array(
    "Volunteering",
  );
  $comp3_service_learning = array(
    "Service learning",
  );


/**
 * Arrays specific to COMPONENT 3
 */
  $comp4_capstone_work = array(
    "Working full-time",
  );

  $comp4_capstone_grad = array(
    "Graduate school",
  );

  $comp4_capstone_prof = array(
    "Professional school",
  );

  $comp4_capstone_noplan = array(
    "No plans",
  );

  $comp4_capstone_other = array(
    "Other",
  );


  /**
   * Array for descriptions. Each key represents their own description
   */

  $comp1_descr = array(
    "No experiences" => "We’re having trouble finding experiences for your EDGE.
     That doesn't mean they don't exist. Consider retaking the quiz or contacting
     the EDGE team for assistance.",

    "CCA/EDGE Workshop" => "You can earn this credit by completing a workshop with
      the Centre for Career Action (CCA).",

    //Note: this description is to be appended to the course code
    //      This is also to be appended with the return value of link_to_edge_courses()
    "COURSE" => " counts as an equivalency for the skills identification
      and articulation workshop. For a full list of equivalencies, visit our list
      of ",
  );


  $comp2_descr = array(
    "No experiences" => "We’re having trouble finding experiences for your EDGE.
     That doesn't mean they don't exist. Consider retaking the quiz or contacting
     the EDGE team for assistance.",

    "PD1" => "You can earn this credit by completing PD1: Career Fundamentals
      online.",

    //Note: This description is to be appended to the appropriate course code
    //      This is also to be appended with the return value of link_to_edge_courses()
    "COURSE" => " counts as an equivalency for the career development
      course. For a full list of equivalencies, visit our list of ",
  );

  $comp3_descr = array(
    "No experiences" => "We’re having trouble finding experiences for your EDGE.
     That doesn't mean they don't exist. Consider retaking the quiz or contacting
     the EDGE team for assistance.",

    //On-campus experiences
    //Note: This description is to be appended to the appropriate course code.
    //      This is also to be appended with the return value of link_to_edge_courses()
    "COURSE" => " counts as an equivalency for a work/community experience.
      For a full list of equivalencies, visit our list of ",

    "Faculties" => "You can earn EDGE credit by being active within your
      faculty and completing a PD course. Click the box to visit our
      list of EDGE experiences.",

    "University colleges" => "You can earn EDGE credit by being active within a
      university college and completing a PD course. Click the box to visit
      our list of EDGE experiences.",

    "Student societies" => "You can earn EDGE credit by being active within
      a student society and completing a PD course. Click the box to visit
      our list of EDGE experiences.",

    "Offices and services" => "You can earn EDGE credit by giving your time to a club,
      office, or service on campus and completing a PD course. Click the
      box for more details regarding off-campus experiences.",

    //Off-Campus experiences
    "Full-time" => "You can earn EDGE credit by working full-time during any term
      and completing a PD course. Click the box for more details regarding
      off-campus experiences.",

    "Part-time" => "You can earn EDGE credit by working part-time during any term
      and completing a PD course. Click the box for more details regarding
      off-campus experiences.",

    "Volunteering" => "You can earn EDGE credit by volunteering off-campus
      and completing a PD course. Click the box for more details regarding
      off-campus experiences.",

    "Service learning" => "You can earn EDGE credit by engaging in service
      learning (e.g. a Habitat for Humanity trip) and completing a PD courses.
      Click the box for more details regarding off-campus experiences.
"
  );

  $comp4_descr = array(
    "Working full-time" => "You’ll use the capstone workshop to make a plan of
      action for the beginning of your professional life. Click the box for
      more details regarding the capstone workshop.",

    "Graduate school" => "You’ll use the capstone workshop to make a
      plan of action for your transition into graduate school. Click the box
      for more details regarding the capstone workshop.",

    "Professional school" => "You’ll use the capstone workshop to make a
      plan of action for your transition into professional school. Click the
      box for more details regarding the capstone workshop.",

    "No plans" => "You’ll use the capstone workshop to make a plan of action for
      your life post-graduation, whatever it entails. Click the box for more
      details regarding the capstone workshop.",

    "Other" => "You’ll use the capstone workshop to make a plan of action for
      your life post-graduation, whatever it entails. Click the box for more
      details regarding the capstone workshop.",
  );


