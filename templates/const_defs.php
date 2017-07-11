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
 * $submission->data[i][j] where i is the question number and j is the index
 * of the array of answers.
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
  global $comp3_renison_don;
  global $comp3_renison_base;
  global $comp3_renison_eli;
  global $comp3_stpaul_don;
  global $comp3_stpaul_leader;
  global $comp3_student_soc;
  global $comp3_gbda_soc;
  global $comp3_hist_soc;
  global $comp3_psych_soc ;
  global $comp3_soc_soc;
  global $comp3_mathsoc;
  global $comp3_bioinformatics_club ;
  global $compr3_farmsa ;
  global $comp3_offices_services;
  global $comp3_first_aid;
  global $comp3_intramural_referee;
  global $comp3_lifeguard;
  global $comp3_bike_centre;
  global $comp3_response_team;
  global $comp3_coop_connection;
  global $comp3_fed_clubs;
  global $comp3_food_bank;
  global $comp3_glow;
  global $comp3_student_network;
  global $comp3_mates;
  global $comp3_community_don;
  global $comp3_sustainable_campus;
  global $comp3_volunteer_centre;
  global $comp3_warrior_tribe;
  global $comp3_womens_centre;
  global $comp3_leave_the_pack;
  global $comp3_health_educator;
  global $comp3_single_sexy_performer;
  global $comp3_residence_don;
  global $comp3_library_associate;
  global $comp3_food_services;
  global $comp3_computing_consultant;
  global $comp3_student_ambassador;
  global $comp3_faculties;
  global $comp3_ahs_ambassador;
  global $comp3_kin_trainer;
  global $comp3_earth_museum;
  global $comp3_sci_outreach;
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
  global $comp3_urls;
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
    "University Colleges",
  );
  $comp3_renison_don = array(
    "Renison Don",
  );
  $comp3_renison_base = array(
    "Renison BASE",
  );
  $comp3_renison_eli = array(
    "Renison ELI",
  );
  $comp3_stpaul_don = array(
    "St. Paul's Don",
  );
  $comp3_stpaul_leader = array(
    "St. Paul's Peer Leader",
  );
  $comp3_student_soc = array(
    "Student Societies",
  );
  $comp3_gbda_soc = array(
    "GBDA Society",
  );
  $comp3_hist_soc = array(
    "HIST Society",
  );
  $comp3_psych_soc = array(
    "PSYCH Society",
  );
  $comp3_soc_soc = array(
    "SOC Society",
  );
  $comp3_mathsoc = array(
    "MathSoc",
  );
  $comp3_bioinformatics_club = array(
    "Bioinformatics Club",
  );
  $compr3_farmsa = array(
    "FARMSA",
  );
  $comp3_offices_services = array(
    "Offices and Services",
  );
  $comp3_first_aid = array(
    "First Aid Trainer",
  );
  $comp3_intramural_referee = array(
    "Intramural Referee",
  );
  $comp3_lifeguard = array(
    "Lifeguard/ Instructor",
  );
  $comp3_bike_centre = array(
    "Bike Centre",
  );
  $comp3_response_team = array(
    "Campus Response Team",
  );
  $comp3_coop_connection = array(
    "Co-op Connection",
  );
  $comp3_fed_clubs = array(
    "Feds Clubs",
  );
  $comp3_food_bank = array(
    "Food Bank",
  );
  $comp3_glow = array(
    "Glow",
  );
  $comp3_student_network = array(
    "ICSN",
  );
  $comp3_mates = array(
    "MATES",
  );
  $comp3_community_don = array(
    "Off Campus Community Don",
  );
  $comp3_sustainable_campus = array(
    "Sustainable Campus Initiative",
  );
  $comp3_volunteer_centre = array(
    "Volunteer Centre",
  );
  $comp3_warrior_tribe = array(
    "Warrior Tribe",
  );
  $comp3_womens_centre = array(
    "The Women's Centre",
  );
  $comp3_leave_the_pack = array(
    "Leave the Pack Behind",
  );
  $comp3_health_educator = array(
    "Peer Health Educator",
  );
  $comp3_single_sexy_performer = array(
    "Single & Sexy Performer",
  );
  $comp3_residence_don = array(
    "Residence Don",
  );
  $comp3_library_associate = array(
    "Library Associate",
  );
  $comp3_food_services = array(
    "Food Services",
  );
  $comp3_computing_consultant = array(
    "Student Computing Consultant",
  );
  $comp3_student_ambassador = array(
    "Student Ambassador",
  );
  $comp3_faculties = array(
    "Faculties",
  );
  $comp3_ahs_ambassador = array(
    "AHS Ambassador",
  );
  $comp3_kin_trainer = array(
    "KIN Student Trainer",
  );
  $comp3_earth_museum = array(
    "EARTH Museum Volunteer",
  );
  $comp3_sci_outreach = array(
    "SCI Outreach Volunteer",
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
    "Service Learning",
  );

