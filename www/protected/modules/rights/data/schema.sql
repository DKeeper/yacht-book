drop table if exists rights_auth_item;
drop table if exists rights_auth_item_child;
drop table if exists rights_auth_assignment;
drop table if exists rights_rights;

create table rights_auth_item
(
   name varchar(64) not null,
   type integer not null,
   description text,
   bizrule text,
   data text,
   primary key (name)
);

create table rights_auth_item_child
(
   parent varchar(64) not null,
   child varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references rights_auth_item (name) on delete cascade on update cascade,
   foreign key (child) references rights_auth_item (name) on delete cascade on update cascade
);

create table rights_auth_assignment
(
   itemname varchar(64) not null,
   userid varchar(64) not null,
   bizrule text,
   data text,
   primary key (itemname,userid),
   foreign key (itemname) references rights_auth_item (name) on delete cascade on update cascade
);

create table rights_rights
(
	itemname varchar(64) not null,
	type integer not null,
	weight integer not null,
	primary key (itemname),
	foreign key (itemname) references rights_auth_item (name) on delete cascade on update cascade
);