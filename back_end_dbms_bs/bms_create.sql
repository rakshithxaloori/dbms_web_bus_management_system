CREATE table admins(
    	username varchar(100) not null,
        password varchar(50) not null,
        name varchar(40) not null,
        age int(11) not null,
        gender varchar(20), not null,
        contact VARCHAR(15) not null,
        admin_login_count int(11) not null,
        primary key(username)
);
CREATE table users(
    	username varchar(100) not null,
        password varchar(50) not null,
        name varchar(40) not null,
        age int(11) not null,
        gender varchar(20), not null,
        contact VARCHAR(15) not null,
        user_login_count int(11) not null,
        primary key(username)
);

CREATE TABLE Model(
    Model_name varchar(50) not null,
    farepkm float not null,
    created_by varachar(100) not null,
    PRIMARY KEY(Model_name)
    FOREIGN KEY model_fk1 (created_by)REFERENCES admins(username),
    );


CREATE TABLE Bus(
    Bus_id int not null,
    Capacity int not null,
    vehicle_no varchar(20) not null ,
    Model_name varchar(50) not null,
    created_by VARCHAR(100) not null,
    CONSTRAINT bus_pk1 PRIMARY KEY(Bus_id),
    FOREIGN KEY bus_fk1(Model_name) REFERENCES Model(Model_name),
    FOREIGN KEY bus_fk2(created_by) REFERENCES admins(username),
    CONSTRAINT bus_uq1 UNIQUE(vehicle_no)
    );

CREATE ta