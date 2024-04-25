BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "User Table" (
	"UserId"	INTEGER NOT NULL UNIQUE,
	"UserName"	TEXT NOT NULL,
	"UserEmail"	TEXT NOT NULL UNIQUE,
	"UserPassswordChecksum"	TEXT NOT NULL,
	"admin bool"	INTEGER NOT NULL,
	PRIMARY KEY("UserId")
);
CREATE TABLE IF NOT EXISTS "Account Table" (
	"Account Id"	INTEGER NOT NULL UNIQUE,
	"Ballance"	REAL NOT NULL,
	"Currency"	TEXT NOT NULL,
	"UserId"	INTEGER NOT NULL,
	PRIMARY KEY("Account Id"),
	FOREIGN KEY("UserId") REFERENCES "User Table"("UserId")
);
CREATE TABLE IF NOT EXISTS "Transaction  Table" (
	"Transaction Id"	INTEGER NOT NULL UNIQUE,
	"Ammount"	REAL NOT NULL,
	"Time"	INTEGER NOT NULL UNIQUE,
	"Currency Convert"	REAL NOT NULL,
	PRIMARY KEY("Transaction Id")
);
CREATE TABLE IF NOT EXISTS "Transaction - account link table" (
	"Account Id"	INTEGER NOT NULL,
	"Transaction Id"	INTEGER NOT NULL,
	"Role"	TEXT NOT NULL,
	PRIMARY KEY("Account Id","Transaction Id"),
	FOREIGN KEY("Transaction Id") REFERENCES "Transaction  Table"("Transaction Id"),
	FOREIGN KEY("Account Id") REFERENCES "Account Table"("Account Id")
);
INSERT INTO "User Table" VALUES (1,'fuckyou','email','324653456',0);
INSERT INTO "Account Table" VALUES (1,1.0,'gbp',1);
INSERT INTO "Account Table" VALUES (2,2.0,'gbp',1);
INSERT INTO "Transaction  Table" VALUES (1,1.0,3463543,1.0);
INSERT INTO "Transaction - account link table" VALUES (1,1,'recipient');
INSERT INTO "Transaction - account link table" VALUES (2,1,'sender');
COMMIT;
