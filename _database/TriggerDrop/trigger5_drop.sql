--Drops the trigger that checks to make sure when you update User the user has a non null location and country in if the User is a seller (in the Auction Table)
PRAGMA foreign_keys = ON;
insert into User values ("testUser", 1, "here", "here"); 
insert into Auction values ("-1", "Test", 1.00, null, .01, "now", "z", "test", "testUser");
update User set Location = "now its here" where UserID = "testUser";
delete from Auction where ItemID = "-1";
delete from User where UserID = "testUser";
drop trigger updateUserLocation;

