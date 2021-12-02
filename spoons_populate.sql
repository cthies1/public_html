begin transaction;
insert into quiz values (1, "Find Your Match",1);
insert into question values (1,"What is your zodiac sign?");
insert into question values (2,"Do you prefer to be a Big or Little spoon?");
insert into question values (3,"What is your primary love language?");
insert into question values (4,"Are you religious?");
insert into question values (5,"What kind of music do you listen to?");
insert into question values (6,"Where is your ideal place to live?");
insert into question values (7,"Are you an introvert or an extrovert?");
insert into question values (8,"Which of the following is your biggest pet peeve?");
insert into question values (9,"Do you smoke?");
insert into question values (10,"Do you drink?");
insert into question values (11,"Are you felixble with change?");
insert into question values (12,"Do you want kids?");
insert into question values (13,"What is your ideal age range?");
insert into quizquestions values (1,1);
insert into quizquestions values (2,1);
insert into quizquestions values (3,1);
insert into quizquestions values (4,1);
insert into users values ("johnsmith@test.com","test","john","smith",20);
insert into users values ("janesmith@test.com","test","jane","smith",21);
insert into users values ("willy@test.com","test","will","smith",30);
insert into users values ("ben@test.com","test","ben","smith",20);
insert into results values (1,1,"johnsmith@test.com","Aries");
insert into results values (1,2,"johnsmith@test.com","Big");
insert into results values (1,3,"johnsmith@test.com","Physical touch");
insert into results values (1,4,"johnsmith@test.com","I am religious");
insert into results values (1,1,"janesmith@test.com","Aquarius");
insert into results values (1,2,"janesmith@test.com","Little");
insert into results values (1,3,"janesmith@test.com","Physical touch");
insert into results values (1,4,"janesmith@test.com","I am religious");
insert into results values (1,1,"willy@test.com","Gemini");
insert into results values (1,2,"willy@test.com","Little");
insert into results values (1,3,"willy@test.com","Words of Affirmation");
insert into results values (1,4,"willy@test.com","I am not religious");
insert into results values (1,1,"ben@test.com","Taurus");
insert into results values (1,2,"ben@test.com","Big");
insert into results values (1,3,"ben@test.com","Acts of Service");
insert into results values (1,4,"ben@test.com","I am not religious");
insert into compatible values (1,"Aries","Aquarius");
insert into compatible values (1,"Aquarius","Aries");
insert into compatible values (1,"Gemini","Taurus");
insert into compatible values (1,"Taurus","Gemini");
insert into compatible values (2,"Big","Little");
insert into compatible values (2,"Little","Big");
insert into compatible values (3,"Physical touch","Physical touch");
insert into compatible values (3,"Words of Affirmation","Acts of Service");
insert into compatible values (3,"Acts of Service","Words of Affirmation");
insert into compatible values (4,"I am religious","I am religious");
insert into compatible values (4,"I am not religious","I am not religious");
commit;