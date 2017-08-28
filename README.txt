Requirements
------------
Drupal 7.x

Installation
------------
Upon installation, the following are required:
1) A webform to be targeted.
2) Two PDF templates for international and regular students respectively.
3) The first question will need to be "Are you an international student" radio
   question. Answer keys:
   1|Yes, I'm an international student
   2|No, I'm not an international student


Configuration page will need to be set once these have been created.
See Usage for help on how to use the configuration page.


Description
-----------
This module is developed specifically for the EDGE program.
The purpose of the module is to extend the functionality of the Webform module.

In short, once a user has submitted a form, the user will be redirected to its
confirmation page. This confirmation page will be themed using the file
"webform-confirmation-quiz.tpl.php". The confirmation page will display specific
text based on the submission values and the rulesets.

The module can be split into two parts:
1)Rulesets
2)A themed confirmation page

A ruleset consists of 4 fields: The rule, result text, description text, and a URL.
The rule in a ruleset is a list of webform component keys delimited by commas.
The result text is the text displayed if the rule has been met. The description
text is similar to the result text as it too will be displayed only if the rule
has been met. Similar to the description and result text, the URL will also only
be available if the rule is met.

Rulesets can be edited by editing the webform and going to Webform -> Rulesets.
Each ruleset is categorized into 5 components: 1,2,3,pd,4. These components from
the EDGE program. In each component's fieldset, there exists an "Add new ruleset"
button, as well as a "Delete ruleset" button for every existing rulesets.
You should be able to add multiple rulesets at once. Once saved, the rulesets
will be saved to the database in the table "find_your_edge_rulesets"

Theming confirmation page is done through the file "webform-confirmaion-quiz.tpl.php".
Once a user has submitted their form and reached the confirmation page, they will
see the themed confirmation page. The EDGE program has 4 components:
(1)Skills Identification and Articulation Workshop,
(2)Career Development Course,
(3)Work and Community Experiences, and
(4)Capstone Workshop. Each component except for Work and Community Experiences
will have its own results box, and its corresponding description text.
Work and Community Experiences will have 3 in addition to its own sub component,
PD course. Each results box will also have a URL link embedded. How the results
box, description and URL gets populated is dependent on the rulesets that have
been met using the submission values.

When populating the confirmation page, the template file will go through each
component and check the submission values against all rulesets' rules in that
component. For every rule that gets met, the corresponding result, description
and URL gets added into an array. From there, depending on how many results there
are, the template file will randomly choose a result with its matched description
and URL. For example, in component 3, the template file will have to choose 3
results, descriptions and URLs. Since it is required to pick 3 for component 3,
if the template file cannot find 3 (i.e. less than 3 rules have been met), then
the template file will populate with "Other Experience" as the result, and its
corresponding description for it.

Down at the bottom of the confirmation page, there is a link to download a PDF
of the confirmation page. This PDF uses the FillPDF module and the form id is
specified using the configuration page. Having forms for both international
and regular is required.

There is also a "Start over" button and a "Generate new EDGE path" button.
The "Start over" will redirect the user to the beginning of the quiz.
The "Generate new EDGE path" will refresh the confirmation, generating new
results. Note that the "Generate new EDGE path" button is literally just a
refresh, since the process of grabbing the results is inside the template file.
Furthermore, hovering over the "Generate new EDGE path" will trigger a hover
text to display.

In addition, there are some rules placed when generating the results for component 3.
These rules are specific to the rules and questions the EDGE team has created.
1) One 1 Don position can be retrieved per EDGE path. For example, a user's
submission qualifies for the results "Renison Don" and "St. Paul's Don", then
the user will never be able to see both Don position in the same EDGE path.

2) One of the questions created by the EDGE team asks which On-campus experiences
the user would like: Faculty experience, Student societies, Feds, etc. Each of
these on-campus experiences has a general result and multiple specific results.
For example, if a user selects Faculty on-campus experiences, then the user is
qualified for the general result, "Faculties" and might be qualified for specific
faculty results such as "AHS Ambassador" and "KIN Student Trainer".
The rule for general results is that once the user is qualified for a specific
result, then its respected general result will be removed from the list of possible
results to pick from when generating the EDGE path.


Usage
-----
The purpose of the module is to only target the Find Your EDGE quiz tool,
hence we do not want it to target all webforms. To enforce this, there is a
configuration page for the module. There are two ways to access the configuration page.
The first is to go under Modules -> uw_find_your_edge -> configure. The other way
is to go into Dashboard, there is a link to the configuration page at the button
of the side bar labeled "Configure quiz". The configuration page lets you specify
the node id for the targeted webform, and the two form ids which will be used to
generate a print friendly version of the confirmation page.

When a webform is created, create questions of type Radio. For each question,
each option should have unique custom keys. These keys should be unique across
all questions

Themeing of the confirmation page will be seen once a webform has been targeted
via configuration page.

When the module is installed, rulesets will have already been created.
If no rulesets are present, each of the 5 components will default to a hard-coded
ruleset.

When creating a ruleset, click “Add new ruleset” The rule should be the keys you
specified in each answer for the questions, delimited by commas. For example: KEY1, KEY2, KEY3
Components can only have values 1, 2, 3, pd or 4. Click save to save your rulesets
if you made any new ones.

