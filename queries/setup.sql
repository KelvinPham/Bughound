/* Creates the database without data */
CREATE DATABASE bughound;

USE bughound;

/* Creates employees table */
CREATE TABLE bughound.employees ( 
    emp_id      INT(11)     NOT NULL AUTO_INCREMENT, 
    name        VARCHAR(32) NOT NULL, 
    username    VARCHAR(32) NOT NULL, 
    password    VARCHAR(32) NOT NULL, 
    userlevel   INT(11)     NOT NULL, 
    PRIMARY KEY (emp_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;

/* Creates programs table */
CREATE TABLE bughound.programs ( 
    prog_id         INT(11)     NOT NULL AUTO_INCREMENT, 
    program         VARCHAR(32) NOT NULL, 
    program_release VARCHAR(32) NOT NULL, 
    program_version VARCHAR(32) NOT NULL, 
    PRIMARY KEY (prog_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;

/* Creates areas table */
CREATE TABLE bughound.areas ( 
    area_id INT(11)     NOT NULL AUTO_INCREMENT, 
    prog_id INT(11)     NOT NULL, 
    area    VARCHAR(32) NOT NULL, 
    PRIMARY KEY (area_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;

/* Creates bugs table which stores bug reports */
CREATE TABLE bughound.bugs (
    bug_id      INT(11)         NOT NULL AUTO_INCREMENT,
    prog_id     INT(11)         NOT NULL,
    bug_type    ENUM('Coding Error', 'Design Issue', 'Suggestion', 'Documentation', 'Hardware', 'Query') NOT NULL,
    severity    ENUM('Minor', 'Serious', 'Fatal') NOT NULL,
    summary     VARCHAR(64)     NOT NULL,
    reproduce   BOOLEAN         NOT NULL,
    problem     VARCHAR(500)    NOT NULL,
    suggest_fix VARCHAR(500),
    emp_id      INT(11)         NOT NULL,
    dDate       DATE            NOT NULL,
    bugOp_id    INT(11),
    PRIMARY KEY (bug_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;

/* Creates attachment table which stores the attachment type and data for each bug */
CREATE TABLE bughound.attachments (
    attach_id   INT(11)         NOT NULL AUTO_INCREMENT,
    bug_id      INT(11)         NOT NULL,
    attach_name VARCHAR(64)     NOT NULL,
    attach_type VARCHAR(64)     NOT NULL,
    attach_data MEDIUMBLOB      NOT NULL,
    PRIMARY KEY(attach_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;

/* Creates bugOptional table which stores the optional fields in a bug report */
CREATE TABLE bughound.bugOptional (
    bugOp_id    INT(11) NOT NULL AUTO_INCREMENT,
    area_id     INT(11),
    aEmp        INT(11),
    comments    VARCHAR(255),
    status      ENUM('Open', 'Closed', 'Resolved'),
    priority    INT(1),
    resolution  ENUM('Pending', 'Fixed', 'Irreproducible', 'Deferred', 'As designed', 'Withdrawn by reporter', 'Need more information', 'Disagree with suggestion', 'Duplicate'),
    res_version INT(11),
    rEmp        INT(11),
    rDate       DATE,
    tEmp        INT(11),
    tDate       DATE,
    deferred    BOOLEAN,
    PRIMARY KEY(bugOp_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;

/* Adds foreign key prog_id to areas */
ALTER TABLE areas ADD CONSTRAINT area_prog FOREIGN KEY (prog_id) REFERENCES programs(prog_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* Adds foreign keys to bug */
ALTER TABLE bugs ADD CONSTRAINT bug_prog FOREIGN KEY (prog_id) REFERENCES programs(prog_id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE bugs ADD CONSTRAINT bug_emp FOREIGN KEY (emp_id) REFERENCES employees(emp_id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE bugs ADD CONSTRAINT bug_bugOp FOREIGN KEY (bugOp_id) REFERENCES bugOptional(bugOp_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* Add foreign key bug_id to attachments */
ALTER TABLE attachments ADD CONSTRAINT attachment_bug FOREIGN KEY (bug_id) REFERENCES bugs(bug_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* Adds foreign keys to bugOptional */
ALTER TABLE bugOptional ADD CONSTRAINT bugOp_area FOREIGN KEY (area_id) REFERENCES areas(area_id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE bugOptional ADD CONSTRAINT bugOp_aEmp FOREIGN KEY (aEmp) REFERENCES employees(emp_id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE bugOptional ADD CONSTRAINT bugOp_rEmp FOREIGN KEY (rEmp) REFERENCES employees(emp_id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE bugOptional ADD CONSTRAINT bugOp_tEmp FOREIGN KEY (tEmp) REFERENCES employees(emp_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* Increments starting id for all tables to 1000 */
ALTER TABLE employees AUTO_INCREMENT = 1000;
ALTER TABLE programs AUTO_INCREMENT = 1000;
ALTER TABLE areas AUTO_INCREMENT = 1000;
ALTER TABLE bugs AUTO_INCREMENT = 1000;
ALTER TABLE attachments AUTO_INCREMENT = 1000;
ALTER TABLE bugOptional AUTO_INCREMENT = 1000;

/* Default Admin and User */
INSERT INTO employees (emp_id, name, username, password, userlevel) VALUES 
(NULL,'root', 'root', SHA2('root', 512), 3),
(NULL,'user', 'user', SHA2('user', 512), 1);

