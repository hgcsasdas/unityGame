create table plan
(
    id     int auto_increment
        primary key,
    titulo varchar(50) not null
);

create table users
(
    id         int auto_increment
        primary key,
    nombre     varchar(20)      not null,
    apellido   varchar(20)      not null,
    nickname   varchar(20)      not null,
    mail       varchar(100)     not null,
    contrasena char(128)        null,
    edad       int              null,
    docente    bit default b'0' not null
);

create table exam
(
    cod_examen  int auto_increment
        primary key,
    duracion    double not null,
    contenido   json   null,
    id_alumno   int    not null,
    id_profesor int    not null,
    constraint exam_ibfk_1
        foreign key (id_profesor) references users (id),
    constraint exam_ibfk_2
        foreign key (id_alumno) references users (id)
);

create index id_alumno
    on exam (id_alumno);

create index id_profesor
    on exam (id_profesor);

create table modules
(
    id_modulo   int auto_increment
        primary key,
    titulo      varchar(50) not null,
    resumen     text        not null,
    id_profesor int         not null,
    constraint modules_ibfk_1
        foreign key (id_profesor) references users (id)
);

create table classes
(
    codigo_clase    int auto_increment
        primary key,
    nombre          varchar(200) not null,
    duracion        double       not null,
    contenido       text         not null,
    video           varchar(200) not null,
    codigo_examen   int          not null,
    codigo_modulo   int          not null,
    codigo_alumno   int          not null,
    codigo_profesor int          not null,
    constraint classes_ibfk_1
        foreign key (codigo_alumno) references users (id),
    constraint classes_ibfk_2
        foreign key (codigo_profesor) references users (id),
    constraint classes_ibfk_3
        foreign key (codigo_modulo) references modules (id_modulo),
    constraint classes_ibfk_4
        foreign key (codigo_examen) references exam (cod_examen)
);

create index codigo_alumno
    on classes (codigo_alumno);

create index codigo_examen
    on classes (codigo_examen);

create index codigo_modulo
    on classes (codigo_modulo);

create index codigo_profesor
    on classes (codigo_profesor);

create index id_profesor
    on modules (id_profesor);

create table payment
(
    id_pago   int auto_increment
        primary key,
    fecha     datetime not null,
    id_plan   int      not null,
    id_alumno int      not null,
    constraint payment_ibfk_1
        foreign key (id_plan) references plan (id),
    constraint payment_ibfk_2
        foreign key (id_alumno) references users (id)
);

create index id_alumno
    on payment (id_alumno);

create index id_plan
    on payment (id_plan);

create table session
(
    id_sesion  int auto_increment
        primary key,
    hora       time not null,
    fecha      date not null,
    id_usuario int  not null,
    constraint session_ibfk_1
        foreign key (id_usuario) references users (id)
);

create index id_usuario
    on session (id_usuario);


