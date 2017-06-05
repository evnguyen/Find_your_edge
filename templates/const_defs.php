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
  global $comp4_capstone_timeoff;
  global $comp4_capstone_noplan;

  global $comp1_descr;
  global $comp2_descr;
  global $comp3_descr;
  global $comp4_descr;



/**
 * Arrays specific to COMPONENT 1
 */
  $comp1_all_courses = array(
    "CCA Workshop",
    );
  $comp1_ahs_courses = array(
    "AHS 107",
    "CCA Workshop",
    );
  $comp1_env_courses = array(
    "ENVS 178",
    "CCA Workshop",
    );
  $comp1_math_courses = array(
    "ENGL 119",
    "CCA Workshop",
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
  $comp3_ahs_rec_courses = array(
    "REC 253",
    "REC 312",
    "REC 450",
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
    "Universities Colleges",
  );
  $comp3_student_soc = array(
    "Student Societies",
  );
  $comp3_offices_services = array(
    "Offices and Services",
  );
  $comp3_faculties = array(
    "Faculties",
  );
  $comp3_full_time = array(
    "Full Time",
  );
  $comp3_part_time = array(
    "Part Time",
  );
  $comp3_volunteering = array(
    "Volunteering",
  );
  $comp3_service_learning = array(
    "Service Learning",
  );


/**
 * Arrays specific to COMPONENT 3
 */
  $comp4_capstone_work = array(
    "Working full-time"
  );

  $comp4_capstone_grad = array(
    "Graduate/Profession school"
  );

  $comp4_capstone_timeoff = array(
    "Time off"
  );

  $comp4_capstone_noplan = array(
    "No plans"
  );


  /**
   * Array for descriptions. Each key represents their own description
   */

  $comp1_descr = array(
    "N/A" => "We’re having trouble filling out your path through EDGE based on your 
    responses. Consider retaking the quiz or contacting the EDGE team for 
    assistance.",

    "CCA Workshop" => "You can earn this credit by completing a workshop with
    the Centre for Career Action (CCA).",

    //Note: this description is to be appended to the course code
    "COURSE" => " counts as an equivalency for the skills identification
    and articulation workshop. Visit our list of EDGE courses for a full list of
    equivalencies.",

  );


  $comp2_descr = array(
    "PD1" => "You can earn this credit by completing PD1: Career Fundamentals
      online.",

    //Note: This description is to be appended to the appropriate course code
    "COURSE" => " counts as an equivalency for the career development
      course. Visit our list of EDGE courses for a full list of equivalencies.",
  );

  $comp3_descr = array(

    //Note: This description is to be appended to the appropriate course code
    "COURSE" => " counts as an equivalency for a work/community experience.
      Visit our list of EDGE courses for a full list of equivalencies.",

    "Faculties" => "You can earn credit for a work/community experience by being 
      active within your faculty. Visit our list of EDGE experiences for full
      details.",

    "Universities Colleges" => "You can earn credit for a work/community experience
      by being active within a university college. Visit our list of EDGE
      experiences for full details. ",

    "Student Societies" => "You can earn credit for a work/community experience by
      being active within a student society. Visit our list of EDGE experiences
      for full details. ",

    "Offices and Services" => "You can earn credit for a work/community
      experience by giving your time to a club, office, or service on campus. 
      Visit our list of EDGE experiences for full details.",

    "Full Time" => "You can earn credit for a work/community experience
      by working full-time during any term. Visit our experiential definitions
      page for more information.",

    "Part Time" => "You can earn credit for a work/community experience 
      by working part-time during any term. Visit our experiential definitions 
      page for more information.",

    "Volunteering" => "You can earn credit for a work/community experience by
     volunteering off-campus during any term. Visit our experiential definitions 
     page for more information.",

    "Service Learning" => "You can earn credit for a work/community experience 
      by completing engaging in short-term service learning during any term. 
      Visit our experiential definitions page for more information."
  );

  $comp4_descr = array(
    "Working full-time" => "You’ll use the capstone workshop to make a plan of 
      action for the beginning of your professional life.",

    "Graduate/Profession school" => "You’ll use the capstone workshop to make a 
      plan of action for your transition into graduate or professional school.",

    "Time off" => "You’ll use the capstone workshop to make a plan of action 
      for your hard-earned time off post-graduation.",

    "No plans" => "You’ll use the capstone workshop to make a plan of action for 
      your life post-graduation, whatever it entails.",
  );


