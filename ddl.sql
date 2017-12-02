DROP DATABASE IF EXISTS truckco;
CREATE DATABASE truckco;
USE truckco;

CREATE TABLE Banking (
	contractor_id		INT	UNSIGNED	AUTO_INCREMENT,
	api_key			char(10)		NOT NULL,
	transaction_id		char(10)	NOT NULL,

	PRIMARY KEY (contractor_id)
);

CREATE TABLE Users(
	user_id			INT	UNSIGNED	AUTO_INCREMENT,
	username		varchar(10)		NOT NULL UNIQUE,
	password		varchar(255)		NOT NULL,
	admin			BOOLEAN			NOT NULL,

	PRIMARY KEY (user_id)
);

CREATE TABLE Employees(
	employee_id		INT	UNSIGNED 	AUTO_INCREMENT,
	user_id			INT	UNSIGNED	NOT NULL,
	permissions	 	BOOLEAN			NOT NULL,
	
	PRIMARY KEY (employee_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Drivers(
	driver_id		INT	UNSIGNED	AUTO_INCREMENT,
	user_id			INT	UNSIGNED	NOT NULL,
	contractor_id	INT UNSIGNED,
	wcb			INT	NOT NULL, 			-- We should create a constraint following the specific format
	license_number		INT		NOT NULL, 			-- We should create a constraint following the specific format
	province		CHAR(2)		NOT NULL,
	expiration		DATE		NOT NULL,

	PRIMARY KEY (driver_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (contractor_id) REFERENCES Banking(contractor_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Employers(
	employer_id		INT	UNSIGNED 	AUTO_INCREMENT,
	user_id			INT	UNSIGNED	NOT NULL,
	contractor_id	INT UNSIGNED, 			  			-- INDEX THIS BAD BOY
	name			VARCHAR(30)	NOT NULL,
	registration		INT		NOT NULL, 			-- Better validation Req'd
	province		CHAR(2)		NOT NULL,

	PRIMARY KEY (employer_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (contractor_id) REFERENCES Banking(contractor_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Trucks(
	truck_id		INT	UNSIGNED 	AUTO_INCREMENT,
	registration		CHAR(10)	NOT NULL UNIQUE, 		-- String Numbers because no math
	contractor_id		INT UNSIGNED, 				 		-- Account-Holding Entities give us truck information pseudo-surrogate key
	provider		VARCHAR(30)	NOT NULL,
	policy_num		CHAR(10)	NOT NULL, 	 		-- Its a num, but we don't do math with it
	plate_num		CHAR(8)		NOT NULL,
	make			VARCHAR(15)	NOT NULL,
	model			VARCHAR(15)	NOT NULL,
	year			YEAR(2)		NOT NULL,
	province		CHAR(2)		NOT NULL,
	trailer_type		CHAR(2),					-- DEFINE THE TRAILER TYPE, MIGHT BE NONE (MAKE A DOMAIN TO COVER THE TYPE

	PRIMARY KEY (truck_id),
	FOREIGN KEY (contractor_id) REFERENCES Banking(contractor_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE						-- ON the deletion of a banking account, do we delete all trucks? only occurs when a business delets itself mind you
);

CREATE TABLE Companies(
	company_id		INT	UNSIGNED 	AUTO_INCREMENT,
	contractor_id		INT UNSIGNED,
	name			VARCHAR(10)	NOT NULL,
	street			VARCHAR(30)	NOT NULL,
	city			VARCHAR(20)	NOT NULL,
	province		CHAR(2)		NOT NULL,
	postal_code		CHAR(6)		NOT NULL,

	PRIMARY KEY(company_id),
	FOREIGN KEY (contractor_id) REFERENCES Banking(contractor_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Locations(
	company_id		INT UNSIGNED,		
	postal_code		CHAR(6)		NOT NULL,
	street			VARCHAR(30)	NOT NULL,
	city			VARCHAR(20)	NOT NULL,
	province		CHAR(2)		NOT NULL,
	contact			VARCHAR(20)	NOT NULL,
	contact_number		CHAR(10)	NOT NULL,

	PRIMARY KEY (company_id, postal_code),
	FOREIGN KEY (company_id) REFERENCES Companies(company_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Payloads(
	payload_id		INT	UNSIGNED 	AUTO_INCREMENT,
	contact			VARCHAR(20)	NOT NULL,
	contact_number		CHAR(10)	NOT NULL,
	manifest		MEDIUMBLOB	NOT NULL, 			-- 5MB binary file (ie: pdf of manifest)
	value			DOUBLE,						-- Maybe Null because it could be an empty container
	cargo_type		CHAR(2)		NOT NULL,			-- DEFINE A DOMAIN FOR THIS AT SOME POINT
	weight			INT		UNSIGNED NOT NULL,

	PRIMARY KEY (payload_id)
);

CREATE TABLE PolicyRequirements(
	policy_id		INT	UNSIGNED 	AUTO_INCREMENT,
	payload_id		INT UNSIGNED,
	jurisdiction		CHAR(2)		NOT NULL,
	tail_or_lead		BOOLEAN		NOT NULL,
	start_time		DATE		NOT NULL,
	deadline		DATE		NOT NULL,

	PRIMARY KEY (policy_id),
	FOREIGN KEY (payload_id) REFERENCES Payloads(payload_id)
		ON UPDATE CASCADE						-- Probably should restrict this idk yet though.
		ON DELETE CASCADE
);

CREATE TABLE Workorder(
	workorder_id		INT	UNSIGNED 	AUTO_INCREMENT,
	pickup_address		VARCHAR(50)	NOT NULL,			-- Full address in one value, just something we can print to a workorder form
	dropoff_address		VARCHAR(50)	NOT NULL,
	start_time		DATE		NOT NULL,
	deadline		DATE		NOT NULL,
	completed		BOOLEAN		NOT NULL,

	PRIMARY KEY (workorder_id)
);

CREATE TABLE Posts(
	workorder_id	INT UNSIGNED	NOT NULL,
	payload_id		INT	UNSIGNED	NOT NULL,
	company_id		INT	UNSIGNED	NOT NULL,
	price			DOUBLE,
	
	PRIMARY KEY (workorder_id, payload_id, company_id),
	FOREIGN KEY (workorder_id) REFERENCES Workorder(workorder_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,						-- We set a workorder to complete, not delete. (Specify a Trigger to do this automatically)
	FOREIGN KEY (payload_id) REFERENCES Payloads(payload_id)
		ON UPDATE RESTRICT						-- Don't let people move the payload onto a different post
		ON DELETE RESTRICT,						-- don't let people delete a payload until the post is deleted too.
	FOREIGN KEY (company_id) REFERENCES Companies(company_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);


CREATE TABLE AcceptedContracts(
	accepted_contract_id	INT	UNSIGNED 	AUTO_INCREMENT,
	contractor_id		INT	UNSIGNED	NOT NULL,
	workorder_id		INT UNSIGNED,

	PRIMARY KEY (accepted_contract_id),
	FOREIGN KEY (workorder_id) REFERENCES Workorder(workorder_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY (contractor_id) REFERENCES Banking(contractor_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);
