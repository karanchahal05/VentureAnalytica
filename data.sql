create table users (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    email varchar(300) not null,
    fullname varchar(300) not null,
    passwrd varchar(100) not null
);

create table ventures (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    email text not null,
    problem text not null,
    solution text not null,
    title varchar(300) not null,
    innovation int(11) not null,
    impact int(11) not null,
    feasability int(11) not null,
    overall_rating int(11) not null,
    custominput text not null
)

create table spam (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    email text not null,
    problem text not null,
    solution text not null,
    title varchar(300) not null
)