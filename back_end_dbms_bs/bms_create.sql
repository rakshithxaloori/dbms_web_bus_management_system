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

CREATE TABLE Station(
    station_code char(2) not null,
    place varchar(50) not null,
    station_name varchar(50) not null,
    created_by VARCHAR(100) not null,
    FOREIGN KEY st_fk1(created_by) REFERENCES admins(username),
    UNIQUE(station_name)
);

CREATE Table Ticket(
    Ticket_id int not null,
    Bus_id int not null,
    Source_code char(2) not null,
    Dest_code CHAR(2) not null,
    total_fare FLOAT not null,
    created_by varchar(100) not null,
    primary key (Ticket_id),
    FOREIGN KEY tc_fk1(Bus_id) REFERENCES Bus(Bus_id),
    FOREIGN KEY tc_fk2(created_by) REFERENCES users(username),
    FOREIGN KEY tc_fk3(Source_code) REFERENCES Station(station_code),
    FOREIGN KEY tc_fk4(Dest_code) REFERENCES Station(station_code)

);
create table Passenger(
    Pass_id int not null,
    Ticket_id int not null,
    Name varchar(50) not null,
    Age int not null,
    gender varchar(20) not null,
    created_by varchar(100) not null,

    primary key(Pass_id),
    FOREIGN key pass_fk1 (Ticket_id) REFERENCES Ticket(Ticket_id),
    FOREIGN KEY pass_fk2(created_by) REFERENCES users(username)

);
CREATE table Route(
    Route_id int not null,
    station_code char(2) not null,
    dis_from_source_in_km int not null,
    time_from_source_in_min int not null,
    created_by varchar(100) not null,

    CONSTRAINT rt_pk1 Primary key (Route_id,station_code),
    FOREIGN KEY rt_fk1(station_code) REFERENCES Station(station_code),
    FOREIGN KEY rt_fk2(created_by) REFERENCES admins(username)

    
);
CREATE TABLE Travel_on(
    Route_id int not null,
    Bus_id int not null,
    created_by varchar(100) not null,

    CONSTRAINT to_pk1 Primary key (Route_id,Bus_id),
    FOREIGN KEY to_fk1(Bus_id) REFERENCES Bus(Bus_id),
    FOREIGN KEY to_fk2(Route_id) REFERENCES Route(Route_id),
    FOREIGN KEY to_fk3(created_by) REFERENCES admins(username)
);

create table Travels_through(
    Bus_id int not null,
    station_code char(2) not null,
    arrv_time TIME not null,
    dept_time TIME not null,
    created_by varchar(100) not null,


    FOREIGN KEY tt_fk1(Bus_id) REFERENCES Bus(Bus_id),
    FOREIGN KEY tt_fk2(station_code) REFERENCES Station(station_code),
    CONSTRAINT tt_pk1 Primary key (station_code,Bus_id),
    FOREIGN KEY tt_fk3(created_by) REFERENCES admins(username)

);