CREATE TABLE kakecoder.contests(
  contest_id varchar(32) NOT NULL,
  contest_name varchar(32) NOT NULL,
  start_time datetime NOT NULL,
  end_time datetime NOT NULL,
 PRIMARY KEY (contest_id)
);
CREATE TABLE kakecoder.problem(
  contest_id varchar(32) NOT NULL,
  problem_id varchar(4) NOT NULL,
  point int,
  testcase_path varchar(255),
  PRIMARY KEY (contest_id, problem_id)
);
CREATE TABLE kakecoder.uploads (
    code_session varchar(32) NOT NULL,
    problem varchar(1) NOT NULL,
    user_id varchar(32) NOT NULL,
    upload_date datetime,
    PRIMARY KEY (code_session)
);