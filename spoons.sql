create table Quiz(
    QuizID integer primary key,
    Title text,
    Require integer check (0<= Require and Require<=1)
);

create table Users(
    Email text primary key check(Email like "%@%"),
    Password text,
    fName text,
    lName text,
    Age integer check(Age>18)
);

create table Question(
    QuestionID integer primary key,
    Quest text
);

create table QuizQuestions(
    QuestionID integer,
    QuizID integer,
    primary key(QuestionID, QuizID),
    foreign key (QuestionID) references Question(QuestionID)
        on update CASCADE
        on delete CASCADE,
    foreign key (QuizID) references Quiz(QuizID)
        on update CASCADE
        on delete CASCADE
);

create table Admin(
    Email text primary key check(Email like "%@%"),
    Password text,
    fName text,
    lName text
);

create table Match(
    User1 text check(User1 like "%@%"),
    User2 text check(User2 like "%@%"),
    matchPercent integer check(0<=matchPercent and matchPercent<=100),
    date text check(date like "%/%/%"),
    primary key(User1,User2),
    foreign key (User1) references Users(email)
        on update CASCADE
        on delete cascade,
    foreign key(User2) references Users(email)
        on update cascade
        on delete cascade
);

create table Report(
    UserID text primary key check(UserID like "%@%"),
    reason text,
    numReports integer,
    foreign key(UserID) references Users(email)
        on update cascade
);

create table Results(
    QuizID integer,
    QuestionID integer,
    UserID text check(userID like "%@%"),
    response text,
    primary key(QuestionID, QuizID, UserID),
    foreign key(QuestionID) references Question(QuestionID)
        on update cascade
        on delete cascade,
    foreign key (QuizID) references Quiz(QuizID)
        on update cascade
        on delete cascade,
    foreign key (UserID) references Users(email)
        on update cascade
        on delete cascade
);

create table unMatch(
    User1 text check(User1 like "%@%"),
    User2 text check(User2 like "%@%"),
    date text check(date like "%/%/%"),
    primary key(User1,User2),
    foreign key (User1) references Users(email)
        on update CASCADE
        on delete cascade,
    foreign key(User2) references Users(email)
        on update cascade
        on delete cascade
);

create table Compatible(
    QuestionID integer,
    r1 text,
    r2 text,
    primary key(QuestionID, r1,r2),
    foreign key(QuestionID) references Question(QuestionID)
        on update cascade
        on delete cascade
);
