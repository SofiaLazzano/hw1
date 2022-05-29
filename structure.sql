create database structure;
use structure;

create table utente(
    nome varchar(35),
    cognome varchar(35),
    username varchar(255) ,
    email varchar(255) primary key,
    password varchar(255)
);

create table posts(
   id integer auto_increment primary key,
   user varchar(255),
   img varchar(255),
   nposts integer,
   nlikes integer default 0,
   description varchar(255),
   foreign key (user) references utente(email) on delete cascade on update cascade

);

CREATE TABLE likes (
    user varchar(255) not null,
    post integer not null ,
    foreign key(user) references utente(email) on delete cascade on update cascade,
    foreign key(post) references posts(id) on delete cascade on update cascade,
    primary key(user, post)
);


DELIMITER //
CREATE TRIGGER likes_trigger
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
UPDATE posts
SET nlikes = nlikes + 1
WHERE id = new.post;
END //
DELIMITER ;



DELIMITER //
CREATE TRIGGER unlikes_trigger
AFTER DELETE ON likes
FOR EACH ROW
BEGIN
UPDATE posts
SET nlikes = nlikes - 1
WHERE id = old.post;
END //
DELIMITER ;

