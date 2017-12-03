DROP DATABASE IF EXISTS truckco;
CREATE DATABASE truckco;
USE truckco;

CREATE TABLE User(
	user_id		INT UNSIGNED	AUTO_INCREMENT,
	username	varchar(16)	NOT NULL UNIQUE,
	password	varchar(255)	NOT NULL, 
	acc_type	INT 		NOT NULL, 		-- make this so it can only tkae on 4 values: 0, 1, 2, 3
	
	PRIMARY KEY (user_id)
);

CREATE TABLE Contractor(
  contractor_id   INT UNSIGNED    AUTO_INCREMENT,

  PRIMARY KEY (contractor_id)
);



CREATE TABLE ContractEmployer(
	user_id		INT UNSIGNED	NOT NULL UNIQUE, 
	name		varchar(255)	NOT NULL, 
	business_id	INT UNSIGNED	NOT NULL UNIQUE, 		-- make this so it can only tkae on 4 values: 0, 1, 2, 3
	banking_info 	varchar(20)	NOT NULL UNIQUE, 
	contractor_id	INT UNSIGNED	NOT NULL UNIQUE, 
	
	PRIMARY KEY (user_id), 
	FOREIGN KEY (contractor_id) REFERENCES Contractor(contractor_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Driver(
	user_id		INT UNSIGNED	NOT NULL UNIQUE, 
	wcb_no		varchar(20)	NOT NULL UNIQUE, 
	driver_license	varchar(20)	NOT NULL UNIQUE, 		
	banking_info 	varchar(20)	NOT NULL UNIQUE, 
	contractor_id	INT UNSIGNED	NOT NULL UNIQUE, 
	
	PRIMARY KEY (user_id), 
	FOREIGN KEY (contractor_id) REFERENCES Contractor(contractor_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Company(
	user_id		INT UNSIGNED	NOT NULL UNIQUE, 
	name		varchar(255)	NOT NULL, 		
	banking_info 	varchar(20)	NOT NULL UNIQUE, 
	address		varchar(255)	NOT NULL, 
	
	PRIMARY KEY (user_id)
);

CREATE TABLE Truck(
	registration		CHAR(10)	NOT NULL UNIQUE, 
	contractor_id		INT UNSIGNED	NOT NULL, 				 		-- Account-Holding Entities give us truck information pseudo-surrogate key
	provider		VARCHAR(30)	NOT NULL,
	policy_num		CHAR(10)	NOT NULL, 	 		-- Its a num, but we don't do math with it
	plate_num		CHAR(8)		NOT NULL,
	make			VARCHAR(15)	NOT NULL,
	model			VARCHAR(15)	NOT NULL,
	year			YEAR(2)		NOT NULL,
	province		CHAR(2)		NOT NULL,
	trailer_type		CHAR(2),					-- DEFINE THE TRAILER TYPE, MIGHT BE NONE (MAKE A DOMAIN TO COVER THE TYPE

	PRIMARY KEY (registration),
	FOREIGN KEY (contractor_id) REFERENCES Contractor(contractor_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE						-- ON the deletion of a banking account, do we delete all trucks? only occurs when a business delets itself mind you
);


CREATE TABLE Payload(
	payload_id		INT	UNSIGNED 	AUTO_INCREMENT,
	company_id		INT UNSIGNED	NOT NULL, 
	manifest		MEDIUMBLOB	NOT NULL, 			-- 5MB binary file (ie: pdf of manifest)
	asset_value		DOUBLE,						-- Maybe Null because it could be an empty container
	cargo_type		CHAR(2)		NOT NULL,			-- DEFINE A DOMAIN FOR THIS AT SOME POINT
	gross_weight		INT UNSIGNED 	NOT NULL,
	contact_info		varchar(255)	NOT NULL, 

	PRIMARY KEY (payload_id), 
	FOREIGN KEY (company_id) REFERENCES Company(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Workorder(
	company_id		INT UNSIGNED	NOT NULL, 
	payload_id		INT UNSIGNED	NOT NULL, 
	workorder_no		INT UNSIGNED	NOT NULL, 
	pickup_address		VARCHAR(50)	NOT NULL,			-- Full address in one value, just something we can print to a workorder form
	dropoff_address		VARCHAR(50)	NOT NULL,
	start_time		DATE		NOT NULL,
	deadline		DATE		NOT NULL,
	completed		BOOLEAN		NOT NULL,
	contract_price		DOUBLE		NOT NULL, 
	
	PRIMARY KEY (company_id, payload_id, workorder_no), 
	FOREIGN KEY (company_id) REFERENCES Company(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (payload_id) REFERENCES Payload(payload_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE PolicyRequirements(
	payload_id		INT UNSIGNED	NOT NULL,
	policy_no		VARCHAR(20)	NOT NULL,
	jurisdiction		CHAR(2)		NOT NULL,
	tail_or_lead		BOOLEAN		NOT NULL,
	start_time		DATE		NOT NULL,
	deadline		DATE		NOT NULL,

	PRIMARY KEY (payload_id, policy_no),
	FOREIGN KEY (payload_id) REFERENCES Payload(payload_id)
		ON UPDATE CASCADE						-- Probably should restrict this idk yet though.
		ON DELETE CASCADE
);


CREATE TABLE AcceptedOrders(
	company_id		INT UNSIGNED 	NOT NULL,
	payload_id		INT UNSIGNED	NOT NULL, 
	workorder_no		INT UNSIGNED	NOT NULL, 
	contractor_id		INT UNSIGNED	NOT NULL, 
	
	PRIMARY KEY (company_id, payload_id, workorder_no, contractor_id),
	FOREIGN KEY (company_id, payload_id, workorder_no) REFERENCES Workorder(company_id, payload_id, workorder_no)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY (contractor_id) REFERENCES Contractor(contractor_id)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);



CREATE TABLE Location(
	location_id		INT UNSIGNED	AUTO_INCREMENT, 
	company_id		INT UNSIGNED,	
	address			varchar(255)	NOT NULL, 
	contact_number		CHAR(10)	NOT NULL,

	PRIMARY KEY (location_id),
	FOREIGN KEY (company_id) REFERENCES Company(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);
