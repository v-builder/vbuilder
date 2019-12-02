


create table if not exists vbd_user_level(
ulevel_id int(10) not null auto_increment,
ulevel_name varchar(20) not null,
ulevel_desc text,
deleted enum('true','false') default 'false',
primary key(ulevel_id)
);



create table if not exists vbd_user(
user_id int(10) not null auto_increment,
ulevel_id int(10) not null references vbd_user_level(ulevel_id),
user_rid varchar(50) not null,
user_rn varchar(50) not null,
user_photo int(10) references vbd_upload(upload_id),
user_idate varchar(50) not null,
user_name varchar(20) not null unique,
user_email varchar(100) not null unique,
user_password text,
user_state enum('0','1','2') default '1',
user_email_conf enum('true','false') default 'false',
deleted enum('true','false') default 'false',
primary key(user_id)
);

create table if not exists vbd_log_track(
log_id int(10) not null auto_increment,
user_id int(10) not null references vbd_user(user_id),
device_name text not null,
log_key text not null,
log_guide text not null,
log_extra text,
log_date datetime not null,
log_date_exp datetime not null,
log_state enum('0','1') default '1',
deleted enum('true','false') default 'false',
primary key(log_id)
);

create table if not exists vbd_rp(
rp_id int(10) not null auto_increment,
rp_email varchar(60) not null,
user_id int(10) not null references vbd_user(user_id),
rp_code text not null,
rp_date datetime not null,
rp_date_exp datetime not null,
rp_state enum('0','1') default '0',
deleted enum('true','false') default 'false',
primary key(rp_id)
);

create table if not exists vbd_at(

vbd_at_id int(10) not null auto_increment,
vbd_at_type varchar(50) not null ,
vbd_at_desc text,
deleted enum('true','false') default 'false',
primary key(vbd_at_id)

);


create table if not exists vbd_user_pdata(

usp_id int(10) not null auto_increment,
user_id int(10) unique not null references vbd_user(user_id),
vbd_at_id int(10) references vbd_at(vbd_at_id),
usp_label_value text,
usp_type_value text,
user_bdate date,
phone_code varchar(60),
phone_number varchar(60),
phone_number_alt  varchar(60),
phone_shown enum('def','alt') default 'def',

gender enum('male','female') default 'male',
about text,
bio text,
deleted enum('true','false') default 'false',

primary key(usp_id)

);


-- start of upload tabs ----------------------------------------

create table if not exists vbd_upload_group(
upg_id int(10) not null auto_increment,
user_id int(10) references vbd_user(user_id),
upg_date datetime not null,
upg_desc text,
deleted enum('true','false') default 'false',
primary key(upg_id)
) charset='UTF8';

create table if not exists vbd_upload(
upload_id int(10) not null auto_increment,
upload_date  datetime not null,
upload_privacy enum('public','private') default 'public',
file_type varchar(50) not null,
file_path text not null,
file_name text,
file_ext text,
file_size text ,
user_id int(10) references vbd_user(user_id),
upg_id int(10) references vbd_upload_group(upg_id),
c int(10) references vbd_user(user_id),
deleted enum('true','false') default 'false',
primary key(upload_id)
) charset='UTF8';



-- end of upload tabs ----------------------------------------


-- newsletter tabs ----------------------------------------

create table if not exists vbd_nsemail(
nsemail_id int(10) not null auto_increment,
nsemail_name varchar(30),
nsemail_email varchar(100) unique not null,
nsemail_date datetime not null,
deleted enum('true','false') default 'false',
primary key(nsemail_id)
) charset='UTF8';

create table if not exists vbd_newsletter(
ns_id int(10) not null auto_increment,
ns_date datetime not null,
ns_subject varchar(50),
ns_body text,
ns_altbody text,
ns_cleanbody text,
ns_attach int(10) references vbd_upload_group(upg_id),
user_id int(10) references vbd_user(user_id),
ns_cover int(10) references vbd_upload_group(upg_id),
ns_pdf int(10) references vbd_upload_group(upg_id),
deleted enum('true','false') default 'false',
primary key(ns_id)
) charset='UTF8';

create table if not exists vbd_ns_mail(
nsmail_id int(10) not null auto_increment,
nsmail_date datetime not null,
ns_id int(10) not null references vbd_newsletter(ns_id),
nsemail_id int(10) not null references vbd_nsemail(nsemail_id),
ns_state enum('true','false'),
deleted enum('true','false') default 'false',
primary key(nsmail_id)
) charset='UTF8';

-- endof newsletter tabs ----------------------------------------


--       This may only concern the AX App
create table if not exists connection_request(
cr_id int(10) not null auto_increment,
from_user_id int(10) not null references vbd_user(user_id),
to_user_id int(10) not null references vbd_user(user_id),
cr_date datetime ,
cr_date_response datetime ,
cr_state enum('0','1','2') default '1',
cr_response enum('0','1','2') default '2',
deleted enum('true','false') default 'false',
primary key(cr_id)
);

CREATE UNIQUE INDEX connection_request
  ON connection_request(from_user_id, to_user_id);
--       End of: This may only concern the AX App


-- DEFAULT  DATA


-- USER LEVELS
INSERT INTO `vbd_user_level` (`ulevel_id`, `ulevel_name`, `ulevel_desc`, `deleted`) VALUES
(1, 'Super Admin', 'All tasks', 'false'),
(2, 'Admin L1', 'All admin level tasks', 'false'),
(3, 'Admin L2', 'Admin L2', 'false'),
(4, 'Admin L3', 'Admin L3', 'false'),
(5, 'Custom User L1', 'Custom User', 'false'),
(6, 'Custom User L2', 'Custom User L2', 'false');

-- ACCOUNT TYPE [personal data]
INSERT INTO `vbd_at` (`vbd_at_id`, `vbd_at_type`, `vbd_at_desc`, `deleted`) VALUES
(1, 'Professional', 'Account having as owner a worker', 'false'),
(2, 'Student', 'Account having as owner a student', 'false'),
(3, 'Entity', 'Account having as owner a Entity', 'false');




-- DEFAULT ADMIN ACCOUNT
-- USER : vbuilder     /      vbuilder_user
-- PASSWORD: enableVBUILDER
INSERT INTO `vbd_user` (`user_id`, `ulevel_id`, `user_rid`, `user_rn`, `user_photo`, `user_idate`, `user_name`, `user_email`, `user_password`, `user_state`, `user_email_conf`, `deleted`) VALUES
(1, 1, 'LAJ4ORp4309','Vbuilder Inc.', NULL, '11/09/2019, Wednesday 02:30 PM', 'vbuilder', 'vbuilder@vbuilder.xxx', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyJlbmFibGVWQlVJTERFUiJd.UhAIoc3JG9e-EM6BPja2xGvoRGSCD8u58UKhuZIkHKw', '1', 'false', 'false'),
(2, 5, 'LAJ4ORp4301','Vbuilder Inc.', NULL, '11/09/2019, Wednesday 02:30 PM', 'vbd_user', 'vbuilder_user@vbuilder.xxx', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.WyJlbmFibGVWQlVJTERFUiJd.UhAIoc3JG9e-EM6BPja2xGvoRGSCD8u58UKhuZIkHKw', '1', 'false', 'false');


-- DEFAULT ADMIN USPDATA ( User Personal Data )
INSERT INTO `vbd_user_pdata` (`usp_id`,`user_id`,`vbd_at_id`) VALUES
(1,1,1), (2,2,1);

