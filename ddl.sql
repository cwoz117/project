CREATE DATABASE IF NOT EXISTS truckco;
USE DATABASE truckco;

--We need a way to make sure contractor_id is
-- a unique surrogate key, I think its 'CREATE UNIQUE INDEX contractor_id' but not sure

CREATE TABLE Users(
	user_id		INT		UNSIGNED AUTO INCREMENT,
	username	varchar(10)	NOT NULL UNIQUE,
	password	varchar(16)	NOT NULL,
	admin		BOOLEAN,

	PRIMARY KEY (user_id)
)

CREATE TABLE Employees(
	employee_id	INT		UNSIGNED AUTO INCREMENT,
	user_id		INT		NOT NULL,
	permissions	TINYBIT(2),
	
	PRIMARY KEY (employee_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)

CREATE TABLE Drivers(
	driver_id	INT		UNSIGNED AUTO INCREMENT,
	user_id		INT		NOT NULL,
	wcb		INT		NOT NULL, -- We should create a constraint following the specific format
	license_number	INT		NOT NULL, -- We should create a constraint following the specific format
	province	CHAR(2)		NOT NULL,
	expiration	DATE,
	contractor_id	INT		NOT NULL, -- GOTTA MAKE THIS AN INDEX

	PRIMARY KEY (driver_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)

CREATE TABLE ContractEmployers(

)

CREATE TABLE Trucks(

)

CREATE TABLE Trailers(

)

CREATE TABLE Companies(

)

CREATE TABLE Locations(

)

CREATE TABLE Payloads(

)

CREATE TABLE PolicyRequirements(

)

CREATE TABLE Workorder(

)

CREATE TABLE Post(

)

CREATE TABLE Banking(

)

CREATE TABLE AcceptedContracts(

)
