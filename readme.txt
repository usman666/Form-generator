********** DB *************

- Table: forms
	Columns: id (PK), title, fields

- Table: fields
	Columns: id (PK), formId (FK), type, label

- Table: attributes
	Columns: id (PK), fieldId (FK), attribute, value


Queries:
  - INSERT INTO forms(title, fields) VALUES('$title', '$amntFields')                          // Insert form
  - INSERT INTO fields(formId, type, label) VALUES('$last_id', '$type', '$label')	      // Insert field
  - INSERT INTO attributes(fieldId, attribute, value) VALUES('$last_id', '$val', '$attVal')   // Insert attribute
  - SELECT * FROM forms									      // Select all forms
  - SELECT * FROM forms INNER JOIN fields						      // Select all data for one specific form
                    ON forms.id = fields.formId
                    INNER JOIN attributes ON fields.id = attributes.fieldId
                    WHERE forms.id = '$id'
                    ORDER BY fieldId

********** DB *************


********** Page 1 *************
File name: index.php
- In this page the user is choosing the title of the form as well as amount of fields the form will have.
- The values entered are stored in session variables and later used in in page 2.

********** Page 1 *************



********** Page 2 *************
File name: add.php
- In this page the user is choosing the title of the form as well as amount of fields the form will have.
- The values entered are stored in session variables and later used in in page 2.
********** Page 2 *************



********** Page 3 *************
File name: specifications.php
- Type of field(s) is chosen and based on that the suitable attributes are being asked.
- The attributes are being generated dynamically using jQuery.
- When the form is submitted, the values are stored in the DB.
********** Page 3 *************



********** Page 4 *************
File name: message.php
- A message is displayed depending on if the form could be created or not.
- All previously created form are displayed and there is a link to each form
********** Page 4 *************



********** Page 5 *************
File name: forms.php
- All previously created form are displayed and there is a link to each form
********** Page 5 *************



********** Page 6 *************
File name: form.php
- The data for specific form is brought from the DB and the form is displayed
********** Page 6 *************