/**
 * Arrays specific to COMPONENT 4
 */
  $comp4_capstone_work = array(
    "Working Full-time",
  );

  $comp4_capstone_grad = array(
    "Graduate School",
  );

  $comp4_capstone_prof = array(
    "Professional School",
  );

  $comp4_capstone_noplan = array(
    "No Plans",
  );

  $comp4_capstone_other = array(
    "Other",
  );

  /**
   * Array for descriptions. Each key represents their own description
   * TODO: Fix line breaks for consistency
   */

  $comp1_descr = array(
    "No Experiences" => "We’re having trouble finding experiences for your EDGE.
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
    "No Experiences" => "We’re having trouble finding experiences for your EDGE.
     That doesn't mean they don't exist. Consider retaking the quiz or contacting
     the EDGE team for assistance.",

    //Note: This description is to be appended to the appropriate course code
    //      This is also to be appended with the return value of link_to_edge_courses()
    "COURSE" => " counts as an equivalency for the career development
      course. For a full list of equivalencies, visit our list of ",
  );

  $comp3_descr = array(
    "No Experiences" => "We’re having trouble finding experiences for your EDGE.
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

    "AHS Ambassador" => "You can earn EDGE credit by promoting your faculty as
      a Student Ambassador and completing a PD course. Click the box to learn
      more about the position.",

    "KIN Student Trainer" => "You can earn EDGE credit by working with varsity
      athletes as a Student Trainer and completing a PD course. Click the box
      to learn more about the position.",

    "EARTH Museum Volunteer" => "You can earn EDGE credit by volunteering
      with an on-campus museum and completing a PD course. Click the box
      to learn more about the position.",

    "SCI Outreach Volunteer" => "You can earn EDGE credit by promoting your
      faculty as an Outreach Volunteer and completing a PD course. Click the
      box to learn more about the position.",

    "University Colleges" => "You can earn EDGE credit by being active within a
      university college and completing a PD course. Click the box to visit
      our list of EDGE experiences.",

    "Renison Don" => "You can earn EDGE credit by working as a Renison Don and
      completing a PD course. Click the box to learn more about this experience.",

    "Renison BASE" => "You can earn EDGE credit by working with Renison’s BASE
      program and completing a PD course. Click the box to learn more about this
      program.",

    "Renison ELI" => "You can earn EDGE credit by working with Renison’s English
      Language Institute (ELI) and completing a PD course. Click the box to
      learn more about this program.",

    "St. Paul's Don" => "You can earn EDGE credit by working as a St. Paul’s Don
      and completing a PD course. Click the box to learn more about this experience.",

    "St. Paul's Peer Leader" => "You can earn EDGE credit by
      working as a living-learning peer leader in St. Paul’s and completing a
      PD course. Click the box to learn more about this experience.",

    "Student Societies" => "You can earn EDGE credit by being active within
      a student society and completing a PD course. Click the box to visit
      our list of EDGE experiences.",

    "GBDA Society" => "You can earn EDGE credit by taking on an executive role
      in the Global Business and Digital Arts (GBDA) Society and completing a PD
      course. Click the box to learn more about your society.",

    "HIST Society" => "You can earn EDGE credit by taking on an executive role
      in the History Society and completing a PD course. Click the box to learn
      more about your society.",

    "PSYCH Society" => "You can earn EDGE credit by taking on an executive role
      in the Psychology Society and completing a PD course. Click the box to
      learn more about your society.",

    "SOC Society" => "You can earn EDGE credit by taking on an executive role in
      the Sociology Society and completing a PD course. Click the box to learn
      more about your society.",

    "MathSoc" => "You can earn EDGE credit by taking on an executive role in
      MathSoc and completing a PD course. Click the box to learn more about your
      society.",

    "Bioinformatics Club" => "You can earn EDGE credit by taking on an executive
      role in the Bioinformatics Club and completing a PD course. Click the box
      to learn more about your society.",

    "FARMSA" => "You can earn EDGE credit by taking on an executive role in the
      Financial Analysis and Risk Management Student Association (FARMSA) and
      completing a PD course. Click the box to learn more about your society.",

    "Offices and Services" => "You can earn EDGE credit by giving your time to
      a club, office, or service on campus and completing a PD course. Click the
      box for more details regarding on-campus experiences.",

    "First Aid Trainer" => "You can earn EDGE credit by working with Athletics
      as a First Aid Trainer and completing a PD course. Click the box to learn
      more about this experience.",

    "Intramural Referee" => "You can earn EDGE credit by working with Athletics
      as an Intramural Referee and completing a PD course. Click the box to
      learn more about this experience.",

    "Lifeguard/ Instructor" => "You can earn EDGE credit by working with
      Athletics as a Lifeguard or Instructor and completing a PD course. Click
      the box to learn more about this experience.",

    "Bike Centre" => "You can earn EDGE credit by working with the Feds Bike
      Centre and completing a PD course. Click the box to learn more about this
      experience.",

    "Campus Response Team" => "You can earn EDGE credit by working with the Feds
      Campus Response Team and completing a PD course. Click the box to learn
      more about this experience.",

    "Co-op Connection" => "You can earn EDGE credit by working with Feds’ Co-op
      Connection and completing a PD course. Click the box to learn more about
      this experience.",

    "Feds Clubs" => "You can earn EDGE credit by taking on an executive role
      within a Feds club and completing a PD course. Click the box to learn more
      about this experience.",

    "Food Bank" => "You can earn EDGE credit by working with the Feds Food Bank
      and completing a PD course. Click the box to learn more about this experience.",

    "Glow" => "You can earn EDGE credit by working with Glow and completing a
      PD course. Click the box to learn more about this experience.",

    "ICSN" => "You can earn EDGE credit by working with Feds’ International and
      Canadian Student Network (ICSN) and completing a PD course. Click the box
      to learn more about this experience.",

    "MATES" => "You can earn EDGE credit by working with Mentor Assistance
      Through Education and Support (MATES) and completing a PD course. Click
      the box to learn more about this experience.",

    "Off Campus Community Don" => "You can earn EDGE credit by working as an Off
      Campus Community Don and completing a PD course. Click the box to learn
      more about this experience.",

    "Sustainable Campus Initiative" => "You can earn EDGE credit by working with
      Feds’ Sustainable Campus Initiative and completing a PD course. Click the
      box to learn more about this experience.",

    "Volunteer Centre" => "You can earn EDGE credit by working with the Feds
      Volunteer Centre and completing a PD course. Click the box to learn more
      about this experience.",

    "Warrior Tribe" => "You can earn EDGE credit by working with Feds’ Warrior
      Tribe and completing a PD course. Click the box to learn more about this
      experience.",

    "The Women's Centre" => "You can earn EDGE credit by working with The
      Women’s Centre and completing a PD course. Click the box to learn more 
      about this experience.",

    "Leave the Pack Behind" => "You can earn EDGE credit by working with Campus
      Wellness’ Leave the Pack Behind program and completing a PD course. Click
      the box to learn more about this experience.",

    "Peer Health Educator" => "You can earn EDGE credit by working with Campus
      Wellness as a Peer Health Educator and completing a PD course. Click the
      box to learn more about this experience.",

    "Single & Sexy Performer" => "You can earn EDGE credit by performing in
      Single & Sexy and completing a PD course. Click the box to learn more
      about this experience.",

    "Residence Don" => "You can earn EDGE credit by working as a Don in Waterloo
      residences and completing a PD course. Click the box to learn more about
      this experience.",

    "Library Associate" => "You can earn EDGE credit by working as a Library
      Associate and completing a PD course. Click the box to learn more about
      these experiences.",

    "Food Services" => "You can earn EDGE credit by working with Food Services
      and completing a PD course. Click the box to learn more about this experience.",

    "Student Computing Consultant" => "You can earn EDGE credit by working as a
      Student Computing Consultant and completing a PD course. Click the box to
      learn more about this experience.",

    "Student Ambassador" => "You can earn EDGE credit by promoting Waterloo as
      a Student Ambassador and completing a PD course. Click the box to learn
      more about this experience.",

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

    "Service Learning" => "You can earn EDGE credit by engaging in service
      learning (e.g. a Habitat for Humanity trip) and completing a PD courses.
      Click the box for more details regarding off-campus experiences.",
  );

  $comp3_urls = array(
    "AHS Ambassador" => "https://uwaterloo.ca/applied-health-sciences/current-undergraduates/get-involved/become-ahs-ambassador",

    "KIN Student Trainer" => "https://uwaterloo.ca/kinesiology/student-trainers",

    "EARTH Museum Volunteer" => "https://uwaterloo.ca/earth-sciences-museum/volunteers",

    "SCI Outreach Volunteer" => "https://uwaterloo.ca/science/community-outreach",

    "Renison Don" => "https://uwaterloo.ca/renison/tour/dons",

    "Renison BASE" => "https://uwaterloo.ca/bridge-to-academic-success-in-english/",

    "Renison ELI" => "https://uwaterloo.ca/english-language-institute/",

    "St. Paul's Don" => "https://uwaterloo.ca/stpauls/about-st-pauls-university-college/were-hiring",

    "St. Paul's Peer Leader" => "https://uwaterloo.ca/stpauls/about-st-pauls-university-college/were-hiring",

    "GBDA Society" => "https://uwaterloo.ca/stratford-campus/undergraduate/student-life/gbda-student-opportunities/gbda-society",

    "HIST Society" => "https://uwaterloo.ca/history/undergraduate/uw-history-society",

    "PSYCH Society" => "https://uwaterloo.ca/psychology/current-undergraduate-students/psychology-undergraduate-society",

    "SOC Society" => "https://uwaterloo.ca/sociology-and-legal-studies/undergraduate/sociology/sociology-society",

    "MathSoc" => "http://mathsoc.uwaterloo.ca/",

    "Bioinformatics Club" => "http://bic.uwaterloo.ca/",

    "FARMSA" => "http://uwfarmsa.uwaterloo.ca/index.html",

    "First Aid Trainer" => "http://www.varsity.uwaterloo.ca/sports/2010/7/22/Aquatic_Leadership_and_First_Aid_Instructors.aspx",

    "Intramural Referee" => "http://www.imleagues.com/spa/intramural/a39a992404294091840d34c3d29a54ef/home",

    "Lifeguard/ Instructor" => "http://www.athletics.uwaterloo.ca/sports/2010/7/22/Lifeguard_Instructor.aspx",

    "Bike Centre" => "http://www.feds.ca/slc/bike-centre/",

    "Campus Response Team" => "http://www.feds.ca/crt/",

    "Co-op Connection" => "http://www.feds.ca/coop/",

    "Feds Clubs" => "http://www.feds.ca/clubs-section/clubs-listing/",

    "Food Bank" => "http://www.feds.ca/foodbank/",

    "Glow" => "http://www.feds.ca/glow/",

    "ICSN" => "http://www.feds.ca/icsn/",

    "MATES" => "http://www.feds.ca/uw-mates/",

    "Off Campus Community Don" => "http://www.feds.ca/offcampus/",

    "Sustainable Campus Initiative" => "http://www.feds.ca/sustainability/",

    "Volunteer Centre" => "http://www.feds.ca/volunteer/",

    "Warrior Tribe" => "http://www.feds.ca/warrior-tribe/",

    "The Women's Centre" => "http://www.feds.ca/women/",

    "Leave the Pack Behind" => "https://uwaterloo.ca/campus-wellness/health-promotion/peer-health-education-teams",

    "Peer Health Educator" => "https://uwaterloo.ca/campus-wellness/health-promotion/peer-health-education-teams",

    "Single & Sexy Performer" => "https://uwaterloo.ca/campus-wellness/health-promotion/single-sexy",

    "Residence Don" => "https://uwaterloo.ca/housing/jobs-leadership/paid-positions/dons",

    "Library Associate" => "https://uwaterloo.ca/library/about/work-library",

    "Food Services" => "https://uwaterloo.ca/food-services/opportunities/part-time-casual",

    "Student Computing Consultant" => "https://uwaterloo.ca/housing/technology/support/scc",

    "Student Ambassador" => "https://uwaterloo.ca/find-out-more/visit-waterloo/visitors-centre/jobs",
  );

  $comp4_descr = array(
    "Working Full-time" => "You’ll use the capstone workshop to make a plan of
      action for the beginning of your professional life. Click the box for
      more details regarding the capstone workshop.",

    "Graduate School" => "You’ll use the capstone workshop to make a
      plan of action for your transition into Graduate School. Click the box
      for more details regarding the capstone workshop.",

    "Professional School" => "You’ll use the capstone workshop to make a
      plan of action for your transition into Professional School. Click the
      box for more details regarding the capstone workshop.",

    "No Plans" => "You’ll use the capstone workshop to make a plan of action for
      your life post-graduation, whatever it entails. Click the box for more
      details regarding the capstone workshop.",

    "Other" => "You’ll use the capstone workshop to make a plan of action for
      your life post-graduation, whatever it entails. Click the box for more
      details regarding the capstone workshop.",
  );


